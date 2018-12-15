<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HiddenTweet extends Model
{
  protected $fillable = [
      'id_tweet', 'author', 'is_hidden'
  ];

  protected $primaryKey = 'id_tweet';
  public $incrementing = false;

}
