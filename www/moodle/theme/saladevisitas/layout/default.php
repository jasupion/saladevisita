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
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
    <title><?php echo $PAGE->title ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
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
            <a href="#" id="openButton"><i class="fa fa-info-circle"></i></a>
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

<?php if ($hasnavbar) { ?>
    <div class="navbar clearfix">
        <div class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></div>
        <div class="navbutton"> <?php echo $PAGE->button; ?></div>
    </div>
<?php } ?>

<div id="page-wrapper">
    <div id="page-content">
      <!-- Conteudo principal do moodle -->
      <div id="navcontainer">
        <?php if ($hascustommenu) { ?>
                <div id="custommenu" class="javascript-disabled"><?php echo $custommenu; ?></div>
        <?php } ?>
      </div>
      <!-- Conteudo das regioes -->
      <div id="region-main-box">
           <div id="region-post-box">
              <div id="region-main-wrap">
                 <div id="region-main-pad">
                   <div id="region-main">
                     <div class="region-content">
                            <?php echo $OUTPUT->main_content() ?>
                     </div>
                   </div>
                 </div>
               </div>

                <?php if ($hassidepre) { ?>
                <div id="region-pre" class="block-region">
                   <div class="region-content">
                        <?php echo $OUTPUT->blocks_for_region('side-pre') ?>
                   </div>
                </div>
                <?php } ?>

                <?php if ($hassidepost) { ?>
                <div id="region-post" class="block-region">
                   <div class="region-content">
                        <?php echo $OUTPUT->blocks_for_region('side-post') ?>
                   </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <!-- START OF FOOTER -->
        <?php if ($hasfooter) { ?>
          <div  class="site-footer">

              <div class="footer-left">

                  <?php if ($hasfootnote) { ?>
                          <div id="footnote"><?php echo $PAGE->theme->settings->footnote;?></div>
                  <?php } ?>

                  <a href="http://moodle.org" title="Moodle">
                      <img width="71" height="37" src="<?php echo $OUTPUT->pix_url('footer/ico_moodle_footer','theme')?>" alt="Moodle logo" />
                  </a>
              </div>

              <div class="footer-right">
                  <?php echo $OUTPUT->login_info();?>
              </div>

              <?php echo $OUTPUT->standard_footer_html(); ?>
          </div>
        <?php } ?>
        <!-- END OF FOOTER -->
    </div><!-- END OF page-content -->
</div>

<div id="panelContent" class="yui3-widget-loading">
    <div class="yui3-widget-hd">
        Atenção!
    </div>
    <div class="yui3-widget-bd">
        <p>
           O acesso a esse ambiente é restrito a colaboradores do SENAI que atuam no desenvolvimento e execução dos cursos 
           a distância. Para esclarecimentos, procure o interlocutor de educação a distância do Departamento Regional 
           do SENAI do seu Estado. 
        </p>
    </div>
</div>

<?php echo $OUTPUT->standard_end_of_body_html() ?>
<script type="text/javascript">
  YUI().use('transition','panel', function (Y) {
        var openBtn = Y.one('#openButton'),
            panel, bb;

        function showModal() {
          panel.show();
          bb.transition({
              duration: 0.5,
              top     : '80px'
          });
        }

        function hidePanel() {
            bb.transition({
                duration: 0.5,
                top     : '-300px'
            }, function () {
                panel.hide();
            });
        }

        panel = new Y.Panel({
          srcNode: '#panelContent',
          width  : 330,
          //xy     : [300, -300],
          centered : true,
          zIndex : 5,
          modal  : true,
          visible: false,
          render : true,
          buttons: [
              {
                  value  : 'Fechar',
                  section: 'footer',
                  action : function (e) {
                      e.preventDefault();
                      hidePanel();
                  }
              }
          ]
        });

        bb = panel.get('boundingBox');

        openBtn.on('click', function (e) {
          showModal();
        })
  });
</script>
</body>
</html>
