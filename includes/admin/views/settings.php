<?php
/**
 *  KWPBorgs Gallery
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
?>

<?php
$settings_tabs = Kwpborgs_Gallery_Settings::$settings_tabs;
?>

<div class="wrap">
 <h1>
	
        <?php echo esc_html(get_admin_page_title()); ?>
        <a href="<?php echo admin_url('admin.php?page=' . $this->plugin_slug . '-entry-add') ?>" class="page-title-action"><?php _e('Add New', 'kwpborgs-gallery');?></a>
    </h1>

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>

    <h2 class="nav-tab-wrapper">
        <?php foreach ($settings_tabs as $tab_id => $tab) {?>
        <a href="#<?php echo $tab_id; ?>" class="nav-tab"><?php _e($tab, 'kwpborgs-gallery');?></a>
        <?php }?>
    </h2>

    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">

            <!-- main content -->
            <div id="post-body-content">

                <div class="meta-box-sortables1 ui-sortable1">
                    <div class="postbox">
                        <div class="inside">
                            <?php 
							settings_errors();
							$path = plugin_basename(__FILE__);
						$i = strpos($path, '/');
						$pluginName = substr($path, 0, $i);

							?>

							
                                <?php
															include_once WP_PLUGIN_DIR.'/'.$pluginName.'/includes/admin/class-kwpborgs-gallery-admin-crud-list.php';
 
								   $listable = new Kwpborgs_Gallery_Admin_CRUD_List();
            $listable->prepare_items();
			
			
			?>
    <form id="kwpborgs-gallery-form" action="admin.php?page=kwpborgs-gallery-settings" method="post">

			<?php
			$listable -> search_box(__('Search Borg Galleries', 'kwpborgs-gallery'), 'search');
			$listable->display();
			
		
?>
                          </form>
                        </div>
                    </div>
                </div>

            </div><!-- #post-body-content -->

            <!-- sidebar -->
            <?php include_once '_sidebar-right.php';?>
            <!-- end sidebar -->

        </div><!-- #post-body-->

        <br class="clear">
    </div>  <!-- #poststuff -->


</div>

<script type="text/javascript">	
jQuery('#doaction').on('click', function(event) {
	if (!confirm('Are you sure you want to apply this bulk action?')) {
		return false;
	}
});
</script>
