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
