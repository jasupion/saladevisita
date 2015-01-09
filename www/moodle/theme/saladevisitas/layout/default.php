<?php 
  include 'includes/header.php';
?>
<?php if ($hasnavbar) { ?>
    <div class="navbar clearfix">
        <div class="breadcrumb">
          <div class="container">
            <?php echo $OUTPUT->navbar(); ?>
          </div>
        </div>
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
          <?php 
            include 'includes/footer.php';
          ?>
    </div><!-- END OF page-content -->
</div>

<?php echo $OUTPUT->standard_end_of_body_html() ?>

</body>
</html>
