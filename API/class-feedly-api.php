<?php

namespace WP_RSS_MC;

class FEEDLY_API extends API_BASE{

  function getBaseURL(){ return 'https://cloud.feedly.com/v3/'; }

  function getHTTPHeader(){
    $auth = 'A1QjS9TnQD4mDJ30WgZVysE9VW0uHBULLrp1sCRiO1Kj05GpqbFyjG0biF5A4SY44Dkx5atQAnMgwMdJ1Dk4eQvHM_skrPT769-k6AlLqeXURvRVZe8GZ3qcfCJcBOwe0p5grlQr9apbEIhLwMtK3_0BbvviknO6kCYrewlmj395CJSKIhQHggWTXacf5eIAOqSNeMN7iCpC3pXKp9FbW-Zlj3J_XiwfvaoszlDUqGwoKWOril2Qx-UefJVuHQ:feedlydev';
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
