<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class HiddenTweet extends Model
{
  protected $fillable = [
      'id_tweet', 'author', 'is_hidden'
  ];

  protected $primaryKey = 'id_tweet';
  public $incrementing = false;


  public static function isTweetHidden($tweet_id, $author){
    // DB::enableQueryLog();
    $hiddenTweetQuery = DB::table('hidden_tweets')
    ->where([
                        ['id_tweet', '=', $tweet_id ],
                        ['author', '=', $author ],
                        ['is_hidden',  '=', 'S']
                    ])

    ->first();



    if(isset($hiddenTweetQuery)){
      return ($hiddenTweetQuery->is_hidden == 'S') ? true : false ;
    }else{
      return false;
    }


  }


  public static function unhideTweet( $tweet_id ){
    //Update state
    $hiddenTweetObj = HiddenTweet::find($tweet_id);
    if( isset( $hiddenTweetObj ) ){
      if($hiddenTweetObj->is_hidden == 'S'){
        $hiddenTweetObj->is_hidden = 'N';

        $hiddenTweetObj->update();
      }
    }

    return $hiddenTweetObj;
  }

  public static function markTweetAsHidden($currentUserLogged, $tweet_id){

    $hiddenTweetObj = HiddenTweet::find($tweet_id);
    if( isset( $hiddenTweetObj ) ){
      if($hiddenTweetObj->is_hidden != 'S'){
        $hiddenTweetObj->is_hidden = 'S';
        $hiddenTweetObj->update();
      }
    } else {
      $newHiddenTweet = new HiddenTweet(
        [
          'id_tweet' => $tweet_id,
          'is_hidden' => 'S',
          'author' => $currentUser
        ]
      );
      $newHiddenTweet->save();
      $hiddenTweetObj = $newHiddenTweet;
    }

    return $hiddenTweetObj;
  }


}
