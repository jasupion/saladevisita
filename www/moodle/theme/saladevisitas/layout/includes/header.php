<?php
$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));
$hassidepre = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-pre', $OUTPUT));
$hassidepost = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-post', $OUTPUT));
$haslogininfo = (empty($PAGE->layout_options['nologininfo']));

$showsidepre = ($hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT));
$showsidepost = ($hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT));

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$hasfootnote = (!empty($PAGE->theme->settings->footnote));

$bodyclasses = array();
if ($showsidepre && !$showsidepost) {
    $bodyclasses[] = 'side-pre-only';
} else if ($showsidepost && !$showsidepre) {
    $bodyclasses[] = 'side-post-only';
} else if (!$showsidepost && !$showsidepre) {
    $bodyclasses[] = 'content-only';
}
if ($hascustommenu) {
    $bodyclasses[] = 'has_custom_menu';
}

echo $OUTPUT->doctype() ?>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php echo $OUTPUT->htmlattributes() ?> class="no-js"> <!--<![endif]-->
<head>
    <title><?php echo $PAGE->title ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
</head>

<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>" class="yui3-skin-sam">

<?php echo $OUTPUT->standard_top_of_body_html() ?>
<div id="topo-flutuante" class="flutuante" style="display:none;">
    <a class="logo-mini" href="<?php echo $CFG->wwwroot; ?>" title="<?php print_string('home'); ?>"></a>
    <div id="flutuante-content"></div> 
    <div id="flutuante-user"></div>
</div>
<!--
<div class="barra-superior">
  <ul>
    <li><a href="http://suporte.aticenter.com.br" target="_blank">Suporte<span class="icon-top icon-suporte">&nbsp;</span></a></li>
  </ul>
</div>-->

<?php if ($hasheading || $hasnavbar) { ?>
    <div id="page-header" >
        <div class="header-menu">
          <div class="login-div">
            <?php echo $src; ?>
            <?php
              if ($haslogininfo) {
                  echo $OUTPUT->login_info();
              }
              echo $PAGE->headingmenu
            ?>
            <a href="#" id="openButton">
              <i class="fa fa-info-circle" id="tool" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"></i>
            </a>
          </div>
          <!--<ul>
            <li><a href="http://suporte.aticenter.com.br" target="_blank"><span class="txt-suporte">Suporte</span><span class="icon-top icon-suporte">&nbsp;</span></a></li>
          </ul>-->
        </div>
        <?php if ($hasheading) { ?>
         <a class="logo" href="<?php echo $CFG->wwwroot; ?>" title="<?php print_string('home'); ?>"></a>
         <div>
           <p><h2 class="logo-name-first">Sala de Visitas</h2></p>
         </div>
         <div class="logo-fies"></div>
        <?php } ?>
    </div>
<?php } ?>
<!-- END OF HEADER -->
