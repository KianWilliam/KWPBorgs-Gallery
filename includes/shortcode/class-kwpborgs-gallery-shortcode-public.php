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

/**
 * Handle Plugin Shortcode Public Side Features
 */
class Kwpborgs_Gallery_Shortcode_Public
{
   protected $version = "1.0.0";
    /**
     * Instance of this class.
     *
     * @since    1.0.0
     *
     * @var      object
     */
    protected static $instance = null;

    /**
     * Initialize the class
     *
     * @since     1.0.0
     */
    private function __construct()
    {
        /**
         * Call $plugin_slug from public plugin class.
         */
        $plugin               = Kwpborgs_Gallery::get_instance();
        $this->plugin_slug    = $plugin->get_plugin_slug();
        $this->plugin_version = $plugin->get_plugin_version();
	
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

        // If the single instance hasn't been set, set it now.
        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Render Shortcode [plugin_shorcode]
     *
     * @since     1.0.0
     */
    public function render_sc($atts, $content = "<div id='borggique' class='borggique'></div>")
    {
		global $wpdb;
		
		
        extract(shortcode_atts(array(
            'id' => '',
        ), $atts));

        $id = (int) $id;

        if (!$id) {
            return '';
        }
		
			$result = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."kwpborgs_gallery WHERE id =" . $id, OBJECT);
			
				if ($result[0]->id) {
						$imagefiles = explode(",", $result[0]->imagespaths);

					
				if($imagefiles !== NULL && is_array($imagefiles))	:
	
        foreach($imagefiles as $i=>$itm)
        { 
		if(!empty($itm) && isset($itm))
	     $images[] = $itm;
		  
        }	
		endif;
		
					
					$imagetexts = $result[0]->imagestexts;
					
					 $texts = explode('|', $imagetexts);
                     $texts = array_filter($texts);
		
	
if(count($images)>=4 && count($texts)>=4 && count($texts)==count($images))	{
	
			$path = plugin_basename(__FILE__);
			
						$i = strpos($path, '/');
						$pluginName = substr($path, 0, $i);
					
						$purl = get_home_url().'/wp-content/plugins/';
		if($result[0]->lib==='yes')	
	   wp_enqueue_script( 'Borgs Scripts' , $purl .'/'.$pluginName . '/includes/admin/assets/js/jquery.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'Borgs Scripts Cube' , $purl .'/'.$pluginName.'/includes/admin/assets/js/cube.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'Borgs Scripts Pieces' , $purl .'/'.$pluginName.'/includes/admin/assets/js/borgspieces.js', array( 'jquery' ), $this->version, false );



	$addscript = "
	 var config = {};
		  var imageindex=0;
          var surfacecounter = 5;
          var generalflag=0;
		  var bq = jQuery.noConflict();
		  
			jQuery(document).ready(function(){
				
				
                jQuery(document).ready(function(){					
		jQuery('.borggique').borg.config({ width:'".$result[0]->imagewidth."', height:'".$result[0]->imageheight."', rows:'".$result[0]->rows."',  cols:'".$result[0]->cols."', cubespeed:'".$result[0]->cubespeed."',
     		imagebuildspeed:'".$result[0]->imagespeed."', axis:'".$result[0]->axis."', cbc:'".$result[0]->cubebackcolor."', dbc:'".$result[0]->dimensionbackcolor."'});
				   bq.fn.tinies.setConfig(config);
					bq('.borggique').borg.init(); 			
	            });
			
				
			});
			
			bq.fn.borg.defaults = {};
	bq.fn.borg.defaults.images = [];
	bq.fn.borg.defaults.descs= [];
	//bq.fn.borg.defaults.width=400;
	//bq.fn.borg.defaults.height=400;
	//bq.fn.borg.defaults.rows=6;
	//bq.fn.borg.defaults.cols=10;
	//bq.fn.borg.defaults.cubespeed=3000;
	//bq.fn.borg.defaults.imagebuildspeed=242;
	//bq.fn.borg.defaults.axis='Y';
	//bq.fn.borg.defaults.cbc='#f18c00';
	//bq.fn.borg.defaults.dbc='#000000';	

	var myimages = ".json_encode($images).";
	var mydescs = ".json_encode($texts).";
	for(var g=0; g<myimages.length; g++)
	{
	    bq.fn.borg.defaults.images[g] = myimages[g];	
		bq.fn.borg.defaults.descs[g] = mydescs[g];	
	}	
			
			
			
			
			";
			
			
		wp_register_script('myscript', '');
		wp_enqueue_script('myscript');
		wp_add_inline_script('myscript', $addscript);
		
		 $status = "  
	.borggique
	{
		left:".esc_attr($result[0]->cubeleft)."px;
				top:".esc_attr($result[0]->cubetop)."px;
				//width:400px;
				//height:400px;
	}	
  ";
		
		
		wp_register_style('mystyle', '');
		wp_enqueue_style('mystyle');
		wp_add_inline_style('mystyle', $status);		  
			
}
else
{
		echo "<h1>ATTENTION : THERE MUST BE AT LEAST 4 IMAGES AND THE NUMBER OF EXPLANATIONS OF IMAGES MUST BE EQUAL WITH IMAGES' NUMBER! CHECK THE BACKGOUND IN JOOMLA CMS </h1>";

}	

		
		
}
			

				$content = __('<div id="borggique", class="borggique">haha</div>','kwpborgs-gallery');

	
        $contentValue = $content ? $content : __('CONF Kwpborgs Gallery Shortcode', 'kwpborgs-gallery');

        return '<span data-borgs-id="' . $id . '" style="cursor:pointer;">' . $contentValue . '</span>';
	

}

}

/**
 * Register [plugin_shorcode] shortcode
 *
 * usage: [plugin_shorcode id='entry-id']Preview[/plugin_shorcode]
 * or: [plugin_shorcode id='entry-id' /]
 *[kwpborgs_gallery id='1' /]
 * @since    1.0.0
 */
add_shortcode('kwpborgs_gallery', array(Kwpborgs_Gallery_Shortcode_Public::get_instance(), 'render_sc'));
