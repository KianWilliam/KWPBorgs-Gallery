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

 
/*
 *-----------------------------------------
 * Added for security reasons: http://codex.wordpress.org/Theme_Development#Template_Files
 *-----------------------------------------
 */
defined('ABSPATH') or die("Direct access to the script does not allowed");
/*-----------------------------------------*/
?>


<div id="postbox-container-1" class="postbox-container sidebar-right">
    <div class="meta-box-sortables">
        <div class="postbox">
            <h3><span><?php esc_attr_e('Get help', 'kwpborgs-gallery');?></span></h3>
            <div class="inside">
                <div>
                    <ul>
                        <li><a class="no-underline" target="_blank" href="CONF_Plugin_Link"><span class="dashicons dashicons-admin-home"></span> <?php esc_attr_e('Plugin Homepage', 'kwpborgs-gallery');?></a></li>
                    </ul>
                </div>
                <div class="sidebar-footer">
                    &copy; <?php echo date('Y'); ?> <a class="no-underline text-highlighted" href="https://extension.kwproductions121.ir" title="CONF_Plugin_Author" target="_blank">KWProductions Co.</a>
                </div>
            </div>
        </div>
    </div>
</div>
