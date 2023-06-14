<?php

  $setting_name = 'wp_rss_mc_settings';

  if( $_POST && isset( $_POST[ $setting_name ] )  ){
    update_option( $setting_name, $_POST[ $setting_name ] );
  }


  $option = get_option( $setting_name );

  $fields = array(
    'feedlyAPIKey' => array(
      'type'  => 'text',
      'label' => 'Feedly API KEY',
      'help'  => '<a target="_blank" href="https://feedly.com/v3/auth/dev">Click here for new token</a>'
    ),
    'categories' => array(
      'type'  => 'textarea',
      'label' => 'Feed Categories',
      'help'  => 'Enter each category line by line'
    )
  );



?>
<form method='POST'>
  <table class='form-table' role='presentation'>
    <tbody>
    <?php foreach( $fields as $key => $field ): $input_name = $setting_name . "[".$key."]";?>
      <tr>
        <th scope='row'><label for='<?php _e( $key );?>'><?php _e( $field['label'] );?></label></th>
        <td>
          <?php if( isset( $field['type'] ) && 'text' == $field['type'] ):?>
          <input id='<?php _e( $key );?>' type="text" name="<?php _e( $input_name );?>" class="regular-text" value="<?php echo is_array( $option ) && isset( $option[ $key ] ) ? $option[ $key ] : ''; ?>"  placeholder="<?php _e( $field['label'] );?>" />
          <?php else:?>
          <textarea id='<?php _e( $key );?>' class="large-text" rows="10" cols="30" name='<?php _e( $input_name );?>'><?php echo is_array( $option ) && isset( $option[ $key ] ) ? $option[ $key ] : ''; ?></textarea>
          <?php endif;?>

          <?php if( isset( $field['help'] ) ):?>
          <p class='description'><?php _e( $field[ 'help' ] );?></p>
          <?php endif;?>
        </td>
      </tr>
    <?php endforeach;?>
    <tbody>
  </table>
  <?php submit_button( 'Save Settings' );?>
</form>
