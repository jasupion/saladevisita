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
        
    </div>
<?php } ?>



<div id="page" class="container">
  <div id="page-content" class="row">
    <div id="region-main" class="<?php //echo $regions['content']; ?>"> 
      <div class="navbutton"> <?php echo $PAGE->button; ?></div>
      <?php
        echo $OUTPUT->course_content_header();
        echo $OUTPUT->main_content();
        echo $OUTPUT->course_content_footer();
      ?>
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


<?php 
  include 'includes/footer.php';
?>

<?php echo $OUTPUT->standard_end_of_body_html() ?>

</body>
</html>
