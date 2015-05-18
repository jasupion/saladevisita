<?php
//função criada para fazer o atalho para enxergar a pasta fonts pelo servidor
function theme_essential_set_fontwww($css) {
    global $CFG;
    $fontwww = preg_replace("(https?:)", "", $CFG->wwwroot . '/theme/saladevisitas/fonts/');
    $fontwww = $CFG->wwwroot . '/theme/saladevisitas/fonts/';
    // $str = explode("/",$CFG->wwwroot);
    // $fontwww = ($str[3] == 'moodle')? '/moodle/theme/saladevisitas/fonts/' : '/theme/saladevisitas/fonts/';
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

function bootstrap_grid($hassidepre, $hassidepost) {
    if ($hassidepre && $hassidepost) {
        $regions = array('content' => 'col-sm-6 col-sm-push-3 col-lg-8 col-lg-push-2');
        $regions['pre'] = 'col-sm-3 col-sm-pull-6 col-lg-2 col-lg-pull-8';
        $regions['post'] = 'col-sm-3 col-lg-2';
    } else if ($hassidepre && !$hassidepost) {
        $regions = array('content' => 'col-sm-9 col-sm-push-3 col-lg-10 col-lg-push-2');
        $regions['pre'] = 'col-sm-3 col-sm-pull-9 col-lg-2 col-lg-pull-10';
        $regions['post'] = 'emtpy';
    } else if (!$hassidepre && $hassidepost) {
        $regions = array('content' => 'col-sm-9 col-lg-10');
        $regions['pre'] = 'empty';
        $regions['post'] = 'col-sm-3 col-lg-2';
    } else if (!$hassidepre && !$hassidepost) {
        $regions = array('content' => 'col-md-12');
        $regions['pre'] = 'empty';
        $regions['post'] = 'empty';
    }

    if ('rtl' === get_string('thisdirection', 'langconfig')) {
        if ($hassidepre && $hassidepost) {
            $regions['pre'] = 'col-sm-3  col-sm-push-3 col-lg-2 col-lg-push-2';
            $regions['post'] = 'col-sm-3 col-sm-pull-9 col-lg-2 col-lg-pull-10';
        } else if ($hassidepre && !$hassidepost) {
            $regions = array('content' => 'col-sm-9 col-lg-10');
            $regions['pre'] = 'col-sm-3 col-lg-2';
            $regions['post'] = 'empty';
        } else if (!$hassidepre && $hassidepost) {
            $regions = array('content' => 'col-sm-9 col-sm-push-3 col-lg-10 col-lg-push-2');
            $regions['pre'] = 'empty';
            $regions['post'] = 'col-sm-3 col-sm-pull-9 col-lg-2 col-lg-pull-10';
        }
    }
    return $regions;
}

/**
 * Loads the JavaScript for the zoom function.
 *
 * @param moodle_page $page Pass in $PAGE.
 */
function theme_bootstrap_initialise_zoom(moodle_page $page) {
    user_preference_allow_ajax_update('theme_bootstrap_zoom', PARAM_TEXT);
    $page->requires->yui_module('moodle-theme_bootstrap-zoom', 'M.theme_bootstrap.zoom.init', array());
}
/**
 * Get the user preference for the zoom function.
 */
function theme_bootstrap_get_zoom() {
    return get_user_preferences('theme_bootstrap_zoom', '');
}
