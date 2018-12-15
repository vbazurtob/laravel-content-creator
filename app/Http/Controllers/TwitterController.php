<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\HiddenTweet;
use Twitter;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Auth;

class TwitterController extends Controller
{



  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }

    public function getUserRecentTweets(Request $request, $id){

      $user = User::find($id);

      $data = Twitter::getUserTimeline(['screen_name' => $user->twitter,'count' => 5, 'format' => 'array']);
      if(isset($data)){
        foreach($data as $key => $tweet){

          if ( $this->userIsCurrentLoggedOne($id) ){ // Generate hide/unhide links

// \Log::info('tweet id '.$tweet['id'] . ',' . $user->id );

              if ( $this->isTweetHidden( $tweet['id'], $user->id  ) ){
                  $data[$key]['isHidden'] = $hiddenTweetQuery->is_hidden;
              }else {
                $data[$key]['isHidden'] = false;
              }
          }


        }
      } else {
        $data = [];
      }

       return response()->json($data, 201);
    }

    public function markTweetAsHidden(Request $request, $tweet_id){
      $currentUser = auth()->user()->id;



      $hiddenTweetObj = HiddenTweet::find($tweet_id);
      if( isset( $hiddenTweetObj ) ){
        if($hiddenTweetObj->is_hidden != 'S'){
          $hiddenTweetObj->is_hidden = 'S';
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

      return response()->json(['id'=> $hiddenTweetObj], 201);
    }

    private function isTweetHidden($tweet_id, $author){

      $hiddenTweetQuery = DB::table('hidden_tweets')
      ->select()
      ->where('id_tweet', $tweet_id)
      ->where('author', $author)
      ->where('is_hidden', 'S')
      ->first();

      if(isset($hiddenTweetQuery)){
        return ($hiddenTweetQuery->is_hidden == 'S') ? true : false ;
      }else{
        return false;
      }


    }

    private function userIsCurrentLoggedOne($userId){
        return $userId == auth()->user()->id;
    }
}
