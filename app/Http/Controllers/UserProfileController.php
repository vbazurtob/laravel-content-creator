<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entry;
use App\User;
use Illuminate\Support\Facades\DB;


class UserProfileController extends Controller
{

    private $maxRecordsPerPage = 10;


    public function __construct(){
              $this->middleware('auth');
    }

    public function show(Request $request, $id){
      // dd($request);
      $lastEntries = DB::table('entries')->select()
      ->orderBy('created_at', 'desc')
      ->where('author', $id)
      ->paginate($this->maxRecordsPerPage);


      return view('user-profile')
      ->with('lastEntries', $lastEntries)
      ->with('user', User::find($id));



    }
}
