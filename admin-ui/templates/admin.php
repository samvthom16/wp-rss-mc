<?php

  if( $_POST && is_array( $_POST['feed'] ) && count( $_POST['feed']) ){

    //echo "<pre>";
    //print_r( $_POST );
    //echo "</pre>";

    update_option( 'wp_rss_mc_publish_feeds', $_POST[ 'feed' ] );

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

  //echo "<pre>";
  //print_r( $categories );
  //echo "</pre>";

  browserData( 'categories', $categories );

?>

<div class='wrap'>
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
        <?php foreach( $categories as $key => $category ):  ?>
        <div class='box' id='cat-<?php echo $key + 1;?>'>
          <h4><?php echo $category;?></h4>
          <input type='hidden' name='feed[<?php echo $key;?>][title]' value='<?php echo $category;?>' />
          <ul></ul>
        </div>
        <?php endforeach;?>
      </form>
    </div>
  </div>
</div>

<style>
  .grid-2{
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 20px;
  }
  .feed{
    border: #CCC solid 1px;
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
  .box h4{
    display: inline-block;
    margin: 0;
    border-bottom: #ccc solid 2px;
    padding-bottom: 5px;
  }
</style>
