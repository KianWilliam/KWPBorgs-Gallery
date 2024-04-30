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
?>

<div class="wrap">

    <h1>
	
        <?php echo esc_html(get_admin_page_title()); ?>
        <a href="<?php echo admin_url('admin.php?page=' . $this->plugin_slug . '-entry-add') ?>" class="page-title-action"><?php _e('Add New', 'kwpborgs-gallery');?></a>
    </h1>


    <form id="plugin-name-filter" method="post">

        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>">

       

    </form>

</div>
