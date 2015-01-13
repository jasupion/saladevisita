<?php 
  include 'includes/header.php';
?>
<div class="coursebox-title">
  <h2>Cursos</h2>  
</div>
<?php  
  include 'includes/breadcrumb.php';
?>
 
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

<?php 
  include 'includes/menu.php';

  include 'includes/footer.php';
?>

<?php echo $OUTPUT->standard_end_of_body_html() ?>

</body>
</html>
