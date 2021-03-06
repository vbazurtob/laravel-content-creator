@extends('layouts.app')

@section('content')


<div id="timeline-entries">
  @foreach( $lastEntries as $entry)
    <div class="card">

      <div class="card-body">
        <div class="row">
          <div class="col-3">
            <a href="/user/{{$entry->author}}" class="card-link">Created by: {{ App\User::find( $entry->author )->name }}</a>
          </div>
          <div class="col">
            <h5 class="card-title"> {{ $entry->title }} </h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ date("F j, Y, g:i a",  strtotime( $entry->creation_date)) }}</h6>
            <p class="card-text">{{ $entry->content }}</p>
          </div>
        </div>

        @auth
          @if(Auth::user()->id == $entry->author)
            <a href="/entry/{{$entry->entry_id}}" class="card-link"><i class="fas fa-sign-out-alt"></i> Edit</a>
          @endif
        @endauth
      </div>

    </div>



  @endforeach
</div>
<div id="paginator-links-container" class="row">
  <span class="col">&nbsp;</span>
  <span class="col-8 flex-row-center" >{{ $lastEntries->links() }}</span>
  <span class="col">&nbsp;</span>

</div>

@endsection
