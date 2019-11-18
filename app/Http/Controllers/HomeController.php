<?php

namespace App\Http\Controllers;
use Spatie\Sitemap\SitemapGenerator;

use App\Game;
use App\Blogger;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::orderBy('created_at', 'desc')->limit(10)->get();
        $posts = Blogger::where('active', 1)->orderBy('created_at', 'desc')->limit(5)->get();
        return view('welcome')->with('games', $games)
                              ->with('posts', $posts);
    }
}
