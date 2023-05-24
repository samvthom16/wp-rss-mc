<?php


  $feedly = WP_RSS_MC\FEEDLY_API::getInstance();

  $collections = $feedly->getCollections();

  //echo "<pre>";
  //print_r( $collections );
  //echo "</pre>";

?>

<div class='wrap'>
  <select data-behaviour='feedly-dropdown'>
    <option>Choose Feed</option>
    <?php foreach( $collections as $collection ):?>
    <option value='<?php print_r( $collection->id );?>'><?php print_r( $collection->label );?></option>
    <?php endforeach;?>
  </select>

  <div style="margin-top:20px;" id='feed-results'></div>

</div>
