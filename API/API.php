<?php


$inc_files = array(
  'class-api-base.php',
  'class-feedly-api.php',
);

foreach( $inc_files as $inc_file ){
  require_once( $inc_file );
}
