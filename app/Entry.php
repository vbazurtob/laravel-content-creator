<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Entry extends Model
{

  protected $recordsPerPage = 10;
  private $entriesPerUser = 3;

  protected $fillable = [
      'title', 'content', 'author', 'creation_date'
  ];


  public function getLastThreeEntriesAll(){

    // the same amount of record per page of unique latest users entries

    $recentPosters = DB::table('entries')
    ->select('author')
    ->groupBy('author')
    ->orderBy('created_at','desc' )
    ->orderBy('author','desc' )
    ->paginate($this->recordsPerPage)
;

    $listEntries = [];

    foreach( $recentPosters as $user ){

      $entries = DB::table('users')
      ->select()
      ->join('entries', 'users.id', '=', 'entries.author')
      ->where('entries.author', $user->author)
      ->orderBy('entries.creation_date','desc' )
      ->take($this->entriesPerUser)
      // ->toSql()
      // dd($entries);
      ->get();



      $entries->each(function ( $entry) use (&$listEntries) {
        // dd($entry);
        array_push($listEntries, $entry);
      });



    }

    array_walk_recursive($listEntries, function($a) use (&$return) { $return[] = $a; });
    $listEntries = collect($return)->sortBy('creation_date');
    return $return;
  }

  public function user()
  {
        return $this->belongsTo('User'); // links this->course_id to courses.id
  }


}

// DESCRIBE
//
//               SELECT * FROM (
// (SELECT * from entries e
//
// WHERE author = 14
//
// ORDER BY e.created_at DESC  LIMIT 3)
//
// UNION
//
// (SELECT * from entries e
//
// WHERE author = 94
//
// ORDER BY e.created_at DESC    LIMIT 3   )
//
//
// )     c
//
//
// ORDER BY creation_date DESC 
