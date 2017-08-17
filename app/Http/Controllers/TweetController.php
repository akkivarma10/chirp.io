<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use Auth;

class TweetController extends Controller
{
  public function create(Request $request)
  {
      $user = Auth::user();
      $tweet = new Tweet;
      $text = $request->tweet_text;
      $tweet->createTweet($user->id, $text);
      return redirect('/'.$user->username);
  }
}
