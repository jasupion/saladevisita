<?php 
  include 'includes/header.php';
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
  echo $OUTPUT->standard_end_of_body_html(); 
?>

</body>
</html>
