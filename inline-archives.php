<?php
/*
 Plugin Name: Inline Archives
 Version: 0.2
 Plugin URI: http://wordpress.org/extend/plugins/inline-archives/
 Description: Display your monthly archives compactly by year with individual links to each month. Replacement for <code>wp_get_archives('type=monthly')</code>
 Author: makoto_kw
 Author URI: http://www.makotokw.com/
*/

function inline_archives_get_contents($args = '')
{
	global $wp_locale;
	$defaults = array('before_year' => '', 'after_year' => '', 'year_format' => 'Y', 'month_format' => 'n', 'echo' => 1);
	$args = wp_parse_args($args, $defaults);
	$archives = explode("\n", wp_get_archives(array_merge($args, (array('echo' => 0)))));
	extract($args, EXTR_SKIP);
	$years = array();
	foreach ($archives as $a) {
		if (preg_match('/\/([0-9]{4})\/([0-9]{2})\//', $a, $matches)) {
			$year = $matches[1];
			$month = $matches[2];
			$label = (empty($month_format)) ? $wp_locale->get_month($month) : date($month_format, mktime(0, 0, 0, $month, 1, $year));
			$a = preg_replace('/(.+<a[^>]+>)([^<]+)(<\/a>.+)/', '${1}' . $label . '$3', $a);
			if (!isset($years[$year])) $years[$year] = array();
			$years[$year][(int)$month] = $a;
		}
	}
	$output = '';
	foreach ($years as $year => $monthes) {
		$label = date($year_format, mktime(0, 0, 0, 1, 1, $year));
		$url = '/' . $year . '/';
		$output .= '<li class="inline-archives-year"><a href="' . $url . '">' . $before_year . $label . $after_year . '</a><ul class="children">';

		for ($i = 1; $i<=12; $i++) {
			if (is_null($monthes[$i])) {
				$output .= '<li> '.$i.' </li>';
			} else {
				$output .= $monthes[$i];
			}
		}
		$output .= '</ul></li>';
	}
	if ($echo) {
		echo $output;
	} else {
		return $output;
	}
}

include_once('inline-archives-widget.php');

function inline_archives_init()
{
	if (!is_admin()) {
		$wpurl = (function_exists('site_url')) ? site_url() : get_bloginfo('wpurl');
		$dir = end(explode(DIRECTORY_SEPARATOR, dirname(__FILE__)));
		wp_enqueue_style('compact-archives', $wpurl.'/wp-content/plugins/'.$dir.'/inline-archives.css',array(),'0,2');
	}
	register_widget('Inline_Archives_Widget');
}

add_action('init', 'inline_archives_init', 1);

