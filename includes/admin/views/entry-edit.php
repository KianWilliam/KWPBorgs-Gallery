<?php

/**
 * KWPBorgs Gallery
 *
 * @package   KWPBorgs_Gallery
 * @author    KWProductions Co.
 * @license   GPL-2.0+
 * @link      https://extensions.kwproductions121.ir
 * @copyright All rights reserved
 */

/**
 *-----------------------------------------
 * Added for security reasons: http://codex.wordpress.org/Theme_Development#Template_Files
 *-----------------------------------------
 */
defined('ABSPATH') or die("Direct access to the script does not allowed");
/*-----------------------------------------*/

$page_title            = 'Add New Entry';
$message_updated_title = 'Entry has been saved!';
if (isset($_GET['id'])) {
    $page_title            = 'Edit Entry';
    $message_updated_title = 'Entry has been updated!';
	
}
?>


<div class="wrap">
<?php if($up==true): ?>
    <div class="updated"><p><?php _e($message_updated_title, 'kwpborgs-gallery');?></p></div>
<?php endif; ?>
    <h2>
        <a href="<?php echo admin_url('admin.php?page=' . $this->plugin_slug . '-settings') ?>" class="page-title-action">&larr; <?php _e('Back', 'kwpborgs-gallery');?></a>
        <?php _e($page_title, 'kwpborgs-gallery')?>
    </h2>


    <div id="poststuff">

        <div id="post-body" class="metabox-holder columns-1">

            <!-- main content -->
            <div id="post-body-content">


                <div class="meta-box-sortables ui-sortable">

                    <div class="postbox">

                        <div class="inside">
						<?php
							$path = plugin_basename(__FILE__);
						$i = strpos($path, '/');
						$pluginName = substr($path, 0, $i);
								    wp_enqueue_media();

						?>
						<?php
					
					   echo  '<form id="plugin-settings-form" action="admin.php?page=kwpborgs-gallery-entry-add" method="post">';
			

                         ?>                                
								<input type="hidden" name="action" value="update">
                            <p><?php
						
							include_once WP_PLUGIN_DIR.'/'.$pluginName.'/includes/admin/class-kwpborgs-gallery-admin-metaboxes.php';
							$metas = Kwpborgs_Gallery_Admin_Metaboxes::get_instance();
						
							$metas->kwpborgs_gallery_meta_box_callback($data);


							?></p>
							<?php if(isset($data) && $data!==NULL){ ?>
							<input type="hidden" name="recordid" value="<?php echo $data->id; ?>" >
							<?php }else{ ?>
							<input type="hidden" name="recordid" value="0" >
							<?php
							}
							submit_button(); 
	
							?>

                         </form>
                        </div><!-- .inside -->

                    </div><!-- .postbox -->

                </div><!-- .meta-box-sortables .ui-sortable -->

            </div><!-- post-body-content -->


        </div><!-- #post-body .metabox-holder .columns-1 -->

        <br class="clear">
    </div><!-- #poststuff -->


</div><!-- .wrap -->
<script>
			jQuery( document ).ready( function( $ ){
					
					var l, t, w, h;
				if(screen.width>=500){
				var screenwidth = screen.width;
				var screenheight = screen.height;
				$('.media-modal-content').css({width:'500px', height:'299px'});
				l= (screenwidth/2)-$('.media-modal-content').width()/2;
				t= (screenheight/2)-$('.media-modal-content').height()/2+55;
				$('.media-modal-content').css({left:l+'px', top:t+'px'});
				}
					
				var file_frame;
				var file_target_input;

				$('.kwpborgs-gallery-media').on('click', function(e){
				
					e.preventDefault();
					 var selected = $( this ).attr( 'data-attachment_id' );

					file_target_input = $( this ).closest('.form-table').find('.file_url');
					// If the media frame already exists, reopen it.
					if ( file_frame ) {
						file_frame.open();
						return;
					}
					
				
					

					file_frame = wp.media.frames.file_frame = wp.media({
						title: $( this ).data( 'uploader_title' ),
						button: {
							text: $( this ).data( 'uploader_button_text' ),
						},
						 
						multiple: true // Set to true to allow multiple files to be selected.
					});

					// When an image is selected, run a callback.
					file_frame.on( 'select', function() {
						

							var selection = file_frame.state().get('selection');
							 // selection.add( wp.media.attachment( selected ) );
					var	attachment = selection.map( function( attachment ) {
				attachment = attachment.toJSON();
				return attachment;
							});
							for(var i=0; i<attachment.length; i++)
							{
								console.log(attachment[i]);
							
						jQuery('#imagespaths').append(attachment[i].url+',');

							}
							$( file_target_input ).val('Images paths on textarea above!');

					});

					// Finally, open the modal.
					file_frame.open();
				});
			});
		</script>
