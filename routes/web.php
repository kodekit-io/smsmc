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

Route::get('/', 'FrontendController@login');
Route::get('/home', 'FrontendController@dashboard');

Route::get('/project-add', 'FrontendController@projectAdd');
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