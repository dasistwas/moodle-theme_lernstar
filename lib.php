<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Moodle's Lernstar theme, an example of how to make a Bootstrap theme
 *
 * DO NOT MODIFY THIS THEME!
 * COPY IT FIRST, THEN RENAME THE COPY AND MODIFY IT INSTEAD.
 *
 * For full information about creating Moodle themes, see:
 * http://docs.moodle.org/dev/Themes_2.0
 *
 * @package   theme_lernstar
 * @copyright 2013 Moodle, moodle.org
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require("lessc.inc.php");

function theme_lernstar_process_css($css, $theme) {
	
	if($theme->settings->devmode){
		$css .= theme_lernstar_get_lesscss($theme);
	}
	// Set the background image for the logo.
    $logo = $theme->setting_file_url('logo', 'logo');
    $css = theme_lernstar_set_logo($css, $logo, $theme->settings->flavour);
    // Set custom CSS.
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = theme_lernstar_set_customcss($css, $customcss);
	if($theme->settings->devmode){
        $css = theme_lernstar_insert_imageurls($css);
	}
    return $css;
}

function theme_lernstar_get_lesscss ($theme){
	$less_input = '
			@import "../../bootstrapbase/less/moodle";
			@import "main";
			@import "'.$theme->settings->flavour.'";
			@import "blocks";
			@import "custommenu";
			@import "mod";
			';
	$less_variables = array();
	$import_dirs[] = $theme->dir.'/less';
	$css_file = $theme->dir.'/style/styles.css';

	$less = new lessc;
	$less->setVariables($less_variables);
	$less->setImportDir($import_dirs);
	$css = $less->compile($less_input);	
	file_put_contents($css_file, $css);
	return $css;
}

function theme_lernstar_callback_imageurls($matches){
	global $OUTPUT;
	if(empty($matches[3])){
		$replace = $OUTPUT->pix_url($matches[2],$matches[1]);
	} else {
		$replace = $OUTPUT->pix_url($matches[3]);
	}
	return $replace;
}

function theme_lernstar_insert_imageurls($css){
	$pattern = '/\[\[pix:(\w+)\|(.+)\]\]|\[\[pix:(\w+\/.+)\]\]/i';
	$newcss = preg_replace_callback($pattern, "theme_lernstar_callback_imageurls", $css);
	return $newcss;
}

function theme_lernstar_set_logo($css, $logo, $flavour) {
	global $OUTPUT;
    $tag = '[[setting:logo]]';
    $replacement = $logo;
    if (is_null($replacement)) {
        $replacement = $OUTPUT->pix_url($flavour.'/header','theme');
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_lernstar_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'logo') {
        $theme = theme_config::load('lernstar');
        return $theme->setting_file_serve('logo', $args, $forcedownload, $options);
    } else {
        send_file_not_found();
    }
}

function theme_lernstar_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);
    return $css;
}
/**
 * Returns an object containing HTML for the areas affected by settings.
 *
 * @param renderer_base $output Pass in $OUTPUT.
 * @param moodle_page $page Pass in $PAGE.
 * @return stdClass An object with the following properties:
 *      - navbarclass A CSS class to use on the navbar. By default ''.
 *      - heading HTML to use for the heading. A logo if one is selected or the default heading.
 *      - footnote HTML to use as a footnote. By default ''.
 */
function theme_lernstar_get_html_for_settings(renderer_base $output, moodle_page $page) {
	global $CFG;
	$return = new stdClass;

	$return->navbarclass = '';
	if (!empty($page->theme->settings->invert)) {
		$return->navbarclass .= ' navbar-inverse';
	}

	if (!empty($page->theme->settings->logo)) {
		$return->heading = html_writer::link($CFG->wwwroot, '', array('title' => get_string('home'), 'class' => 'logo'));
	} else {
		$return->heading = $output->page_heading();
	}

	$return->footnote = '';
	if (!empty($page->theme->settings->footnote)) {
		$return->footnote = '<div class="footnote text-center">'.$page->theme->settings->footnote.'</div>';
	}
	return $return;
}

function theme_lernstar_copyright() {
		// Copyright information for the theme. If removed here, place the Copyright notice as somewhere on your site.
		$copyright = html_writer::tag('a', "Lernstar Online-Nachhilfe", array('href'=>'http://www.lernstar.com'));
		$content = html_writer::tag('div','Theme by '.$copyright,array('class'=>'copyright'));
		return $content;
}