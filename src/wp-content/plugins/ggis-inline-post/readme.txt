=== ggis-InlinePost ===
Contributors: bujanga
Donate link: http://dvector.com/oracle/2008/11/04/donate-to-ggis-plugins-and-modules/
Tags: inline, post, include
Requires at least: 2.5
Tested up to: 3.0
Stable tag: 1.2

Include posts in pages (and in other posts). Simply add [ggisinlinepost id="id"] to your post.

== Description ==

ggis-InlinePost gives authors an easy way to insert a post within a page or another post. Simply add [ggisinlinepost id="id"] to your post. There are a few attributes to control the display of the inlined post's title, content, metadata, and separators.

== ChangeLog ==

= 1.2 =
* FIX:  Correct improper ordering of heading tags that caused
        HTML validation error.

= 1.1 =
* FIX:  Shortcodes within an inlined post are now processed.
        Uses do_shortcode().
* FIX:  Comment metadata now shows correct number of comments made.
* NEW:  Change code convention to shortcode which allows use of the
		standard shortcode functions. Old insert methods are
		deprecated but will still work.
* NEW:  Recursive inlining now allowed when using new shortcode 
		styling. Protection against infinite loop coded.
* NEW	Added the showcontent attribute to control display of the post's content

= 1.0 =
* FIX:	Correct paragraph formatting. 
* NEW:	Inlined post now recognizes the 'more' shortcode.
* NEW:	If a post requires a password, the password entry form will
		be displayed.
* UPDATE: Improved display of metadata.

== Installation ==

1. Download and unzip the plugin
2. Upload the ggis-inlinepost to the '/wp-content/plugins/' directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Edit the ggis InlinePost optional parameters from the Settings menu.
5. Place `[ggisinlinepost id="id"]` in your posts.


== Frequently Asked Questions ==

= Can I put more than 1 inline post on a page? =

Yes.

= Does this act recursively by including posts within posts within posts? =

Yes, but not when using the deprecated code convention.

= Why does a post not seem to show even when the plugin is working? =
= Do I need to worry about causing a recursive infinite loop? =

In order to prevent the recursive features of this plugin from causing an infinite loop, an inlined post limit has been set. 
If a post has already been inlined using the plugin, it will not be inlined again; instead an HTML comment will be inserted. If you think this might be happening, use your browser to view the page source. The comment, `<!-- ggis-InlinePost already included postID =??. Inifinite inlined loop avoided.  -->`, is inserted whenever ggis-InlinePost purposely does not inline a post.

= What usage do you recommend as best practice for this plugin? =

Because of the recursion issue, I only inline post onto pages. Wordpress does not strongly differentiate between posts and pages other than by a post_type flag. This means you could inline a page into a page. Best practice is to only inline posts into pages.

= How can I adjust the inline post's appearance? =

You should be able to fully control your form's appearance using CSS. The HTML output is fully embedded with CSS tags to make personalization easy. The DIV tag is of the form:
>	`<div class="ggis-inlinepost" id="ggis-inlinepost-f56-p69">`

The class applies to all inline posts but the id specifically identifies the post inlined (f) with the page it is inlined onto (p).

== Screenshots ==

1. A screenshot of the ggis InlinePost Settings page, screen1.png

== Upgrade Notice ==
Follow standard plugin upgrade procedures. No special actions are required.

== Usage ==

A post may be inlined onto a post or page, by including the following code in your text.

>	`[ggisinlinepost id="%id" attribute1="%attr1" attribute2="%attr2"]`

Here is an explanation of all the available attributes:

1. ggisinlinepost - identifies the shortcode (required)
2. id - id of post to include (required)
3. titletag - the tag in which to enclose the title (limited to simple tags such as h2, h5, p, b, etc.)
4. topseparator - put a horizontal rule before the post (0/1, default = 0) 
5. botseparator - put a horizontal rule after the post (0/1, default = 0)
6. showtitle - show title of the post (0/1, default = 1)
7. showmeta - show metadata of the post, includes modified date and comments (0/1, default = 1)
8. showcontent - show the main content of the post (0/1, default = 1)

Most of the above optional fields may be set via the wordpress dashboard settings. Below is a sample using all possible attributes and their default values:
>	`[ggisinlinepost id="4" titletag="h3" topseparator="0" botseparator="0" showtitle="1" showmeta="1" showcontent="1"]`

= Deprecated Usage =

The following code convention will still be properly parsed by this plugin though it usage has been superceded by the shortcode convention.

>	`[-ggis-inlinepost attribute1="%attr1" attribute2="%attr2"-]`
