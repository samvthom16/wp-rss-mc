<?php

namespace WP_RSS_MC;

class FEEDLY_API extends API_BASE{

  function getBaseURL(){ return 'https://cloud.feedly.com/v3/'; }

  function getHTTPHeader(){
    $auth = get_option( 'feedly_api_key' );
    return array( 'Authorization: Bearer '. $auth );
  }

  function getCollections(){
    return $this->cachedProcessRequest( 'collections' );
  }

  function getStream( $stream_id ){
    $query = urlencode( $stream_id );
    $url = "streams/contents?streamId=$query&hours=24";
    return $this->cachedProcessRequest( $url );
  }

}


FEEDLY_API::getInstance();