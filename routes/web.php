<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Models\User;
use Laravel\Fortify\RoutePath;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'language'])->group(function () {

    Route::get('/', function () {
        return redirect()->route('user_profile', ['username' => auth()->user()->username]);
    });


    Route::get('/Home', function () {
        $profile = auth()->user();
        $iFollow = $profile->iFollow()->take(3);
        $toFollow = $profile->otherUsers()->take(3);
        return view('home', [
            'posts' => auth()->user()->home(),
            'profile' => $profile,
            'iFollow' => $iFollow,
            'toFollow' => $toFollow
        ]);
    })->name('home');
    Route::get('users/profile', function () {
        return view('profile.show');
    })->name('profile');


    route::get('/explore', function () {
        $user = auth()->user();
        return view('explore', ['profile' => $user, 'posts' => $user->explore()]);
    })->name('explore');
    route::get('/{username}/followers', function ($username) {
        $user = User::where('username', $username)->first();
        return view('followers', ['profile' => $user, 'followers' => $user->followers()->paginate(10)]);
    })->name('followers');
    route::get('/{username}/following', function ($username) {
        $user = User::where('username', $username)->first();
        return view('following', ['profile' => $user, 'followers' => $user->follows()->paginate(10)]);
    })->name('following');

    Route::get('/inbox', function () {
        $user = auth()->user();
        $requests = $user->FollowReq();
        $pendings = $user->pendingFollowReq();
        return view('inbox', [
            'profile' => $user,
            'requests' => $requests,
            'pendings' => $pendings
        ]);
    })->name('inbox');
    Route::resource('comments', CommentController::class);
});

Route::get('profile/{username}', function ($username) {

    $user = User::where('username', $username)->first();
    $posts = $user->posts()->paginate(9);
    if ($user == null || $posts == null) {
        abort(404);
    }

    return view('profile', [
        'profile' => $user,
        'posts' => $posts,
    ]);
})->name('user_profile')->middleware(['language']);

Route::resource('posts', PostController::class)->middleware(['language']);
Route::get('setlang/{lang}', function ($lang) {
    if ($lang == 'ar' || $lang == 'en') {
        // session_start(); // start the session
        // session(['language' => $lang], $lang);
        session(['language' => $lang]);
    } else {
        abort(404);
    }
    return redirect()->back();
});