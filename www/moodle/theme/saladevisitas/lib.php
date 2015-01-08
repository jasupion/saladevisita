<?php
//função criada para fazer o atalho para enxergar a pasta fonts pelo servidor
function theme_essential_set_fontwww($css) {
    global $CFG;
    //$fontwww = preg_replace("(https?:)", "", $CFG->wwwroot . '/theme/saladevisitas/fonts/');
    //$fontwww = $CFG->wwwroot . '/theme/saladevisitas/fonts/';
    $str = explode("/",$CFG->wwwroot);
    $fontwww = ($str[3] == 'moodle')? '/moodle/theme/saladevisitas/fonts/' : '/theme/saladevisitas/fonts/';
    $tag = '[[setting:fontwww]]';
    
    $css = str_replace($tag, $fontwww, $css);
   
    return $css;
}


function saladevisitas_process_css($css, $theme) {

    // Set the background image for the logo
    if (!empty($theme->settings->logo)) {
        $logo = $theme->settings->logo;
    } else {
        $logo = null;
    }
    $css = saladevisitas_set_logo($css, $logo);

    // Set custom CSS
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = afterburner_set_customcss($css, $customcss);

    return $css;
}

function saladevisitas_set_logo($css, $logo) {
    global $OUTPUT;
    $tag = '[[setting:logo]]';
    $replacement = $logo;
    if (is_null($replacement)) {
        $replacement = $OUTPUT->pix_url('images/logo','theme');
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

function saladevisitas_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}