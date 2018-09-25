<div class="tabs-settings tabs-content">
  <div id="propoerties_accordion" class="setting-accordions">
    <?php
      $i = 1;
      foreach ($overlay_windows as $overlay_window):
        $cw_placement_pages = $overlay_window->window_placement->pages;
        if (is_null($cw_placement_pages)) {
          $cw_placement_pages = array();
        }
    ?>
      <div class="accordion-title <?php echo $i == 1 ? 'active' : ''?>" data-content-id="overlay_window_properties_<?php echo $i; ?>">OVERLAY WINDOW <?php echo $i; ?><span></span></div>
      <div class="accordion-contents <?php echo $i == 1 ? 'active' : ''?>" id="overlay_window_properties_<?php echo $i; ?>">
        <div class="cw-row">
          <div class="setting-description">
            <b>OVERLAY WINDOW PLACEMENT:</b> Show Overlay Windows on all pages or specific pages?
          </div>
          <div class="settings-area">
            <div class="tabs-position">
              <div class="tab-bottom tab-position">
                <input type="radio" name="overlay_placement_<?php echo $i; ?>" <?php echo $overlay_window->window_placement->type == 'all' ? 'checked': ''; ?> id="overlay_all_pages_<?php echo $i; ?>" value="all">
                <label for="overlay_all_pages_<?php echo $i; ?>">All Pages</label>
              </div>
              <div class="tab-top tab-position">
                <input type="radio" name="overlay_placement_<?php echo $i; ?>" <?php echo $overlay_window->window_placement->type == 'custom' ? 'checked': ''; ?> id="overlay_custom_pages_<?php echo $i; ?>" value="custom">
                <label for="overlay_custom_pages_<?php echo $i; ?>">Custom Pages</label>
              </div>
              <div class="tap-top tab-position">
                <div class="pages-box">
                  <div class="pages-box-header">
                    Select Pages
                  </div>
                  <div class="pages-box-body">
                    <?php foreach ($pages as $page): ?>
                      <div class="page-row" data-page-id="<?php echo $page->ID;?>">
                        <input type="checkbox" <?php echo in_array($page->ID, $cw_placement_pages) ? 'checked': ''; ?>>
                        <div><?php echo $page->post_title; ?></div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="cw-row">
          <div class="setting-description no-bottom-border">
            <b>OVERLAY WINDOW DIVIDERS:</b> Will you provide your content into sections?
          </div>
          <div class="settings-area">
            <div class="window-dividers">
              <div class="tab-bottom tab-position">
                <input type="radio" class="overlay-dividers" name="overlay_dividers_<?php echo $i; ?>" <?php echo $overlay_window->window_dividers == 'none' ? 'checked': ''; ?> id="overlay_no_divider_<?php echo $i; ?>" value="none">
                <label for="overlay_no_divider_<?php echo $i; ?>">None</label>
              </div>
              <div class="tab-top tab-position">
                <input type="radio" class="overlay-dividers" name="overlay_dividers_<?php echo $i; ?>" <?php echo $overlay_window->window_dividers == '1' ? 'checked': ''; ?> id="overlay_one_divider_<?php echo $i; ?>" value="1">
                <label for="overlay_one_divider_<?php echo $i; ?>">1 Divider</label>
              </div>
              <div class="tab-left tab-position">
                <input type="radio" class="overlay-dividers" name="overlay_dividers_<?php echo $i; ?>" <?php echo $overlay_window->window_dividers == '2' ? 'checked': ''; ?> id="overlay_two_dividers_<?php echo $i; ?>" value="2">
                <label for="overlay_two_dividers_<?php echo $i; ?>">2 Dividers</label>
              </div>
              <div class="tab-right tab-position">
                <input type="radio" class="overlay-dividers" name="overlay_dividers_<?php echo $i; ?>" <?php echo $overlay_window->window_dividers == '3' ? 'checked': ''; ?> id="overlay_three_dividers_<?php echo $i; ?>" value="3">
                <label for="overlay_three_dividers_<?php echo $i; ?>">3 Dividers</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php $i ++; endforeach; ?>
  </div>
</div>
