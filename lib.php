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

function lernstar_process_css($css, $theme) {
	
	$css .= lernstar_get_lesscss($theme);
	// Set the background image for the logo.
    $logo = $theme->setting_file_url('logo', 'logo');
    $css = lernstar_set_logo($css, $logo);
    // Set custom CSS.
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = lernstar_set_customcss($css, $customcss);
    $css = lernstar_insert_imageurls($css);
    return $css;
}

function lernstar_get_lesscss ($theme){
	$less_input = '@import "main";';
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

function lernstar_callback_imageurls($matches){
	global $OUTPUT;
	if(empty($matches[3])){
		$replace = $OUTPUT->pix_url($matches[2],$matches[1]);
	} else {
		$replace = $OUTPUT->pix_url($matches[3]);
	}
	return $replace;
}

function lernstar_insert_imageurls($css){
	$pattern = '/\[\[pix:(\w+)\|(.+)\]\]|\[\[pix:(\w+\/.+)\]\]/i';
	$newcss = preg_replace_callback($pattern, "lernstar_callback_imageurls", $css);
	return $newcss;
}

function lernstar_set_logo($css, $logo) {
    global $OUTPUT;
    $tag = '[[setting:logo]]';
    $replacement = $logo;
    if (is_null($replacement)) {
        $replacement = '';
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

function lernstar_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}
