@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Results</h4>
        @if(count($posts) == 0)
            <h5 class="text-center pacifico grey-text">No tweets containing {{ $tag }} found</h5>
        @else
            @foreach($posts as $post)
            <div class="card margin-top-10">
                <div class="card-content">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
                            <img class="img-responsive img-circle"
                                 src="{{ asset(Config::get('constants.avatars').$post->profile_image) }}" alt="">
                        </div>
                        <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                            <ul class="list-unstyled list-inline">
                                <li><h6>{{ $post->name }}</h6></li>
                                <li>{{ '@'.$post->username }}</li>
                                <li>{{ $post->created_at->toDayDateTimeString() }}</li>
                            </ul>
                            <p>
                                @foreach($post->text as $word)
                                    @if(in_array($word, $post->tags))
                                        <a href="/tag/{{ ltrim($word, '#') }}">{!! $word !!}</a>
                                    @else
                                        {!! $word !!}
                                    @endif
                                @endforeach
                            </p>
                            @if($post->tweet_image != null)
                                <a href="{{ asset(Config::get('constants.tweet_images').$post->original_image) }}" data-lightbox="box-{{ $post->id }}">
                                    <img src="{{ asset(Config::get('constants.tweet_images').$post->tweet_image) }}" class="img-responsive hidden-xs lightboxed" alt="">
                                </a>
                            @endif
                        </div>
                        @if($post->tweet_image != null)
                            <div class="col-xs-12 visible-xs">
                                <a href="{{ asset(Config::get('constants.tweet_images').$post->original_image) }}" data-lightbox="box-{{ $post->id }}-mini">
                                    <img src="{{ asset(Config::get('constants.tweet_images').$post->tweet_image) }}" class="img-responsive lightboxed" alt="">
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                @if(!in_array($post->id, $liked))
                    <div class="card-action">
                        <h6><a class="red-text likes" id="{{ $post->id }}"><i class="material-icons">favorite_border</i> <span>{{ $post->likes }}</span></a></h6>
                    </div>
                @else
                <div class="card-action">
                    <h6><a class="red-text unlikes" id="{{ $post->id }}"><i class="material-icons">favorite</i> <span>{{ $post->likes }}</span></a></h6>
                </div>
                @endif
            </div>
            @endforeach
        @endif
    </div>
@endsection