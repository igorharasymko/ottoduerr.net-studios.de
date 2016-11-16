<?php

	$flipbooks = get_option("flipbooks");

	if(!$flipbooks){
		$flipbooks = array();
		add_option("flipbooks", $flipbooks);
	}

	function read3d_flipbook_admin_init(){

	}
	add_action("admin_init", "read3d_flipbook_admin_init");
	
	function read3d_flipbook_admin_menu(){
		add_options_page("Real 3D Flipbook Admin", "Real3D Flipbook", "publish_posts", "real3d_flipbook_admin", "real3d_flipbook_admin"); 
		add_menu_page("Real 3D Flipbook Admin", "Real3D Flipbook", "publish_posts", "real3d_flipbook_admin", "real3d_flipbook_admin",'dashicons-book'); 
	}
	add_action("admin_menu", "read3d_flipbook_admin_menu");
	
	//options page
	function real3d_flipbook_admin()
    {
		$current_action = $current_id = $page_id = '';
		// handle action from url
		if (isset($_GET['action']) ) {
			$current_action = $_GET['action'];
		}

		if (isset($_GET['bookId']) ) {
			$current_id = $_GET['bookId'];
		}
		
		if (isset($_GET['pageId']) ) {
			$page_id = $_GET['pageId'];
		}

		$flipbooks = get_option("flipbooks");
		
		// trace($current_action);
		switch( $current_action ) {
		
			case 'edit':
				include("edit-flipbook.php");
				break;
				
			case 'delete':
				//backup
				$flipbooks_backup = get_option("flipbooks_backup");
				if(!$flipbooks_backup){
					add_option("flipbooks_backup", array());
				}
				update_option("flipbooks_backup", get_option('flipbooks'));
				
				
				$ids = explode(',', $current_id);
				
				foreach ($ids as $id) {
					unset($flipbooks[$id]);
				}
				
				//delete flipbook with id from url
				
				update_option("flipbooks", $flipbooks);
				include("flipbooks.php");
				// trace($flipbooks[$current_id]['name']);
				// trace(REAL3D_FLIPBOOK_DIR);
				////delete folder books/$flipbooks[$current_id]['name']
				// $bookFolder = $flipbooks[$current_id]['name'];
				// trace(REAL3D_FLIPBOOK_DIR.'books/'.$bookFolder);
				// rrmdir(REAL3D_FLIPBOOK_DIR.'books/'.$bookFolder);
				break;
				
			case 'delete_all':
				//backup
				$flipbooks_backup = get_option("flipbooks_backup");
				if(!$flipbooks_backup){
					add_option("flipbooks_backup", array());
				}
				update_option("flipbooks_backup", get_option('flipbooks'));
				
				update_option('flipbooks',array());
				include("flipbooks.php");
				break;
				
			case 'duplicate':
				$highest_id = 0;
				foreach ($flipbooks as $flipbook) {
					$flipbook_id = $flipbook["id"];
					if($flipbook_id > $highest_id) {
						$highest_id = $flipbook_id;
					}
				}
				$new_id = $highest_id + 1;
				$flipbooks[$new_id] = $flipbooks[$current_id];
				$flipbooks[$new_id]["id"] = $new_id;
				$flipbooks[$new_id]["name"] = $flipbooks[$current_id]["name"]." (copy)";
				
				$flipbooks[$new_id]["date"] = current_time( 'mysql' );
				update_option("flipbooks", $flipbooks);
				include("flipbooks.php");
				break;
				
			case 'add_new':
				//generate ID 
				$new_id = 0;
				$highest_id = 0;
				foreach ($flipbooks as $flipbook) {
					$flipbook_id = $flipbook["id"];
					if($flipbook_id > $highest_id) {
						$highest_id = $flipbook_id;
					}
				}
				$current_id = $highest_id + 1;
				//create new book 
				$book = array(	"id" => $current_id, 
								"name" => "flipbook " . $current_id,
								"pages" => array()
						);
				$flipbooks[$current_id] = $book;
				$flipbooks[$current_id]["date"] = current_time( 'mysql' );
				update_option("flipbooks", $flipbooks);
				include("edit-flipbook.php");
				break;
				
			case 'save_settings':
			
				if($flipbooks && $current_id != ''){
					$flipbook = $flipbooks[$current_id];
					if($flipbook){
						$pages = $flipbook["pages"];
					}
				}
		
		
				// trace($flipbooks[$current_id]);
				 // trace($_POST);
				
				//clear pages array if delete all pages
				if (!isset($_POST['pages']) ) {
					$_POST['pages'] = array();
				}
				$new = array_merge($flipbook, $_POST);
				$flipbooks[$current_id] = $new;
				//reset indexes because of sortable pages can be rearranged
				$oldPages = $flipbooks[$current_id]["pages"];
				$newPages = array();
				$index = 0;
				foreach($oldPages as $p){
					$newPages[$index] = $p;
					$index++;
				}
				$flipbooks[$current_id]["pages"] = $newPages;
								
				//for each page
				for($i = 0; $i < count($flipbooks[$current_id]["pages"]); $i++){
					$p = $flipbooks[$current_id]["pages"][$i];

					if(isset($p["links"])){
						//reset links 
						$oldLinks = $p["links"];
						if($oldLinks){
							$newLinks = array();
							$index = 0;
							foreach($oldLinks as $lnk){
								$newLinks[$index] = $lnk;
								$index++;
							}
							$flipbooks[$current_id]["pages"][$i]["links"] = $newLinks;
							$p = $flipbooks[$current_id]["pages"][$i];
							//for each link in links
							$formattedLinks = array();
							for($j = 0; $j < count($p["links"]); $j++){
								$l = $p["links"][$j];
								$formattedLink = array_map("cast", $l);
								$formattedLinks[$j] = $formattedLink;
							}
							$flipbooks[$current_id]["pages"][$i]["links"] = $formattedLinks;
						}
					}	
				}
				update_option("flipbooks", $flipbooks);
				include("edit-flipbook.php");
				break;
				
			case 'generate_json':
				// trace("generate_json");
				// trace($_POST);
				include("flipbooks.php");
				break;
			
			case 'import_from_json':
				// trace("import_from_json");
				// trace($_POST);
				include("flipbooks.php");
				break;
			
			case 'import_from_json_confirm':
				//backup
				$flipbooks_backup = get_option("flipbooks_backup");
				if(!$flipbooks_backup){
					add_option("flipbooks_backup", array());
				}
				update_option("flipbooks_backup", get_option('flipbooks'));
				
				// trace("import_from_json_confirm");
				// trace($_POST['flipbooks']);
				$json = stripslashes($_POST['flipbooks']);
				// trace($_POST['flipbooks']);
				if((string)$json != "" && is_array(real3dflipbook_objectToArray(json_decode($json)))){
					update_option("flipbooks", real3dflipbook_objectToArray(json_decode($json)));
				}
				
				// trace($_POST['flipbooks'] !== "");
				// trace($_POST['flipbooks']);
				// trace(json_decode(stripslashes($_POST['flipbooks'])));
				include("flipbooks.php");
				break;
				
			case 'undo':
				$flipbooks_backup = get_option("flipbooks_backup");
				if($flipbooks_backup){
					update_option("flipbooks", $flipbooks_backup);
				}
				include("flipbooks.php");
				break;
			
			default:
				include("flipbooks.php");
				break;
				
		}
    }
	
	
	function real3dflipbook_objectToArray($d) {
		if (is_object($d)) {
			// Gets the properties of the given object
			// with get_object_vars function
			$d = get_object_vars($d);
		}

		if (is_array($d)) {
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return array_map(__FUNCTION__, $d);
		}
		else {
			// Return array
			return $d;
		}
	}				
	
	function cast($n)
	{
		if($n === "true") {
			return true;
		}else if ($n === "false"){
			return false;
		}else if(is_numeric($n)){
			// return (int)$n;
			return floatval($n);
		}else{
			return $n;
		}
	}
	
	