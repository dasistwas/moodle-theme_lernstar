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
}