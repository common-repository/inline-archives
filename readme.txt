=== Inline Archives ===
Contributors: makoto_kw
Donate link: https://makotokw.com/
Tags: widget
Requires at least: 2.8
Tested up to: 3.5.1
Stable tag: trunk
Requires PHP: 5.3.3

Display your monthly archives compactly by year with individual links to each month. Replacement for <code>wp_get_archives('type=monthly')</code>.

== Description ==

Display your monthly archives compactly by year with individual links to each month. Replacement for <code>wp_get_archives('type=monthly')</code>

== Installation ==

1. Upload `inline-archives` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Replace <code>wp_get_archives('type=monthly')</code> to:
<code>
  if (function_exists('inline_archives_get_contents')) {
    inline_archives_get_contents();
  } else {
    wp_get_archives('type=monthly');
  }
</code>
1. Or add `Inline Archive` widget.

== Frequently Asked Questions ==

== Screenshots ==

1. Before
2. After

== Upgrade Notice ==

== Changelog ==

= 0.2 =

* Fill month even if it has no posts

= 0.1 =

* released at 2012/08/01
* initial release