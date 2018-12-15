function getTweets(id){

  console.log('Loading...');
  $.get( "/tweets/" + id, function( data ) {
      console.log( data );
      console.log('Loaded');

      data.map(function(tw){
        getTweetDOMCard(tw, tw.isHidden);
      });


  }).fail(function(){
    console.log('Error loading tweets');
  });



}

function getTweetDOMCard(tweetObj, isHidden){

  let tweet = '<div class="card tweet">'+
  '<div class="card-body">'+
    '<div class="row">' +
      '<div class="col">' +
        '<h6 class="card-subtitle mb-2 text-muted">@' + tweetObj.user.screen_name + '</h6>' +

        '<h5 class="card-title"> ' + tweetObj.user.name + ' </h5>' +
        '<h6 class="card-subtitle mb-2 text-muted">' + parseTwitterDate( tweetObj.created_at ) + '</h6>' +
        '<p class="card-text">'+ tweetObj.text +'</p>' +
      '</div>' +
    '</div>'; // +

if( tweetObj.hasOwnProperty('isHidden')){
  if(isHidden === true){
    tweet += '<a href="#" onclick="unhide( '+ tweetObj.id +' )" class="card-link">Unhide</a>';
  }else{
    tweet += '<a href="#" onclick="hide('+ tweetObj.id +')" class="card-link">Hide</a>';
  }
}



  tweet += '</div>' +
  '</div>';

  $('.tweets-container').append(tweet);

}

function parseTwitterDate(tdate) {
    var system_date = new Date(Date.parse(tdate));
    var user_date = new Date();
    if (K.ie) {
        system_date = Date.parse(tdate.replace(/( \+)/, ' UTC$1'))
    }
    var diff = Math.floor((user_date - system_date) / 1000);
    if (diff <= 1) {return "just now";}
    if (diff < 20) {return diff + " seconds ago";}
    if (diff < 40) {return "half a minute ago";}
    if (diff < 60) {return "less than a minute ago";}
    if (diff <= 90) {return "one minute ago";}
    if (diff <= 3540) {return Math.round(diff / 60) + " minutes ago";}
    if (diff <= 5400) {return "1 hour ago";}
    if (diff <= 86400) {return Math.round(diff / 3600) + " hours ago";}
    if (diff <= 129600) {return "1 day ago";}
    if (diff < 604800) {return Math.round(diff / 86400) + " days ago";}
    if (diff <= 777600) {return "1 week ago";}
    return "on " + system_date;
}

// from http://widgets.twimg.com/j/1/widget.js
var K = function () {
    var a = navigator.userAgent;
    return {
        ie: a.match(/MSIE\s([^;]*)/)
    }
}();


function hide(id){

  // TODO
  console.log('Loading');

  $.get( "/hide-tweet/" + id, function( data ) {
      console.log( data );
      console.log('Loaded');

      //update DOM to show unhide function
      //TODO

        


  }).fail(function(){
    console.log('Error loading tweets');
  });

}

function unhide(){

  $.get( "/tweets/" + id, function( data ) {
      console.log( data );
      console.log('Loaded');

      data.map(function(tw){
        getTweetDOMCard(tw, tw.isHidden);
      });


  }).fail(function(){
    console.log('Error loading tweets');
  });

}

// var demodata = [{"created_at":"Thu Dec 13 20:00:30 +0000 2018","id":1073306689850331136,"id_str":"1073306689850331136","text":"One of the BEST gifts of being an artist is when people joyfully sing back the lyrics that you wrote. So excited to\u2026 https:\/\/t.co\/YSYazWNIul","truncated":true,"entities":{"hashtags":[],"symbols":[],"user_mentions":[],"urls":[{"url":"https:\/\/t.co\/YSYazWNIul","expanded_url":"https:\/\/twitter.com\/i\/web\/status\/1073306689850331136","display_url":"twitter.com\/i\/web\/status\/1\u2026","indices":[117,140]}]},"source":"<a href=\"http:\/\/twitter.com\/download\/iphone\" rel=\"nofollow\">Twitter for iPhone<\/a>","in_reply_to_status_id":null,"in_reply_to_status_id_str":null,"in_reply_to_user_id":null,"in_reply_to_user_id_str":null,"in_reply_to_screen_name":null,"user":{"id":21447363,"id_str":"21447363","name":"KATY PERRY","screen_name":"katyperry","location":"","description":"Love. Light.","url":"https:\/\/t.co\/UCVo8NkmAc","entities":{"url":{"urls":[{"url":"https:\/\/t.co\/UCVo8NkmAc","expanded_url":"http:\/\/www.katyperry.com\/tour","display_url":"katyperry.com\/tour","indices":[0,23]}]},"description":{"urls":[]}},"protected":false,"followers_count":106817502,"friends_count":216,"listed_count":141362,"created_at":"Fri Feb 20 23:45:56 +0000 2009","favourites_count":6126,"utc_offset":null,"time_zone":null,"geo_enabled":true,"verified":true,"statuses_count":9335,"lang":"en","contributors_enabled":false,"is_translator":false,"is_translation_enabled":true,"profile_background_color":"CECFBC","profile_background_image_url":"http:\/\/abs.twimg.com\/images\/themes\/theme10\/bg.gif","profile_background_image_url_https":"https:\/\/abs.twimg.com\/images\/themes\/theme10\/bg.gif","profile_background_tile":false,"profile_image_url":"http:\/\/pbs.twimg.com\/profile_images\/1062939426647490560\/9_8nIK5M_normal.jpg","profile_image_url_https":"https:\/\/pbs.twimg.com\/profile_images\/1062939426647490560\/9_8nIK5M_normal.jpg","profile_banner_url":"https:\/\/pbs.twimg.com\/profile_banners\/21447363\/1542313977","profile_link_color":"D55732","profile_sidebar_border_color":"FFFFFF","profile_sidebar_fill_color":"78C0A8","profile_text_color":"5E412F","profile_use_background_image":true,"has_extended_profile":true,"default_profile":false,"default_profile_image":false,"following":false,"follow_request_sent":false,"notifications":false,"translator_type":"regular"},"geo":null,"coordinates":null,"place":null,"contributors":null,"is_quote_status":false,"retweet_count":1416,"favorite_count":7728,"favorited":false,"retweeted":false,"possibly_sensitive":false,"lang":"en"}];
