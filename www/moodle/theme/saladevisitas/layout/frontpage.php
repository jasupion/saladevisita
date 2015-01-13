<?php
  include 'includes/header.php';
?>

<?php 
  global $DB;
  $course = $DB->get_records_sql('SELECT id, name FROM mdl_course_categories WHERE parent = 0', array('parent'=> 0));
?>

<div class="main-front-page">
  <div class="front-page-logo container">
    <img class="svg" src="<?php echo $OUTPUT->pix_url('images/logo_sala_de_visitas', 'theme'); ?>"/> 
  </div>
  <div class="container front-page-desc">
    <p>
      Ambiente para demonstração dos cursos a distância com padronização educacional que são oferecidos pelo SENAI  
    </p>
  </div>
  <div class="front-page-form container">
    <?php  $urlSearch = new moodle_url('/course/search.php'); ?>
    <form id="coursesearch" action="<?php echo $urlSearch; ?>" method="get">
      <input type="text" id="shortsearchbox" class="front-page-input" size="12" name="search" placeholder="Buscar cursos" value="">
    </form>
  </div>
  <div class="front-page-links container">
    <div class="row front-page-box-container">
      <?php foreach ($course as $obj): ?>
      <div class="col-md-4 col-xs-6 col-sm-4">
        <?php $urlSearchCat = new moodle_url('/course/index.php?categoryid='.$obj->id); ?>
        <a href="<?php echo $urlSearchCat; ?>">
          <div class="front-page-box">
              <?= $obj->name ?>
          </div>
        </a>
      </div>
    <?php endforeach; ?>
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
      <div id="region-main-box" >
           <div id="region-post-box">
              <div id="region-main-wrap" style="display:none">
                 <div id="region-main-pad">
                   <div id="region-main">
                     <div class="region-content" class="container" >
                            <?php echo $OUTPUT->main_content() ?>
                     </div>
                   </div>
                 </div>
               </div>

                <?php if ($hassidepre) { ?>
                <div id="region-pre" class="block-region">                    
                      <div class="nav">
                      <div class="menu-anchor menu-close"><i class="fa fa-times"></i></div>
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
        <?php 
          include 'includes/footer.php';
        ?>

    </div><!-- END OF page-content -->
</div>

<?php echo $OUTPUT->standard_end_of_body_html() ?>
<?php
  
  //define('AJAX_SCRIPT', true);

  /*require_once(dirname(__dir__) . '/config.php');

  if ($CFG->forcelogin) {
      require_login();
  }

  $PAGE->set_context(context_system::instance());
  $courserenderer = $PAGE->get_renderer('core', 'course');

  echo json_encode($courserenderer->coursecat_ajax());
*/

  
  //$options = coursecat::get_all_visible();
  //$options = coursecat::get_courses();
  //$coursecatcache = cache::make('core', 'coursecat');
  //$ids = $coursecatcache->get('user'. $USER->id);
  //echo "<pre>";
  //var_dump($options);
  //echo "</pre>";
  
?>
</body>
</html>
