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