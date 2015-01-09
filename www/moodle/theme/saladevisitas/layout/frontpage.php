<?php 
  include 'includes/header.php';
?>

<div class="main-front-page">
  <div class="front-page-logo container">
    <img class="svg" src="<?php echo $OUTPUT->pix_url('images/logo_sala_de_visitas', 'theme'); ?>"/> 
  </div>
  <div class="front-page-form container">
    <form id="coursesearch" action="http://saladevisitas.avasmanager.com.br/course/search.php" method="get">
      <input type="text" id="shortsearchbox" class="front-page-input" size="12" name="search" placeholder="Buscar cursos" value="">
    </form>
  </div>
  <div class="front-page-links container">
    <div class="row">
      <div class="col-md-4 col-xs-6 col-sm-4">
        <div class="front-page-box">
          <a href="">
            Cursos Técnicos
          </a>  
        </div>
      </div>
      <div class="col-md-4 col-xs-6 col-sm-4">
        <div class="front-page-box">
          <a href="">
            Curso De Qualificação Técnica
          </a>  
        </div>
      </div>
      <div class="col-md-4 col-xs-6 col-sm-4">
        <div class="front-page-box">
          <a href="">
            Cursos em Validação
          </a>  
        </div>
      </div>
    </div>
  </div>
</div>


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
                     <div class="region-content" class="container">
                            <?php echo $OUTPUT->main_content() ?>
                     </div>
                   </div>
                 </div>
               </div>

                <?php if ($hassidepre) { ?>
                <div id="region-pre" class="block-region">                    
                      <div class="nav">
                         <div class="region-content">
                              <?php echo $OUTPUT->blocks_for_region('side-pre') ?>
                              <?php 
                                if ($hassidepost) { 
                                  echo $OUTPUT->blocks_for_region('side-post');
                                }
                              ?>
                         </div>
                      </div>                   
                </div>
                <?php } ?>

                <?php //if ($hassidepost) { ?>
                <!-- <div id="region-post" class="block-region">
                   <div class="region-content">
                        <?php //echo $OUTPUT->blocks_for_region('side-post') ?>
                   </div>
                </div> -->
                <?php //} ?>
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

<?php echo $OUTPUT->standard_end_of_body_html() ?>

</body>
</html>
