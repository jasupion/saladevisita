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
                <a href="#" data-toggle="modal" data-target="#modalAjuda" class="ajuda">Ajuda</a>
            </div>
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
            <h4 class="modal-title">Créditos!</h4>
          </div>
          <div class="modal-body">
            <div style="width: 123px; float:left; margin-right:26px;"><img class="img-logo svg" src="<?php echo $OUTPUT->pix_url('images/logo_senai', 'theme'); ?>"/></div>
            <div style="width: 55px; float: left; margin-right: 26px;"><img class="img-logo svg" src="<?php echo $OUTPUT->pix_url('images/logo_ads', 'theme'); ?>"/></div>
            <div style="padding-top: 16px;"><p> Desenvolvido pela Área de Software - SENAI Cimatec. </p></div>
            <div style="clear: both;"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" id="modalAjuda">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Ajuda!</h4>
          </div>
          <div class="modal-body">
            <div style="padding-top: 16px;">
              <p>Tem alguma sugestão de melhoria ou encontrou algum problema no curso?
                 Gentileza encaminhar para a Central de Orientação pelo email:</p>
              <p><a href="mailto:suporte.pnead@avantebrasil.com.br">suporte.pnead@avantebrasil.com.br</a></p>
            </div>
            <div style="clear: both;"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

  <?php } ?>
  <!-- END OF FOOTER -->
