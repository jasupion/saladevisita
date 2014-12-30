<?php

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

    // Logo file setting
    $name = 'theme_saladevisitas/logo';
    $title = get_string('logo','theme_saladevisitas');
    $description = get_string('logodesc', 'theme_saladevisitas');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $settings->add($setting);

    // Foot note setting
    $name = 'theme_saladevisitas/footnote';
    $title = get_string('footnote','theme_saladevisitas');
    $description = get_string('footnotedesc', 'theme_saladevisitas');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $settings->add($setting);

    // Custom CSS file
    $name = 'theme_saladevisitas/customcss';
    $title = get_string('customcss','theme_saladevisitas');
    $description = get_string('customcssdesc', 'theme_saladevisitas');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $settings->add($setting);

}