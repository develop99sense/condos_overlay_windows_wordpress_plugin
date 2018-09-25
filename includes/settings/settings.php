<div class="tabs-settings">
  <div class="cw-row no-bottom-border">
    <div class="setting-description">
      <b>OVERLAY WINDOW STATUS:</b> Setting to In-Active will hide Overlay Windows.
    </div>
    <div class="settings-area">
      <div class="tabs-position">
        <div class="tab-bottom tab-position">
          <input type="radio" name="overlay_status" id="overlay_active" value="active" <?php echo $settings->windows_status == 'active' ? 'checked' : ''; ?>>
          <label for="overlay_active">Active</label>
        </div>
        <div class="tab-top tab-position">
          <input type="radio" name="overlay_status" id="overlay_in_active" value="in_active" <?php echo $settings->windows_status == 'in_active' ? 'checked' : ''; ?>>
          <label for="overlay_in_active">In-Active</label>
        </div>
      </div>
    </div>
  </div>

  <div class="cw-row">
    <div class="setting-description">
      <b>OVERLAY WINDOW LOCATION:</b> Where will be the Overlay Windows be located?
    </div>
    <div class="settings-area">
      <div class="tabs-position">
        <div class="tab-bottom tab-position">
          <input type="radio" name="overlay_location" id="overlay_admin" value="admin" <?php echo $settings->windows_location == 'admin' ? 'checked' : ''; ?>>
          <label for="overlay_admin">Admin</label>
        </div>
        <div class="tab-top tab-position">
          <input type="radio" name="overlay_location" id="overlay_frontend" value="front_end" <?php echo $settings->windows_location == 'front_end' ? 'checked' : ''; ?>>
          <label for="overlay_frontend">Front-End</label>
        </div>
        <div class="tab-top tab-position">
          <input type="radio" name="overlay_location" id="overlay_all" value="all" <?php echo $settings->windows_location == 'all' ? 'checked' : ''; ?>>
          <label for="overlay_all">All</label>
        </div>
      </div>
    </div>
  </div>

  <div class="cw-row" style="padding-bottom: 200px;">
    <div class="setting-description">
      <b>NUMBER OF WINDOWS:</b> How many windows will be there?
    </div>
    <div class="settings-area">
      <div class="tabs-position">
        <div class="tab-bottom tab-position">
          <input type="radio" name="windows_number" id="windows_one" value="1" <?php echo $settings->windows_count == '1' ? 'checked' : ''; ?>>
          <label for="windows_one">1</label>
        </div>
        <div class="tab-top tab-position">
          <input type="radio" name="windows_number" id="windows_two" value="2" <?php echo $settings->windows_count == '2' ? 'checked' : ''; ?>>
          <label for="windows_two">2</label>
        </div>
        <div class="tab-top tab-position">
          <input type="radio" name="windows_number" id="windows_three" value="3" <?php echo $settings->windows_count == '3' ? 'checked' : ''; ?>>
          <label for="windows_three">3</label>
        </div>
        <div class="tab-top tab-position">
          <input type="radio" name="windows_number" id="windows_four" value="4" <?php echo $settings->windows_count == '4' ? 'checked' : ''; ?>>
          <label for="windows_four">4</label>
        </div>
      </div>
    </div>
  </div>
</div>
