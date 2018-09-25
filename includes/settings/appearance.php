<div class="tabs-settings">
  <div id="appearance_accordion" class="setting-accordions">
    <?php
      $i = 1;
      foreach ($overlay_windows as $overlay_window):
    ?>
      <div class="accordion-title <?php echo $i == 1 ? 'active' : ''?>" data-content-id="overlay_window_appearnace_<?php echo $i; ?>">OVERLAY WINDOW <?php echo $i; ?><span></span></div>
      <div class="accordion-contents <?php echo $i == 1 ? 'active' : ''?>" id="overlay_window_appearnace_<?php echo $i; ?>">
        <div class="cw-row">
          <div class="setting-description">
            <b>OVERLAY WINDOW POSITION:</b> Where will you place your Tabs?
          </div>
          <div class="settings-area">
            <div class="tabs-position">
              <div class="tab-bottom tab-position">
                <input type="radio" name="tabs_position_<?php echo $i; ?>" <?php echo $overlay_window->window_position == 'bottom' ? 'checked': ''; ?> id="tab_bottom_<?php echo $i; ?>" value="bottom">
                <label for="tab_bottom_<?php echo $i; ?>">Bottom(Default)</label>
              </div>
              <div class="tab-top tab-position">
                <input type="radio" name="tabs_position_<?php echo $i; ?>" <?php echo $overlay_window->window_position == 'top' ? 'checked': ''; ?> id="tab_top_<?php echo $i; ?>" value="top">
                <label for="tab_top_<?php echo $i; ?>">Top</label>
              </div>
              <div class="tab-left tab-position">
                <input type="radio" name="tabs_position_<?php echo $i; ?>" <?php echo $overlay_window->window_position == 'left' ? 'checked': ''; ?> id="tab_left_<?php echo $i; ?>" value="left">
                <label for="tab_left_<?php echo $i; ?>">Side(Left)</label>
              </div>
              <div class="tab-right tab-position">
                <input type="radio" name="tabs_position_<?php echo $i; ?>" <?php echo $overlay_window->window_position == 'right' ? 'checked': ''; ?> id="tab_right_<?php echo $i; ?>" value="right">
                <label for="tab_right_<?php echo $i; ?>">Side(Right)</label>
              </div>
            </div>
          </div>
        </div>

        <div class="cw-row no-bottom-border">
          <div class="setting-description no-bottom-border">
            <b>OVERLAY WINDOW SIZE:</b> What size will your windows be?
          </div>
          <div class="settings-area">
            <div class="tabs-size">
              <div class="tab-bottom tab-position">
                <input type="radio" name="tabs_size_<?php echo $i; ?>" <?php echo $overlay_window->window_size == 'tab' ? 'checked': ''; ?> id="tab_size_default_<?php echo $i; ?>" value="tab">
                <label for="tab_size_default_<?php echo $i; ?>">TAB</label>
              </div>
              <div class="tab-top tab-position">
                <input type="radio" name="tabs_size_<?php echo $i; ?>" <?php echo $overlay_window->window_size == '50' ? 'checked': ''; ?> id="tab_size_50_<?php echo $i; ?>" value="50">
                <label for="tab_size_50_<?php echo $i; ?>">50%</label>
              </div>
              <div class="tab-left tab-position">
                <input type="radio" name="tabs_size_<?php echo $i; ?>" <?php echo $overlay_window->window_size == '75' ? 'checked': ''; ?> id="tab_size_75_<?php echo $i; ?>" value="75">
                <label for="tab_size_75_<?php echo $i; ?>">75%</label>
              </div>
              <div class="tab-right tab-position">
                <input type="radio" name="tabs_size_<?php echo $i; ?>" <?php echo $overlay_window->window_size == '100' ? 'checked': ''; ?> id="tab_size_100_<?php echo $i; ?>" value="100">
                <label for="tab_size_100_<?php echo $i; ?>">100%</label>
              </div>
            </div>
          </div>
        </div>

        <div class="cw-row no-bottom-border">
          <div class="setting-description">
            <b>OVERLAY WINDOW DIALOG SIZE:</b> What size will your windows dialog be (Size when open)?
          </div>
          <div class="settings-area">
            <div class="tabs-dialog-size">
              <div class="tab-bottom tab-position">
                <input type="radio" name="tabs_dialog_size_<?php echo $i; ?>" <?php echo $overlay_window->window_dialog_size == 'tab' ? 'checked': ''; ?> id="tab_dialog_size_default_<?php echo $i; ?>" value="tab">
                <label for="tab_dialog_size_default_<?php echo $i; ?>">TAB</label>
              </div>
              <div class="tab-top tab-position">
                <input type="radio" name="tabs_dialog_size_<?php echo $i; ?>" <?php echo $overlay_window->window_dialog_size == '50' ? 'checked': ''; ?> <?php echo $overlay_window->tab_type == 'individual' ? 'disabled': ''; ?> id="tab_dialog_size_50_<?php echo $i; ?>" value="50">
                <label for="tab_dialog_size_50_<?php echo $i; ?>">50%</label>
              </div>
              <div class="tab-left tab-position">
                <input type="radio" name="tabs_dialog_size_<?php echo $i; ?>" <?php echo $overlay_window->window_dialog_size == '75' ? 'checked': ''; ?> <?php echo $overlay_window->tab_type == 'individual' ? 'disabled': ''; ?> id="tab_dialog_size_75_<?php echo $i; ?>"  value="75">
                <label for="tab_dialog_size_75_<?php echo $i; ?>">75%</label>
              </div>
              <div class="tab-right tab-position">
                <input type="radio" name="tabs_dialog_size_<?php echo $i; ?>" <?php echo $overlay_window->window_dialog_size == '100' ? 'checked': ''; ?> <?php echo $overlay_window->tab_type == 'individual' ? 'disabled': ''; ?> id="tab_dialog_size_100_<?php echo $i; ?>" value="100">
                <label for="tab_dialog_size_100_<?php echo $i; ?>">100%</label>
              </div>
            </div>
          </div>
        </div>

        <div class="cw-row">
          <div class="setting-description">
            <b>TAB TYPE:</b>
          </div>
          <div class="settings-area">
            <div class="tabs-type">
              <div class="tab-bottom tab-position">
                <input type="radio" name="tabs_type_<?php echo $i; ?>" <?php echo $overlay_window->tab_type == 'full' ? 'checked': ''; ?> id="tab_type_full_<?php echo $i; ?>" data-windows-number="<?php echo $i; ?>" value="full">
                <label for="tab_type_full_<?php echo $i; ?>">Full</label>
              </div>
              <div class="tab-top tab-position">
                <input type="radio" name="tabs_type_<?php echo $i; ?>" <?php echo $overlay_window->tab_type == 'individual' ? 'checked': ''; ?> id="tab_type_individual_<?php echo $i; ?>" value="individual" data-windows-number="<?php echo $i; ?>">
                <label for="tab_type_individual_<?php echo $i; ?>">Individual</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php $i ++; endforeach; ?>
  </div>
</div>
