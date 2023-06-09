<?php

  if( $_POST && is_array( $_POST['feed'] ) && count( $_POST['feed']) ){

    //echo "<pre>";
    //print_r( $_POST );
    //echo "</pre>";



    update_option( 'wp_rss_mc_publish_feeds', $_POST[ 'feed' ] );

    update_option( 'wp_rss_mc_publish_time', current_datetime()->format('D, d M Y H:i:s +0000') );

    echo '<div class="notice notice-info is-dismissible"><p>RSS feed has been updated.</p></div>';

  }

  function browserData( $type, $data ){
    ?>
    <script type="text/javascript">
    if( window.browserData === undefined || window.browserData[ '<?php _e( $type );?>' ] === undefined ){
      var data = window.browserData = window.browserData || {};
      browserData[ '<?php _e( $type );?>' ] = <?php echo json_encode( wp_unslash( $data ) );?>;
    }
    </script>
    <?php
  }

  $feedly = WP_RSS_MC\FEEDLY_API::getInstance();

  $collections = $feedly->getCollections();

  $categories = WP_RSS_MC\ADMIN_SETTINGS::getInstance()->getCategories();

  if( isset( $collections->errorCode ) ){
    echo '<div class="notice notice-info is-dismissible"><p>' . $collections->errorMessage . '</p></div>';
  }

  browserData( 'categories', $categories );

  $rss_feed_link = get_bloginfo( 'url' ) . "/feed/mailchimp?v=" . time();





?>

<div class='wrap'>

  <p>Find your latest feed <a target='_blank' href='<?php echo $rss_feed_link;?>'>here</a></p>


  <div class='grid-2'>
    <div>
      <select data-behaviour='feedly-dropdown'>
        <option>Choose Feed</option>
        <?php foreach( $collections as $collection ):?>
        <option value='<?php print_r( $collection->id );?>'><?php print_r( $collection->label );?></option>
        <?php endforeach;?>
      </select>

      <div style="margin-top:20px;" id='feed-results'></div>
    </div>
    <div id='rightcol'>
      <form method="POST">
        <?php submit_button( 'Publish Feed' );?>
        <p style='margin-top:-10px;'><a href="#TB_inline?width=400&height=400&inlineId=modal-window" class="thickbox">+ Custom Feed</a></p>
        <?php foreach( $categories as $key => $category ):  ?>
        <div class='box' id='cat-<?php echo $key + 1;?>'>
          <h4><?php echo $category;?></h4>
          <input type='hidden' name='feed[<?php echo $key;?>][title]' value='<?php echo $category;?>' />
          <ul class='category-feed-list'></ul>
        </div>
        <?php endforeach;?>
      </form>
    </div>
  </div>
</div>



<?php

  $fields = array(
    'title'   => 'Title of the article',
    'source'  => 'Source of the article',
    'link'    => 'Link of the article'
  );

?>

<div id="modal-window" style="display:none;">
  <?php foreach( $fields as $slug => $field ):?>
  <p>
    <label><?php _e( $field );?></label><br>
    <input type='text' name='custom[<?php _e( $slug );?>]' placeholder="<?php _e( $field );?>" />
  </p>
  <?php endforeach;?>

  <p>
    <label>Choose Category</label><br>
    <select name='custom[category]'>
      <?php foreach( $categories as $key => $category ):  ?>
      <option value='<?php echo $key;?>'><?php _e( $category );?></option>
      <?php endforeach;?>
    </select>
  </p>
  <p>
    <button id='btn-custom-feed' type='button' class='button button-secondary'>+ Custom Feed</button>
  </p>
</div>


<style>
  .grid-2{
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 20px;
  }
  .feed{
    border-bottom: #DDD solid 1px;
    padding: 0 10px;
    margin-bottom: 20px;
  }
  .feed select{
    margin-bottom: 15px;
    font-size: 14px;
    padding: 5px;
    min-height: auto;
  }
  #rightcol p.submit{
    margin-top: 0;
    padding-top: 0;
  }
  .box{
    min-height: 200px;
    background: #fff;
    padding: 10px 10px 10px;
    margin-bottom: 20px;
  }
  .box li{
    padding-bottom: 20px;
    margin-bottom: 20px;
    border-bottom: #CCC solid 1px;
  }
  .box li a[href]{
    /*
    display: inline-block;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: calc( 100% - 50px );
    */
  }
  .box h4{
    display: inline-block;
    margin: 0;
    border-bottom: #ccc solid 2px;
    padding-bottom: 5px;
  }
  .box button{
    margin-left: 5px;
    font-size: 10px;
  }
  .box input.title{
    border: none;
    width: 100%;
    font-size: 14px;
    padding: 0;
  }
  .box input.source{
    font-size: 10px;
    width: 100%;
    border: none;
    padding: 0;
  }

  #TB_ajaxContent input{
    width: 100%;
    padding: 5px 10px;
    max-width: 500px;
  }
</style>
