<?php  
/* 
Plugin Name: Dx Scan Texts
Plugin URI: http://www.designlex.com/
Description: Compare and scan two texts/texts for duplicacy.  Display results in %age 
Version: 1.0 
Author: Sagar Awasthi 
Author URI: http://www.designlex.com
License: GPLv2 or later


'Dx Scan Texts' is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
'Dx Scan Texts' is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with 'Dx Scan Texts'. If not, write to the Free Software
 Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

defined('ABSPATH') or die;

//Global Options
$wpscantexts_options = get_option('wpscantextssettings');

//original_txt text
$original_txt_txt = $wpscantexts_options['original_txt'];

//spun text
$rewritten_txt = $wpscantexts_options['rewritten_txt'];

//compare texts

$dx_scantextsfunction = similar_text($original_txt_txt, $rewritten_txt, $scanned);


/*
 * Admin PAge
 * @ver 1.0
 */

function dx_scan_texts_page() {
	
	global $wpscantexts_options;
	global $scanned;
	ob_start();
	?>
	<div class="wrap">
			<br>
			<h1>Dx's Texts/Article Scanner Engine</h1><br>
			<hr>
			<form action="options.php" method="POST">
		<?php settings_fields('wpscantextsgroup'); ?>	
			<p>
				<h3>Paste your original text/article/post</h3>
				<textarea cols="100" rows="20" name="wpscantextssettings[original_txt]" ><?php echo $wpscantexts_options['original_txt'] ?></textarea>
			</p>
			<hr>
			<p>
			<h3>Paste your re-written text/text</h3>
			<textarea cols="100" rows="20" name="wpscantextssettings[rewritten_txt]" ><?php echo $wpscantexts_options['rewritten_txt'] ?></textarea>
			</p>
			<p><input type="submit" value="Scan Texts" class="button-primary"> </p>
			<hr>
			<p>Simliar content in the text: <input type="button" value="<?php echo round($scanned, 2).' %'?>" class="button"></p>
		</form>
			</div>
			<hr>
	<?php 
	echo ob_get_clean();
}


/*
 * Admin Tab
 * @version 1.0
 *  
 */

function dx_scan_texts_tab() {
	
	$page_title = 'Dx Scan Texts';
	$menu_title = 'Dx Scan Texts';
	$capability = 'manage_options';
	$menu_slug = 'dxtextchecker';
	//Adding submenu to the page
	add_options_page($page_title, $menu_title, $capability, $menu_slug, 'dx_scan_texts_page');
	
}
add_action('admin_menu', 'dx_scan_texts_tab');

function dx_scan_texts_setting() {
	register_setting('wpscantextsgroup', 'wpscantextssettings');
}
add_action('admin_init', 'dx_scan_texts_setting');


//
function dx_scan_texts_login_logo() {
	echo '<style>h1 a, h1 a:hover, h1 a:focus { font-size: 1.4em; font-weight: normal; text-align: center; text-indent: 0; line-height: 1.1em; text-decoration: none; color: #dadada; text-shadow: 0 -1px 1px #666, 0 1px 1px #fff; background-image: none !important; }</style>';
}

add_action('login_head', 'custom_login_logo');


// change administration panel footer

function dx_scan_texts_footer_admin() {
	return  'For support & suggestions, please mail me at <a href="mailto:mail@designlex.com">mail@designlex.com</a><br />contributed by www.designlex.com';
}

function dx_scan_texts__footer_version() {
	return 'Follow us for more plugins and FREE stuffs: <a  href="https://twitter.com/designlexcom"><img align="absmiddle" target="_blank" src="'.plugins_url( 'img/twitter.png', __FILE__ ) .'" /></a> <a target="_blank" href="https://www.facebook.com/designlex"><img align="absmiddle" src="'.plugins_url( 'img/fb.png', __FILE__ ) .'" /></a><a target="_blank" href="https://plus.google.com/+Designlexcom"><img align="absmiddle" src="'.plugins_url( 'img/googleplus.png', __FILE__ ) .'" /></a>';
}
add_filter( 'admin_footer_text', 'dx_scan_texts_footer_admin', 99);
add_filter( 'update_footer', 'dx_scan_texts__footer_version', 11 );

/*
 * End of plugin file: dx-scan-texts.php
 * File Location: root/wp-content/plugins/dx-scan-texts/dx-scan-texts.php
 * */