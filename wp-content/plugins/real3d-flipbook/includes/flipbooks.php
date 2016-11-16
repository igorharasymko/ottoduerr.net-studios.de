<?php
function sksort(&$array, $subkey="id", $sort_ascending=false) {

    if (count($array))
        $temp_array[key($array)] = array_shift($array);

    foreach($array as $key => $val){
        $offset = 0;
        $found = false;
        foreach($temp_array as $tmp_key => $tmp_val)
        {
            if(!$found and strtolower($val[$subkey]) > strtolower($tmp_val[$subkey]))
            {
                $temp_array = array_merge(    (array)array_slice($temp_array,0,$offset),
                                            array($key => $val),
                                            array_slice($temp_array,$offset)
                                          );
                $found = true;
            }
            $offset++;
        }
        if(!$found) $temp_array = array_merge($temp_array, array($key => $val));
    }

    if ($sort_ascending) $array = array_reverse($temp_array);

    else $array = $temp_array;
}

$flipbooks = get_option("flipbooks");
if(!is_array($flipbooks) ){
	$flipbooks = array();
	update_option('flipbooks',$flipbooks);
}
$pageSize = 20;
$flipbooksCount = count($flipbooks);
// $flipbooksCount = 62;
$pagesCount = ceil($flipbooksCount / $pageSize);

$pageId = 1;
if (isset($_GET['pageid']))
	$pageId = $_GET['pageid'];
$url=admin_url( "admin.php?page=real3d_flipbook_admin" );

$orderBy = '';
if (isset($_GET['orderby']))
	$orderBy = $_GET['orderby'];
	
$order = '';
if (isset($_GET['order']))
	$order = $_GET['order'];

?>

<div class="wrap">
	<h2>Manage Flipbooks
		<a href='<?php echo $url . "&action=add_new" ?>' class='add-new-h2'>Add New</a>
	</h2>
	
	<?php
				
		if (isset($_GET['action'])){
	
		if($_GET['action'] == "delete"){

		$flipbooks_backup = get_option("flipbooks_backup");
		$names = '';
		$ids = explode(',', $_GET['bookId']);
		// trace(count($ids));
		if(count($ids) == 1)
			$prefix = 'Flipbook';
		else
			$prefix = 'Flipbooks';
		foreach ($ids as $id) {
		// trace($id);
			if($names != '')
				$names = $names . ', ';
			$names = $names . $flipbooks_backup[$id]['name'];
		}
		
			echo '<div id="message" class="updated notice is-dismissible below-h2">
					<p><strong>'.$prefix .' </strong><i>' . $names.'</i> <strong>deleted</strong>. <a href="'.$url . '&action=undo">Undo		</a></p>
					<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
				</div>';
		
		}elseif($_GET['action'] == "delete_all"){
		
			echo '<div id="message" class="updated notice is-dismissible below-h2">
					<p>All Flipbooks deleted. <a href="'.$url . '&action=undo">Undo		</a></p>
					<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
				</div>';
		
		}elseif($_GET['action'] == "import_from_json_confirm" ) {
					
			echo '<div id="message" class="updated notice is-dismissible below-h2">
					<p>Flipbooks imported from JSON. <a href="'.$url . '&action=undo">Undo		</a></p>
					<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
				</div>';
		}	
	}		
	
	?>			
				

	<div class="tablenav top">
		<div class="alignleft actions bulkactions">
			<label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label>
			<select name="action" id="bulk-action-selector-top">
				<option value="-1" selected="selected">Bulk Actions</option>
				<option value="trash">Trash</option>
			</select>
			<input type="submit" id="doaction" class="button action bulkactions-apply" value="Apply">
		</div>
		
		
		<div class="tablenav-pages 
		<?php 
			if($flipbooksCount <= $pageSize) echo ("one-page");
		?>
		"><span class="displaying-num">
		<?php
			echo($flipbooksCount);
		?>
		items</span>
		<span class="pagination-links"><a class="first-page <?php if($pageId == 1) echo 'disabled'?>" title="Go to the first page" href="
		<?php 
			if($pageId > 1) {
				echo($url . '&pageid=1');
				if($orderBy != '' && $order != ''){
					echo('&orderby='.$orderBy.'&order='.$order);
				}
			}else{
				echo '#';
			}
		?>
		">«</a>
		<a class="prev-page <?php if($pageId == 1) echo 'disabled'?>" title="Go to the previous page" href="
		<?php 
			if($pageId > 1) {
				echo($url . '&pageid=' . ($pageId -1));
				if($orderBy != '' && $order != ''){
					echo('&orderby='.$orderBy.'&order='.$order);
				}
			}else{
				echo '#';
			}
		?>
		">‹</a>
		<span class="paging-input"><label for="current-page-selector" class="screen-reader-text">Select Page</label><input class="current-page" id="current-page-selector" title="Current page" type="text" name="paged" value="<?php 
			echo $pageId;
		?>" size="1"> of <span class="total-pages"><?php echo($pagesCount)?></span></span>
		<a class="next-page <?php if($pageId == $pagesCount) echo 'disabled'?>" title="Go to the next page" href="
		<?php 
			if($pageId < $pagesCount) {
				echo($url . '&pageid=' . ($pageId +1));
				if($orderBy != '' && $order != ''){
					echo('&orderby='.$orderBy.'&order='.$order);
				}
			}else{
				echo '#';
			}
		?>
		">›</a>
		<a class="last-page <?php if($pageId == $pagesCount) echo 'disabled'?>" title="Go to the last page" href="
		<?php 
			if($pageId < $pagesCount) {
				echo($url . '&pageid=' . $pagesCount);
				if($orderBy != '' && $order != ''){
					echo('&orderby='.$orderBy.'&order='.$order);
				}
			}else{
				echo '#';
			}
		?>
		">»</a></span></div>
	</div>	
	
	
	
	<table class='flipbooks-table wp-list-table widefat fixed striped pages'>
	<?php 
	if(count($flipbooks) > 0){
	
	echo '<thead>
			<tr>
				<th scope="col" id="cb" class="manage-column column-cb check-column" style="">
					<label class="screen-reader-text" for="cb-select-all-1">Select All</label>
					<input id="cb-select-all-1" type="checkbox">
				</th>
			
				<th scope="col" id="name" class="manage-column column-title sorted ';
				
					if ($orderBy == "name" && $order == 'asc')
						echo 'asc';
					else
						echo 'desc';
				echo '
				"><a href="';
				
				$str = 'asc';
				if ($orderBy == "name"){
					if($order == 'asc')
						$str = 'desc';
				}
				echo $url .'&orderby=name&order='.$str .'"><span>Name</span><span class="sorting-indicator"></span></a></th>
				
				<th style="width:150px">Shortcode</th>
				
				<th style="width:100px" scope="col" id="date" class="manage-column column-date sorted ';
				
					if ($orderBy == "date" && $order == 'desc')
						echo 'desc';
					else
						echo 'asc';
				echo '
				"><a href="	';
				
				$str = 'desc';
				if ($orderBy == "date"){
					if($order == 'desc')
						$str = 'asc';
				}
				echo $url .'&orderby=date&order='.$str .'"><span>Date</span><span class="sorting-indicator"></span></a></th>
			</tr>
			</thead>'; 
		}
			
		echo '<tbody>';
				
				foreach ($flipbooks as $flipbook) {
					$flipbook_id = $flipbook["id"];
					if(!isset($flipbooks[$flipbook_id]["date"]))
						$flipbooks[$flipbook_id]["date"] = '';
				}
		
		
				// $flipbooks = update_option("flipbooks",Array());
				// trace($flipbooks);
 
				if (count($flipbooks) == 0) {
					echo '<tr>'.
							 '<td colspan="100%">No Flipbooks found.</td>'.
						 '</tr>';
				} else {
				
					if ($orderBy == "id"){
						sksort($flipbooks, "id", $order == 'asc');
					}elseif($orderBy == "name"){
						sksort($flipbooks, "name", $order == 'asc');
					}elseif($orderBy == "date"){
						sksort($flipbooks, "date", $order == 'asc');
					}else{
						sksort($flipbooks, "id");
					}
					// $pageSize = 5;
					// $pageId = 2;
					$row = 0;
					$flipbook_display_name;
					foreach ($flipbooks as $flipbook) {
						$row++;
						if($row <= ($pageId - 1)*$pageSize || $row > $pageId  * $pageSize)
							continue;
						$flipbook_display_name = $flipbook["name"];
						if(!$flipbook_display_name) {
							$flipbook_display_name = 'Flipbook #' . $flipbook["id"] . ' (no name)';
						}
						$flipbook_date = '';
						if(isset($flipbook["date"]))
							$flipbook_date = $flipbook["date"];
						echo '<tr>
								<th scope="row" class="manage-column column-cb check-column">
									<input type="checkbox" class="row-checkbox" name="'.$flipbook["id"] .'">
								</th>					
								<td>
									<strong><a href="' . admin_url('admin.php?page=real3d_flipbook_admin&action=edit&bookId=' . $flipbook["id"]) . '" title="Edit">'.$flipbook_display_name.'</a></strong>
									<div class="row-actions"><span class="edit"><a href="' . admin_url('admin.php?page=real3d_flipbook_admin&action=edit&bookId=' . $flipbook["id"]) . '" title="Edit this item">Edit</a> | </span><span class="inline hide-if-no-js"><a href="' . admin_url('admin.php?page=real3d_flipbook_admin&action=duplicate&bookId='  . $flipbook["id"]) . '" title="Duplicate flipbook" >Duplicate</a> | </span><span class="trash"><a href="' . admin_url('admin.php?page=real3d_flipbook_admin&action=delete&bookId='  . $flipbook["id"]) . '" title="Move to trash" >Trash</a></span>
									</div>
								</td>
								<td>[real3dflipbook  id="' . $flipbook["id"] . '"]</td>
								<td>' . $flipbook_date . '</td>
							</tr>';
					}
					
					
				}
				
				
			?>
		</tbody>		 
	</table>
	
<div class="tablenav bottom">

<div class="alignleft actions bulkactions">
	<label for="bulk-action-selector-bottom" class="screen-reader-text">Select bulk action</label>
	<select name="action2" id="bulk-action-selector-bottom">
		<option value="-1" selected="selected">Bulk Actions</option>
		<option value="trash">Trash</option>
	</select>
	<input type="submit" id="doaction2" class="button action bulkactions-apply" value="Apply">
</div>
<div class="alignleft actions"></div>

			
			<div class="tablenav-pages 
		<?php 
			if($flipbooksCount <= $pageSize) echo ("one-page");
		?>
		"><span class="displaying-num">
		<?php
			echo($flipbooksCount);
		?>
		items</span>
		<span class="pagination-links"><a class="first-page <?php if($pageId == 1) echo 'disabled'?>" title="Go to the first page" href="
		<?php 
			if($pageId > 1) {
				echo($url . '&pageid=1');
				if($orderBy != '' && $order != ''){
					echo('&orderby='.$orderBy.'&order='.$order);
				}
			}else{
				echo '#';
			}
		?>
		">«</a>
		<a class="prev-page <?php if($pageId == 1) echo 'disabled'?>" title="Go to the previous page" href="
		<?php 
			if($pageId > 1) {
				echo($url . '&pageid=' . ($pageId -1));
				if($orderBy != '' && $order != ''){
					echo('&orderby='.$orderBy.'&order='.$order);
				}
			}else{
				echo '#';
			}
		?>
		">‹</a>
		<span class="paging-input"><label for="current-page-selector" class="screen-reader-text">Select Page</label><input class="current-page" id="current-page-selector" title="Current page" type="text" name="paged" value="<?php 
			echo $pageId;
		?>" size="1"> of <span class="total-pages"><?php echo($pagesCount)?></span></span>
		<a class="next-page <?php if($pageId == $pagesCount) echo 'disabled'?>" title="Go to the next page" href="
		<?php 
			if($pageId < $pagesCount) {
				echo($url . '&pageid=' . ($pageId +1));
				if($orderBy != '' && $order != ''){
					echo('&orderby='.$orderBy.'&order='.$order);
				}
			}else{
				echo '#';
			}
		?>
		">›</a>
		<a class="last-page <?php if($pageId == $pagesCount) echo 'disabled'?>" title="Go to the last page" href="
		<?php 
			if($pageId < $pagesCount) {
				echo($url . '&pageid=' . $pagesCount);
				if($orderBy != '' && $order != ''){
					echo('&orderby='.$orderBy.'&order='.$order);
				}
			}else{
				echo '#';
			}
		?>
		">»</a></span></div>

	</div>

	<br/>
	
	<br/>
	<br/>
	<br/>
	<h3>Import / Export</h3>
	<div>
		<a class='button-secondary' href='<?php echo admin_url( "admin.php?page=real3d_flipbook_admin&action=generate_json" ); ?>'>Export (Generate JSON)</a>
	</div>

	</p>    
	
	<form method="post" enctype="multipart/form-data" action="admin.php?page=real3d_flipbook_admin&amp;action=import_from_json_confirm">
	
		<?php 
				if (isset($_GET['action']) && $_GET['action'] == "generate_json") {
					echo '<textarea id="flipbook-admin-json" rows="20" cols="100" >' . json_encode($flipbooks) . '</textarea>';
				}
			?>
			<br/>
			<br/>
			<br/>
			<p>Import flipbooks from JSON( overwrite existing flipbooks)</p>
			
			<textarea name="flipbooks" id="flipbook-admin-json" rows="20" cols="100" placeholder="Paste JSON here"></textarea>
			<p class="submit"><input type="submit" name="submit" id="submit" class="button save-button button-secondary" value="Import"></p>
	
	</form>
	<br/>
	<br/>
	<br/>
	<span class="submitbox"><a class="submitdelete" href='<?php echo $url .'&action=delete_all'; ?>'>Delete all flipbooks</a></span>
	
	
	
</div>
<?php


wp_enqueue_script("read3d_flipbook_admin", plugins_url()."/real3d-flipbook/js/plugin_admin.js", array('jquery' ),REAL3D_FLIPBOOK_VERSION);


// wp_enqueue_script("read3d_flipbook_admin", plugins_url()."/real3d-flipbook/js/plugin_admin.js", array('jquery','jquery-ui-sortable','jquery-ui-resizable','jquery-ui-selectable','jquery-ui-tabs' ),REAL3D_FLIPBOOK_VERSION);
// wp_enqueue_style( 'read3d_flipbook_admin_css', plugins_url()."/real3d-flipbook/css/flipbook-admin.css",array(), REAL3D_FLIPBOOK_VERSION );
//pass $flipbooks to javascript
// wp_localize_script( 'read3d_flipbook_admin', 'options', json_encode($flipbooks) );
// wp_localize_script( 'read3d_flipbook_admin', 'flipbooks', true );