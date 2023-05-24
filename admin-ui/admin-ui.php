<?php


$inc_files = array(
  'class-admin-ui.php',
  'class-admin-settings.php'
);

foreach( $inc_files as $inc_file ){
  require_once( $inc_file );
}
