<?php

/**
 * Plugin Name: WP-Multirow-Slider
 * Description: Multirow slider for wordpress.
 * Version: 1.0.0
 * License: GPLv2 or later
 * Plugin URI: https://wordpress.org/plugins/wp-multirow-slider/
 * Author: Betlace
 * Author URI: https://www.betlace.com/
 *
 * @package WP-Multirow-Slider
 *
*/

/** Install Folder */
define('WPMRS_FOLDER', '/' . dirname( plugin_basename(__FILE__)));

/** Path for front-end links */
define('WPMRS_URL', WP_PLUGIN_URL . WPMRS_FOLDER);

// Post type
define('WPMRS_POSTYPE', 'wpmrs');

add_action( 'init', 'wpmrs_create_post_type' );

// ===================
// ** Setup the style and script
// ===================
add_action( 'init', 'wpmrs_add_style' );
add_action( 'init', 'wpmrs_add_script' );

	
function wpmrs_add_style(){
	wp_register_style('wpmultirowslider.css', WPMRS_URL . '/wpmultirowslider.css');
	wp_enqueue_style('wpmultirowslider.css');
	wp_register_style('slick-slider.css', WPMRS_URL . '/js/slick/slick.css');
	wp_enqueue_style('slick-slider.css');
}
	
function wpmrs_add_script(){
    wp_register_script( 'slick-slider', WPMRS_URL . '/js/slick/slick.js', array('jquery'));
    wp_enqueue_script( 'slick-slider' );
}

// =======================
// ** Create the post type
// =======================
function wpmrs_create_post_type() {
	// Define the labels
	$labels = array(
		'name' => _x('WPMultirowSlider', 'post type general name'),
		'add_new' => _x('Add New Slide', 'new slide')
	);
		
	// Register the post type
	register_post_type(WPMRS_POSTYPE, array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'query_var' => true,
		'menu_icon' => WPMRS_URL .'/images/gallery_ico.png',
		'supports' => array(
				'title',
        'editor',
        'thumbnail'),
    'taxonomies' => array('wpmrs_category')
  ));
  
  register_taxonomy( 'wpmrs_category', [ 'wpmrs' ], [ 
		'label'                 => '',
		'labels'                => [
			'name'              => 'Wpmrs category',
			'singular_name'     => 'Wpmrs',
			'search_items'      => 'Search Wpmrs',
			'all_items'         => 'All Wpmrs',
			'view_item '        => 'View Wpmrs',
			'parent_item'       => 'Parent Wpmrs',
			'parent_item_colon' => 'Parent Wpmrs:',
			'edit_item'         => 'Edit Wpmrs',
			'update_item'       => 'Update Wpmrs',
			'add_new_item'      => 'Add New Category',
			'new_item_name'     => 'New Wpmrs Name',
			'menu_name'         => 'Wpmrs categories',
		],
		'description'           => '',
		'public'                => true,
		'hierarchical'          => true,
		'rewrite'               => true,
		'capabilities'          => array(),
		'meta_box_cb'           => null,
		'show_admin_column'     => false,
		'show_in_rest'          => null,
		'rest_base'             => null,
	] );
}

add_action('admin_menu', 'register_wpmrs_instruction_page');
function register_wpmrs_instruction_page() {
  add_submenu_page('edit.php?post_type=wpmrs', 'Wpmrs instruction', 'Wpmrs instruction', 'manage_options', 'wpmrs-instruction', 'wpmrs_instruction_content');
}

function wpmrs_instruction_content() {
  echo '<div class="wrap">';
  echo '<h2>'. get_admin_page_title() .'</h2>';
  echo '</div>';
  echo '<div class="wpms_instruction_content">
    <p>Simple shortcode, show all images - [wpmultirowslider]</p>
    <p>To show images from special category, use "category" option - [wpmultirowslider category="24"] (number - category id)</p>
    <p>Slider default options:</p>
    <ul>
      <li>infinite => true</li>
      <li>slidesToShow => 1</li>
      <li>slidesToScroll => 1</li>
      <li>rows => 1</li>
      <li>slidesPerRow => 1</li>
      <li>dots => false</li>
      <li>arrows => true</li>
      <li>speed => 300</li>
      <li>autoplay => false</li>
      <li>centermode => false</li>
      <li>equal_height => false (not work with MULTI ROW SETTINGS)</li>
    </ul>
    <p>Use this options in shortcode for customize slider, example:</p>
    <p>[wpmultirowslider category="24" slidesToShow="2" slidesToScroll="2" arrows="false"]</p>
    <p>For MULTI ROW slider - [wpmultirowslider category="24" rows="3" slidesPerRow="3"]</p>
    <p>Option for responsive breakpoints:</p>
    <ul class="wpms_instruction_breakpoints">
      <li>1200_infinite</li>
      <li>1200_slidesToShow</li>
      <li>1200_slidesToScroll</li>
      <li>1200_rows</li>
      <li>1200_slidesPerRow</li>
      <li>1200_dots</li>
      <li>1200_arrows</li>
      <li>1200_speed</li>
      <li>1200_autoplay</li>
      <li>1200_centermode</li>
    </ul>
    <ul class="wpms_instruction_breakpoints">
      <li>991_infinite</li>
      <li>991_slidesToShow</li>
      <li>991_slidesToScroll</li>
      <li>991_rows</li>
      <li>991_slidesPerRow</li>
      <li>991_dots</li>
      <li>991_arrows</li>
      <li>991_speed</li>
      <li>991_autoplay</li>
      <li>991_centermode</li>
    </ul>
    <ul class="wpms_instruction_breakpoints">
      <li>767_infinite</li>
      <li>767_slidesToShow</li>
      <li>767_slidesToScroll</li>
      <li>767_rows</li>
      <li>767_slidesPerRow</li>
      <li>767_dots</li>
      <li>767_arrows</li>
      <li>767_speed</li>
      <li>767_autoplay</li>
      <li>767_centermode</li>
    </ul>
    <ul class="wpms_instruction_breakpoints">
      <li>575_infinite</li>
      <li>575_slidesToShow</li>
      <li>575_slidesToScroll</li>
      <li>575_rows</li>
      <li>575_slidesPerRow</li>
      <li>575_dots</li>
      <li>575_arrows</li>
      <li>575_speed</li>
      <li>575_autoplay</li>
      <li>575_centermode</li>
    </ul>
    <p>Exaples:</p>
    <p>[wpmultirowslider category="24" slidesToShow="3" 1200_slidesToShow="2" 767_slidesToShow="1" slidesToScroll="3" 1200_slidesToScroll="2" 767_slidesToScroll="1"]</p>
  ';

}

//==================================
// ** Add Shortcode [wpmultirowslider]
//==================================
	
add_shortcode('wpmultirowslider', 'wpmultirowslider_shortcode');

function wpmultirowslider_shortcode($atts, $content = null) { 
  global $wpdb;
  
  $a = shortcode_atts( array(
    'category' => '',
    'infinite' => 'true',
    'slidestoshow' => 1,
    'slidestoscroll' => 1,
    'rows' => 1,
    'slidesperrow' => 1,
    'dots' => 'false',
    'arrows' => 'true',
    'speed' => 300,
    'autoplay' => 'false',
    'centermode' => 'false',
  ), $atts );

  isset($atts['1200_infinite']) ? $infinite_1200 = $atts['1200_infinite'] : $infinite_1200 = $a['infinite'];
  isset($atts['1200_slidestoshow']) ? $slidestoshow_1200 = $atts['1200_slidestoshow'] : $slidestoshow_1200 = $a['slidestoshow'];
  isset($atts['1200_slidestoscroll']) ? $slidestoscroll_1200 = $atts['1200_slidestoscroll'] : $slidestoscroll_1200 = $a['slidestoscroll'];
  isset($atts['1200_rows']) ? $rows_1200 = $atts['1200_rows'] : $rows_1200 = $a['rows'];
  isset($atts['1200_slidesperrow']) ? $slidesperrow_1200 = $atts['1200_slidesperrow'] : $slidesperrow_1200 = $a['slidesperrow'];
  isset($atts['1200_dots']) ? $dots_1200 = $atts['1200_dots'] : $dots_1200 = $a['dots'];
  isset($atts['1200_arrows']) ? $arrows_1200 = $atts['1200_arrows'] : $arrows_1200 = $a['arrows'];
  isset($atts['1200_speed']) ? $speed_1200 = $atts['1200_speed'] : $speed_1200 = $a['speed'];
  isset($atts['1200_autoplay']) ? $autoplay_1200 = $atts['1200_autoplay'] : $autoplay_1200 = $a['autoplay'];
  isset($atts['1200_centermode']) ? $centermode_1200 = $atts['1200_centermode'] : $centermode_1200 = $a['centermode'];

  isset($atts['991_infinite']) ? $infinite_991 = $atts['991_infinite'] : $infinite_991 = $infinite_1200;
  isset($atts['991_slidestoshow']) ? $slidestoshow_991 = $atts['991_slidestoshow'] : $slidestoshow_991 = $slidestoshow_1200;
  isset($atts['991_slidestoscroll']) ? $slidestoscroll_991 = $atts['991_slidestoscroll'] : $slidestoscroll_991 = $slidestoscroll_1200;
  isset($atts['991_rows']) ? $rows_991 = $atts['991_rows'] : $rows_991 = $rows_1200;
  isset($atts['991_slidesperrow']) ? $slidesperrow_991 = $atts['991_slidesperrow'] : $slidesperrow_991 = $slidesperrow_1200;
  isset($atts['991_dots']) ? $dots_991 = $atts['991_dots'] : $dots_991 = $dots_1200;
  isset($atts['991_arrows']) ? $arrows_991 = $atts['991_arrows'] : $arrows_991 = $arrows_1200;
  isset($atts['991_speed']) ? $speed_991 = $atts['991_speed'] : $speed_991 = $speed_1200;
  isset($atts['991_autoplay']) ? $autoplay_991 = $atts['991_autoplay'] : $autoplay_991 = $autoplay_1200;
  isset($atts['991_centermode']) ? $centermode_991 = $atts['991_centermode'] : $centermode_991 = $centermode_1200;

  isset($atts['767_infinite']) ? $infinite_767 = $atts['767_infinite'] : $infinite_767 = $infinite_991;
  isset($atts['767_slidestoshow']) ? $slidestoshow_767 = $atts['767_slidestoshow'] : $slidestoshow_767 = $slidestoshow_991;
  isset($atts['767_slidestoscroll']) ? $slidestoscroll_767 = $atts['767_slidestoscroll'] : $slidestoscroll_767 = $slidestoscroll_991;
  isset($atts['767_rows']) ? $rows_767 = $atts['767_rows'] : $rows_767 = $rows_991;
  isset($atts['767_slidesperrow']) ? $slidesperrow_767 = $atts['767_slidesperrow'] : $slidesperrow_767 = $slidesperrow_991;
  isset($atts['767_dots']) ? $dots_767 = $atts['767_dots'] : $dots_767 = $dots_991;
  isset($atts['767_arrows']) ? $arrows_767 = $atts['767_arrows'] : $arrows_767 = $arrows_991;
  isset($atts['767_speed']) ? $speed_767 = $atts['767_speed'] : $speed_767 = $speed_991;
  isset($atts['767_autoplay']) ? $autoplay_767 = $atts['767_autoplay'] : $autoplay_767 = $autoplay_991;
  isset($atts['767_centermode']) ? $centermode_767 = $atts['767_centermode'] : $centermode_767 = $centermode_991;

  isset($atts['575_infinite']) ? $infinite_575 = $atts['575_infinite'] : $infinite_575 = $infinite_767;
  isset($atts['575_slidestoshow']) ? $slidestoshow_575 = $atts['575_slidestoshow'] : $slidestoshow_575 = $slidestoshow_767;
  isset($atts['575_slidestoscroll']) ? $slidestoscroll_575 = $atts['575_slidestoscroll'] : $slidestoscroll_575 = $slidestoscroll_767;
  isset($atts['575_rows']) ? $rows_575 = $atts['575_rows'] : $rows_575 = $rows_767;
  isset($atts['575_slidesperrow']) ? $slidesperrow_575 = $atts['575_slidesperrow'] : $slidesperrow_575 = $slidesperrow_767;
  isset($atts['575_dots']) ? $dots_575 = $atts['575_dots'] : $dots_575 = $dots_767;
  isset($atts['575_arrows']) ? $arrows_575 = $atts['575_arrows'] : $arrows_575 = $arrows_767;
  isset($atts['575_speed']) ? $speed_575 = $atts['575_speed'] : $speed_575 = $speed_767;
  isset($atts['575_autoplay']) ? $autoplay_575 = $atts['575_autoplay'] : $autoplay_575 = $autoplay_767;
  isset($atts['575_centermode']) ? $centermode_575 = $atts['575_centermode'] : $centermode_575 = $centermode_767;

  isset($atts['equal_height']) ? $equal_height = $atts['equal_height'] : $equal_height = false;



  if($a['category'] > 0) {
    $rows = $wpdb->get_results( "SELECT w.id, w.post_date, w.post_title, w.post_content FROM $wpdb->posts w LEFT JOIN  $wpdb->term_relationships as t ON ID = t.object_id WHERE w.post_type = 'wpmrs' and w.post_status='publish' and t.term_taxonomy_id = ".$a['category']." ORDER BY w.post_date DESC");
  } else {
    $rows = $wpdb->get_results( "SELECT w.id, w.post_date, w.post_title, w.post_content FROM $wpdb->posts w WHERE w.post_type = 'wpmrs' and w.post_status='publish' ORDER BY w.post_date DESC");
  }

  $sliderId = rand(100, 99999);
  
	$display = '';
  $display = '<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function(event) { 
    jQuery(function() {
      jQuery(".wpmrs'.esc_html($sliderId).'").slick({
        infinite: '.esc_attr($a["infinite"]).',
        slidesToShow: '.esc_attr($a["slidestoshow"]).',
        slidesToScroll: '.esc_attr($a["slidestoscroll"]).',
        rows: '.esc_attr($a["rows"]).',
        slidesPerRow: '.esc_attr($a["slidesperrow"]).',
        dots: '.esc_attr($a["dots"]).',
        arrows: '.esc_attr($a["arrows"]).',
        speed: '.esc_attr($a["speed"]).',
        autoplay: '.esc_attr($a["autoplay"]).',
        centerMode: '.esc_attr($a["centermode"]).',
        responsive: [
        {
          breakpoint: 1199,
          settings: {
            infinite: '.esc_attr($infinite_1200).',
            slidesToShow: '.esc_attr($slidestoshow_1200).',
            slidesToScroll: '.esc_attr($slidestoscroll_1200).',
            rows: '.esc_attr($rows_1200).',
            slidesPerRow: '.esc_attr($slidesperrow_1200).',
            dots: '.esc_attr($dots_1200).',
            arrows: '.esc_attr($arrows_1200).',
            speed: '.esc_attr($speed_1200).',
            autoplay: '.esc_attr($autoplay_1200).',
            centerMode: '.esc_attr($centermode_1200).',
          }
        },
        {
          breakpoint: 991,
          settings: {
            infinite: '.esc_attr($infinite_991).',
            slidesToShow: '.esc_attr($slidestoshow_991).',
            slidesToScroll: '.esc_attr($slidestoscroll_991).',
            rows: '.esc_attr($rows_991).',
            slidesPerRow: '.esc_attr($slidesperrow_991).',
            dots: '.esc_attr($dots_991).',
            arrows: '.esc_attr($arrows_991).',
            speed: '.esc_attr($speed_991).',
            autoplay: '.esc_attr($autoplay_991).',
            centerMode: '.esc_attr($centermode_991).',
          }
        },
        {
          breakpoint: 767,
          settings: {
            infinite: '.esc_attr($infinite_767).',
            slidesToShow: '.esc_attr($slidestoshow_767).',
            slidesToScroll: '.esc_attr($slidestoscroll_767).',
            rows: '.esc_attr($rows_767).',
            slidesPerRow: '.esc_attr($slidesperrow_767).',
            dots: '.esc_attr($dots_767).',
            arrows: '.esc_attr($arrows_767).',
            speed: '.esc_attr($speed_767).',
            autoplay: '.esc_attr($autoplay_767).',
            centerMode: '.esc_attr($centermode_767).',
          }
        },
        {
          breakpoint: 575,
          settings: {
            infinite: '.esc_attr($infinite_575).',
            slidesToShow: '.esc_attr($slidestoshow_575).',
            slidesToScroll: '.esc_attr($slidestoscroll_575).',
            rows: '.esc_attr($rows_575).',
            slidesPerRow: '.esc_attr($slidesperrow_575).',
            dots: '.esc_attr($dots_575).',
            arrows: '.esc_attr($arrows_575).',
            speed: '.esc_attr($speed_575).',
            autoplay: '.esc_attr($autoplay_575).',
            centerMode: '.esc_attr($centermode_575).',
          }
        } ],
      });
    });
  });

</script>';

  if($equal_height == true) {
    $equal_height_style = 'inherit!important';
  }
  else {
    $equal_height_style = '100%';
  }
  
  $display .='<style>
  .wpmultirowslider .slick-prev {
    font-size: 0;
    border: none;
    background: none;
  }
  .wpmultirowslider .slick-prev:before {
    content: "";
    display: block;
    position: absolute;
    background: url("'.esc_url(WPMRS_URL).'/images/prev.png");
    width: 50px;
    height: 50px;
    z-index: 10;
    background-repeat: no-repeat;
    background-size: contain;
    cursor: pointer;
    top: 50%;
    left: -10px;
    transform: translateY(-50%);
  }
  .wpmultirowslider .slick-prev:focus {
    outline: none;
  }
  .wpmultirowslider .slick-next {
    font-size: 0;
    border: none;
    background: none;
  }
  .wpmultirowslider .slick-next:before {
    content: "";
    display: block;
    position: absolute;
    background: url("'.esc_url(WPMRS_URL).'/images/next.png");
    width: 50px;
    height: 50px;
    z-index: 10;
    background-repeat: no-repeat;
    background-size: contain;
    cursor: pointer;
    top: 50%;
    right: -10px;
    transform: translateY(-50%);
  }
  .wpmultirowslider .slick-next:focus {
    outline: none;
  }
  .wpmrs'.esc_html($sliderId).' .slick-slide {height: '.esc_attr($equal_height_style).';}
  </style>';


	$display .= '<div class="wpmultirowslider wpmrs'.esc_html($sliderId).'">';
		
	foreach ( (array) $rows as $row ) {
    $thumb = get_the_post_thumbnail_url($row->id);
		
		$display .= '<div class="img_container">';
		$display .= '<img src="'.esc_url($thumb).'" alt=""/>';
		$display .= '</div>';
			
	}		

	$display .= '</div><div class="clear"></div>';
		
	return $display;
}