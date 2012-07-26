<?php
/*
Plugin Name: ggis Inline Post
Plugin URI: http://dvector.com/oracle/ggis-inlinepost/
Description: Allows you to include posts in pages (and in other posts). Simply add [ggisinlinepost id="id"] to your post.
Author: Gary Dalton
Version: 1.2
Author URI: http://dvector.com/oracle/
*/
/*
ACKNOWLEDGEMENT
This plugin draws the idea but very little code from the inlineposts.php plugin by Aral Balkan version 2.1.2.g ( http://aralbalkan.com)
*/

/*  Copyright 2008-2010 Gary Dalton  (email : PLUGIN AUTHOR EMAIL)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

// Pre-2.6 compatibility
// DISABLE/false COMPATIBILITY
if ( true ){
	if ( ! defined( 'WP_CONTENT_URL' ) )
		  define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
	if ( ! defined( 'WP_CONTENT_DIR' ) )
		  define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
	if ( ! defined( 'WP_PLUGIN_URL' ) )
		  define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
	if ( ! defined( 'WP_PLUGIN_DIR' ) )
		  define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
}
  
/*
*	START CLASS
*/
if (!class_exists("ggisInlinepost")) {
	class ggisInlinepost {
		var $adminOptionsName = 'ggisInlinepostAdminOptions';	

		function ggisInlinepost() { //constructor
		}
		
		/**
		* Method to extract key/value pairs out of a string with xml style attributes
		*
		* @param    string    $string    String containing xml style attributes
		* @return    array    Key/Value pairs for the attributes
		*/

	    function parseAttributes( $string ){
			//Initialize variables
			$attr        = array();
			$retarray    = array();
			
			// Lets grab all the key/value pairs using a regular expression
			preg_match_all( '/([\w:-]+)[\s]?=[\s]?"([^"]*)"/i', $string, $attr );
			
			if (is_array($attr)){
				$numPairs = count($attr[1]);
				for($i = 0; $i < $numPairs; $i++ ){
					$retarray[$attr[1][$i]] = $attr[2][$i];
				}
			}
			return $retarray;
		}

		// ACTIVATE PLUGIN
		function ggisinlinepost_activate(){
			// Set default options
			$options = array( 'titletag'	=> 'h3',
							'topseparator'	=> 0,
							'botseparator'	=> 0,
							'showtitle'		=> 1,
							'showmeta'		=> 1
						);
			add_option( 'ggis-Inlinepost', serialize( $options));
		}
		
		// DEACTIVATE PLUGIN
		function ggisinlinepost_deactivate(){
			delete_option( 'ggis-Inlinepost');
		}
		
		// OUTPUT FUNCTIONS
		var $processing_unit_tag;
		var $processing_within;
		var $unit_count;
		var $regex = '/\[-\s*ggis-inlinepost\s*(.*)?\s*-\]/';
		
		function the_content_filter($content) {
			$this->processing_within = 'p' . get_the_ID();
			$this->unit_count = 0;
			return preg_replace_callback($this->regex, array(&$this, 'the_content_filter_callback'), $content);
			
			$this->processing_within = null;
		}
		
		/**
		 * Handles the shortcode callback.
		 *
		 * @since 1.1
		 *
		 * @param string $atts Required.
		 * @return string
		 */
		function ggis_shortcode_handler($attrs){
			return $this->the_content_filter_callback(NULL, $attrs);
		
		}
		
		function the_content_filter_callback($matches, $attrs=FALSE) {
			// GET AND SET VARIABLES
			global $ggis_inlined_post_ids;
			$post = NULL;
			$postout = '';
			$toprule = '';
			$bottomrule = '';
			$default_params = unserialize( get_option( 'ggis-Inlinepost'));
			// Changed in 1.1 to handle the new shortcode convention
			//$my_params = $this->parseAttributes($matches[1]);
			if ( $attrs === FALSE ){
				$my_params = $this->parseAttributes($matches[1]);
			}else{
				$my_params = $attrs;
			}
			
						
			if( !isset($my_params['id']) ){
				return '';
			}
			
			if( !isset($my_params['titletag']) )		$my_params['titletag'] = $default_params['titletag'];
			if( !isset($my_params['topseparator']) )	$my_params['topseparator'] = $default_params['topseparator'];
			if( !isset($my_params['botseparator']) )	$my_params['botseparator'] = $default_params['botseparator'];
			if( !isset($my_params['showtitle']) )		$my_params['showtitle'] = $default_params['showtitle'];
			if( !isset($my_params['showmeta']) )		$my_params['showmeta'] = $default_params['showmeta'];
			if( !isset($my_params['showcontent']) )		$my_params['showcontent'] = 1;	// added 1.1
			

			if( $my_params['topseparator'] )			$toprule = '<hr />';
			if( $my_params['botseparator'] )			$bottomrule = '<hr />';
			
			// GET AND FORMAT POST
			$this->unit_count += 1;
			$unit_tag = 'ggis-inlinepost-f' . $my_params['id'] . '-' . $this->processing_within;
			$this->processing_unit_tag = $unit_tag;
			
			// PREVENT DUPLICATED INLINING
			if ( isset($ggis_inlined_post_ids) ){
				if ( in_array($my_params['id'], $ggis_inlined_post_ids) ){
					$postout = '<!-- ggis-InlinePost already included postID = ';
					$postout .= $my_params['id'];
					$postout .= '. Inifinite inlined loop avoided.  -->';
					return $postout;
				}
			}
			
			// GET POST
			$ggis_inlined_post_ids[] = $my_params['id'];
			$post = get_post($my_params['id']);
			$postout .= '<div class="ggis-inlinepost" id="' . $unit_tag . '">';
			$postout .= $toprule;
			// Post title
			if( $my_params['showtitle'] ){
				$postout .= (strlen($my_params['titletag']) > 0) ? '<'. $my_params['titletag'] .'>' : '';	// open title tag
				$postout .= '<a href="'. get_permalink($my_params['id']) .'">';	// open link to post
				$postout .= $post->post_title;									// title
				$postout .= '</a>';												// close link tag
				$postout .= (strlen($my_params['titletag']) > 0) ? '</'. $my_params['titletag'] .'>' : '<br />';	// close title tag
			}
			// Post metadata
			if( $my_params['showmeta'] ){
				$postout .= '<div class="entry-meta">';
				$postout .= $this->ggis_format_author($post->post_author);
				$postout .= '<span class="meta-sep"> | </span>';
				$postout .= $this->ggis_format_time($post->post_modified);
				$postout .= '<span class="meta-sep"> | </span>';
				$postout .= $this->ggis_format_comments($post->ID);
				$postout .= '</div>';
			}
			// Post content
			if( $my_params['showcontent'] ){	// added in 1.1
				$post_content = $this->ggis_format_post_content($post);
				//$postout .= '<p>'.format_to_post($post_content).'</p>';
				$postout .= format_to_post($post_content);
			}
			
			$postout .= $bottomrule;
			$postout .= '</div>';
			
			$this->processing_unit_tag = null;
			return $postout;
		}
		
		/**
		 * Format the comments metadata.
		 *
		 * @since 1.0
		 *
		 * @param string $post_id Required.
		 * @return string
		 */
		function ggis_format_comments($post_id){
			$numComments = get_comments_number($post_id);
			$commentsout = ' <a href="'. get_permalink($post_id) .'#comments">';
			$commentsout .= $numComments .' comment'; 
			$commentsout .= ($numComments == 1) ? '':'s';
			$commentsout .= '</a>';
			return $commentsout;
		}
		
		/**
		 * Format the time metadata.
		 *
		 * @since 1.0
		 *
		 * @param string $post_modified Required. Updated time to format.
		 * @return string
		 */
		function ggis_format_time($post_modified){
			$entrydate = '<span class="meta-prep">' . 'Updated: ' . '</span>';
			$entrydate .= '<span class="entry-date"><abbr class="published" title="';
			$entrydate .= $post_modified . '">';
			$entrydate .= date('F d, Y', strtotime($post_modified));
			$entrydate .= '</abbr></span>';
			return $entrydate;
		}
		
		/**
		 * Format the author metadata.
		 *
		 * @since 1.0
		 *
		 * @param string $author_id Required. ID of author to collect.
		 * @return string
		 */
		function ggis_format_author($author_id=NULL){
			$authorlink = '<span class="meta-prep">' . 'By ' . '</span>';
			$authorlink .= '<span class="author vcard">'. '<a class="url fn n" href="';
			$authorlink .= get_bloginfo('url') . '?author=' .$author_id;
			$authorlink .= '" title="' . __('View all posts by ', 'thematic') . get_the_author_meta('user_nicename', $author_id) . '">';
			$authorlink .= get_the_author_meta('user_nicename', $author_id);
			$authorlink .= '</a></span>';
			return $authorlink;

		}
		
		/**
		 * Format the post content.
		 *	This is based upon the WP functions of the_content() and
		 *	get_the_content() found in wp-includes/post-template.php.
		 *
		 * @since 1.0
		 *
		 * @param string $more_link_text Optional. Content for when there is more text.
		 * @param string $stripteaser Optional. Teaser content before the more text.
		 * @return string
		 */
		function ggis_format_post_content($post=NULL, $more_link_text=null, $stripteaser=0){
			$more = 0;
			
			if ( $more_link_text === NULL )
				$more_link_text = __( '(more...)' );

			$output = '';
			$hasTeaser = false;

			// If post password required and it doesn't match the cookie.
			if ( post_password_required($post->ID) ) {
				$output = get_the_password_form();
				return $output;
			}
			
			// Handling of the more shortcode
			$content = $post->post_content;
			if ( preg_match('/<!--more(.*?)?-->/', $content, $matches) ) {
			$content = explode($matches[0], $content, 2);
				if ( !empty($matches[1]) && !empty($more_link_text) )
					$more_link_text = strip_tags(wp_kses_no_null(trim($matches[1])));

				$hasTeaser = true;
			} else {
				$content = array($content);
			}

			if ( false !== strpos($post->post_content, '<!--noteaser-->') )
				$stripteaser = 1;
			$teaser = $content[0];
			if ( ($more) && ($stripteaser) && ($hasTeaser) )
				$teaser = '';
			$output .= $teaser;

			if ( count($content) > 1 ) {
				if ( $more ) {
					$output .= '<span id="more-' . $id . '"></span>' . $content[1];
				} else {
					if ( ! empty($more_link_text) )
						$output .= apply_filters( 'the_content_more_link', ' <a href="' . get_permalink($post->ID) . '" class="more-link">' . $more_link_text. '</a>', $more_link_text );
					$output = force_balance_tags($output);
				}
			}
			if ( $preview ) // preview fix for javascript bug with foreign languages
				$output =	preg_replace_callback('/\%u([0-9A-F]{4})/', create_function('$match', 'return "&#" . base_convert($match[1], 16, 10) . ";";'), $output);

			// Final formatting -- from the_content()
			$output = do_shortcode( $output );
			$output = apply_filters('the_content', $output);
			$output = str_replace(']]>', ']]&gt;', $output);
			return $output;
		}
		
		// ADMIN MENUS
		var $adminform = '';
		function ggis_admin_add_pages() {
			add_options_page('ggisInlinepost', 'ggisInlinepost', 'manage_options', basename(__FILE__), array(&$this, 'ggisinlinepost_options'));
		}
		
		function form_ggisinlinepost_options(){
			$form = '';
			$options = unserialize( get_option( 'ggis-Inlinepost'));
			
			$checktitle = $options['showtitle'] ? ' checked ' : '';
			$checkmeta = $options['showmeta'] ? ' checked ' : '';
			$checktop = $options['topseparator'] ? ' checked ' : '';
			$checkbottom = $options['botseparator'] ? ' checked ' : '';
			$form .= '<form method="post">';
			$form .= wp_nonce_field('ggis-inlinepost-update-options_base');
			$form .= '<fieldset><legend>Inline Post Options</legend>
						<p>All fields are optional.</p>';
			$form .= '<p>
						Tag to use for the posts title (eg. h3, p, h4; no more than 2 characters)<br />';
			$form .= '<input type="text"  size="60" name="ggisinlinepost_titletag" value="'. $options['titletag'] . '" />';
			$form .= '</p>
						<p>
						Show the title of the inlined post?<br />';
			$form .= '<input type="checkbox" name="ggisinlinepost_showtitle" value="1"'. $checktitle . ' />';
			$form .= '</p>
						<p>
						Show the metadata of the inlined post? Includes the last modified date and comments.<br />';
			$form .= '<input type="checkbox" name="ggisinlinepost_showmeta" value="1"'. $checkmeta . ' />';
			$form .= '</p>
						<p>
						Use horizontal rule as the top separator<br />';
			$form .= '<input type="checkbox" name="ggisinlinepost_topseparator" value="1"'. $checktop . ' />';
			$form .= '</p>
						<p>
						Use horizontal rule as the bottom separator<br />';
			$form .= '<input type="checkbox" name="ggisinlinepost_botseparator" value="1"'. $checkbottom . ' />';
			$form .= '</p>
						<input type="hidden" name="action" value="update" />
						<input type="hidden" name="page_options" value="ggisinlinepost_titletag,ggisinlinepost_topseparator,ggisinlinepost_botseparator" />
						<p class="submit">';
			$form .= '<input type="submit" name="submit" value="Save Changes" /></p>
						</fieldset>';
						
			return $form;
		}
		
		function ggisinlinepost_options() {
			$this->adminform .= '<div class="wrap"><h2>ggis Inline Post</h2>';
			if ( $_POST['submit'] ){
				$this->adminform .= $this->update_ggisinlinepost_options();
			}
			$this->adminform .= $this->form_ggisinlinepost_options();
			$this->adminform .= '</div>';
			echo $this->adminform;
		}
		
		function update_ggisinlinepost_options(){
			$msg = '<div id="message" class="updated fade">';
			$options = NULL;
			
			check_admin_referer('ggis-inlinepost-update-options_base');
			
			if ( isset($_POST['ggisinlinepost_titletag']) ) {
				if ( strlen($_POST['ggisinlinepost_titletag']) > 2 ){
					$options['titletag'] = '';
					$msg .= '<p>Title tag too long, hence discarded.</p>';
				}else{
					$options['titletag'] = htmlspecialchars( $_POST['ggisinlinepost_titletag'] );
				}
			}
			if ( $_POST['ggisinlinepost_showtitle'] ) {
				$options['showtitle'] = $_POST['ggisinlinepost_showtitle'];
			}
			if ( $_POST['ggisinlinepost_showmeta'] ) {
				$options['showmeta'] = $_POST['ggisinlinepost_showmeta'];
			}
			if ( $_POST['ggisinlinepost_topseparator'] ) {
				$options['topseparator'] = $_POST['ggisinlinepost_topseparator'];
			}
			if ( $_POST['ggisinlinepost_botseparator'] ) {
				$options['botseparator'] = $_POST['ggisinlinepost_botseparator'];
			}
			if ( !is_null( $options) ){
				update_option( 'ggis-Inlinepost', serialize( $options));
				$msg .= '<p>Options saved.</p>';
			}
			$msg .= '</div>';
			return $msg;
		}
	
	}	//End Class ggisInlinepost
	
	// SUBSTANTIATE AND ACT USING CLASS	
	if (class_exists("ggisInlinepost")) {
		$ggisInlinepost = new ggisInlinepost();
	}
	
	//Actions and Filters   
	if (isset($ggisInlinepost)) {
		//Actions
		add_action('admin_menu', array(&$ggisInlinepost, 'ggis_admin_add_pages'));
		//Filters
		add_filter('the_content', array(&$ggisInlinepost, 'the_content_filter'));
		register_activation_hook( __FILE__, array(&$ggisInlinepost, 'ggisinlinepost_activate') );
		register_deactivation_hook( __FILE__, array(&$ggisInlinepost, 'ggisinlinepost_deactivate') );
		//Shortcodes
		add_shortcode('ggisinlinepost', array(&$ggisInlinepost, 'ggis_shortcode_handler'));
	}

}	// End ggis Inlinepost
	// include code in wordpress post - &#91;-ggis-inlinepost id="%id" titletag="%tag"-&#93;
	  
?>