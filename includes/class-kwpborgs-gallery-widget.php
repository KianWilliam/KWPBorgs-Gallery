<?php
/*

Plugin Name: Kwpborgs Gallery Widget
Description: Borgs Gallery
Version: 1.0
author:    KWProductions Co.
license:   GPL-2.0+
 link:      https://extensions.kwproductions121.ir
copyright: All rights reserved
 
 */


/**
 *-----------------------------------------
 * Do not delete this line
 * Added for security reasons: http://codex.wordpress.org/Theme_Development#Template_Files
 *-----------------------------------------
 */
defined('ABSPATH') or die("Direct access to the script does not allowed");
/*-----------------------------------------*/

/**
 * Core class used to implement a Recent Posts widget.
 *
 * @since 1.0.0
 *
 * @see WP_Widget
 */
 
  class Kwpborgs_gallery_Widget_Init
    {
        public function __construct()
        {
			
            add_action('widgets_init', array($this, 'register_widget'));
        }

        public function register_widget()
        {
		
			
            register_widget('Kwpborgs_Gallery_Widget');
        }
    }
 
 
class Kwpborgs_Gallery_Widget extends WP_Widget {
	

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	 
	public function __construct() {
		
		$widget_ops = array(
			'classname'   => 'kwpborgs_gallery',
			'description' => __( 'The Borgs galleries.', 'text_domain' ),
			'show_instance_in_rest' => true,
		//	'customize_selective_refresh' => true,
		);
		parent::__construct( 'kwpborgs_gallery_widget', 'Kwpborgs_Gallery_Widget', $widget_ops );
		
	}
	public function kwpborgs_gallery_get_shortcode($inst)
	{
		return 	 '["kwpborgs_gallery"  "id="' .$inst['galleries']. '"]';

	}


	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
	
		
		extract($args);
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'The Borgs Gallery', 'kwpborgs-gallery' );
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

				 echo $before_widget;
					if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}

             //   $this->kwpborgs_gallery_get_shortcode($instance);

		global $wpdb;

		
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

	
		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 1.0.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		 //here publish the gallery in the site part using the id I set in function form of widget in backsite
		 //
	$result = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."kwpborgs_gallery WHERE id =" . $instance['galleries'], OBJECT);
	$path = plugin_basename(__FILE__);
	$i = strpos($path, '/');
	$pluginName = substr($path, 0, $i);
	

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

	

	
		

  if ($result[0]->title) :
		    echo '<h2><span class="borggique-name">';
			      echo $result[0]->title;
			echo '</span></h2>';
   endif;  
   
   
		
		
		?>
		
		
         <div id="borggique" class="borggique">
         </div>
    
<?php
		
		echo $after_widget;
		
		
		}

	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 
	 */
	public function update( $new_instance, $old_instance ) {
		$instance 					= $old_instance;
		$instance['title'] 			= sanitize_text_field( $new_instance['title'] );
		//$instance['entries_number'] = (int) $new_instance['entries_number'];
		//$instance['display_date'] 	= isset( $new_instance['display_date'] ) ? (bool) $new_instance['display_date'] : false;
		$instance['galleries'] = $new_instance['galleries'];
		return $instance;
		/*$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;*/
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 * This is the background site of widget to consider for widgets
	 * add a select box to print all galleries with ids here
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 * @return string|void
	 */
	public function form( $instance ) {
		global $wpdb;
		$results = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."kwpborgs_gallery");
		$title     		= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		
		$galleries = isset($instance["galleries"]) ? $instance["galleries"] : 0;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'kwpborgs-gallery' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
       	<p><label for="<?php echo $this->get_field_id( 'galleries' ); ?>"><?php _e( 'Galleries:', 'kwpborgs-gallery' ); ?></label>
     	   <select  class="widefat" name="<?php echo $this->get_field_name('galleries') ?>"  id="<?php $this->get_field_id('galleries') ?>" >
  
<?php

       foreach($results as $result){
			  if($galleries == $result->id)
			  echo "<option value='".$result->id."' selected>".$result->title."</option>";
		      else
		      echo "<option value='".$result->id."'>".$result->title."</option>";

				  
		  }
?>
		
          </select>

<?php
	} //end of form function
} //end of class


/**
 * Register Widgets
 * 
 * @since 1.0.0
 */
 /*
function kwpborgs_gallery_register_widgets() {
	register_widget( 'Kwpborgs_Gallery_Recent_Entries' );
}
add_action( 'widgets_init', 'kwpborgs_gallery_register_widgets' );
*/