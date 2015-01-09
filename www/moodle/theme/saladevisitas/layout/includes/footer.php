<!-- START OF FOOTER -->
  <?php if ($hasfooter) { ?>
    <footer>
        <div class="container">
            <div class="pull-left">
                <a class="logo" href="<?php echo $CFG->wwwroot; ?>" title="<?php print_string('home'); ?>">
                    <img class="img-logo svg" src="<?php echo $OUTPUT->pix_url('images/logo_sala_de_visitas', 'theme'); ?>"/> 
                </a>
            </div>
            <div class="pull-right">
                <div class="creditos">
                    <a href="#">Créditos</a>
                </div>
            </div>
        </div>
    </footer>
  <?php } ?>
  <!-- END OF FOOTER -->