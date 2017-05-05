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

Route::group(['middleware' => ['auth','socmedAccount']], function () {
    Route::any('home', 'DashboardController@dashboard');
    Route::get('get-project-list', 'DashboardController@getProjectList');
    Route::get('get-brand-equity/{projectId}', 'DashboardController@getBrandEquity');
});

Route::group(['middleware' => ['auth', 'role', 'socmedAccount']], function () {
    Route::get('project/add', 'ProjectController@add')->name('projectCreate');
    Route::post('project/create', 'ProjectController@create')->name('projectCreate');
    Route::get('project/{id}/edit', 'ProjectController@edit')->name('projectUpdate');
    Route::post('project/{id}/update', 'ProjectController@update')->name('projectUpdate');
    Route::get('project/{id}/delete', 'ProjectController@delete')->name('projectDelete');

    Route::any('project/all/{projectId}', 'ProjectController@allMedia')->name('projectRead');
    Route::any('project/facebook/{projectId}', 'ProjectController@facebook')->name('projectRead');
    Route::any('project/twitter/{projectId}', 'ProjectController@twitter')->name('projectRead');
    Route::any('project/news/{projectId}', 'ProjectController@news')->name('projectRead');
    Route::any('project/news-int/{projectId}', 'ProjectController@newsInt')->name('projectRead');
    Route::any('project/blog/{projectId}', 'ProjectController@blog')->name('projectRead');
    Route::any('project/forum/{projectId}', 'ProjectController@forum')->name('projectRead');
    Route::any('project/youtube/{projectId}', 'ProjectController@youtube')->name('projectRead');
    Route::any('project/instagram/{projectId}', 'ProjectController@instagram')->name('projectRead');

    Route::any('project/ontologi-test/{projectId}', 'ProjectController@ontologiTest');

    Route::any('socmed/facebook', 'SocmedController@facebook');
    Route::any('socmed/twitter', 'SocmedController@twitter');
    Route::any('socmed/youtube', 'SocmedController@youtube');
    Route::any('socmed/instagram', 'SocmedController@instagram');

    Route::get('ticket', 'TicketController@index');
    Route::get('view-ticket', 'TicketController@ticketList');
    Route::get('ticket/add', 'TicketController@add');
    Route::post('ticket/create', 'TicketController@create');
    Route::get('ticket/{ticketId}/detail', 'TicketController@detail');
    Route::post('ticket/{ticketId}/reply', 'TicketController@reply');
    Route::post('ticket/{ticketId}/change-status', 'TicketController@changeStatus');
    Route::post('convo/create-ticket', 'TicketController@createTicketFromConvo');
    Route::get('/notifications', 'TicketController@notif');
    Route::get('/notification/list', 'TicketController@notifList');

    Route::get('setting/account', 'SettingController@account');
    Route::post('setting/account/update', 'SettingController@update');

    Route::get('setting/user', 'SettingController@user')->name('userRead');
    Route::get('setting/user/list', 'SettingController@userList')->name('userRead');
    Route::get('setting/user/add', 'SettingController@userAdd')->name('userCreate');
    Route::post('setting/user/store', 'SettingController@userStore')->name('userCreate');
    Route::get('setting/user/{userId}/edit', 'SettingController@userEdit')->name('userUpdate');
    Route::post('setting/user/{userId}/update', 'SettingController@userUpdate')->name('userUpdate');
    Route::get('setting/user/{userId}/delete', 'SettingController@userDelete')->name('userDelete');

    Route::get('setting/group', 'SettingController@group')->name('groupRead');
    Route::get('setting/group/list', 'SettingController@groupList')->name('groupRead');
    Route::get('setting/group/add', 'SettingController@groupAdd')->name('groupCreate');
    Route::post('setting/group/store', 'SettingController@groupStore')->name('groupCreate');
    Route::get('setting/group/{groupId}/edit', 'SettingController@groupEdit')->name('groupUpdate');
    Route::post('setting/group/{groupId}/update', 'SettingController@groupUpdate')->name('groupUpdate');
    Route::get('setting/group/{groupId}/delete', 'SettingController@groupDelete')->name('groupDelete');

    Route::get('setting/role', 'SettingController@role')->name('roleRead');
    Route::get('setting/role/list', 'SettingController@roleList')->name('roleRead');
//    Route::get('setting/role/add', 'SettingController@roleAdd');
//    Route::post('setting/role/store', 'SettingController@roleStore');
    Route::get('setting/role/{roleId}/edit', 'SettingController@roleEdit')->name('roleUpdate');
    Route::post('setting/role/{roleId}/update', 'SettingController@roleUpdate')->name('roleUpdate');
//    Route::get('setting/role/{roleId}/delete', 'SettingController@roleDelete');

    Route::get('report', 'ReportController@index');
    Route::get('report/list', 'ReportController@reportList');
    Route::get('report/add', 'ReportController@add');
    Route::post('report/create', 'ReportController@create');
    Route::get('report/delete/{id}', 'ReportController@delete');

    Route::get('/socmed-accounts', 'FrontendController@socmedAccounts')->name('registerRead');
    Route::post('/socmed-accounts/save', 'FrontendController@socmedAccountsSave');

    Route::get('/engagement-accounts', 'EngagementController@accounts');
    Route::post('/engagement/account-login/{idMedia}', 'EngagementController@login');
    Route::post('/engagement/account-logout/{idMedia}', 'EngagementController@logout');

    Route::get('/engagement/calendar', 'FrontendController@engagementCalendar');
    Route::get('/engagement/timeline', 'FrontendController@engagementTimeline');
    Route::get('/engagement/get-timeline/{idMedia}', 'EngagementController@getTimeline');
    Route::get('/engagement/add', 'EngagementController@add');
    Route::post('/engagement/post', 'EngagementController@post');
    Route::get('/engagement/reply', 'FrontendController@engagementReply');
    Route::get('/engagement/detail/{id}', 'FrontendController@engagementDetail');
    Route::get('/engagement/list', 'FrontendController@engagementList');

    Route::get('medialist', 'TestController@medialist');
    Route::get('forumlist', 'TestController@forumlist');
    Route::get('bloglist', 'TestController@bloglist');
    Route::get('/page-help', 'FrontendController@pageHelp');
    Route::get('/page-media', 'FrontendController@media');
});

Route::group(['middleware' => ['auth','role']], function() {
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
});

Route::get('/delay/{time}/{next}', 'DashboardController@timerRedirect');



// Route::get('tests/upload-file', 'TestController@uploadFile');
// Route::get('/project-edit', 'FrontendController@projectEdit');
//
// Route::get('/socmed-fb', 'FrontendController@socmedFB');
// Route::get('/socmed-tw', 'FrontendController@socmedTW');
// Route::get('/socmed-yt', 'FrontendController@socmedYT');
// Route::get('/socmed-ig', 'FrontendController@socmedIG');

// Route::get('/report-view', 'FrontendController@reportView');
// Route::get('/report-add', 'FrontendController@reportAdd');

// Route::get('tests/googlechart', 'TestController@googlechart');
// Route::get('tests/echarts', 'TestController@echarts');
// Route::post('tests/echarts/post', 'TestController@echartsPost');
// Route::get('tests/summary', 'TestController@summary');

// Route::get('calendar', 'TestController@calendar');
//
// Route::get('api1/{x}/{a}', 'TestController@api1');
// Route::get('api2/{x}/{a}/{b}', 'TestController@api2');
// Route::get('api3/{x}/{a}/{b}/{c}', 'TestController@api3');
// Route::get('api4/{x}/{a}/{b}/{c}/{d}', 'TestController@api4');
// Route::get('api5/{x}/{a}/{b}/{c}/{d}/[e]', 'TestController@api5');
