<?php


/**
 * KWPBorgs Gallery
 *
 * @package   KWPBorgs_Gallery
 * @author    KWProductions Co.
 * @license   GPL-2.0+
 * @link      https://extensions.kwproductions121.ir
 * @copyright 2020
 */


/**
 *-----------------------------------------
 * Added for security reasons: http://codex.wordpress.org/Theme_Development#Template_Files
 *-----------------------------------------
 */
defined('ABSPATH') or die("Direct access to the script does not allowed");
/*-----------------------------------------*/

class Kwpborgs_Gallery_Admin_Pages_CRUD
{

    /**
     * Instance of this class.
     *
     * @since    1.0.0
     *
     * @var      object
     */
    protected static $instance = null;

    /**
     * Slug of the plugin screen.
     *
     * @since    1.0.0
     *
     * @var      string
     */
    protected $plugin_screen_hook_suffix = array();

    /**
     * Initialize the plugin by loading admin scripts & styles and adding a
     * settings page and menu.
     *
     * @since     1.0.0
     */
    private function __construct()
    {

        /*
         * @TODO :
         *
         * - Uncomment following lines if the admin class should only be available for super admins
         */
        /* if( ! is_super_admin() ) {
        return;
        } */

        /*
         * Call $plugin_slug from public plugin class.
         */
        $plugin               =Kwpborgs_Gallery::get_instance();
        $this->plugin_slug    = $plugin->get_plugin_slug();
        $this->plugin_version = $plugin->get_plugin_version();

        // Load admin style sheet and JavaScript.
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_css_js'));

        // Add the plugin admin pages and menu items.
        add_action('admin_menu', array($this, 'add_plugin_admin_menu'));
	


    }
	

    /**
     * Return an instance of this class.
     *
     * @since     1.0.0
     *
     * @return    object    A single instance of this class.
     */
    public static function get_instance()
    {

        /*
         * @TODO :
         *
         * - Uncomment following lines if the admin class should only be available for super admins
         */
        /* if( ! is_super_admin() ) {
        return;
        } */

        // If the single instance hasn't been set, set it now.
        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Register and enqueue admin-specific CSS and JS.
     *
     * @since     1.0.0
     *
     * @return    null    Return early if no settings page is registered.
     */
    public function enqueue_admin_css_js()
    {

        if (!isset($this->plugin_screen_hook_suffix)) {
            return;
        }

        $screen = get_current_screen();

        /* ----- Plugin Module: CRUD ----- */
        if ((($this->plugin_screen_hook_suffix['entries_view'] == $screen->id) && isset($_GET['action']) && ($_GET['action'] == 'edit')) || ($this->plugin_screen_hook_suffix['entry_add'] == $screen->id)) {
            /* Admin Styles */
            wp_enqueue_style($this->plugin_slug . '-admin-styles', plugins_url('assets/css/admin.css', __FILE__), array(), $this->plugin_version);

            // Main Admin JS Script
            wp_register_script($this->plugin_slug . '-admin-script', plugins_url('assets/js/admin.js', __FILE__), array('jquery', $this->plugin_slug . '-admin-app'), $this->plugin_version);
            wp_enqueue_script($this->plugin_slug . '-admin-script');
        }
        /* ----- End Module: CRUD ----- */

    }

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    1.0.0
     */
    public function add_plugin_admin_menu()
    {

        /*
         * Add a settings page for this plugin to the Settings menu.
         *
         * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
         *
         *        Administration Menus: http://codex.wordpress.org/Administration_Menus
         *        For reference: http://codex.wordpress.org/Roles_and_Capabilities
         *
         */

        /* ----- Plugin Module: CRUD ----- */
        // Example of custom pages (Entries View and Edit)

        $this->plugin_screen_hook_suffix['entries_view'] = add_submenu_page(
           'edit.php?post_type=entries',
			__('Manage Entries', 'kwpborgs-gallery'),
            __('Entries', 'kwpborgs-gallery'),
            'manage_options',
            $this->plugin_slug . '-entries-view',
            array($this, 'display_plugin_page_entries_view'),
           0// 'dashicons-layout'
        );

        $this->plugin_screen_hook_suffix['entry_add'] = add_submenu_page(
            'edit.php?post_type=entries',
            __('Add New Entry', 'kwpborgs-gallery'),
            __('Add New', 'kwpborgs-gallery'),
            'manage_options',
            $this->plugin_slug . '-entry-add',
            array($this, 'display_plugin_page_entry_edit')
        );
        /* ----- End Module: CRUD ----- */

    }

    /* ----- Plugin Module: CRUD ----- */
    /**
     * Render "Manage Entries" page
     *
     * @since    1.0.0
     */

    public function display_plugin_page_entries_view()
    {
        if (isset($_GET['action']) && ($_GET['action'] == 'edit')) {
            $this->display_plugin_page_entry_edit();
        } else {
            $plugin_name_list_table = new Kwpborgs_Gallery_Admin_CRUD_List();
            $plugin_name_list_table->prepare_items();
         //  var_dump('eeeeeeeeeeeeeeeeeeeeeh dar kosset');
            include_once 'views/entries-view.php';

        }
    }

    /**
     * Render "Add New / Edit" page
     *
     * @since    1.0.0
     */

   public function display_plugin_page_entry_edit()
    {
        global $wpdb;
		$up = false;
		$data = NULL;
		
			global $wp;
			$error="Errors:";
			$flag = 0;
			$imagepathflag = 0;

            $url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
			
			if(!empty($_POST['kwpborgs_gallery_nonce'])){
		    if(empty($_POST['title']))
			{	                   		
				    $_POST['title']='default';	
          		    echo '<div class="notice notice-error"><p>Title can not be empty!, retuned back to default.</p></div>';

                   					
			}
			if(empty($_POST['imagespaths']))
			{
				  
          		   	echo '<div class="notice notice-error"><p>Images paths can not be empty! select from images button below</p></div>';
					

			}
			if(!empty($_POST['imagestexts']) && !preg_match('/^(\|?([a-zA-Z0-9\?\/\.\-\=&_:\s])+\|?)+$/', $_POST['imagestexts']))
			{	                   		
				    $_POST['imagestexts']='| blah1 | blah2 |';	
					echo '<div class="notice notice-error"><p>The syntax for images texts is wrong! follow the default syntax</p></div>';				
			}
			
			   if(!isset($_POST['cubeleft']))
			{	                   		
				    $_POST['cubeleft']=1;	
          		    echo '<div class="notice notice-error"><p>Cube left can not be empty!, returned back to default.</p></div>';

                   					
			}
			 if(!isset($_POST['cubetop']))
			{	                   		
				    $_POST['cubetop']=1;	
          		    echo '<div class="notice notice-error"><p>Cube top can not be empty! returned back to default</p></div>';

                   					
			}
		 if(isset($_POST['imagewidth']))
			$iw=(int) $_POST['imagewidth'];
		 if(isset($_POST['cols']))
			$c=(int) $_POST['cols'];
		 if(isset($_POST['imageheight']))
			$ih=(int) $_POST['imageheight'];
		 if(isset($_POST['rows']))
			$r=(int) $_POST['rows'];
			 if(!isset($_POST['cols']) || !isset($_POST['imagewidth']) || ($iw % $c !=0) )
			{	                   		
				    $_POST['imagewidth']=300;
                    $_POST['cols']=12;					
          		    echo '<div class="notice notice-error"><p>Image width can not be empty! or imagewidth is not divisible with columns!</p></div>';
                					
			}
		    if(!isset($_POST['rows']) || !isset($_POST['imageheight']) || ($ih % $r!=0) )
			{	                   		
				    $_POST['imageheight']=300;
                    $_POST['rows']=12;					
          		    echo '<div class="notice notice-error"><p>Image hright can not be empty! or image height is not divisible with rows!</p></div>';
                					
			}
			 if(!isset($_POST['cubespeed']) || $_POST['cubespeed']==0)
			{	                   		
				    $_POST['cubespeed']=5000;	
          		    echo '<div class="notice notice-error"><p>Cube speed can not be empty or zero! returned back to default</p></div>';

                   					
			}
				 if(!isset($_POST['imagespeed']) || $_POST['imagespeed']==0)
			{	                   		
				    $_POST['imagespeed']=5000;	
          		    echo '<div class="notice notice-error"><p>Image speed can not be empty or zero! returned back to default</p></div>';

                   					
			}
			
			
			}
		
		
        if (isset($_GET['id']) && $_GET['id'] != 0) {
			
            $data = $wpdb->get_row('SELECT * FROM `'.Kwpborgs_Gallery_DB::get_table_name().'` WHERE `id` = ' . $_GET['id']);
            
			
            $id    = $data->id;
            $title = $data->title;
		
        }
		else
	     if(isset($_POST['recordid']) && $_POST['recordid']!= 0)
		{
		
			  $id = $_POST['recordid'];
			   $result = $wpdb->update(Kwpborgs_Gallery_DB::get_table_name(), array('title'=>$_POST['title'], 'imagespaths'=>$_POST['imagespaths'],
			  'imagestexts'=>$_POST['imagestexts'],'lib'=>$_POST['lib'],'cubeleft'=>$_POST['cubeleft'],
			  'cubetop'=>$_POST['cubetop'],'imagewidth'=>$_POST['imagewidth'],'imageheight'=>$_POST['imageheight'],
			  'rows'=>$_POST['rows'],'cols'=>$_POST['cols'],'cubespeed'=>$_POST['cubespeed'],
			  'imagespeed'=>$_POST['imagespeed'],'axis'=>$_POST['axis'],
			  'cubebackcolor'=>$_POST['cubebackcolor'],'dimensionbackcolor'=>$_POST['dimensionbackcolor']),
			  array('id'=>$_POST['recordid']),
			  array('%s','%s','%s','%d','%d','%d','%d','%d','%d','%d','%d','%d','%s','%s','%s'), array('%d'));
			  $up = true;
		 
		}
		  else
			  if(isset($_POST['recordid']) && $_POST['recordid']== 0)
		  {
		
		
			  $result = $wpdb->insert(Kwpborgs_Gallery_DB::get_table_name(), array('title'=>$_POST['title'],'imagespaths'=>$_POST['imagespaths'],
			  'imagestexts'=>$_POST['imagestexts'],'lib'=>$_POST['lib'],'cubeleft'=>$_POST['cubeleft'],
			  'cubetop'=>$_POST['cubetop'],'imagewidth'=>$_POST['imagewidth'],'imageheight'=>$_POST['imageheight'],
			  'rows'=>$_POST['rows'],'cols'=>$_POST['cols'],'cubespeed'=>$_POST['cubespeed'],
			  'imagespeed'=>$_POST['imagespeed'],'axis'=>$_POST['axis'],
			  'cubebackcolor'=>$_POST['cubebackcolor'],'dimensionbackcolor'=>$_POST['dimensionbackcolor']),
			  array('%s','%s','%s','%d','%d','%d','%d','%d','%d','%d','%d','%d','%s','%s','%s'));
			  $id = $wpdb->insert_id;
			  $up = true;
			
		  }
		  
		  if($up)
		  {
			
			  $data = $wpdb->get_row('SELECT * FROM `'.Kwpborgs_Gallery_DB::get_table_name().'` WHERE `id` = ' . $id );
            
		  }
		
		
        include_once 'views/entry-edit.php';
    }
    /* ----- End Module: CRUD ----- */

}
