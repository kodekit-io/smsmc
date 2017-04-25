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
    Route::get('home', 'DashboardController@dashboard');
    Route::get('get-project-list', 'DashboardController@getProjectList');
    Route::get('get-brand-equity/{projectId}', 'DashboardController@getBrandEquity');

    Route::get('project/add', 'ProjectController@add');
    Route::post('project/create', 'ProjectController@create');
    Route::get('project/{id}/edit', 'ProjectController@edit');
    Route::post('project/{id}/update', 'ProjectController@update');
    Route::get('project/{id}/delete', 'ProjectController@delete');

    Route::any('project/all/{projectId}', 'ProjectController@allMedia');
    Route::any('project/facebook/{projectId}', 'ProjectController@facebook');
    Route::any('project/twitter/{projectId}', 'ProjectController@twitter');
    Route::any('project/news/{projectId}', 'ProjectController@news');
    Route::any('project/news-int/{projectId}', 'ProjectController@newsInt');
    Route::any('project/blog/{projectId}', 'ProjectController@blog');
    Route::any('project/forum/{projectId}', 'ProjectController@forum');
    Route::any('project/youtube/{projectId}', 'ProjectController@youtube');
    Route::any('project/instagram/{projectId}', 'ProjectController@instagram');

    Route::any('project/ontologi-test/{projectId}', 'ProjectController@ontologiTest');

    Route::any('socmed/facebook', 'SocmedController@facebook');
    Route::any('socmed/twitter', 'SocmedController@twitter');
    Route::any('socmed/youtube', 'SocmedController@youtube');
    Route::any('socmed/instagram', 'SocmedController@instagram');

    // Charts
    Route::post('charts/brand-equity', 'ChartController@brandEquity');
    Route::post('charts/bar-sentiment', 'ChartController@barSentiment');

    Route::post('charts/trend-sentiment', 'ChartController@trendSentiment');
    Route::post('charts/trend-post', 'ChartController@trendPost');
    Route::post('charts/trend-buzz', 'ChartController@trendBuzz');
    Route::post('charts/trend-reach', 'ChartController@trendReach');
    Route::post('charts/trend-interaction', 'ChartController@trendInteraction');
    Route::post('charts/trend-user', 'ChartController@trendUser');
    Route::post('charts/trend-comment', 'ChartController@trendComment');
    Route::post('charts/trend-view', 'ChartController@trendView');
    Route::post('charts/trend-potential-reach', 'ChartController@trendPotentialReach');
    Route::post('charts/trend-love', 'ChartController@trendLove');
    Route::post('charts/trend-fans', 'ChartController@trendFans');

    Route::post('charts/pie-post', 'ChartController@piePost');
    Route::post('charts/pie-buzz', 'ChartController@pieBuzz');
    Route::post('charts/pie-interaction', 'ChartController@pieInteraction');
    Route::post('charts/pie-unique-user', 'ChartController@pieUniqueUser');
    Route::post('charts/pie-comment', 'ChartController@pieComment');
    Route::post('charts/pie-like', 'ChartController@pieLike');
    Route::post('charts/pie-share', 'ChartController@pieShare');
    Route::post('charts/pie-viral-reach', 'ChartController@pieViralReach');
    Route::post('charts/pie-potential-reach', 'ChartController@piePotentialReach');
    Route::post('charts/pie-reach', 'ChartController@pieReach');
    Route::post('charts/pie-view', 'ChartController@pieView');
    Route::post('charts/pie-rating', 'ChartController@pieRating');
    Route::post('charts/pie-love', 'ChartController@pieLove');

    Route::post('charts/bar-interaction-rate', 'ChartController@barInteractionRate');
    Route::post('charts/bar-media-share', 'ChartController@barMediaShare');
    Route::post('charts/bar-topic-distribution', 'ChartController@barTopicDistribution');

    Route::post('charts/ontologi', 'ChartController@ontologi');
    Route::post('charts/wordcloud', 'ChartController@wordcloud');
    Route::post('charts/influencer', 'ChartController@influencer');
    Route::post('charts/convo', 'ChartController@convo');
    Route::any('charts/paging-convo', 'ChartController@pagingConvo');
    Route::post('change-sentiment', 'ChartController@changeSentiment');
    Route::any('charts/download-convo', 'ChartController@downloadConvo');

    Route::get('ticket', 'TicketController@index');
    Route::get('view-ticket', 'TicketController@ticketList');
    Route::get('ticket/add', 'TicketController@add');
    Route::post('ticket/create', 'TicketController@create');
    Route::get('ticket/{ticketId}/detail', 'TicketController@detail');
    Route::post('ticket/{ticketId}/reply', 'TicketController@reply');
    Route::post('ticket/{ticketId}/change-status', 'TicketController@changeStatus');
    Route::post('convo/create-ticket', 'TicketController@createTicketFromConvo');

    Route::get('setting/account', 'SettingController@account');
    Route::post('setting/account/update', 'SettingController@update');

    Route::get('setting/user', 'SettingController@user');
    Route::get('setting/user/list', 'SettingController@userList');
    Route::get('setting/user/add', 'SettingController@userAdd');
    Route::post('setting/user/store', 'SettingController@userStore');
    Route::get('setting/user/{userId}/edit', 'SettingController@userEdit');
    Route::post('setting/user/{userId}/update', 'SettingController@userUpdate');
    Route::get('setting/user/{userId}/delete', 'SettingController@userDelete');

    Route::get('setting/group', 'SettingController@group');
    Route::get('setting/group/list', 'SettingController@groupList');
    Route::get('setting/group/add', 'SettingController@groupAdd');
    Route::post('setting/group/store', 'SettingController@groupStore');
    Route::get('setting/group/{groupId}/edit', 'SettingController@groupEdit');
    Route::post('setting/group/{groupId}/update', 'SettingController@groupUpdate');
    Route::get('setting/group/{groupId}/delete', 'SettingController@groupDelete');

    Route::get('report', 'ReportController@index');
    Route::get('report/list', 'ReportController@reportList');
    Route::get('report/add', 'ReportController@add');
    Route::post('report/create', 'ReportController@create');
    Route::get('report/delete/{id}', 'ReportController@delete');

    Route::get('/socmed-accounts', 'FrontendController@socmedAccounts');
    Route::post('/socmed-accounts/save', 'FrontendController@socmedAccountsSave');
});

Route::get('/project-edit', 'FrontendController@projectEdit');


Route::get('/socmed-fb', 'FrontendController@socmedFB');
Route::get('/socmed-tw', 'FrontendController@socmedTW');
Route::get('/socmed-yt', 'FrontendController@socmedYT');
Route::get('/socmed-ig', 'FrontendController@socmedIG');

Route::get('/engagement-accounts', 'FrontendController@engagementAccounts');
Route::get('/engagement-calendar', 'FrontendController@engagementCalendar');
Route::get('/engagement-timeline', 'FrontendController@engagementTimeline');

Route::get('/report-view', 'FrontendController@reportView');
Route::get('/report-add', 'FrontendController@reportAdd');

Route::get('/notifications', 'FrontendController@notif');
Route::get('/page-help', 'FrontendController@pageHelp');
Route::get('/page-media', 'FrontendController@media');

Route::get('tests/googlechart', 'TestController@googlechart');
Route::get('tests/echarts', 'TestController@echarts');
Route::post('tests/echarts/post', 'TestController@echartsPost');
Route::get('tests/summary', 'TestController@summary');

Route::get('medialist', 'TestController@medialist');
Route::get('forumlist', 'TestController@forumlist');
Route::get('bloglist', 'TestController@bloglist');

Route::get('alert/view', 'TestController@alertView');

//
// Route::get('api1/{x}/{a}', 'TestController@api1');
// Route::get('api2/{x}/{a}/{b}', 'TestController@api2');
// Route::get('api3/{x}/{a}/{b}/{c}', 'TestController@api3');
// Route::get('api4/{x}/{a}/{b}/{c}/{d}', 'TestController@api4');
// Route::get('api5/{x}/{a}/{b}/{c}/{d}/[e]', 'TestController@api5');
