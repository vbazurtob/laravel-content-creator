@extends('layouts.app')

@section('content')


<div id="timeline-entries">

  <h3>{{$user->name}}</h3>



<div class="paginator">
  {{ $lastEntries->links() }}
</div>
  <div class="row">
    <div class="col-6">

      @foreach( $lastEntries as $entry)
        <div class="card">

          <div class="card-body">
            <div class="row">
              <div class="col">
                <h5 class="card-title"> {{ $entry->title }} </h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ date("F j, Y, g:i a",  strtotime( $entry->creation_date)) }}</h6>
                <p class="card-text">{{ $entry->content }}</p>
              </div>
            </div>
            @if(Auth::user()->id == $entry->author)
            <a href="/entry/{{$entry->id}}" class="card-link"><i class="fas fa-edit"></i> Edit</a>
            @endif
          </div>

        </div>
      @endforeach

    </div>
    <div class="col">
      <aside class="tweets-container">

      </aside>
    </div>
  </div>



</div>


@endsection

@section('twitterjs')
<script type="text/javascript" src="/js/twittercode.js">
</script>
  <script type="text/javascript">
    $(document).ready(function(){
      getTweets( "{{$user->id}}" );
    });
  </script>
@endsection
