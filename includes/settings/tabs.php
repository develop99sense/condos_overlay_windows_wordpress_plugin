<div class="tabs-settings">
  <div id="tabs_accordion" class="setting-accordions">
    <?php
      $i = 1;
      foreach ($overlay_windows as $overlay_window):
        $tabs = $overlay_window->tabs;
        if (is_null($tabs)) {
          $tabs = array();
        }
    ?>
      <div class="accordion-title <?php echo $i == 1 ? 'active' : ''?>" data-content-id="overlay_window_tabs_<?php echo $i; ?>">OVERLAY WINDOW <?php echo $i; ?><span></span></div>
      <div class="accordion-contents <?php echo $i == 1 ? 'active' : ''?>" id="overlay_window_tabs_<?php echo $i; ?>" data-tab-count="<?php echo count($tabs) + 1; ?>">
        <div class="cw-row tab-amount">
          <div class="setting-description">
            <b>AMOUNT:</b> How may Tabs?
          </div>
          <div class="settings-area">
            <div class="tabs-show tabs-edit add-tab-section">
              <?php $j = 1; foreach ($tabs as $tab): ?>
                <div class="cw-tabs tab-<?php echo $j; ?>" data-tab-id="tab-<?php echo $j; ?>" data-tab-color="<?php echo $tab->color; ?>" style="background: <?php echo $tab->color; ?>;">
                  <span class="tab-title"><?php echo $tab->title; ?></span>
                  <i class="fa fa-trash delete-tab" data-windows-number="<?php echo $i; ?>" style="color: #C00000;"></i>
                </div>
              <?php $j ++; endforeach; ?>
              <div class="cw-tabs add-tab" data-windows-number="<?php echo $i; ?>">
                +
              </div>
            </div>
          </div>
        </div>

        <div class="cw-row tab-amount">
          <div class="setting-description">
            <b>TAB TITLES:</b> Give your Tabs a Name, or keep the default designations.
          </div>
          <div class="settings-area">
            <div class="tabs-show tabs-edit edit-titles">
              <?php $j = 1; foreach ($tabs as $tab): ?>
                <div class="cw-tabs tab-<?php echo $j; ?>" data-tab-id="tab-<?php echo $j; ?>" data-tab-color="<?php echo $tab->color; ?>" style="background: <?php echo $tab->color; ?>;">
                  <span class="tab-title"><?php echo $tab->title; ?></span>
                  <i class="fa fa-pencil edit-tab-title" data-windows-number="<?php echo $i; ?>"></i>
                </div>
              <?php $j ++; endforeach; ?>
            </div>
          </div>
        </div>

        <div class="cw-row tab-amount no-bottom-border">
          <div class="setting-description">
            <b>COLOR SCHEME:</b> Give your Tabs a color.
          </div>
          <div class="settings-area">
            <div class="tabs-show tabs-edit edit-colors">
              <?php $j = 1; foreach ($tabs as $tab): ?>
                <div class="cw-tabs tab-<?php echo $j; ?>" data-tab-id="tab-<?php echo $j; ?>" data-tab-color="<?php echo $tab->color; ?>" style="background: <?php echo $tab->color; ?>;">
                  <span class="tab-title"><?php echo $tab->title; ?></span>
                  <i class="fa fa-pencil edit-tab-color" data-windows-number="<?php echo $i; ?>"></i>
                </div>
              <?php $j ++; endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    <?php $i ++; endforeach; ?>
  </div>
</div>
