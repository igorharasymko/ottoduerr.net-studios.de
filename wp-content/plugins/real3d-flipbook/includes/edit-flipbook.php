<div class='wrap'>
	<div id='real3dflipbook-admin'>
		<a href="admin.php?page=real3d_flipbook_admin" class="back-to-list-link">&larr; <?php _e('Back to flipbooks list', 'flipbook'); ?></a>
		<h2 id="edit-flipbook-text">Edit flipbook
		<?php
			if (isset($_GET['bookId']) && $_GET['bookId'] > -1) {
				echo ' ' . $_GET['bookId'];
			}
		?>
		</h2>
		
		<form method="post" enctype="multipart/form-data" action="admin.php?page=real3d_flipbook_admin&action=save_settings&bookId=<?php _e($current_id)?>">
			<p class="submit"><input type="submit" name="submit" id="submit" class="button save-button button-primary" value="Save Changes"> 
			<a href="#TB_inline?width=600&height=550&inlineId=flipbook-preview-container" class="thickbox flipbook-preview button save-button button-secondary">Preview</a>	</p>
			
			 
<div id="flipbook-preview-container" style="display:none">
     <div id="flipbook-preview-container-inner" style="position:relative;height:100%">
     </div>
</div>




			<div class="metabox-holder">
				<div class="meta-box-sortables">
				
					<!-- <div class="column-left"> -->
						
						<!-- <div class="postbox"> -->
							<!-- <div class="handlediv" title="Click to toggle"></div> -->
							<!-- <h3 class="hndle">General Options</h3> -->
							
							<div class="tabs settings-area">
							
							<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
								<li><a href="#tabs-1">Pages</a></li>
								<li><a href="#tabs-2">General</a></li>
								<li><a href="#tabs-9">PDF</a></li>
								<li><a href="#tabs-4">Normal mode</a></li>
								<li><a href="#tabs-5">Lightbox mode</a></li>
								<li><a href="#tabs-6">Menu</a></li>
								<li><a href="#tabs-8">Share</a></li>
								<li><a href="#tabs-7">WebGl</a></li>
								<li><a href="#tabs-3">Mobile</a></li>
							</ul>
							
							<div id="tabs-2" class="inside">
								<table class="form-table" id="flipbook-general-options">
									<tbody/>
								</table>
							</div>
							<div id="tabs-9" class="inside">
								<table class="form-table" id="flipbook-pdf-options">
									<tbody/>
								</table>
							</div>
							<div id="tabs-3" class="inside">
								<table class="form-table" id="flipbook-mobile-options">
									<tbody/>
								</table>
							</div>
							<div id="tabs-4" class="inside">
								<table class="form-table" id="flipbook-normal-options">
									<tbody/>
								</table>
							</div>
							<div id="tabs-5" class="inside">
								<table class="form-table" id="flipbook-lightbox-options">
									<tbody/>
								</table>
							</div>
							<div id="tabs-6" class="inside">
							
							
						<div class="postbox">
							<div class="handlediv" title="Click to toggle"></div>
							<h3 class="hndle">Current page</h3>
							<div class="inside">
								<table class="form-table" id="flipbook-currentPage-options">
									<tbody/>
								</table>
								</div>
						</div>
						
						<div class="postbox">
							<div class="handlediv" title="Click to toggle"></div>
							<h3 class="hndle">Button next page</h3>
							<div class="inside">
								<table class="form-table" id="flipbook-btnNext-options">
									<tbody/>
								</table>
								</div>
						</div>
								
								<div class="postbox">
							<div class="handlediv" title="Click to toggle"></div>
							<h3 class="hndle">Button last page</h3>
							<div class="inside">
								<table class="form-table" id="flipbook-btnLast-options">
									<tbody/>
								</table>
								</div>
						</div>
								<div class="postbox">
							<div class="handlediv" title="Click to toggle"></div>
							<h3 class="hndle">Button previous page</h3>
							<div class="inside">
								<table class="form-table" id="flipbook-btnPrev-options">
									<tbody/>
								</table>
								</div>
						</div>
								<div class="postbox">
							<div class="handlediv" title="Click to toggle"></div>
							<h3 class="hndle">Button first page</h3>
							<div class="inside">
								<table class="form-table" id="flipbook-btnFirst-options">
									<tbody/>
								</table>
								</div>
						</div>
								<div class="postbox">
							<div class="handlediv" title="Click to toggle"></div>
							<h3 class="hndle">Button zoom in</h3>
							<div class="inside">
								<table class="form-table" id="flipbook-btnZoomIn-options">
									<tbody/>
								</table>
								</div>
						</div>
								
								<div class="postbox">
							<div class="handlediv" title="Click to toggle"></div>
							<h3 class="hndle">Button zoom out</h3>
							<div class="inside">
								<table class="form-table" id="flipbook-btnZoomOut-options">
									<tbody/>
								</table>
								</div>
						</div>
								<div class="postbox">
							<div class="handlediv" title="Click to toggle"></div>
							<h3 class="hndle">Button table of content</h3>
							<div class="inside">
								<table class="form-table" id="flipbook-btnToc-options">
									<tbody/>
								</table>
								</div>
						</div>
								<div class="postbox">
							<div class="handlediv" title="Click to toggle"></div>
							<h3 class="hndle">Button thumbnails</h3>
							<div class="inside">
								<table class="form-table" id="flipbook-btnThumbs-options">
									<tbody/>
								</table>
								</div>
						</div>
								<div class="postbox">
							<div class="handlediv" title="Click to toggle"></div>
							<h3 class="hndle">Button share</h3>
							<div class="inside">
								<table class="form-table" id="flipbook-btnShare-options">
									<tbody/>
								</table>
								</div>
						</div>
								<div class="postbox">
							<div class="handlediv" title="Click to toggle"></div>
							<h3 class="hndle">Button download pages</h3>
							<div class="inside">
								<table class="form-table" id="flipbook-btnDownloadPages-options">
									<tbody/>
								</table>
								</div>
						</div>
								
								<div class="postbox">
							<div class="handlediv" title="Click to toggle"></div>
							<h3 class="hndle">Button download PDF</h3>
							<div class="inside">
								<table class="form-table" id="flipbook-btnDownloadPdf-options">
									<tbody/>
								</table>
								</div>
						</div>
								<div class="postbox">
							<div class="handlediv" title="Click to toggle"></div>
							<h3 class="hndle">Button sound</h3>
							<div class="inside">
								<table class="form-table" id="flipbook-btnSound-options">
									<tbody/>
								</table>
								</div>
						</div>
								<div class="postbox">
							<div class="handlediv" title="Click to toggle"></div>
							<h3 class="hndle">Button expand</h3>
							<div class="inside">
								<table class="form-table" id="flipbook-btnExpand-options">
									<tbody/>
								</table>
								</div>
						</div>
								
								<div class="postbox">
							<div class="handlediv" title="Click to toggle"></div>
							<h3 class="hndle">Button expand lightbox</h3>
							<div class="inside">
								<table class="form-table" id="flipbook-btnExpandLightbox-options">
									<tbody/>
								</table>
								</div>
						</div>
								<div class="postbox">
							<div class="handlediv" title="Click to toggle"></div>
							<h3 class="hndle">Button print</h3>
							<div class="inside">
								<table class="form-table" id="flipbook-btnPrint-options">
									<tbody/>
								</table>
								</div>
						</div>
								
								

								
								<table class="form-table" id="flipbook-menu-options">
									<tbody/>
								</table>
							</div>
							<div id="tabs-7" class="inside">
								<table class="form-table" id="flipbook-webgl-options">
									<tbody/>
								</table>
							</div>
							<div id="tabs-8" class="inside">
							
<div class="postbox">
							<div class="handlediv" title="Click to toggle"></div>
							<h3 class="hndle">Share on Google plus</h3>
							<div class="inside">
								<table class="form-table" id="flipbook-google_plus-options">
									<tbody/>
								</table>
								</div>
						</div>
								<div class="postbox">
							<div class="handlediv" title="Click to toggle"></div>
							<h3 class="hndle">Share on Twitter</h3>
							<div class="inside">
								<table class="form-table" id="flipbook-twitter-options">
									<tbody/>
								</table>
								</div>
						</div>
								
								<div class="postbox">
							<div class="handlediv" title="Click to toggle"></div>
							<h3 class="hndle">Share on Facebook</h3>
							<div class="inside">
								<table class="form-table" id="flipbook-facebook-options">
									<tbody/>
								</table>
								</div>
						</div>
								<div class="postbox">
							<div class="handlediv" title="Click to toggle"></div>
							<h3 class="hndle">Share on pinterest</h3>
							<div class="inside">
								<table class="form-table" id="flipbook-pinterest-options">
									<tbody/>
								</table>
								</div>
						</div>
								
								<div class="postbox">
							<div class="handlediv" title="Click to toggle"></div>
							<h3 class="hndle">Share by email</h3>
							<div class="inside">
								<table class="form-table" id="flipbook-email-options">
									<tbody/>
								</table>
								</div>
						</div>
						<!-- 		<div>
									<div class="ui-sortable">
										<div id="share-container" class="ui-sortable"></div>
										<div><a id="add-share-button" class="alignleft button-primary " href='#'>Add Share Button</a></div>
									</div>
								</div> -->
							</div>
							<div id="tabs-1" class="inside">
								<div>
									<p class=""><input type="submit" name="save-background-options" id="save-background-options" class="add-pages-button button button-primary" value="Add JPG Pages (select / upload images)"></p>
									
									<p class=""><input type="submit" name="save-background-options" id="save-background-options" class="select-pdf-button button button-primary" value="Add pages from PDF (select / upload PDF)"></p>
									
									<span class="creating-page">  Creating page 1/10...</span>
									
									<div class="ui-sortable sortable-pages-body">
										<p class=""><a class="delete-all-pages-button alignleft button-secondary " href='#'>Delete All Pages</a></p><img src="http://www.lolinez.com/erw.jpg">
										<br/>
										<br/>
										<div id="pages-container" class="ui-sortable sortable-pages-container"></div>
									</div>
								</div>
							</div>
							
						</div>
						<!-- </div> -->
						
					<!-- </div> -->
				</div>
			</div>
			<p class="submit"><input type="submit" name="submit" id="submit" class="button save-button button-primary" value="Save Changes">
			<a href="#TB_inline?width=600&height=550&inlineId=flipbook-preview-container" class="thickbox flipbook-preview button save-button button-secondary">Preview</a>	</p>
		</form>
	</div>
</div>
<?php 
wp_enqueue_media();
add_thickbox();

wp_enqueue_script("read3d_flipbook", plugins_url()."/real3d-flipbook/js/flipbook.min.js", array('jquery'),REAL3D_FLIPBOOK_VERSION);
wp_enqueue_style( 'flipbook_style', plugins_url()."/real3d-flipbook/css/flipbook.style.css" , array(),REAL3D_FLIPBOOK_VERSION);
wp_enqueue_style( 'font_awesome', plugins_url()."/real3d-flipbook/css/font-awesome.css" , array(),REAL3D_FLIPBOOK_VERSION);

wp_enqueue_script("pdfjs", plugins_url()."/real3d-flipbook/js/pdf.min.js", array(),REAL3D_FLIPBOOK_VERSION);
wp_enqueue_style( 'wp-color-picker' );
wp_enqueue_script("read3d_flipbook_admin", plugins_url()."/real3d-flipbook/js/plugin_admin.js", array('jquery','jquery-ui-sortable','jquery-ui-resizable','jquery-ui-selectable','jquery-ui-tabs','pdfjs','wp-color-picker' ),REAL3D_FLIPBOOK_VERSION);
wp_enqueue_style( 'read3d_flipbook_admin_css', plugins_url()."/real3d-flipbook/css/flipbook-admin.css",array(), REAL3D_FLIPBOOK_VERSION );
wp_enqueue_style( 'jquery-ui-style', plugins_url()."/real3d-flipbook/css/jquery-ui.css",array(), REAL3D_FLIPBOOK_VERSION );


$flipbooks[$current_id]['rootFolder'] = plugins_url()."/real3d-flipbook/";
//pass $flipbooks to javascript
wp_localize_script( 'read3d_flipbook_admin', 'options', json_encode($flipbooks[$current_id]) );
