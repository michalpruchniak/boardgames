<?php
use Carbon\Carbon;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'notifications'], function(){
  Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'home'
  ]);

  Auth::routes();

  Route::get('/', 'HomeController@index')->name('home');
  Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function(){
    Route::get('/edytuj/{id}', [
      'uses' => 'GameController@edit',
      'as' => 'game.edit'
    ]);
    Route::get('/lista-gier', [
      'uses' => 'GameController@gameList',
      'as' => 'game.list'
    ]);
    Route::post('/update/{id}', [
      'uses' => 'GameController@update',
      'as' => 'game.update'
    ]);
  });
  Route::group(['prefix' => 'moderator', 'middleware' => ['moderator']], function(){
    Route::get('sitemap', function(){
  SitemapGenerator::create('http://www.sex-wishes.com/')->writeToFile('sitemap.xml');
          return 'sitemap created';
    });
    Route::group(['prefix' => 'game'], function(){
      Route::get('/create', [
        'uses' => 'GameController@create',
        'as' => 'game.create'
      ]);
      Route::post('/store', [
        'uses' => 'GameController@store',
        'as' => 'game.store'
      ]);
    });
    Route::group(['prefix' => 'category'], function(){
      Route::get('/create', [
        'uses' => 'CategoryController@create',
        'as' => 'category.create'
      ]);
      Route::post('/store', [
        'uses' => 'CategoryController@store',
        'as' => 'category.store'
      ]);
    });


    Route::group(['prefix' => 'artist'], function(){
      Route::get('/create', [
        'uses' => 'ArtistController@create',
        'as' => 'artist.create'
      ]);
      Route::post('/store', [
        'uses' => 'ArtistController@store',
        'as' => 'artist.store'
      ]);
    });
    Route::group(['prefix' => 'publisher'], function(){
      Route::get('/create', [
        'uses' => 'PublisherController@create',
        'as' => 'publisher.create'
      ]);
      Route::post('/store', [
        'uses' => 'PublisherController@store',
        'as' => 'publisher.store'
      ]);
    });

    Route::group(['prefix' => 'designer'], function(){
      Route::get('/create', [
        'uses' => 'DesignerController@create',
        'as' => 'designer.create'
      ]);
      Route::post('/store', [
        'uses' => 'DesignerController@store',
        'as' => 'designer.store'
      ]);
    });

    Route::get('/create/moderator/{id}', [
      'uses' => 'UsersController@makeModerator',
      'as' => 'moderator.users.makemoderator'
    ]);
    Route::get('/create/blogger/{id}', [
      'uses' => 'UsersController@makeBlogger',
      'as' => 'moderator.users.makeblogger'
    ]);
  });

  //panel
  Route::group(['prefix' => 'panel', 'middleware' => ['authuser', 'notifications']], function(){

    Route::get('/powiadomienie/komentarz/{id}/{commentid}', [
      'uses' => 'notificationsController@goToComment',
      'as' => 'notification.comment'
    ]);
    Route::get('/zmien-haslo', [
      'uses' => 'ProfileController@ChangePasswword',
      'as' => 'panel.changepassword'
    ]);

    Route::post('/zmien-haslo/zapisz', [
      'uses' => 'ProfileController@UpdatePasswword',
      'as' => 'panel.updatepassword'
    ]);
    Route::get('/preferencje', [
      'uses' => 'ProfileController@Preferences',
      'as' => 'panel.preferences'
    ]);
    Route::post('/preferencje/avatar/zapisz', [
      'uses' => 'ProfileController@AvatarStore',
      'as' => 'panel.preferences.avatar.store'
    ]);
    Route::get('/preferencje/avatar/usun', [
      'uses' => 'ProfileController@DelAvatar',
      'as' => 'panel.preferences.avatar.del'
    ]);
    Route::post('/preferencje/plec/wybierz', [
      'uses' => 'ProfileController@checkGender',
      'as' => 'panel.preferences.gender.check'
    ]);
    Route::post('/preferencje/data-urodzenia/wybierz', [
      'uses' => 'ProfileController@checkDOB',
      'as' => 'panel.preferences.dob.check'
    ]);
    Route::post('/preferencje/opis/zmien', [
      'uses' => 'ProfileController@addDescription',
      'as' => 'panel.preferences.description.change'
    ]);

    Route::post('/preferencje/lista/zmien', [
      'uses' => 'ProfileController@ChangeListLayout',
      'as' => 'panel.preferences.layout.list.update'
    ]);
  });

  // inne
  Route::group(['prefix' => 'dodaj', 'middleware' => 'authuser'], function(){
    Route::post('/komentarz/{id}', [
      'uses' => 'FrontendController@CommentStore',
      'as' => 'frontend.comment.store'
    ]);
    Route::post('/odpowiedz/{id}', [
      'uses' => 'FrontendController@ResponseStore',
      'as' => 'frontend.response.store'
    ]);
    Route::get('/mam/{id}', [
      'uses' => 'GamelistController@ihave',
      'as' => 'gamelist.ihave'
    ]);

    Route::get('/gralem/{id}', [
      'uses' => 'GamelistController@iplayed',
      'as' => 'gamelist.iplayed'
    ]);

    Route::get('/chce-kupic/{id}', [
      'uses' => 'GamelistController@iwtb',
      'as' => 'gamelist.iwtb'
    ]);

    Route::get('/ulubione/{id}', [
      'uses' => 'GamelistController@favorite',
      'as' => 'gamelist.favorite'
    ]);

    Route::get('/glos/{game}/{vote}', [
      'uses' => 'VoteController@saveVote',
      'as' => 'vote.save'
    ]);
    Route::get('/glos/aktualizacja/{game}/{vote}', [
      'uses' => 'VoteController@updateVote',
      'as' => 'vote.update'
    ]);

    Route::group(['prefix' => 'bloger', 'middleware' => 'bloger'], function(){
      Route::get('dodaj-recenzje/{id}', [
        'uses' => 'BloggerController@createReview',
        'as' => 'blogger.review.create'
      ]);
      Route::post('dodaj-recenzje/zapisz/{id}', [
        'uses' => 'BloggerController@storeReview',
        'as' => 'blogger.review.store'
      ]);
    });
    Route::group(['prefix' => 'bloger', 'middleware' => ['bloger', 'publisher']], function(){
    Route::get('dodaj-wpis', [
      'uses' => 'BloggerController@create',
      'as' => 'blogger.post.create'
    ]);
    Route::post('dodaj-wpis/zapisz', [
      'uses' => 'BloggerController@store',
      'as' => 'blogger.post.store'
    ]);
  });

  });
  //Moderator
  Route::group(['prefix' => 'moderator', 'middleware' => 'moderator'], function(){
    Route::get('posty-blogerow', [
      'uses' => 'BloggerController@allPosts',
      'as' => 'blogger.allposts'
    ]);
    Route::get('activated/{id}', [
      'uses' => 'BloggerController@activated',
      'as' => 'blogger.activated'
    ]);
    Route::get('usun-komentarz/{id}', [
      'uses' => 'GameController@delComment',
      'as' => 'moderator.delcomment'
    ]);
    Route::group(['prefix' => 'users'], function(){
      Route::get('/', [
        'uses' => 'UsersController@index',
        'as' => 'moderator.users.index'
      ]);
      Route::get('/zbanuj/{id}', [
        'uses' => 'UsersController@banned',
        'as' => 'moderator.users.banned'
      ]);
    });
  });
  // Frontend
  Route::get('/gra/{slug}', [
    'uses' => 'FrontendController@singleGame',
    'as' => 'frontend.singlegame'
  ]);
  Route::get('/wszystkie-posty', [
    'uses' => 'FrontendController@allPosts',
    'as' => 'frontend.allposts'
  ]);
  Route::get('/post/{id}', [
    'uses' => 'FrontendController@singlePost',
    'as' => 'frontend.singlepost'
  ]);
  Route::get('/gra/opis/{slug}', [
    'uses' => 'FrontendController@singleGameFullDesc',
    'as' => 'frontend.singlegameDesc'
  ]);
  Route::get('/gra/{slug}/statystyki', [
    'uses' => 'FrontendController@singleGameStats',
    'as' => 'frontend.singlegameStats'
  ]);
  Route::get('/komentarz/{id}', [
    'uses' => 'FrontendController@Comment',
    'as' => 'frontend.comment'
  ]);
  Route::get('/wszystkie-gry', [
    'uses' => 'FrontendController@allGames',
    'as' => 'frontend.allgames'
  ]);
  Route::get('/najlepsze-gry', [
    'uses' => 'FrontendController@topGames',
    'as' => 'frontend.topgames'
  ]);
  Route::get('/wydawca/{slug}', [
    'uses' => 'FrontendController@allGamesPublisher',
    'as' => 'frontend.publisher'
  ]);
  Route::get('/kategoria/{slug}', [
    'uses' => 'FrontendController@allGamesCategory',
    'as' => 'frontend.category'
  ]);
  Route::get('/projektant/{slug}', [
    'uses' => 'FrontendController@allGamesDesigner',
    'as' => 'frontend.designer'
  ]);
  Route::get('/grafik/{slug}', [
    'uses' => 'FrontendController@allGamesArtist',
    'as' => 'frontend.artist'
  ]);
  Route::get('/moja-lista/{slug}', [
    'uses' => 'FrontendController@myList',
    'as' => 'frontend.mylist'
  ]);
  Route::get('/o-mnie/{slug}', [
    'uses' => 'FrontendController@myDescription',
    'as' => 'frontend.mydescription'
  ]);
  Route::get('/artykul/{slug}', [
    'uses' => 'FrontendController@defaultArticles',
    'as' => 'frontend.defaultarticles'
  ]);

  Route::group(['prefix' => 'ajax'], function(){
    Route::post('/gry', [
      'uses' => 'AjaxController@callGames',
      'as' => 'ajax.callgames'
    ]);
    Route::post('/wydawcy', [
      'uses' => 'AjaxController@callPublishers',
      'as' => 'ajax.callpublishers'
    ]);
    Route::post('/projektanci', [
      'uses' => 'AjaxController@callDesigners',
      'as' => 'ajax.calldesigners'
    ]);
    Route::post('/graficy', [
      'uses' => 'AjaxController@callArtists',
      'as' => 'ajax.callartists'
    ]);
  });

});
