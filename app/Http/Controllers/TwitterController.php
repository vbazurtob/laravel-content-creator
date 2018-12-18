<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\HiddenTweet;
use Twitter;
use Illuminate\Support\Facades\DB;

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
        $keysToBeDeleted = [];
        foreach($data as $key => $tweet){


          if ( $this->userIsCurrentLoggedOne($id) ){ // Generate hide/unhide links
              $data[$key]['isMyTweetAccount'] = true;

              $data[$key]['isHidden'] = HiddenTweet::isTweetHidden( $tweet['id_str'], $id );
          }else{

            if( HiddenTweet::isTweetHidden( $tweet['id_str'], $id ) == true) {
              array_push($keysToBeDeleted, $key);
            }
          }


        }

        foreach($keysToBeDeleted as $key) {
          unset($data[$key]);
        }


      } else {
        $data = [];
      }

       return response()->json($data, 201);
    }

    public function markTweetAsHidden(Request $request, $tweet_id){
      $currentUser = auth()->user()->id;
      return response()->json(['id'=> HiddenTweet::markTweetAsHidden( $currentUser, $tweet_id) ], 201);
    }

    public function unhideTweet(Request $request, $tweet_id){
      return response()->json(['id'=> HiddenTweet::unhideTweet($tweet_id)], 201);
    }

    private function userIsCurrentLoggedOne($userId){
        return $userId == auth()->user()->id;
    }
}
