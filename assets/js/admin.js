function getIDFromTitle( title ){
  var slug = title.toLowerCase().trim().replace(/[^\w\s-]/g, '').replace(/[\s_-]+/g, '-').replace(/^-+|-+$/g, '');
  return btoa( slug ).replace(/[^a-zA-Z0-9 ]/g, '');
}

// SORTING
jQuery( '.category-feed-list').sortable();


function addFeedToList( cat_key, feedData ){

  //console.log( cat_key );
  //console.log( 'hello' );

  function createInputElement( $list_item, key, inputType ){

    var list_item_id = getIDFromTitle( feedData.title );

    var arr_i = cat_key - 1;
    var $inputTitle = jQuery( document.createElement( 'input') );
    $inputTitle.appendTo( $list_item );
    $inputTitle.addClass( key );
    $inputTitle.attr( 'type', inputType );
    $inputTitle.attr( 'name', 'feed[' + arr_i + '][items][' + list_item_id + '][' + key + ']' );
    $inputTitle.val( feedData[key] );
  }

  function createListElement(){

    var list_item_id = getIDFromTitle( feedData.title );
    //console.log( list_item_id );

    jQuery( '#' + list_item_id ).remove();

    var $list_item = jQuery( document.createElement( 'li' ) );
    $list_item.appendTo( '#cat-' + cat_key + ' ul' );
    $list_item.attr( 'id', list_item_id );

    createInputElement( $list_item, 'title', 'text' );
    createInputElement( $list_item, 'link', 'hidden' );
    createInputElement( $list_item, 'source', 'text' );

    var $anchor = jQuery( document.createElement( 'a' ) );
    $anchor.appendTo( $list_item );
    $anchor.html( 'View' );
    $anchor.attr( 'href', feedData.link );
    $anchor.attr( 'target', '_blank' );


    var $btn = jQuery( document.createElement( 'button' ) );
    $btn.attr( 'type', 'button' );
    $btn.html( 'Delete' );
    $btn.appendTo( $list_item );

    $btn.click( function( ev ){
      ev.preventDefault();

      var $parent_list  = $btn.closest( 'li' ),
        feedId          = $parent_list.attr( 'id' ),
        $feedItem       = jQuery( '[data-id~='+ feedId + ']');

      $feedItem.find('select').prop( 'selectedIndex', 0 );
      $parent_list.remove();
      //$btn.closest( 'li' ).remove();
    } );



  }

  createListElement();
}

/*
addFeedToList( 1, {
  link    : "https://www.catholicworldreport.com/2023/05/04/in-5-years-the-church-in-nicaragua-has-suffered-more-than-500-attacks-90-in-2023-alone/",
  title   : "In 5 years the Church in Nicaragua has suffered more than 500 attacks, 90 in 2023 alone",
  source  : "Catholic World Report"
} );

addFeedToList( 1, {
  link    : "https://www.catholicworldreport.com/2023/05/04/in-5-years-the-church-in-nicaragua-has-suffered-more-than-500-attacks-90-in-2023-alone/",
  title   : "In 15 years the Church in Nicaragua has suffered more than 500 attacks, 90 in 2023 alone",
  source  : "Catholic World Report"
} );

addFeedToList( 1, {
  link    : "https://www.catholicworldreport.com/2023/05/04/in-5-years-the-church-in-nicaragua-has-suffered-more-than-500-attacks-90-in-2023-alone/",
  title   : "In 25 years the Church in Nicaragua has suffered more than 500 attacks, 90 in 2023 alone",
  source  : "Catholic World Report"
} );
*/


jQuery( "[data-behaviour~='feedly-dropdown']" ).each( function(){

  var $dropdown = jQuery( this );

  function addOptionToDropdownBtn( $dropdownBtn, optionData ){
    var $option = jQuery( document.createElement( 'option' ) );
    $option.appendTo( $dropdownBtn );
    $option.val( optionData.value );
    $option.html( optionData.text );
  }

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

      //console.log( data )

      for( i in data.items ){

        var tempFeed = {
          title   : data.items[i].title,
          link    : data.items[i].canonicalUrl,
          source  : ''
        };

        var source = [];
        if( data.items[i].origin && data.items[i].origin.title ) source.push( data.items[i].origin.title );
        if( data.items[i].author ) source.push( data.items[i].author )
        tempFeed.source = source.join( ' | ' );

        var $list_item = jQuery( document.createElement( 'li' ) );
        $list_item.addClass( 'feed' );
        $list_item.appendTo( $list );
        $list_item.attr( 'data-feedtitle', tempFeed.title );
        $list_item.attr( 'data-feedlink', tempFeed.link );
        $list_item.attr( 'data-feedsource', tempFeed.source );
        $list_item.attr( 'data-id', getIDFromTitle( tempFeed.title ) );

        var $title = jQuery( document.createElement( 'h4') );
        $title.html( "<a href='" + tempFeed.link + "' target='_blank'>" + tempFeed.title + "</a>" );
        $title.appendTo( $list_item );

        var $desc = jQuery( document.createElement( 'p') );
        $desc.html( 'Source: ' + tempFeed.source );
        $desc.appendTo( $list_item );

        var $dropdownBtn = jQuery( document.createElement( 'select' ) );
        $dropdownBtn.appendTo( $list_item );
        addOptionToDropdownBtn( $dropdownBtn, {
          value : 0,
          text  : 'Select Feed'
        } );
        for( j in window.browserData.categories ){
          addOptionToDropdownBtn( $dropdownBtn, {
            value : parseInt(j) + 1,
            text  : window.browserData.categories[ j ]
          } );
        }

        $dropdownBtn.change( function( e ){

          var cat_key = e.target.value;

          var $list_item = jQuery( e.target ).closest( 'li' );

          var tempFeed = {
            title : $list_item.attr( 'data-feedtitle' ),
            link  : $list_item.attr( 'data-feedlink' ),
            source: $list_item.attr( 'data-feedsource' ),
          };

          if( cat_key > 0 ){
            addFeedToList( cat_key, tempFeed );
          }

        } );


        //console.log( data.items[i] );
      }



    } );


  } )


} );

jQuery( document ).on("click", "#btn-custom-feed", function( ev ){

  var feed = {
    title   : jQuery( 'input[name="custom[title]"]' ).val(),
    source  : jQuery( 'input[name="custom[source]"]' ).val(),
    link    : jQuery( 'input[name="custom[link]"]' ).val()
  };

  if( feed.title && feed.source && feed.link ){
    var category  = parseInt( jQuery( '[name="custom[category]"]' ).val() ) + 1;

    addFeedToList( category, feed );

    jQuery( 'input[name="custom[title]"]' ).val( '' );
    jQuery( 'input[name="custom[source]"]' ).val( '' );
    jQuery( 'input[name="custom[link]"]' ).val( '' );


    jQuery( "#btn-custom-feed" ).closest( '#TB_window' ).find( '#TB_closeWindowButton' ).click();
  }





} );
