<!--START OF FOOTER -->
  <?php if ($hasfooter) { ?>
    <footer>
        <div class="container">
            <div class="pull-left">
                <a class="logo" href="<?php echo $CFG->wwwroot; ?>" title="<?php print_string('home'); ?>">
                    <img class="img-logo svg" src="<?php echo $OUTPUT->pix_url('images/logo_sala_de_visitas', 'theme'); ?>"/> 
                </a>
            </div>
            <div class="pull-right">
                <a href="#" data-toggle="modal" data-target="#modalCreditos"> Créditos </a>
            </div>
    </footer>

    <!-- Modal de créditos -->
    <div class="modal fade" id="modalCreditos">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>           
          </div>
          <div class="modal-body">
            <p> Desenvolvido pela Área de Software - SENAI Cimatec. </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

  <?php } ?>
  <!-- END OF FOOTER