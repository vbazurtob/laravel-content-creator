<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use Illuminate\Pagination\LengthAwarePaginator;

class Entry extends Model
{

  protected $recordsPerPage = 5;
  private $entriesPerUser = 3;

  protected $fillable = [
      'title', 'content', 'author', 'creation_date'
  ];


  public function getLastThreeEntriesAll(){


    $subquery = DB::table('users as u')
    ->selectRaw(
       ' ( @num:=if ( @author = e.author, @num +1, if( @author := e.author, 1, 1 ))) row_number,
        COUNT(e.id) as cnt,
              e.id as id,
              u.id as user_id,
              e.title,
              e.content,
              e.creation_date,
              e.author '
      )
    ->crossJoin('entries as  e')
    ->whereRaw(' u.id = e.author ')
    ->groupBy('e.id')
    ->orderBy('e.creation_date','DESC')
    // ->toSql()
    ;

    $queryPaginated = DB::table(
      DB::raw(

      ' ( '.
         $subquery->toSql()

      .') as x'

      )
    )
    ->selectRaw(
    '
      user_id,
      row_number,
      id as entry_id,
      title ,
      content ,
      author   ,
      creation_date
    '
      )
    ->where('row_number', '<=', $this->entriesPerUser)
    ->paginate($this->recordsPerPage);


    return $queryPaginated;

  }

  public function user()
  {
        return $this->belongsTo('User'); // links this->course_id to courses.id
  }


}


//Query for obtaining the last 3 entries for every user

// SELECT * FROM
// (SELECT
//
// (@num:=if(@author = author, @num +1, if(@author := `author`, 1, 1))) row_number     ,
//
// u.id as user_id, e.* from users u CROSS JOIN
//
//
// (
// SELECT
// *
// FROM entries
//
// )                  e
//
//
// WHERE u.id = author
//
//
// GROUP BY id
//
// ORDER BY e.creation_date DESC
//
//  ) x
//  WHERE row_number <=3
