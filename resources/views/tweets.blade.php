@extends('partials.profile')

@section('data')
    <div class="col-lg-8 col-md-9 col-sm-9 col-xs-12" >
        @if(!Auth::guest())
            @if(Auth::user()->username == $user->username)
                @include('partials.tweet_form')
            @else
                @include('partials.tweetmodal')
            @endif
        @endif
        <div id="feed-tweet">

        </div>
        <div class="spinner" id="loading">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>

        <div id="notweetmessageprofile">
          <h5 class="pacifico">
              @if(!Auth::guest() and Auth::user()->username == $user->username)
                You haven't tweeted anything yet
              @else
                {{ $user->name }} hasn't tweeted anything yet
              @endif
          </h5>
        </div>

        @include('partials.backtotop')
    </div>
@endsection
