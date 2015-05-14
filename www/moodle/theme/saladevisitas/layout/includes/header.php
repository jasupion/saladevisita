<?php
$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));
$hassidepre = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-pre', $OUTPUT));
$hassidepost = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-post', $OUTPUT));
$haslogininfo = (empty($PAGE->layout_options['nologininfo']));
$haslogo = (empty($PAGE->theme->settings->logo)) ? false : $PAGE->theme->settings->logo;

$showsidepre = ($hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT));
$showsidepost = ($hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT));

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$hasfootnote = (!empty($PAGE->theme->settings->footnote));

$regions = bootstrap_grid($hassidepre, $hassidepost);

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
    <link href='http://fonts.googleapis.com/css?family=Roboto:500,300,400' rel='stylesheet' type='text/css'>
    <?php echo $OUTPUT->standard_head_html() ?>
</head>

<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>" class="yui3-skin-sam">
<div class="overlay"></div>
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
    <header id="page-header" >
        <div class="container">
        <div class="menu-anchor"><i class="fa fa-bars"></i></div>
            
            <?php if ($hasheading) { ?>
           <a class="logo" href="<?php echo $CFG->wwwroot; ?>" title="<?php print_string('home'); ?>">
             <img class="img-logo svg" src="<?php echo $OUTPUT->pix_url('images/logo_sala_de_visitas', 'theme'); ?>"/>
           </a>
           <div class="logo-senai">
             <img src="<?php echo $OUTPUT->pix_url('images/logo_senai_dn', 'theme'); ?>">
           </div>
          <?php } ?>
            
            
             <div class="header-titulo">
            <h4 class="titulo">Programa SENAI de Educação a Distância</h4>
          </div>
            
            
          <div class="header-menu">
            <div class="login-div">
              <?php if(!isloggedin()): ?>
                <a href="#" data-toggle="modal" data-target="#modalAviso">
                  <!-- <i class="fa fa-info-circle fa-width" id="tool"></i> -->
                  Sobre Acesso
                </a>&nbsp;
              <?php endif ?>
              <?php //echo $src; ?>
              <?php
                if ($haslogininfo) {
                    if(isloggedin()){
                      global $USER;
                      //echo $OUTPUT->login_info();
                    }else{
                       $branchurl = new moodle_url('/login/index.php');
                       echo "<a href=".$branchurl." class='btn btn-primary btn-login'>Login</a>";
                    }
                }
                //echo $PAGE->headingmenu
              ?>
              <?php

                //var_dump($USER);
              ?>
              <?php if(isloggedin()): ?>
                <div class="dropdown">
                  <a href="" class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                    <?php echo $USER->firstname; ?>
                    <span class="fa-stack fa-lg">
                      <i class="fa fa-circle-thin fa-stack-2x"></i>
                      <i class="fa fa-user fa-stack-1x"></i>
                    </span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu1">
                    <li role="presentation">
                      <?php
                        $branchurlUser = new moodle_url('/user/profile.php?id='.$USER->id);
                      ?>
                      <a role="menuitem" tabindex="-1" href="<?php echo $branchurlUser; ?>">
                      <i class="fa fa-cog"></i> Perfil</a>
                    </li>
                    <li role="presentation">
                      <?php
                        $branchurlLogout = new moodle_url('/login/logout.php?sesskey='.$USER->sesskey);
                      ?>
                      <a role="menuitem" tabindex="-1" href="<?php echo $branchurlLogout; ?>">
                      <i class="fa fa-times"></i> Sair</a>
                    </li>
                  </ul>
                </div>
              <?php endif ?>
            </div>
            <!--<ul>
              <li><a href="http://suporte.aticenter.com.br" target="_blank"><span class="txt-suporte">Suporte</span><span class="icon-top icon-suporte">&nbsp;</span></a></li>
            </ul>-->
          </div>
          
            
            
         
        </div>


    </header>
<?php } ?>
<!-- END OF HEADER -->

<div class="modal fade" id="modalAviso">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> Atenção!</h4>
      </div>
      <div class="modal-body">
        <p>
           O acesso a esse ambiente é restrito a colaboradores do SENAI que atuam no desenvolvimento e execução dos cursos
           a distância. Para esclarecimentos, procure o interlocutor de educação a distância do Departamento Regional
           do SENAI do seu Estado.
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
