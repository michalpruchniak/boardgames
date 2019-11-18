<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Cookie;
use App\User;
use App\Vote;
use App\Game;
use App\Publisher;
use App\Gamelist;
use App\Category;
use App\Designer;
use App\Artist;
use App\Comment;
use App\Blogger;
use App\StatsGame;
use App\defaultArticles;
use App\Notifications;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function myDescription($slug)
     {
       $user = User::where('slug', $slug)->first();
       if(!$user){
         return view('frontend.messages.error')->with('error', 'Ten użytkownik nie istnieje');
         exit;
       }
        return view('frontend.profile.description')->with('user', $user)
                                                   ->with('activelink', 'description');

     }

    public function myList($slug)
    {
      $user = User::where('slug', $slug)->first();
      if(!$user){
        return view('frontend.messages.error')->with('error', 'Ten użytkownik nie istnieje');
        exit;
      }
      $IHave = User::where('slug', $slug)->first()->Gamelist->where('list', 1);
      $IPlayed = User::where('slug', $slug)->first()->Gamelist->where('list', 2);
      $WTB = User::where('slug', $slug)->first()->Gamelist->where('list', 3);
      $Favorite = User::where('slug', $slug)->first()->Gamelist->where('list', 4);
      $user = User::where('slug', $slug)->first();
      if(Auth::user()){
        $currentuserid = Auth::user()->id;

      } else {
        $currentuserid = 0;

      }
      if((!Auth::user() && $user->layoutvisible == 0)){
        return view('frontend.profile.error')->with('user', $user)
                                            ->with('error', 'Użytkownik wyłączył możliwość przeglądania swojej listy gier.');
        exit;

      }
      if($currentuserid != $user->id && $user->layoutvisible == 0){
        return view('frontend.profile.error')->with('user', $user)
                                            ->with('error', 'Użytkownik wyłączył możliwość przeglądania swojej listy gier.');

      }

      switch($user->mylist){
        case 1:
                $layout = 'frontend.profile.gamelist.accordeon';
                break;
        default:
                $layout = 'frontend.profile.gamelist.accordeon';
                break;
      }
      return view($layout)->with('user', $user)
                                                ->with('activelink', 'mylist')
                                                ->with('ihave', $IHave)
                                                ->with('iplayed', $IPlayed)
                                                ->with('wtb', $WTB)
                                                ->with('favorite', $Favorite)
                                                ->with('maintitle', $user->name)
                                                ->with('mainkeywords', 'lista gier, moje gry', $user->name)
                                                ->with('maindescription', 'Lista gier planszowych użytkownika ' . $user->name . '. Ulubioe gry planszowe, karciane.');
    }
    public function allGames(){
      $games = Game::orderBy('id', 'desc')->paginate(30);
      return view('frontend.game.gamelist')->with('elements', $games)
                                           ->with('listTitle', 'Wszystkie gry')
                                           ->with('maintitle', 'Wszystkie gry planszowe')
                                           ->with('maindescription', 'Lista wszystkich gier planszowych. Gry karciane i planszówki.');
    }
    public function allGamesArtist($slug){
      $artist = Artist::where('slug', $slug)->first();
      if(!$artist){
        return view('frontend.messages.error')->with('error', 'Ten grafik nie istnieje');
      }
      $artist = Artist::find($artist->id);
      $title = 'Grafik: ' . $artist->name;
      return view('frontend.game.gamelist')->with('elements', $artist->games()->paginate(30))
                                           ->with('listTitle', $title)
                                           ->with('maintitle', $artist->name. ' - wszystkie gry planszowe, artysta, grafik')
                                           ->with('mainkeywords', $artist->name . ', arysta, grafik')
                                           ->with('maindescription', 'Lista gier planszowych. Gry karciane i planszówki, grafik ' . $artist->name);
    }
    public function allGamesPublisher($slug){
      $publisher = Publisher::where('slug', $slug)->first();
      if(!$publisher){
        return view('frontend.messages.error')->with('error', 'To wydawnictwo nie istnieje');
      }
      $games = Game::where('publisher_id', $publisher->id)->paginate(30);
      $title = 'Wydawca: ' . $publisher->name;
      return view('frontend.game.gamelist')->with('elements', $games)
                                           ->with('listTitle', $title)
                                           ->with('maintitle', $publisher->name. ' - wszystkie gry planszowe, wydawca')
                                           ->with('mainkeywords', $publisher->name . ', wydawca')
                                           ->with('maindescription', 'Lista gier planszowych. Gry karciane i planszówki, grafik ' . $publisher->name);
    }

    public function allGamesDesigner($slug){
      $designer = Designer::where('slug', $slug)->first();
      if(!$designer){
        return view('frontend.messages.error')->with('error', 'Ten projektant nie istnieje');
      }
      $games = Designer::find($designer->id);
      $title = 'Projektant: ' . $designer->name;

      return view('frontend.game.gamelist')->with('elements', $designer->games()->paginate(30))
                                           ->with('listTitle', $title)
                                           ->with('maintitle', $designer->name. ' - wszystkie gry planszowe, projektant')
                                           ->with('mainkeywords', $designer->name . ', projektant')
                                           ->with('maindescription', 'Lista gier planszowych. Gry karciane i planszówki, projektant ' . $designer->name);
    }
    public function allGamesCategory($slug){
      $category = Category::where('slug', $slug)->first();
      if(!$category){
        return view('frontend.messages.error')->with('error', 'Ta kategoria nie istnieje');
      }
      if(Category::where('slug', $slug)->count() < 1){
        return view('frontend.messages.error')->with('error', 'Ta kategoria nie istnieje');

      }
      $games = Category::find($category->id);
      $title = 'Kategoria: ' . $category->name;

      return view('frontend.game.gamelist')->with('elements', $category->games()->paginate(30))
                                           ->with('listTitle', $title)
                                           ->with('maintitle', $category->name. ' - wszystkie gry planszowe, katgoria')
                                           ->with('mainkeywords', $category->name . ', kategoria')
                                           ->with('maindescription', 'Lista gier planszowych. Gry karciane i planszówki, kategoria ' . $category->name);
    }
    public function singleGame($slug)
    {
        $game = Game::where('slug', $slug)->first();
        if(!$game){
          return view('frontend.messages.error')->with('error', 'Ta gra nie istnieje');
        }
        if($game->game_id ){
          $addon = Game::find($game->game_id);
        } else {
          $addon = null;
        }
        // $addon = Game::where('id', 1)->first();

        $value = rand(100, 9999999999);
        if(!Cookie::get('5556526')){
                    Cookie::queue(Cookie::make('5556526', $value, 1440));
                    StatsGame::create([
                        'game_id' => $game->id,
                        'token' => $value
                    ]);

                }
        if(Cookie::get('5556526')){
            $stats = StatsGame::where('game_id', $game->id)->where('token', Cookie::get('5556526'))->count();
            if($stats < 1){
                StatsGame::create([
                    'game_id' => $game->id,
                    'token' => Cookie::get('5556526')
                ]);
            }
        }
        $avgVote = Vote::where('game_id', $game->id)->avg('vote');
        $voteCount = Vote::where('game_id', $game->id)->count();
        $comments = Comment::where('game_id', $game->id)->where('comment_id', null)->get();

        if(!isset(Auth::user()->id)){
          return view('frontend.game.single')->with('game', $game)
                                             ->with('avgVote', $avgVote)
                                             ->with('comments', $comments)
                                             ->with('voteCount', $voteCount);
        }
        $user = Auth::user()->id;
        $gamelistIhave = Gamelist::where('user_id', $user)->where('game_id', $game->id)->where('list', 1)->count();
        $gamelistIplayed = Gamelist::where('user_id', $user)->where('game_id', $game->id)->where('list', 2)->count();
        $gamelistIwtb = Gamelist::where('user_id', $user)->where('game_id', $game->id)->where('list', 3)->count();
        $gamelistFavorite = Gamelist::where('user_id', $user)->where('game_id', $game->id)->where('list', 4)->count();



        $voted = Vote::where('user_id', Auth::user()->id)->where('game_id', $game->id);

        if($voted->count() == 0){
          $yourVote = 0;
        } else {
          $yourVote = $voted->first()->vote;
        }
        $user = Auth::user()->id;
        $posts = Blogger::where('game_id', $game->id)->where('active', 1)->get();
        $tags = '';

        return view('frontend.game.single')->with('game', $game)
                                           ->with('addon', $addon)
                                           ->with('avgVote', $avgVote)
                                           ->with('ihave', $gamelistIhave)
                                           ->with('iplayed', $gamelistIplayed)
                                           ->with('iwtb', $gamelistIwtb)
                                           ->with('favorite', $gamelistFavorite)
                                           ->with('voted', $voted->count())
                                           ->with('yourVote', $yourVote)
                                           ->with('voteCount', $voteCount)
                                           ->with('review', $posts)
                                           ->with('comments', $comments)
                                           ->with('maintitle', $game->title. ' - oceń grę, planszówki, karcianki')
                                           ->with('mainkeywords', $game->title )
                                           ->with('maindescription', $game->title . ', ' . $game->publisher );
    }
    public function allPosts(){
      $posts = Blogger::where('active', 1)->orderBy('created_at', 'desc')->paginate(30);
      return view('frontend.blog.all')->with('posts', $posts)
                                      ->with('maintitle','Wszystkie wpisy, gry planszowe, gry karciane')
                                      ->with('mainkeywords', 'artykuły')
                                      ->with('maindescription', 'Wszystkie wpisy, artykuły, gry planszowe, gry bez prądu.');
    }

    public function singlePost($id)
    {
        $post = Blogger::where('id', $id)->where('active', 1)->first();

        if(!$post){
          return view('frontend.messages.error')->with('error', 'Ten post nie istnieje');
          exit;
        }

        $latest = Blogger::orderBy('created_at', 'desc')->where('active', 1)->limit(4)->get();
        return view('frontend.blog.single')->with('post', $post)
                                           ->with('latest', $latest)
                                           ->with('maintitle',$post->title . ' - artykuł, gry planszowe, gry karciane')
                                           ->with('mainkeywords', $post->title, ', artykuły')
                                           ->with('maindescription', substr($post->description, 15) .'...');
    }

    public function Comment($id){
      $comment = Comment::where('id', $id)->where('comment_id', null)->first();
      if(!$comment){
        return view('frontend.messages.error')->with('error', 'Taki komentarz nie istnieje');
      }
      $response = Comment::where('comment_id', $id)->get();
      $game = $comment->Game;
      $avgVote = Vote::where('game_id', $game->id)->avg('vote');
      $voteCount = Vote::where('game_id', $game->id)->count();

      if(!isset(Auth::user()->id)){
        return view('frontend.game.comment')->with('game', $game)
                                            ->with('comment', $comment)
                                            ->with('response', $response)
                                            ->with('avgVote', $avgVote)
                                            ->with('voteCount', $voteCount);
      }
      $user = Auth::user()->id;
      $gamelistIhave = Gamelist::where('user_id', $user)->where('game_id', $game->id)->where('list', 1)->count();
      $gamelistIplayed = Gamelist::where('user_id', $user)->where('game_id', $game->id)->where('list', 2)->count();
      $gamelistIwtb = Gamelist::where('user_id', $user)->where('game_id', $game->id)->where('list', 3)->count();
      $gamelistFavorite = Gamelist::where('user_id', $user)->where('game_id', $game->id)->where('list', 4)->count();



      $voted = Vote::where('user_id', Auth::user()->id)->where('game_id', $game->id);

      if($voted->count() == 0){
        $yourVote = 0;
      } else {
        $yourVote = $voted->first()->vote;
      }
      $user = Auth::user()->id;
      return view('frontend.game.comment')->with('game', $game)
                                         ->with('comment', $comment)
                                         ->with('response', $response)
                                         ->with('avgVote', $avgVote)
                                         ->with('ihave', $gamelistIhave)
                                         ->with('iplayed', $gamelistIplayed)
                                         ->with('iwtb', $gamelistIwtb)
                                         ->with('favorite', $gamelistFavorite)
                                         ->with('voted', $voted->count())
                                         ->with('yourVote', $yourVote)
                                         ->with('voteCount', $voteCount)
                                         ->with('maintitle', 'komentarz #'. $comment->id . ' - gy planszowe, gry karciane')
                                         ->with('mainkeywords', '')
                                         ->with('maindescription', substr($comment->description, 15) .'...');;


      // return view('frontend.game.comment')->with('comment', $comment)
      //                                     ->with('game', $comment->Game);
    }

    public function singleGameFullDesc($slug){
      $game = Game::where('slug', $slug)->first();


      if(!$game){
        return view('frontend.messages.error')->with('error', 'Ta gra nie istnieje');
      }


      $avgVote = Vote::where('game_id', $game->id)->avg('vote');
      $voteCount = Vote::where('game_id', $game->id)->count();

      if(!isset(Auth::user()->id)){
        return view('frontend.game.singleDesc')->with('game', $game)
                                           ->with('avgVote', $avgVote)
                                           ->with('voteCount', $voteCount);
      }
      $user = Auth::user()->id;
      $gamelistIhave = Gamelist::where('user_id', $user)->where('game_id', $game->id)->where('list', 1)->count();
      $gamelistIplayed = Gamelist::where('user_id', $user)->where('game_id', $game->id)->where('list', 2)->count();
      $gamelistIwtb = Gamelist::where('user_id', $user)->where('game_id', $game->id)->where('list', 3)->count();
      $gamelistFavorite = Gamelist::where('user_id', $user)->where('game_id', $game->id)->where('list', 4)->count();



      $voted = Vote::where('user_id', Auth::user()->id)->where('game_id', $game->id);

      if($voted->count() == 0){
        $yourVote = 0;
      } else {
        $yourVote = $voted->first()->vote;
      }
      $user = Auth::user()->id;
      return view('frontend.game.singleDesc')->with('game', $game)
                                         ->with('avgVote', $avgVote)
                                         ->with('ihave', $gamelistIhave)
                                         ->with('iplayed', $gamelistIplayed)
                                         ->with('iwtb', $gamelistIwtb)
                                         ->with('favorite', $gamelistFavorite)
                                         ->with('voted', $voted->count())
                                         ->with('yourVote', $yourVote)
                                         ->with('voteCount', $voteCount)
                                         ->with('maintitle',$game->title . ' - gry planszowe, gry karciane')
                                         ->with('mainkeywords', $game->title . ', artykuły')
                                         ->with('maindescription', substr($game->description, 15) .'...');;
    }
    public function singleGameStats($slug){
      $game = Game::where('slug', $slug)->first();


      if(!$game){
        return view('frontend.messages.error')->with('error', 'Ta gra nie istnieje');
      }


      $avgVote = Vote::where('game_id', $game->id)->avg('vote');
      $voteCount = Vote::where('game_id', $game->id)->count();
      $expertVote = Vote::where('game_id', $game->id)->where('expert', 1)->avg('vote');
      $expertVoteCount = Vote::where('game_id', $game->id)->where('expert', 1)->count();
      $visitors = StatsGame::where('game_id', $game->id)->count();
      $visitorsTwoWeek = StatsGame::where('game_id', $game->id)
                                  ->where('created_at', '>', now()->subWeeks(2))->count();

      if(!isset(Auth::user()->id)){
        return view('frontend.game.stats')->with('game', $game)
                                           ->with('visitors', $visitors)
                                           ->with('visitorsTwoWeek', $visitorsTwoWeek)
                                           ->with('avgVote', $avgVote)
                                           ->with('expertVote', $expertVote)
                                           ->with('voteCount', $voteCount)
                                           ->with('expertVoteCount', $expertVoteCount);
      }
      $user = Auth::user()->id;
      $gamelistIhave = Gamelist::where('user_id', $user)->where('game_id', $game->id)->where('list', 1)->count();
      $gamelistIplayed = Gamelist::where('user_id', $user)->where('game_id', $game->id)->where('list', 2)->count();
      $gamelistIwtb = Gamelist::where('user_id', $user)->where('game_id', $game->id)->where('list', 3)->count();
      $gamelistFavorite = Gamelist::where('user_id', $user)->where('game_id', $game->id)->where('list', 4)->count();



      $voted = Vote::where('user_id', Auth::user()->id)->where('game_id', $game->id);

      if($voted->count() == 0){
        $yourVote = 0;
      } else {
        $yourVote = $voted->first()->vote;
      }
      $user = Auth::user()->id;
      return view('frontend.game.stats')->with('game', $game)
                                         ->with('avgVote', $avgVote)
                                         ->with('expertVote', $expertVote)
                                         ->with('ihave', $gamelistIhave)
                                         ->with('iplayed', $gamelistIplayed)
                                         ->with('iwtb', $gamelistIwtb)
                                         ->with('favorite', $gamelistFavorite)
                                         ->with('voted', $voted->count())
                                         ->with('visitors', $visitors)
                                         ->with('visitorsTwoWeek', $visitorsTwoWeek)
                                         ->with('yourVote', $yourVote)
                                         ->with('voteCount', $voteCount)
                                         ->with('expertVoteCount', $expertVoteCount)
                                         ->with('maintitle',$game->title . ' - gry planszowe, gry karciane')
                                         ->with('mainkeywords', $game->title . ', artykuły')
                                         ->with('maindescription', substr($game->description, 15) .'...');
    }
    public function commentStore(Request $request, $id)
    {
        $game = Game::find($id);
        if(!$game){
          Session::flash('error', 'Ta gra nie istnieje');
          return redirect()->back();
        }
        if(!Auth::user()){
          Session::flash('error', 'Zaloguj się, żeby dodać komentarz');
          return redirect()->back();
        }
        $request->validate([
          'comment' => 'required|between:5,600'
        ]);
        Comment::create([
          'comment' => $request->comment,
          'user_id' => Auth::user()->id,
          'game_id' => $id
        ]);
        Session::flash('success', 'Komentarz został dodany');
        return redirect()->back();
    }
    public function responseStore(Request $request, $id)
    {
        $comment = Comment::find($id);
        if(!$comment){
          Session::flash('error', 'Ten komentarz nie istnieje');
          return redirect()->back();
        }
        if(!Auth::user()){
          Session::flash('error', 'Zaloguj się, żeby dodać komentarz');
          return redirect()->back();
        }
        $request->validate([
          'comment' => 'required|between:5,600'
        ]);
        Comment::create([
          'comment' => $request->comment,
          'comment_id' => $id,
          'user_id' => Auth::user()->id,
          'game_id' => $id
        ]);
        //powiadomienie

        // if(Auth::user()->id != $comment->user_id){
        //   Notifications::create([
        //     'user_id' => $comment->user_id,
        //     'type' => 1,
        //     'comment_id' => $comment->id,
        //     'content' => 'Ktoś odpowiedział na Twój komentarz!'
        //   ]);
        // }

        Session::flash('success', 'Komentarz został dodany');
        return redirect()->back();
    }

    public function topGames(){
      $gamesRanking = Game::withCount(['Visitors' => function($q) {
      $q->where('created_at', '>', now()->subWeeks(2));
    }])->orderBy('Visitors_count', 'desc')->limit(15)->get();

    return view('frontend.gameranking.index')->with('elements', $gamesRanking)
                                             ->with('maintitle', 'Najpopularniejsze gry')
                                             ->with('mainkeywords', 'najpopularniejsze gry')
                                             ->with('maindescription', 'Toplista gier planszowych, najpopuarniejsz gry.');
    }



    public function defaultArticles($slug){
      $description = defaultArticles::where('slug', $slug)->first();

      if(!$description){
        return view('frontend.messages.error')->with('error', 'Ten artykuł nie istnieje');
        exit;
      }
    return view('frontend.defaultarticles.index')->with('description', $description);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
