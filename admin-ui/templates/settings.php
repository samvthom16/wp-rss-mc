<?php

  $setting_name = 'feedly_api_key';

  if( $_POST && isset( $_POST[ $setting_name ] )  ){
    update_option( $setting_name, $_POST[ $setting_name ] );
  }



  $option = get_option( $setting_name );

?>
<form method='POST'>
  <p><label>Feedly API KEY</label></p>
  <p>
    <input type="text" name="<?php echo $setting_name;?>" class="regular-text" value="<?php echo isset( $option ) ? $option : ''; ?>"  placeholder="API KEY" />
  </p>
  <?php submit_button( 'Save Settings' );?>
</form>
