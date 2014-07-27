<?php

class theme_lernstar_core_renderer extends theme_bootstrapbase_core_renderer {

	public function theme_lernstar_socialicons(){
		$content = '';
		if (!empty($this->page->theme->settings->googlepluslink)) {
			$content .= html_writer::tag('a','<img src="'.$this->pix_url('gplus', 'theme').'" class="sicons" alt="google plus" />', array('href' => $this->page->theme->settings->googlepluslink, 'class' => 'icons', 'target' => '_blank'));
		}
		if (!empty($this->page->theme->settings->twitterlink)) {
			$content .= html_writer::tag('a','<img src="'.$this->pix_url('twitter', 'theme').'" class="sicons" alt="twitter" />', array('href' => $this->page->theme->settings->twitterlink, 'class' => 'icons', 'target' => '_blank'));
		}
		if (!empty($this->page->theme->settings->facebooklink)) {

			$content .= html_writer::tag('a','<img src="'.$this->pix_url('faceb', 'theme').'" class="sicons" alt="facebook" />', array('href' => $this->page->theme->settings->facebooklink, 'class' => 'icons', 'target' => '_blank'));
		}
		if (!empty($this->page->theme->settings->youtubelink)) {

			$content .= html_writer::tag('a','<img src="'.$this->pix_url('youtube', 'theme').'" class="sicons" alt="youtube" />', array('href' => $this->page->theme->settings->youtubelink, 'class' => 'icons', 'target' => '_blank'));
		}
		return $content;
	}
	
	/**
	 * The standard tags (meta tags, links to stylesheets and JavaScript, etc.)
	 * that should be included in the <head> tag. Designed to be called in theme
	 * layout.php files.
	 *
	 * @return string HTML fragment.
	 */
	public function standard_head_html() {
	 global $CFG, $SESSION;
	
	 // Before we output any content, we need to ensure that certain
	 // page components are set up.
	
	 // Blocks must be set up early as they may require javascript which
	 // has to be included in the page header before output is created.
	 foreach ($this->page->blocks->get_regions() as $region) {
	  $this->page->blocks->ensure_content_created($region, $this);
	 }
	
	 $output = '';
	 $output .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />' . "\n";
	 $output .= '<meta name="keywords" content="'.$this->page->theme->settings->metakeaywords.'" />' . "\n";
	 $output .= '<meta name="description" content="'.$this->page->theme->settings->metadescription.'" />' . "\n";
	 if (!$this->page->cacheable) {
	  $output .= '<meta http-equiv="pragma" content="no-cache" />' . "\n";
	  $output .= '<meta http-equiv="expires" content="0" />' . "\n";
	 }
	 // This is only set by the {@link redirect()} method
	 $output .= $this->metarefreshtag;
	
	 // Check if a periodic refresh delay has been set and make sure we arn't
	 // already meta refreshing
	 if ($this->metarefreshtag=='' && $this->page->periodicrefreshdelay!==null) {
	  $output .= '<meta http-equiv="refresh" content="'.$this->page->periodicrefreshdelay.';url='.$this->page->url->out().'" />';
	 }
	
	 // flow player embedding support
	 $this->page->requires->js_function_call('M.util.load_flowplayer');
	
	 // Set up help link popups for all links with the helptooltip class
	 $this->page->requires->js_init_call('M.util.help_popups.setup');
	
	 // Setup help icon overlays.
	 $this->page->requires->yui_module('moodle-core-popuphelp', 'M.core.init_popuphelp');
	 $this->page->requires->strings_for_js(array(
	   'morehelp',
	   'loadinghelp',
	 ), 'moodle');
	
	 $this->page->requires->js_function_call('setTimeout', array('fix_column_widths()', 20));
	
	 $focus = $this->page->focuscontrol;
	 if (!empty($focus)) {
	  if (preg_match("#forms\['([a-zA-Z0-9]+)'\].elements\['([a-zA-Z0-9]+)'\]#", $focus, $matches)) {
	   // This is a horrifically bad way to handle focus but it is passed in
	   // through messy formslib::moodleform
	   $this->page->requires->js_function_call('old_onload_focus', array($matches[1], $matches[2]));
	  } else if (strpos($focus, '.')!==false) {
	   // Old style of focus, bad way to do it
	   debugging('This code is using the old style focus event, Please update this code to focus on an element id or the moodleform focus method.', DEBUG_DEVELOPER);
	   $this->page->requires->js_function_call('old_onload_focus', explode('.', $focus, 2));
	  } else {
	   // Focus element with given id
	   $this->page->requires->js_function_call('focuscontrol', array($focus));
	  }
	 }
	
	 // Get the theme stylesheet - this has to be always first CSS, this loads also styles.css from all plugins;
	 // any other custom CSS can not be overridden via themes and is highly discouraged
	 $urls = $this->page->theme->css_urls($this->page);
	 foreach ($urls as $url) {
	  $this->page->requires->css_theme($url);
	 }
	
	 // Get the theme javascript head and footer
	 if ($jsurl = $this->page->theme->javascript_url(true)) {
	  $this->page->requires->js($jsurl, true);
	 }
	 if ($jsurl = $this->page->theme->javascript_url(false)) {
	  $this->page->requires->js($jsurl);
	 }
	
	 // Get any HTML from the page_requirements_manager.
	 $output .= $this->page->requires->get_head_code($this->page, $this);
	
	 // List alternate versions.
	 foreach ($this->page->alternateversions as $type => $alt) {
	  $output .= html_writer::empty_tag('link', array('rel' => 'alternate',
	    'type' => $type, 'title' => $alt->title, 'href' => $alt->url));
	 }
	
	 if (!empty($CFG->additionalhtmlhead)) {
	  $output .= "\n".$CFG->additionalhtmlhead;
	 }
	
	 return $output;
	}
}