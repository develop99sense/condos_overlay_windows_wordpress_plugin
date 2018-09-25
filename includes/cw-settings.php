<div class="wrap">
  <?php
    $settings = json_decode(get_option('cw_settings'));
    $overlay_windows = $settings->overlay_windows;
    $pages = get_pages();
  ?>
  <!-- Header -->
  <?php require_once plugin_dir_path(__FILE__) . 'cw-header.php'; ?>
  <!-- End -->

  <div class="tab-area">
    <div id="tabs">
      <ul>
        <li><a href="#settings_dash">DASH</a></li>
        <li><a href="#settings_settings">SETTINGS</a></li>
        <li><a href="#settings_tabs">TABS</a></li>
        <li><a href="#settings_appearance">APPEARANCE</a></li>
        <li><a href="#settings_properties">PROPERTIES</a></li>
        <li><a href="#settings_content">CONTENT</a></li>
      </ul>
      <div class="tabs-background"></div>
      <div id="settings_dash" class="tab-contents">
        <?php require_once plugin_dir_path(__FILE__) . 'settings/dash.php'; ?>
      </div>
      <div id="settings_settings" class="tab-contents">
        <?php require_once plugin_dir_path(__FILE__) . 'settings/settings.php'; ?>
      </div>
      <div id="settings_tabs" class="tab-contents">
        <?php require_once plugin_dir_path(__FILE__) . 'settings/tabs.php'; ?>
      </div>
      <div id="settings_appearance" class="tab-contents">
        <?php require_once plugin_dir_path(__FILE__) . 'settings/appearance.php'; ?>
      </div>
      <div id="settings_properties" class="tab-contents">
        <?php require_once plugin_dir_path(__FILE__) . 'settings/properties.php'; ?>
      </div>
      <div id="settings_content" class="tab-contents">
        <?php require_once plugin_dir_path(__FILE__) . 'settings/content.php'; ?>
      </div>
    </div>
  </div>

  <!-- Footer  -->
  <?php require_once plugin_dir_path(__FILE__) . 'cw-footer.php'; ?>
  <!-- End -->
</div>

<script>
  var $ = jQuery;
  var default_tab_color = '#717171';
  var overlay_windows = <?php echo json_encode($overlay_windows); ?>;
  var pages = <?php echo json_encode($pages); ?>;
  $(function() {
    $('input[name="windows_number"]').change(function() {
      var windows_number = $(this).val();
      init_windows_settings(windows_number);
    });
    $('#tabs').tabs();
    $('#save_settings').click(function() {
      save_settings();
    });

    /* -------- Events --------- */
    add_tabs();
    accordion_event();
    content_tab_event();
    divider_tab_event();
    divider_count_change();
    change_tab_type();
  });

  function init_windows_settings(windows_number) {
    /* -------------- Tabs --------------- */
    var current_tabs_count = $('#tabs_accordion .accordion-title').length;
    if (windows_number > current_tabs_count) {
      for (var i = 0; i < windows_number - current_tabs_count; i ++) {
        var window_index = i + 1 + current_tabs_count;
        var html_str = '<div class="accordion-title" data-content-id="overlay_window_tabs_' + window_index + '">OVERLAY WINDOW ' + window_index + '<span></span></div>';
        html_str += '<div class="accordion-contents" id="overlay_window_tabs_' + window_index + '">';
          html_str += '<div class="cw-row tab-amount">';
            html_str += '<div class="setting-description">';
              html_str += '<b>AMOUNT:</b> How many Tabs?';
            html_str += '</div>';
            html_str += '<div class="settings-area">';
              html_str += '<div class="tabs-show tabs-edit add-tab-section">';
                html_str += '<div class="cw-tabs tab-1" data-tab-id="tab-1" data-tab-color="#717171" style="background: #717171;">';
                  html_str += '<span class="tab-title">Tab-1</span>';
                  html_str += '<i class="fa fa-trash delete-tab" style="color: #C00000;"></i>';
                html_str += '</div>';
                html_str += '<div class="cw-tabs add-tab" data-windows-number="' + window_index + '">';
                  html_str += '+';
                html_str += '</div>';
              html_str += '</div>';
            html_str += '</div>';
          html_str += '</div>';

          html_str += '<div class="cw-row tab-amount">';
            html_str += '<div class="setting-description">';
              html_str += '<b>TAB TITLES:</b> Give your Tabs a Name, or keep the default designations.';
            html_str += '</div>';
            html_str += '<div class="settings-area">';
              html_str += '<div class="tabs-show tabs-edit edit-titles">';
                html_str += '<div class="cw-tabs tab-1" data-tab-id="tab-1" data-tab-color="#717171" style="background: #717171;">';
                  html_str += '<span class="tab-title">Tab-1</span>';
                  html_str += '<i class="fa fa-pencil edit-tab-title" data-windows-number="' + window_index + '"></i>';
                html_str += '</div>';
              html_str += '</div>';
            html_str += '</div>';
          html_str += '</div>';

          html_str += '<div class="cw-row tab-amount no-bottom-border">';
            html_str += '<div class="setting-description">';
              html_str += '<b>COLOR SCHEME:</b> Give your Tabs a color.';
            html_str += '</div>';
            html_str += '<div class="settings-area">';
              html_str += '<div class="tabs-show tabs-edit edit-colors">';
                html_str += '<div class="cw-tabs tab-1" data-tab-id="tab-1" data-tab-color="#717171" style="background: #717171;">';
                  html_str += '<span class="tab-title">Tab-1</span>';
                  html_str += '<i class="fa fa-pencil edit-tab-title" data-windows-number="' + window_index + '"></i>';
                html_str += '</div>';
              html_str += '</div>';
            html_str += '</div>';
          html_str += '</div>';
        html_str += '</div>';

        $('#tabs_accordion').append(html_str);
      }
    }
    else if (windows_number < current_tabs_count) {
      for (var i = 0; i < current_tabs_count - windows_number; i ++) {
        $('#tabs_accordion .accordion-title').last().remove();
        $('#tabs_accordion .accordion-contents').last().remove();
      }
    }
    add_tabs();

    /* -------------- Appearance --------------- */
    var current_appearance_count = $('#appearance_accordion .accordion-title').length;
    if (windows_number > current_appearance_count) {
      for (var i = 0; i < windows_number - current_appearance_count; i ++) {
        var window_index = i + 1 + current_appearance_count;
        var html_str = '<div class="accordion-title" data-content-id="overlay_window_appearnace_' + window_index + '">OVERLAY WINDOW ' + window_index + '<span></span></div>';
        html_str += '<div class="accordion-contents" id="overlay_window_appearnace_' + window_index + '">';
          html_str += '<div class="cw-row">';
            html_str += '<div class="setting-description">';
              html_str += '<b>OVERLAY WINDOW POSITION:</b> Where will you place your Tabs?';
            html_str += '</div>';
            html_str += '<div class="settings-area">';
              html_str += '<div class="tabs-position">';
                html_str += '<div class="tab-bottom tab-position">';
                  html_str += '<input type="radio" name="tabs_position_' + window_index + '" checked id="tab_bottom_' + window_index + '" value="bottom">';
                  html_str += '<label for="tab_bottom_' + window_index + '">Bottom(Default)</label>';
                html_str += '</div>';
                html_str += '<div class="tab-top tab-position">';
                  html_str += '<input type="radio" name="tabs_position_' + window_index + '" id="tab_top_' + window_index + '" value="top">';
                  html_str += '<label for="tab_top_' + window_index + '">Top</label>';
                html_str += '</div>';
                html_str += '<div class="tab-left tab-position">';
                  html_str += '<input type="radio" name="tabs_position_' + window_index + '" id="tab_left_' + window_index + '" value="left">';
                  html_str += '<label for="tab_left_' + window_index + '">Side(Left)</label>';
                html_str += '</div>';
                html_str += '<div class="tab-right tab-position">';
                  html_str += '<input type="radio" name="tabs_position_' + window_index + '" id="tab_right_' + window_index + '" value="right">';
                  html_str += '<label for="tab_right_' + window_index + '">Side(Right)</label>';
                html_str += '</div>';
              html_str += '</div>';
            html_str += '</div>';
          html_str += '</div>';

          html_str += '<div class="cw-row no-bottom-border">';
            html_str += '<div class="setting-description no-bottom-border">';
              html_str += '<b>OVERLAY WINDOW SIZE:</b> What size will your windows be?';
            html_str += '</div>';
            html_str += '<div class="settings-area">';
              html_str += '<div class="tabs-size">';
                html_str += '<div class="tab-bottom tab-position">';
                  html_str += '<input type="radio" name="tabs_size_' + window_index + '" checked id="tab_size_default_' + window_index + '" value="tab">';
                  html_str += '<label for="tab_size_default_' + window_index + '">TAB</label>';
                html_str += '</div>';
                html_str += '<div class="tab-top tab-position">';
                  html_str += '<input type="radio" name="tabs_size_' + window_index + '" id="tab_size_50_' + window_index + '" value="50">';
                  html_str += '<label for="tab_size_50_' + window_index + '">50%</label>';
                html_str += '</div>';
                html_str += '<div class="tab-left tab-position">';
                  html_str += '<input type="radio" name="tabs_size_' + window_index + '" id="tab_size_75_' + window_index + '" value="75">';
                  html_str += '<label for="tab_size_75_' + window_index + '">75%</label>';
                html_str += '</div>';
                html_str += '<div class="tab-right tab-position">';
                  html_str += '<input type="radio" name="tabs_size_' + window_index + '" id="tab_size_100_' + window_index + '" value="100">';
                  html_str += '<label for="tab_size_100_' + window_index + '">100%</label>';
                html_str += '</div>';
              html_str += '</div>';
            html_str += '</div>';
          html_str += '</div>';

          html_str += '<div class="cw-row no-bottom-border">';
            html_str += '<div class="setting-description">';
              html_str += '<b>OVERLAY WINDIW DIALOG SIZE:</b> What size will your windows dialog be (Size when open)?';
            html_str += '</div>';
            html_str += '<div class="settings-area">';
              html_str += '<div class="tabs-dialog-size">';
                html_str += '<div class="tab-bottom tab-position">';
                  html_str += '<input type="radio" name="tabs_dialog_size_' + window_index + '" checked id="tab_dialog_size_default_' + window_index + '" value="tab">';
                  html_str += '<label for="tab_dialog_size_default_' + window_index + '">TAB</label>';
                html_str += '</div>';
                html_str += '<div class="tab-top tab-position">';
                  html_str += '<input type="radio" name="tabs_dialog_size_' + window_index + '" id="tab_dialog_size_50_' + window_index + '" value="50">';
                  html_str += '<label for="tab_dialog_size_50_' + window_index + '">50%</label>';
                html_str += '</div>';
                html_str += '<div class="tab-left tab-position">';
                  html_str += '<input type="radio" name="tabs_dialog_size_' + window_index + '" id="tab_dialog_size_75_' + window_index + '"  value="75">';
                  html_str += '<label for="tab_dialog_size_75_' + window_index + '">75%</label>';
                html_str += '</div>';
                html_str += '<div class="tab-right tab-position">';
                  html_str += '<input type="radio" name="tabs_dialog_size_' + window_index + '" id="tab_dialog_size_100_' + window_index + '" value="100">';
                  html_str += '<label for="tab_dialog_size_100_' + window_index + '">100%</label>';
                html_str += '</div>';
              html_str += '</div>';
            html_str += '</div>';
          html_str += '</div>';

          html_str += '<div class="cw-row">';
            html_str += '<div class="setting-description">';
              html_str += '<b>TAB TYPE:</b>';
            html_str += '</div>';
            html_str += '<div class="settings-area">';
              html_str += '<div class="tabs-type">';
                html_str += '<div class="tab-bottom tab-position">';
                  html_str += '<input type="radio" name="tabs_type_' + window_index + '" checked id="tab_type_full_' + window_index + '" value="full" data-windows-number="' + window_index + '">';
                  html_str += '<label for="tab_type_full_' + window_index + '">Full</label>';
                html_str += '</div>';
                html_str += '<div class="tab-top tab-position">';
                  html_str += '<input type="radio" name="tabs_type_' + window_index + '" id="tab_type_individual_' + window_index + '" value="individual" data-windows-number="' + window_index + '">';
                  html_str += '<label for="tab_type_individual_' + window_index + '">Individual</label>';
                html_str += '</div>';
              html_str += '</div>';
            html_str += '</div>';
          html_str += '</div>';
        html_str += '</div>';

        $('#appearance_accordion').append(html_str);
      }
    }
    else if (windows_number < current_appearance_count) {
      for (var i = 0; i < current_tabs_count - windows_number; i ++) {
        $('#appearance_accordion .accordion-title').last().remove();
        $('#appearance_accordion .accordion-contents').last().remove();
      }
    }
    change_tab_type();

    /* ------------------- Properties --------------------- */
    var current_properties_count = $('#propoerties_accordion .accordion-title').length;
    if (windows_number > current_properties_count) {
      for (var i = 0; i < windows_number - current_properties_count; i ++) {
        var window_index = i + 1 + current_properties_count;
        var html_str = '<div class="accordion-title" data-content-id="overlay_window_properties_' + window_index + '">OVERLAY WINDOW ' + window_index + '<span></span></div>';
        html_str += '<div class="accordion-contents" id="overlay_window_properties_' + window_index + '">';
          html_str += '<div class="cw-row">';
            html_str += '<div class="setting-description">';
              html_str += '<b>OVERLAY WINDOW PLACEMENT:</b> Show Overlay Windows on all pages or specific pages?';
            html_str += '</div>';
            html_str += '<div class="settings-area">';
              html_str += '<div class="tabs-position">';
                html_str += '<div class="tab-bottom tab-position">';
                  html_str += '<input type="radio" name="overlay_placement_' + window_index + '" checked id="overlay_all_pages_' + window_index + '" value="all">';
                  html_str += '<label for="overlay_all_pages_' + window_index + '">All Pages</label>';
                html_str += '</div>';
                html_str += '<div class="tab-top tab-position">';
                  html_str += '<input type="radio" name="overlay_placement_' + window_index + '" id="overlay_custom_pages_' + window_index + '" value="custom">';
                  html_str += '<label for="overlay_custom_pages_' + window_index + '">Custom Pages</label>';
                html_str += '</div>';
                html_str += '<div class="tap-top tab-position">';
                  html_str += '<div class="pages-box">';
                    html_str += '<div class="pages-box-header">';
                      html_str += 'Select Pages';
                    html_str += '</div>';
                    html_str += '<div class="pages-box-body">';
                      for (var j = 0; j < pages.length; j ++ ) {
                        html_str += '<div class="page-row" data-page-id="' + pages[j].ID + '">';
                          html_str += '<input type="checkbox">';
                          html_str += '<div>' + pages[j].post_title + '</div>';
                        html_str += '</div>';
                      }
                    html_str += '</div>';
                  html_str += '</div>';
                html_str += '</div>';
              html_str += '</div>';
            html_str += '</div>';
          html_str += '</div>';

          html_str += '<div class="cw-row">';
            html_str += '<div class="setting-description no-bottom-border">';
              html_str += '<b>OVERLAY WINDOW DIVIDERS:</b> Will you provide your content into sections?';
            html_str += '</div>';
            html_str += '<div class="settings-area">';
              html_str += '<div class="window-dividers">';
                html_str += '<div class="tab-bottom tab-position">';
                  html_str += '<input type="radio" class="overlay-dividers" name="overlay_dividers_' + window_index + '" checked id="overlay_no_divider_' + window_index + '" value="none">';
                  html_str += '<label for="overlay_no_divider_' + window_index + '">None</label>';
                html_str += '</div>';
                html_str += '<div class="tab-top tab-position">';
                  html_str += '<input type="radio" class="overlay-dividers" name="overlay_dividers_' + window_index + '" id="overlay_one_divider_' + window_index + '" value="1">';
                  html_str += '<label for="overlay_one_divider_' + window_index + '">1 Divider</label>';
                html_str += '</div>';
                html_str += '<div class="tab-left tab-position">';
                  html_str += '<input type="radio" class="overlay-dividers" name="overlay_dividers_' + window_index + '" id="overlay_two_dividers_' + window_index + '" value="2">';
                  html_str += '<label for="overlay_two_dividers_' + window_index + '">2 Dividers</label>';
                html_str += '</div>';
                html_str += '<div class="tab-right tab-position">';
                  html_str += '<input type="radio" class="overlay-dividers" name="overlay_dividers_' + window_index + '" id="overlay_three_dividers_' + window_index + '" value="3">';
                  html_str += '<label for="overlay_three_dividers_' + window_index + '">3 Dividers</label>';
                html_str += '</div>';
              html_str += '</div>';
            html_str += '</div>';
          html_str += '</div>';
        html_str += '</div>';

        $('#propoerties_accordion').append(html_str);
      }
    }
    else if (windows_number < current_properties_count) {
      for (var i = 0; i < current_tabs_count - windows_number; i ++) {
        $('#propoerties_accordion .accordion-title').last().remove();
        $('#propoerties_accordion .accordion-contents').last().remove();
      }
    }
    divider_count_change();

    /* ------------------- Content --------------------- */
    var current_content_count = $('#content_accordion .accordion-title').length;
    if (windows_number > current_content_count) {
      for (var i = 0; i < windows_number - current_content_count; i ++) {
        var window_index = i + 1 + current_content_count;
        var html_str = '<div class="accordion-title" data-content-id="overlay_window_content_' + window_index + '">OVERLAY WINDOW ' + window_index + '<span></span></div>';
        html_str += '<div class="accordion-contents" id="overlay_window_content_' + window_index + '">';
          html_str += '<div class="content-tabs" id="content_tabs_' + window_index + '">';
            html_str += '<ul class="content-tab-links">';
              html_str += '<li class="content-tab-link current" data-content-tab-id="content_tab_' + window_index + '_1">Tab - Tab-1</li>';
            html_str += '</ul>';
            html_str += '<div id="content_tab_' + window_index + '_1" class="content-tab current">';
              html_str += '<div class="divider-tabs">';
                html_str += '<ul class="divider-tab-links">';
                    html_str += '<li class="individual-tab-link divider-tab-link current" data-divider-tab-id="divider_content_' + window_index + '_1_1">Content - 1</li>';
                html_str += '</ul>';
                html_str += '<div id="divider_content_' + window_index + '_1_1" class="individual-window divider-tab-content current">';
                  html_str += '<div class="cw-row no-bottom-border">';
                    html_str += '<div class="setting-description">';
                      html_str += '<b>Input URL Content:</b>';
                    html_str += '</div>';
                    html_str += '<div class="settings-area">';
                      html_str += '<div>';
                        html_str += '<input type="text" class="cw-form-control" id="url_content_' + window_index + '_1_1" value="">';
                      html_str += '</div>';
                    html_str += '</div>';
                  html_str += '</div>';

                  html_str += '<div class="cw-row no-bottom-border">';
                    html_str += '<div class="setting-description">';
                      html_str += '<b>Input embedded Content:</b>';
                    html_str += '</div>';
                    html_str += '<div class="settings-area">';
                      html_str += '<div>';
                        html_str += '<input type="text" class="cw-form-control" id="embedded_content_' + window_index + '_1_1" value="">';
                      html_str += '</div>';
                    html_str += '</div>';
                  html_str += '</div>';

                  html_str += '<div class="cw-row no-bottom-border">';
                    html_str += '<div class="setting-description">';
                      html_str += '<b>Input Api-Key Content:</b>';
                    html_str += '</div>';
                    html_str += '<div class="settings-area">';
                      html_str += '<div>';
                        html_str += '<input type="text" class="cw-form-control" id="api_key_content_' + window_index + '_1_1" value="">';
                      html_str += '</div>';
                    html_str += '</div>';
                  html_str += '</div>';
                html_str += '</div>';
              html_str += '</div>';
            html_str += '</div>';
          html_str += '</div>';
        html_str += '</div>';

        $('#content_accordion').append(html_str);
      }
    }
    else if (windows_number < current_content_count) {
      for (var i = 0; i < current_content_count - windows_number; i ++) {
        $('#content_accordion .accordion-title').last().remove();
        $('#content_accordion .accordion-contents').last().remove();
      }
    }
    divider_tab_event();
    divider_count_change();
    accordion_event();
  }

  function accordion_event() {
    $('.accordion-title').unbind().bind('click', function() {
      var content_id = $(this).data('content-id');
      var parent_id = $(this).parent().prop('id');
      $('#' + parent_id + ' .accordion-title').removeClass('active', 300);
      if (!$(this).hasClass('active')) {
        $(this).addClass('active', 300);
      }
      $('#' + parent_id + ' .accordion-contents').removeClass('active', 300);
      if (!$('#' + content_id).hasClass('active')) {
        $('#' + content_id).addClass('active', 300);
      }
    });
  }

  function add_tabs() {
    $('.add-tab').unbind().bind('click', function() {
      var window_index = $(this).data('windows-number');
      tab_count = $('#overlay_window_tabs_' + window_index + ' .edit-colors .cw-tabs').length + 1;
      var html_str = '<div class="cw-tabs tab-' + tab_count + '" data-tab-id="tab-' + tab_count + '" data-tab-color="#717171">';
        html_str += '<span class="tab-title">TAB-' + tab_count + '</span>';
        html_str += '<i class="fa fa-trash delete-tab" style="color: #C00000;" data-windows-number="' + window_index + '"></i>';
      html_str += '</div>';
      $(this).before(html_str);

      var html_str = '<div class="cw-tabs tab-' + tab_count + '" data-tab-id="tab-' + tab_count + '" data-tab-color="#717171">';
        html_str += '<span class="tab-title">TAB-' + tab_count + '</span>';
        html_str += '<i class="fa fa-pencil edit-tab-title" data-windows-number="' + window_index + '"></i>';
      html_str += '</div>';
      $('#overlay_window_tabs_' + window_index + ' .edit-titles').append(html_str);

      html_str = '<div class="cw-tabs tab-' + tab_count + '" data-tab-id="tab-' + tab_count + '" data-tab-color="#717171">';
        html_str += '<span class="tab-title">TAB-' + tab_count + '</span>';
        html_str += '<i class="fa fa-pencil edit-tab-color" data-windows-number="' + window_index + '"></i>';
      html_str += '</div>';
      $('#overlay_window_tabs_' + window_index + ' .edit-colors').append(html_str);

      $('#overlay_window_content_' + window_index + ' ul.content-tab-links').append('<li class="content-tab-link" data-content-tab-id="content_tab_' + window_index + '_' + tab_count + '">Tab - TAB-' + tab_count + '</li>');
      var window_dividers = $('#overlay_window_properties_' + window_index + ' input.overlay-dividers:checked').val();
      if (window_dividers == 'none') {
        window_dividers = 0;
      }
      html_str = '<div id="content_tab_' + window_index + '_' + tab_count + '" class="content-tab">';
        html_str += '<div class="divider-tabs">';
          html_str += '<ul class="divider-tab-links">';
            for (var i = 0; i < parseInt(window_dividers) + 1; i ++) {
              var content_index = i + 1;
              var class_string = content_index == 1 ? 'current' : '';
              html_str += '<li class="individual-tab-link divider-tab-link ' + class_string + '" data-divider-tab-id="divider_content_' + window_index + '_' + tab_count + '_' + content_index + '">Content - ' + content_index + '</li>';
            }
          html_str += '</ul>';
          for (var i = 0; i < parseInt(window_dividers) + 1; i ++) {
            var content_index = i + 1;
            var class_string = content_index == 1 ? 'current' : '';
            html_str += '<div id="divider_content_' + window_index + '_' + tab_count + '_' + content_index + '" class="individual-window divider-tab-content ' + class_string + '">';
              html_str += '<div class="cw-row no-bottom-border">';
                html_str += '<div class="setting-description">';
                  html_str += '<b>Input URL Content:</b>';
                html_str += '</div>';
                html_str += '<div class="settings-area">';
                  html_str += '<div>';
                    html_str += '<input type="text" class="cw-form-control" id="url_content_' + window_index + '_' + tab_count + '_' + content_index + '" value="">';
                  html_str += '</div>';
                html_str += '</div>';
              html_str += '</div>';

              html_str += '<div class="cw-row no-bottom-border">';
                html_str += '<div class="setting-description">';
                  html_str += '<b>Input embedded Content:</b>';
                html_str += '</div>';
                html_str += '<div class="settings-area">';
                  html_str += '<div>';
                    html_str += '<input type="text" class="cw-form-control" id="embedded_content_' + window_index + '_' + tab_count + '_' + content_index + '" value="">';
                  html_str += '</div>';
                html_str += '</div>';
              html_str += '</div>';

              html_str += '<div class="cw-row no-bottom-border">';
                html_str += '<div class="setting-description">';
                  html_str += '<b>Input Api-Key Content:</b>';
                html_str += '</div>';
                html_str += '<div class="settings-area">';
                  html_str += '<div>';
                    html_str += '<input type="text" class="cw-form-control" id="api_key_content_' + window_index + '_' + tab_count + '_' + content_index + '" value="">';
                  html_str += '</div>';
                html_str += '</div>';
              html_str += '</div>';
            html_str += '</div>';
          html_str += '</div>';
        html_str += '</div>';
      }
      $('#content_tabs_' + window_index).append(html_str);

      content_tab_event();
      divider_tab_event();

      $('.delete-tab').unbind().bind('click', function() {
        var tab_id = $(this).parent().data('tab-id');
        var window_index = $(this).data('windows-number');
        delete_tab(tab_id, window_index);
      });

      $('.edit-tab-title').unbind().bind('click', function() {
        var tab_id = $(this).parent().data('tab-id');
        var tab_title = $(this).parent().find('span.tab-title').text();
        var window_index = $(this).data('windows-number');
        edit_tab_title(tab_id, tab_title, window_index);
      });

      $('.edit-tab-color').unbind().bind('click', function() {
        var tab_id = $(this).parent().data('tab-id');
        var tab_color = $(this).parent().data('tab-color');
        var window_index = $(this).data('windows-number');
        edit_tab_color(tab_id, tab_color, window_index);
      });
    });

    $('.delete-tab').unbind().bind('click', function() {
      var tab_id = $(this).parent().data('tab-id');
      var window_index = $(this).data('windows-number');
      delete_tab(tab_id, window_index);
    });

    $('.edit-tab-title').unbind().bind('click', function() {
      var tab_id = $(this).parent().data('tab-id');
      var tab_title = $(this).parent().find('span.tab-title').text();
      var window_index = $(this).data('windows-number');
      edit_tab_title(tab_id, tab_title, window_index);
    });

    $('.edit-tab-color').unbind().bind('click', function() {
      var tab_id = $(this).parent().data('tab-id');
      var tab_color = $(this).parent().data('tab-color');
      var window_index = $(this).data('windows-number');
      edit_tab_color(tab_id, tab_color, window_index);
    });
  }

  function delete_tab(tab_id, window_index) {
    if ($('#overlay_window_tabs_' + window_index + ' .edit-titles .cw-tabs').length > 1) {
      var tab_index = tab_id.split('-')[1];
      var i = 1;
      $('#overlay_window_content_' + window_index + ' .content-tab-links li').removeClass('current');
      $('#overlay_window_content_' + window_index + ' .content-tab').removeClass('current');
      $('#overlay_window_content_' + window_index + ' .content-tab-links li').each(function() {
        var content_tab_id = $(this).data('content-tab-id');
        if (i == 1) {
          $(this).addClass('current');
          $('#' + content_tab_id).addClass('current');
        }
        if (tab_index == i) {
          $(this).remove();
          $('#' + content_tab_id).remove();
        }
        i ++;
      });
      $('#overlay_window_tabs_' + window_index + ' .cw-tabs').each(function() {
        if ($(this).data('tab-id') == tab_id) {
          $(this).remove();
        }
      });
    }
  }

  function edit_tab_title(tab_id, tab_title, window_index) {
    $('#edit_title_dialog').remove();
    var html_str = '<div id="edit_title_dialog" title="Edit Tab Title">';
      html_str += '<input type="text" id="current_tab_title" class="cw-form-control" value="' + tab_title + '">';
    html_str += '</div>';
    $('body').append(html_str);
    var edit_title_dialog = $('#edit_title_dialog').dialog({
			autoOpen: true,
			height: 160,
			width: 230,
			modal: true,
      close: function() {
        var changed_tab_title = $('#current_tab_title').val();
        var tab_index = tab_id.split('-')[1];
        var i = 1;
        $('#overlay_window_content_' + window_index + ' .content-tab-links li').each(function() {
          if (tab_index == i) {
            $(this).text('TAB - ' + changed_tab_title);
          }
          i ++;
        });
        $('#overlay_window_tabs_' + window_index + ' .cw-tabs').each(function() {
          if ($(this).data('tab-id') == tab_id) {
            $(this).find('span.tab-title').text(changed_tab_title);
          }
        });
      },
      buttons: {
        'SAVE': function() {
          edit_title_dialog.dialog('close');
        }
      }
    });
  }

  function edit_tab_color(tab_id, tab_color, window_index) {
    $('#edit_tab_color_dialog').remove();
    var html_str = '<div id="edit_tab_color_dialog" title="Edit Tab Color">';
      html_str += '<div class="colorpicker-area">';
        html_str += '<div id="colorpicker"></div>';
        html_str += '<input type="text" id="current_tab_color" name="color" class="cw-form-control" value="' + tab_color + '" style="margin-top: 15px;">';
      html_str += '</div>';
    html_str += '</div>';
    $('body').append(html_str);

    var edit_tab_color_dialog = $('#edit_tab_color_dialog').dialog({
			autoOpen: true,
			height: 370,
			width: 250,
			modal: true,
      close: function() {
        var changed_color = $('#current_tab_color').val();
        $('#overlay_window_tabs_' + window_index + ' .cw-tabs').each(function() {
          if ($(this).data('tab-id') == tab_id) {
            $(this).data('tab-color', changed_color);
            $(this).css('background', changed_color);
          }
        });
      },
      buttons: {
        'SAVE': function() {
          edit_tab_color_dialog.dialog('close');
        }
      }
    });
    $('#colorpicker').farbtastic('#current_tab_color');
  }

  function content_tab_event() {
    $('ul.content-tab-links li').unbind().bind('click', function() {
      var content_tabs = $(this).parent().parent().prop('id');
      var content_tab_id = $(this).data('content-tab-id');

      $('#' + content_tabs + ' ul.content-tab-links li').removeClass('current');
      $('#' + content_tabs + ' .content-tab').removeClass('current');

      $(this).addClass('current');
      $('#' + content_tab_id).addClass('current');
    });
  }

  function divider_tab_event() {
    $('ul.divider-tab-links li').unbind().bind('click', function() {
      var parent_id = $(this).parent().parent().parent().prop('id');
      var divider_tab_id = $(this).data('divider-tab-id');

      $('#' + parent_id + ' ul.divider-tab-links li').removeClass('current');
      $('#' + parent_id + ' .divider-tab-content').removeClass('current');

      $(this).addClass('current');
      $('#' + divider_tab_id).addClass('current');
    });
  }

  function divider_count_change() {
    $('input.overlay-dividers').unbind().bind('change', function() {
      var element_id = $(this).prop('id');
      var window_index = element_id.slice(-1);
      var divider_count = $(this).val() == 'none' ? 1 : parseInt($(this).val()) + 1;
      var tab_count = $('#overlay_window_content_' + window_index + ' .content-tab-links li').length;
      for (var t = 0; t < tab_count; t ++) {
        var tab_index = t + 1;
        var current_divider_count = $('#overlay_window_content_' + window_index + ' #content_tab_' + window_index + '_' + tab_index + ' .divider-tab-content').length;
        if (divider_count > current_divider_count) {
          for (var i = 0; i < divider_count - current_divider_count; i ++) {
            var divider_index = i + current_divider_count + 1;
            var class_string = '';
            if (divider_index == 1) {
              class_string = 'current';
            }
            $('#overlay_window_content_' + window_index + ' #content_tab_' + window_index + '_' + tab_index + ' .divider-tab-links').append('<li class="divider-tab-link ' + class_string + '" data-divider-tab-id="divider_content_' + window_index + '_' + tab_index + '_' + divider_index + '">Content - ' + divider_index + '</li>');

            var html_str = '<div id="divider_content_' + window_index + '_' + tab_index + '_' + divider_index + '" class="divider-tab-content ' + class_string + '">';
              html_str += '<div class="cw-row no-bottom-border">';
                html_str += '<div class="setting-description">';
                  html_str += '<b>Input URL Content:</b>';
                html_str += '</div>';
                html_str += '<div class="settings-area">';
                  html_str += '<div>';
                    html_str += '<input type="text" class="cw-form-control" id="url_content_' + window_index + '_' + tab_index + '_' + divider_index + '">';
                  html_str += '</div>';
                html_str += '</div>';
              html_str += '</div>';

              html_str += '<div class="cw-row no-bottom-border">';
                html_str += '<div class="setting-description">';
                  html_str += '<b>Input embedded Content:</b>';
                html_str += '</div>';
                html_str += '<div class="settings-area">';
                  html_str += '<div>';
                    html_str += '<input type="text" class="cw-form-control" id="embedded_content_' + window_index + '_' + tab_index + '_' + divider_index + '">';
                  html_str += '</div>';
                html_str += '</div>';
              html_str += '</div>';

              html_str += '<div class="cw-row no-bottom-border">';
                html_str += '<div class="setting-description">';
                  html_str += '<b>Input Api-Key Content:</b>';
                html_str += '</div>';
                html_str += '<div class="settings-area">';
                  html_str += '<div>';
                    html_str += '<input type="text" class="cw-form-control" id="api_key_content_' + window_index + '_' + tab_index + '_' + divider_index + '">';
                  html_str += '</div>';
                html_str += '</div>';
              html_str += '</div>';
            html_str += '</div>';

            $('#overlay_window_content_' + window_index + ' #content_tab_' + window_index + '_' + tab_index + ' .divider-tabs').append(html_str);
          }
        }
        else if (divider_count < current_divider_count) {
          for (var i = 0; i < current_divider_count - divider_count; i ++) {
            $('#overlay_window_content_' + window_index + ' #content_tab_' + window_index + '_' + tab_index + ' .divider-tabs .divider-tab-content').last().remove();
            $('#overlay_window_content_' + window_index + ' #content_tab_' + window_index + '_' + tab_index + ' .divider-tab-links li').last().remove();
          }
        }
      }
      divider_tab_event();
    });
  }

  function change_tab_type() {
    divider_count_change();
    $('.tabs-type input[type="radio"]').unbind().bind('change', function() {
      var window_index = $(this).data('windows-number');
      if ($(this).val() == 'individual') {
        $('#overlay_window_appearnace_' + window_index + ' .tabs-dialog-size input[type="radio"]').each(function() {
          if ($(this).val() == 'tab') {
            $(this).prop('checked', true);
          }
          else {
            $(this).prop('checked', false);
            $(this).prop('disabled', true);
          }
        });

        $('#overlay_window_properties_' + window_index + ' .window-dividers input[type="radio"]').each(function() {
          if ($(this).val() == 'none') {
            $(this).trigger('click');
          }
          else {
            $(this).prop('checked', false);
            $(this).prop('disabled', true);
          }
        });
      }
      else {
        $('#overlay_window_appearnace_' + window_index + ' .tabs-dialog-size input[type="radio"]').each(function() {
          $(this).prop('disabled', false);
        });
        $('#overlay_window_properties_' + window_index + ' .window-dividers input[type="radio"]').each(function() {
          $(this).prop('disabled', false);
        });
      }
      divider_tab_event();
    });
  }

  function save_settings() {
    var overlay_windows = [];
    var license_key = $('#license_key').val();
    var windows_status = $('input[name="overlay_status"]:checked').val();
    var windows_location = $('input[name="overlay_location"]:checked').val();
    var windows_count = $('input[name="windows_number"]:checked').val();
    for (var i = 0; i < windows_count; i ++) {
      var window_index = i + 1;
      var tabs = [];
      var tab_index = 1;
      $('#overlay_window_tabs_' + window_index + ' .add-tab-section .cw-tabs').each(function() {
        if (!$(this).hasClass('add-tab')) {
          var tab = {
            'title': $(this).find('span.tab-title').text(),
            'color': $(this).data('tab-color')
          }
          var contents = [];
          var divider_index = 1;
          $('#overlay_window_content_' + window_index + ' #content_tabs_' + window_index + ' .divider-tab-content').each(function() {
            var content = {
              url_content: $('#url_content_' + window_index + '_' + tab_index + '_' + divider_index).val(),
              embedded_content: $('#embedded_content_' + window_index + '_' + tab_index + '_' + divider_index).val(),
              api_key_content: $('#api_key_content_' + window_index + '_' + tab_index + '_' + divider_index).val(),
            };
            contents.push(content);
            divider_index ++;
          });
          tab.contents = contents;
          tabs.push(tab);
          tab_index ++;
        }
      });
      var window_position = $('#overlay_window_appearnace_' + window_index + ' input[name="tabs_position_' + window_index + '"]:checked').val();
      var window_size = $('#overlay_window_appearnace_' + window_index + ' input[name="tabs_size_' + window_index + '"]:checked').val();
      var window_dialog_size = $('#overlay_window_appearnace_' + window_index + ' input[name="tabs_dialog_size_' + window_index + '"]:checked').val();
      var tab_type = $('#overlay_window_appearnace_' + window_index + ' input[name="tabs_type_' + window_index + '"]:checked').val();
      var window_placement = {
        type: $('#overlay_window_properties_' + window_index + ' input[name="overlay_placement_' + window_index + '"]:checked').val()
      };
      var window_placement_pages = [];
      $('#overlay_window_properties_' + window_index + ' .page-row').each(function() {
        if ($(this).find('input').prop('checked')) {
          window_placement_pages.push($(this).data('page-id'));
        }
      });
      window_placement.pages = window_placement_pages;

      var window_dividers = $('#overlay_window_properties_' + window_index + ' input[name="overlay_dividers_' + window_index + '"]:checked').val();

      var overlay_window = {
        tabs: tabs,
        window_position: window_position,
        window_size: window_size,
        window_dialog_size: window_dialog_size,
        tab_type: tab_type,
        window_placement: window_placement,
        window_dividers: window_dividers
      };

      overlay_windows.push(overlay_window);
    }

    var cw_settings = {
      license_key: license_key,
      windows_status: windows_status,
      windows_location: windows_location,
      windows_count: windows_count,
      overlay_windows: overlay_windows
    }

    $.ajax({
      url: ajaxurl,
      data: {
        action: 'save_cw_settings',
        cw_settings: cw_settings
      },
      type: 'POST',
      success: function() {
        alert('Successfully Saved!');
        location.reload();
      }
    });
  }
</script>
