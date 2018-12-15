<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entry;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-entry');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $request->validate([
        'title'=>'required',
        'content'=> 'required',
      ]);

      $newEntry = new Entry([
          'title' => $request->get('title'),
          'content' => $request->get('content'),
          'creation_date' => now(),
          'author' => auth()->user()->id()
      ]);

      $newEntry->save();
      return redirect('/create-entry')->with('success', 'A new entry has been created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      return view('edit-entry')->with('entry', Entry::find($id));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      $request->validate([
        'title'=>'required',
        'content'=> 'required',
      ]);

      $entry = Entry::find($id);
      $entry->title = $request->get('title');
      $entry->content = $request->get('content');
      $entry->save();


      return redirect('/entry/'.$entry->id)->with('success', 'Entry was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
