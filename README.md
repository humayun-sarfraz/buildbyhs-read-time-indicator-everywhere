# buildbyhs-read-time-indicator-everywhere

=== BuildByHS Read Time Indicator Everywhere ===
Displays an estimated "X min read" indicator at the top of post/page content and widget text. Word count defaults to 200 WPM but is configurable via filter.

== Installation ==
1. Upload the `buildbyhs-read-time-indicator-everywhere` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. The read time indicator will appear automatically.

== Usage and Customization ==
* Filter words per minute:
  `add_filter('rtie_words_per_minute', function($wpm){ return 250; });`
* Change the read time label:
  `add_filter('gettext', function($translation, $text, $domain){ if($text=='%d min read' && $domain=='read-time-indicator-everywhere') return '%d minute read'; return $translation; }, 10, 3);`

== Frequently Asked Questions ==
= How do I style the indicator? =
Edit or override `assets/css/rtie-style.css` in your theme or via another plugin.

= Can I disable widgets? =
Remove the filter with:
```
remove_filter('widget_text', 'rtie_widget_text_read_time', 5);
```

== Changelog ==
= 1.0 =
* Initial release with post and widget integration.

== Upgrade Notice ==
= 1.0 =
Initial plugin release.
