


jQuery( "[data-behaviour~='feedly-dropdown']" ).each( function(){

  var $dropdown = jQuery( this );

  $dropdown.change( function( ){

    var feed_id = $dropdown.val();

    jQuery( '#feed-results').html( "Loading..." );

    jQuery.ajax( {
      url: ajaxurl + '?action=wp_rss_mc',
      data: {
        feedly    : "stream",
        stream_id : feed_id
      }
    } ).done( function( data ){

      jQuery( '#feed-results').html( "" );

      var $list = jQuery( document.createElement( 'ul' ) );

      $list.appendTo( '#feed-results' );

      if( !data.items.length ){
        jQuery( '#feed-results').html( "No items found." );
      }

      for( i in data.items ){

        var $list_item = jQuery( document.createElement( 'li' ) );

        var $title = jQuery( document.createElement( 'h4') );
        $title.html( data.items[i].title );
        $title.appendTo( $list_item );

        $list_item.appendTo( $list );

        //console.log( data.items[i] );
      }



    } );


  } )


} );
