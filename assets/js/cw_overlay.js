var $ = jQuery;
var cw_settings = {};
var current_page_id = cw_global_vars.current_page_id;
$(function() {
  $.ajax({
    url: '/wp-admin/admin-ajax.php',
    data: {action: 'get_cw_settings'},
    success: function(data) {
      cw_settings = JSON.parse(data);
      var overlay_windows = cw_settings.overlay_windows;
      for (var i = 0; i < overlay_windows.length; i ++) {
        var window_index = i + 1;
        var overlay_window = overlay_windows[i];
        var window_placement = overlay_window.window_placement;
        if (window_placement.type == 'custom' && $.inArray(current_page_id, window_placement.pages) == -1) {
          continue;
        }
        if (overlay_window.tab_type == 'full') {
          init_full_tabs(overlay_window, window_index);
        }
        else {
          init_individual_tabs(overlay_window, window_index);
        }
      }
      full_pin_click_event();
      individual_pin_click_event();
    }
  });
});

function init_full_tabs(overlay_window, window_index) {
  var window_position = overlay_window.window_position;
  var tabs = overlay_window.tabs;
  var window_dialog_size = overlay_window.window_dialog_size;
  var window_dividers = overlay_window.window_dividers;
  var dividers = overlay_window.dividers;
  var html_str = '<div id="cw_overlay_windows_' + window_index + '" class="cw-overlay-windows cw-' + window_position + ' cw-dialog-size-' + window_dialog_size + ' full-windows">';
    for(var i = 0; i < tabs.length; i ++) {
      var tab_id = 'cw_tabs_' + (i + 1);
      var contents = tabs[i].contents;

      html_str += '<div class="cw-overlay-pins" style="background: ' + tabs[i].color + '" data-tab-id="overlay_window_tab_' + tab_id + '_' + window_index + '">' + tabs[i].title + '</div>';
      html_str += '<div class="cw-overlay-contents" id="overlay_window_tab_' + tab_id + '_' + window_index + '">';
        for (var j = 0; j < contents.length; j ++) {
          var id_string = 'overlay_window_divider_content_' + (j + 1) + '_' + (i + 1);
          html_str += '<div class="cw-overlay-divider-contents divider-' + window_dividers + '" id="' + id_string + '">';
            if (contents[j].url_content) {
              html_str += '<iframe src="' + contents[j].url_content + '" style="width: 100%; height: 100%;"></iframe>';
            }
            else if (contents[j].embedded_content) {

            }
            else if (contents[j].api_key_content) {

            }
          html_str += '</div>';
        }
      html_str += '</div>';
    }
  html_str += '</div>';
  $('body').append(html_str);
  var i = 0;
  var tab_widths = [];
  var first_width = 0;
  $('#cw_overlay_windows_' + window_index + ' .cw-overlay-pins').each(function() {
    if ($(this).parent().hasClass('cw-top') || $(this).parent().hasClass('cw-bottom')) {
      var position_name = 'left';
    }
    else {
      var position_name = 'top';
    }
    if (i == 0) {
      first_width = $(this).width();
      if (position_name == 'top'){
        $(this).css(position_name, (0 - first_width) + 'px');
      }
      else {
        $(this).css(position_name, '0');
      }
    }
    else {
      var position_length = 0;
      for (var j = 0; j < tab_widths.length; j ++) {
        position_length += tab_widths[j] + 42;
      }
      if (position_name == 'top') {
        $(this).css(position_name, (position_length - first_width) + 'px');
      }
      else {
        $(this).css(position_name, position_length + 'px');
      }
    }
    tab_widths.push($(this).width());
    i ++;
  });
}

function full_pin_click_event() {
  $('.full-windows .cw-overlay-pins').bind('click', function() {
    var window_index = $(this).parent().prop('id').slice(-1);
    var overlay_window = cw_settings.overlay_windows[window_index - 1];
    var window_size = overlay_window.window_size;
    if (window_size == 100) {
      window_size = 97;
    }
    var window_dialog_size = overlay_window.window_dialog_size;
    if ($(this).parent().hasClass('cw-top')) {
      var window_position = 'top';
    }
    if ($(this).parent().hasClass('cw-bottom')) {
      var window_position = 'bottom';
    }
    if ($(this).parent().hasClass('cw-left')) {
      var window_position = 'left';
    }
    if ($(this).parent().hasClass('cw-right')) {
      var window_position = 'right';
    }
    var cw_overlay_window = $('#cw_overlay_windows_' + window_index);
    var tab_id = $(this).data('tab-id');
    if (!$(this).hasClass('active')) {
      $('.full-windows .cw-overlay-pins').removeClass('active');
      $(this).addClass('active');
      $('.cw-overlay-contents').removeClass('active');
      $('#' + tab_id).addClass('active');

      if (!cw_overlay_window.hasClass('expand')) {
        if (window_position == 'bottom') {
          $('.cw-overlay-windows').each(function() {
            if ($(this).prop('id') != ('cw_overlay_windows_' + window_index)) {
              $(this).removeClass('expand');
              if ($(this).hasClass('cw-bottom')) {
                $(this).css('height', '0');
              }
              if ($(this).hasClass('cw-top')) {
                $(this).find('.cw-overlay-pins').css('top', '0');
                $(this).css('height', '0');
              }
              if ($(this).hasClass('cw-left')) {
                $(this).find('.cw-overlay-pins').css('left', '0');
                $(this).css('width', '0');
              }
              if ($(this).hasClass('cw-right')) {
                $(this).find('.cw-overlay-pins').css('right', '0');
                $(this).css('width', '0');
              }
            }
          });
          if (window_size != 'tab') {
            cw_overlay_window.animate({"height": window_size + '%'}, 300, function() {
    					cw_overlay_window.addClass("expand");
    				});
          }
        }
        else if (window_position == 'top') {
          $('.cw-overlay-windows').each(function() {
            if ($(this).prop('id') != ('cw_overlay_windows_' + window_index)) {
              $(this).removeClass('expand');
              if ($(this).hasClass('cw-bottom')) {
                $(this).css('height', '0');
              }
              if ($(this).hasClass('cw-top')) {
                $(this).find('.cw-overlay-pins').css('top', '0');
                $(this).css('height', '0');
              }
              if ($(this).hasClass('cw-left')) {
                $(this).find('.cw-overlay-pins').css('left', '0');
                $(this).css('width', '0');
              }
              if ($(this).hasClass('cw-right')) {
                $(this).find('.cw-overlay-pins').css('right', '0');
                $(this).css('width', '0');
              }
            }
          });
          if (window_size != 'tab') {
            cw_overlay_window.animate({"height": window_size + '%'}, 300, function() {
    					cw_overlay_window.addClass("expand");
    				});

            var pin_position = $(window).height() * window_size / 100 - 17;
            $('#cw_overlay_windows_' + window_index + ' .cw-overlay-pins').css('top', pin_position + 'px');
          }
        }
        else if (window_position == 'left') {
          $('.cw-overlay-windows').each(function() {
            if ($(this).prop('id') != ('cw_overlay_windows_' + window_index)) {
              $(this).removeClass('expand');
              if ($(this).hasClass('cw-bottom')) {
                $(this).css('height', '0');
              }
              if ($(this).hasClass('cw-top')) {
                $(this).find('.cw-overlay-pins').css('top', '0');
                $(this).css('height', '0');
              }
              if ($(this).hasClass('cw-left')) {
                $(this).find('.cw-overlay-pins').css('left', '0');
                $(this).css('width', '0');
              }
              if ($(this).hasClass('cw-right')) {
                $(this).find('.cw-overlay-pins').css('right', '0');
                $(this).css('width', '0');
              }
            }
          });
          if (window_size != 'tab') {
            cw_overlay_window.animate({"width": window_size + '%'}, 300, function() {
    					cw_overlay_window.addClass("expand");
    				});
            var pin_position = $(window).width() * window_size / 100 - 17;
            $('#cw_overlay_windows_' + window_index + ' .cw-overlay-pins').css('left', pin_position + 'px');
          }
        }
        else if (window_position == 'right') {
          $('.cw-overlay-windows.full-windows').each(function() {
            if ($(this).prop('id') != ('cw_overlay_windows_' + window_index)) {
              $(this).removeClass('expand');
              if ($(this).hasClass('cw-bottom')) {
                $(this).css('height', '0');
              }
              if ($(this).hasClass('cw-top')) {
                $(this).find('.cw-overlay-pins').css('top', '0');
                $(this).css('height', '0');
              }
              if ($(this).hasClass('cw-left')) {
                $(this).find('.cw-overlay-pins').css('left', '0');
                $(this).css('width', '0');
              }
              if ($(this).hasClass('cw-right')) {
                $(this).find('.cw-overlay-pins').css('right', '0');
                $(this).css('width', '0');
              }
            }
          });
          if (window_size != 'tab') {
            cw_overlay_window.animate({"width": window_size + '%'}, 300, function() {
    					cw_overlay_window.addClass("expand");
    				});
            var pin_position = $(window).width() * window_size / 100 - 17;
            $('#cw_overlay_windows_' + window_index + ' .cw-overlay-pins').css('right', pin_position + 'px');
          }
        }
      }
      else {
        $(this).addClass('active');
        $('#' + tab_id).addClass('active');
        cw_overlay_window.addClass('expand');
        if (window_position == 'bottom') {
          cw_overlay_window.animate({height: window_size + '%'}, 300, function() {

          });
        }
        if (window_position == 'top') {
          if (window_size != 'tab') {
            cw_overlay_window.animate({height: window_size + '%'}, 300, function() {
            });
            var pin_position = $(window).height() * window_size / 100 - 17;
            $('#cw_overlay_windows_' + window_index + ' .cw-overlay-pins').css('top', pin_position + 'px');
          }
        }
        if (window_position == 'left') {
          if (window_size != 'tab') {
            cw_overlay_window.animate({width: window_size + '%'}, 300, function() {
            });
            var pin_position = $(window).width() * window_size / 100 - 17;
            $('#cw_overlay_windows_' + window_index + ' .cw-overlay-pins').css('left', pin_position + 'px');
          }
        }
        if (window_position == 'right') {
          if (window_size != 'tab') {
            cw_overlay_window.animate({width: window_size + '%'}, 300, function() {
            });
            var pin_position = $(window).width() * window_size / 100 - 17;
            $('#cw_overlay_windows_' + window_index + ' .cw-overlay-pins').css('right', pin_position + 'px');
          }
        }
      }
    }
    else {
      $(this).removeClass('active');
      $('#' + tab_id).removeClass('active');
      if (window_position == 'bottom') {
        cw_overlay_window.animate({height: '0'}, 300, function() {

        });
      }
      if (window_position == 'top') {
        cw_overlay_window.animate({height: '0'}, 300, function() {
          $('#cw_overlay_windows_' + window_index + ' .cw-overlay-pins').css('top', '0');
        });
      }
      if (window_position == 'left') {
        cw_overlay_window.animate({width: '0'}, 300, function() {
          $('#cw_overlay_windows_' + window_index + ' .cw-overlay-pins').css('left', '0');
        });
      }
      if (window_position == 'right') {
        cw_overlay_window.animate({width: '0'}, 300, function() {
          $('#cw_overlay_windows_' + window_index + ' .cw-overlay-pins').css('right', '0');
        });
      }
    }
  });
}

function init_individual_tabs(overlay_window, window_index) {
  var window_position = overlay_window.window_position;
  var tabs = overlay_window.tabs;
  var window_width = 0;
  if (window_position == 'top' || window_position == 'bottom') {
    var html_str = '<div id="cw_overlay_windows_' + window_index +   '" class="cw-overlay-windows cw-' + window_position + ' individual-windows" style="width: ' + ((150 * tabs.length + 4)) + 'px;">';
  }
  else {
    var html_str = '<div id="cw_overlay_windows_' + window_index +   '" class="cw-overlay-windows cw-' + window_position + ' individual-windows" style="height: ' + ((150 * tabs.length)) + 'px; width: 0px;">';
  }
    for (var i = 0; i < tabs.length; i ++) {
      var tab_id = 'cw_tabs_' + (i + 1);
      html_str += '<div class="cw-overlay-pins" style="background: ' + tabs[i].color + '" data-tab-id="overlay_window_tab_' + tab_id + '_' + window_index + '">' + tabs[i].title + '</div>';
      html_str += '<div class="cw-overlay-contents" id="overlay_window_tab_' + tab_id + '_' + window_index + '">';
      var contents = tabs[i].contents;
        if (contents[0].url_content) {
          html_str += '<iframe src="' + contents[0].url_content + '" style="width: 100%; height: 100%;"></iframe>';
        }
        else if (contents[0].embedded_content) {

        }
        else if (contents[0].api_key_content) {

        }
      html_str += '</div>';
    }
  html_str += '</div>';
  $('body').append(html_str);
  var i = 0;
  var tab_widths = [];
  var first_width = 0;
  $('#cw_overlay_windows_' + window_index + ' .cw-overlay-pins').each(function() {
    if ($(this).parent().hasClass('cw-top') || $(this).parent().hasClass('cw-bottom')) {
      var position_name = 'left';
    }
    else {
      var position_name = 'top';
    }
    if (i == 0) {
      first_width = $(this).width();
      if (position_name == 'top'){
        $(this).css(position_name, (0 - first_width) + 'px');
      }
      else {
        $(this).css(position_name, '0');
      }
    }
    else {
      var position_length = 0;
      for (var j = 0; j < tab_widths.length; j ++) {
        position_length += tab_widths[j] + 42;
      }
      if (position_name == 'top') {
        $(this).css(position_name, (position_length - first_width) + 'px');
      }
      else {
        $(this).css(position_name, position_length + 'px');
      }
    }
    tab_widths.push($(this).width());
    i ++;
  });
}

function individual_pin_click_event() {
  $('.individual-windows .cw-overlay-pins').bind('click', function() {
    $('.cw-overlay-windows').each(function() {

    });
    var pin_element = $(this);
    var window_index = $(this).parent().prop('id').slice(-1);
    var overlay_window = cw_settings.overlay_windows[window_index - 1];
    var window_size = overlay_window.window_size;
    if (window_size == 100) {
      window_size = 97;
    }
    if ($(this).parent().hasClass('cw-top')) {
      var window_position = 'top';
    }
    if ($(this).parent().hasClass('cw-bottom')) {
      var window_position = 'bottom';
    }
    if ($(this).parent().hasClass('cw-left')) {
      var window_position = 'left';
    }
    if ($(this).parent().hasClass('cw-right')) {
      var window_position = 'right';
    }
    var tab_id = $(this).data('tab-id');
    if (!$(this).hasClass('active')) {
      $(this).addClass('active');
      pin_element.hide();
      var real_size = $(window).height() * window_size / 100;
      $('#' + tab_id).show();
      if (window_position == 'top') {
        $('#' + tab_id).animate({height: real_size + 'px'}, 300, function() {
          pin_element.css('top', real_size + 'px');
          pin_element.show();
        });
      }
      else if (window_position == 'bottom') {
        $('#' + tab_id).css({height: real_size});
        var p = (0 - real_size - 15) + 'px';
        var margin = (0 - real_size - 50) + 'px';
        $('#' + tab_id).animate({marginTop: p}, 300, function() {
          pin_element.css('margin-top', margin);
          pin_element.show();
        });
      }
      else if (window_position == 'left') {
        real_size = $(window).width() * window_size / 100;
        $('#' + tab_id).css('margin-left', '15px');
        $('#' + tab_id).animate({width: real_size - 2 + 'px'}, 300, function() {
          pin_element.css('left', real_size + 'px');
          pin_element.show();
        });
      }
      else if (window_position == 'right') {
        real_size = $(window).width() * window_size / 100;
        var left = $('#' + tab_id).offset().left;
        $('#' + tab_id).css({width: real_size});
        var p = (0 - real_size) + "px";
        $('#' + tab_id).animate({"marginLeft": p}, 300, function() {
          pin_element.css('right', real_size + 'px');
          pin_element.show();
        });
      }
    }
    else {
      $(this).removeClass('active');
      pin_element.hide();
      if (window_position == 'top') {
        $('#' + tab_id).animate({height: 0}, 300, function() {
          pin_element.css('top', 0);
          pin_element.show();
        });
      }
      if (window_position == 'bottom') {
        $('#' + tab_id).animate({marginTop: 0}, 300, function() {
          pin_element.css('margin-top', '-50px');
          pin_element.show();
        });
      }
      if (window_position == 'right') {
        $('#' + tab_id).animate({marginLeft: '15px'}, 300, function() {
          pin_element.css('right', 0);
          pin_element.show();
        });
      }
      if (window_position == 'left') {
        $('#' + tab_id).animate({width: 0}, 300, function() {
          pin_element.css('left', 0);
          pin_element.show();
        });
      }
    }
  });
}
