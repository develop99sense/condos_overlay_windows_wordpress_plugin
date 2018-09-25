<div class="tabs-settings tabs-content">
  <div id="content_accordion" class="setting-accordions">
    <?php
      $i = 1;
      foreach ($overlay_windows as $overlay_window):
        $dividers = $overlay_window->dividers;
        $tabs = $overlay_window->tabs;
    ?>
      <div class="accordion-title <?php echo $i == 1 ? 'active' : ''?>" data-content-id="overlay_window_content_<?php echo $i; ?>">OVERLAY WINDOW <?php echo $i; ?><span></span></div>
      <div class="accordion-contents <?php echo $i == 1 ? 'active' : ''?>" id="overlay_window_content_<?php echo $i; ?>">
        <?php if (!empty($tabs)): ?>
          <div class="content-tabs" id="content_tabs_<?php echo $i; ?>">
            <ul class="content-tab-links">
              <?php $t = 1; foreach ($tabs as $tab): ?>
                <li class="content-tab-link <?php echo $t == 1 ? 'current': ''; ?>" data-content-tab-id="content_tab_<?php echo $i . '_' . $t; ?>">TAB - <?php echo $tab->title; ?></li>
              <?php $t ++; endforeach; ?>
            </ul>
            <?php $t = 1; foreach ($tabs as $tab): ?>
              <div id="content_tab_<?php echo $i . '_' . $t; ?>" class="content-tab <?php echo $t == 1 ? 'current': ''; ?>">
                <div class="divider-tabs">
                  <ul class="divider-tab-links">
                    <?php $c = 1; foreach ($tab->contents as $content): ?>
                      <li class="individual-tab-link divider-tab-link <?php echo $c == 1 ? 'current': ''; ?>" data-divider-tab-id="divider_content_<?php echo $i . '_' . $t . '_' . $c; ?>">Content - <?php echo $c; ?></li>
                    <?php $c ++; endforeach; ?>
                  </ul>
                  <?php $c = 1; foreach ($tab->contents as $content): ?>
                    <div id="divider_content_<?php echo $i . '_' . $t . '_' . $c; ?>" class="individual-window divider-tab-content <?php echo $c == 1 ? 'current': ''; ?>">
                      <div class="cw-row no-bottom-border">
                        <div class="setting-description">
                          <b>Input URL Content:</b>
                        </div>
                        <div class="settings-area">
                          <div>
                            <input type="text" class="cw-form-control" id="url_content_<?php echo $i . '_' . $t . '_' . $c; ?>" value="<?php echo $content->url_content; ?>">
                          </div>
                        </div>
                      </div>

                      <div class="cw-row no-bottom-border">
                        <div class="setting-description">
                          <b>Input embedded Content:</b>
                        </div>
                        <div class="settings-area">
                          <div>
                            <input type="text" class="cw-form-control" id="embedded_content_<?php echo $i . '_' . $t . '_' . $c; ?>" value="<?php echo $content->embedded_content; ?>">
                          </div>
                        </div>
                      </div>

                      <div class="cw-row no-bottom-border">
                        <div class="setting-description">
                          <b>Input Api-Key Content:</b>
                        </div>
                        <div class="settings-area">
                          <div>
                            <input type="text" class="cw-form-control" id="api_key_content_<?php echo $i . '_' . $t . '_' . $c; ?>" value="<?php echo $content->api_key_content; ?>">
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php $c ++; endforeach; ?>
                </div>
              </div>
            <?php $t ++; endforeach; ?>
          </div>
        <?php else: ?>
          <div class="content-tabs" id="content_tabs_<?php echo $i; ?>">
            <ul class="content-tab-links"></ul>
          </div>
          <h4 class="no-tabs">No Tabs</h4>
        <?php endif; ?>
      </div>
    <?php $i ++; endforeach; ?>
  </div>
</div>
