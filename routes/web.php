<?php

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

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/login', 'ApiAuthController@getLogin');
Route::post('/login', 'ApiAuthController@postLogin');
Route::post('/logout', 'ApiAuthController@logout');
Route::get('/logout', 'ApiAuthController@logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'DashboardController@dashboard');
    Route::get('get-project-list', 'DashboardController@getProjectList');
    Route::get('get-brand-equity/{projectId}', 'DashboardController@getBrandEquity');
});


Route::get('/project-add', 'FrontendController@projectAdd');
Route::get('/project-edit', 'FrontendController@projectEdit');

Route::get('/project-all', 'FrontendController@projectAll');
Route::get('/project-fb', 'FrontendController@projectFB');
Route::get('/project-tw', 'FrontendController@projectTW');
Route::get('/project-yt', 'FrontendController@projectYT');
Route::get('/project-ig', 'FrontendController@projectIG');
Route::get('/project-news', 'FrontendController@projectNews');
Route::get('/project-blog', 'FrontendController@projectBlog');
Route::get('/project-forum', 'FrontendController@projectForum');

Route::get('/socmed-accounts', 'FrontendController@socmedAccounts');
Route::get('/socmed-fb', 'FrontendController@socmedFB');
Route::get('/socmed-tw', 'FrontendController@socmedTW');
Route::get('/socmed-yt', 'FrontendController@socmedYT');
Route::get('/socmed-ig', 'FrontendController@socmedIG');

Route::get('/engagement-accounts', 'FrontendController@engagementAccounts');
Route::get('/engagement-ticket', 'FrontendController@engagementTicket');
Route::get('/engagement-ticket-details', 'FrontendController@engagementTicketDetails');
Route::get('/engagement-calendar', 'FrontendController@engagementCalendar');
Route::get('/engagement-timeline', 'FrontendController@engagementTimeline');

Route::get('/report-view', 'FrontendController@reportView');
Route::get('/report-add', 'FrontendController@reportAdd');

Route::get('/account', 'FrontendController@account');
Route::get('/admin', 'FrontendController@admin');
Route::get('/admin-add', 'FrontendController@adminAdd');
Route::get('/admin-edit', 'FrontendController@adminEdit');

Route::get('/page-help', 'FrontendController@pageHelp');

Route::get('test/api', 'TestController@api');