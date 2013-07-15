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

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

    // Invert Navbar to dark background.
    $name = 'theme_lernstar/invert';
    $title = get_string('invert', 'theme_lernstar');
    $description = get_string('invertdesc', 'theme_lernstar');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $settings->add($setting);

    // Logo file setting.
    $name = 'theme_lernstar/logo';
    $title = get_string('logo','theme_lernstar');
    $description = get_string('logodesc', 'theme_lernstar');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);
    
    // Footnote setting.
    $name = 'theme_lernstar/footnote';
    $title = get_string('footnote', 'theme_lernstar');
    $description = get_string('footnotedesc', 'theme_lernstar');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Custom CSS file.
    $name = 'theme_lernstar/customcss';
    $title = get_string('customcss', 'theme_lernstar');
    $description = get_string('customcssdesc', 'theme_lernstar');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $settings->add($setting);

    // Footnote setting.
    $name = 'theme_lernstar/footnote';
    $title = get_string('footnote', 'theme_lernstar');
    $description = get_string('footnotedesc', 'theme_lernstar');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $settings->add($setting);
    
    // Choose your color
    $name = 'theme_lernstar/flavour';
    $title = get_string('flavour', 'theme_lernstar');
    $description = get_string('flavourdesc', 'theme_lernstar');
    $choices = array('green'=>'green','blue'=>'blue');
    $setting = new admin_setting_configselect($name, $title, $description, 'green', $choices);
    $settings->add($setting);
    
    // Enable Developer Mode
    $name = 'theme_lernstar/devmode';
    $title = get_string('devmode', 'theme_lernstar');
    $description = get_string('devmodedesc', 'theme_lernstar');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0, true, false);
    $settings->add($setting);
    
    $name = 'theme_lernstar/youtubelink'; 
    $title = get_string('youtubelink','theme_lernstar');   
    $description = get_string('youtubelinkdesc', 'theme_lernstar');   
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_TEXT);  
    $settings->add($setting);
    
    $name = 'theme_lernstar/googlepluslink';   
    $title = get_string('googlepluslink','theme_lernstar');    
    $description = get_string('googlepluslinkdesc', 'theme_lernstar');    
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_TEXT);
    $settings->add($setting);
    
    $name = 'theme_lernstar/facebooklink';
    $title = get_string('facebooklink','theme_lernstar');
    $description = get_string('facebooklinkdesc', 'theme_lernstar');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_TEXT);
    $settings->add($setting);
    
    $name = 'theme_lernstar/twitterlink';
    $title = get_string('twitterlink','theme_lernstar');   
    $description = get_string('twitterlinkdesc', 'theme_lernstar');   
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_TEXT);    
    $settings->add($setting);
}
