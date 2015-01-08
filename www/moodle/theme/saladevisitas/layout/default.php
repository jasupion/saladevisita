<?php 
  include 'includes/header.php';
?>
<?php if ($hasnavbar) { ?>
    <div class="navbar clearfix">
        <div class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></div>
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
                     <div class="region-content">
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
                         </div>
                      </div>                   
                </div>
                <?php } ?>

                <?php if ($hassidepost) { ?>
                <div id="region-post" class="block-region">
                   <div class="region-content">
                        <?php echo $OUTPUT->blocks_for_region('side-post') ?>
                   </div>
                </div>
                <?php } ?>
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

<div id="panelContent" class="yui3-widget-loading">
    <div class="yui3-widget-hd">
        Atenção!
    </div>
    <div class="yui3-widget-bd">
        <p>
           O acesso a esse ambiente é restrito a colaboradores do SENAI que atuam no desenvolvimento e execução dos cursos 
           a distância. Para esclarecimentos, procure o interlocutor de educação a distância do Departamento Regional 
           do SENAI do seu Estado. 
        </p>
    </div>
</div>

<?php echo $OUTPUT->standard_end_of_body_html() ?>
<script type="text/javascript">
  $("#tool").tooltip({
    placement:'bottom',
    title:'Tolltip funcionsado'
  });

  /*YUI().use('transition','panel', function (Y) {
        var openBtn = Y.one('#openButton'),
            panel, bb;

        function showModal() {
          panel.show();
          bb.transition({
              duration: 0.5,
              top     : '80px'
          });
        }

        function hidePanel() {
            bb.transition({
                duration: 0.5,
                top     : '-300px'
            }, function () {
                panel.hide();
            });
        }

        panel = new Y.Panel({
          srcNode: '#panelContent',
          width  : 330,
          //xy     : [300, -300],
          centered : true,
          zIndex : 5,
          modal  : true,
          visible: false,
          render : true,
          buttons: [
              {
                  value  : 'Fechar',
                  section: 'footer',
                  action : function (e) {
                      e.preventDefault();
                      hidePanel();
                  }
              }
          ]
        });

        bb = panel.get('boundingBox');

        openBtn.on('click', function (e) {
          showModal();
        })
  });*/
</script>
</body>
</html>
