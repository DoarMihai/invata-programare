<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Example 2
// login url http://www.example.com/login
// logout url http://www.example.com/logout
// registration url http://www.example.com/register
Route::controllers([
    // 'account' => 'Auth\AuthController',
    // 'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('/', ['as' => 'home', 'uses' => 'PublicController@index']);
Route::get('/api/test', ['as' => 'home', 'uses' => 'ApiController@index']);


Route::get('/new_account', 		['as' => 'user.register', 'uses' => 'UserController@getRegister']);
Route::post('/new_account', 	['as' => 'user.register.post', 'uses' => 'UserController@postRegister']);
Route::get('/get_into', 		['as' => 'user.login', 'uses' => 'UserController@getLogin']);
Route::post('/get_into', 		['as' => 'user.login.post', 'uses' => 'UserController@postLogin']);
Route::get('/forgot_account',	['as' => 'user.forgot', 'uses' => 'UserController@getResetpass']);
Route::post('/forgot_account',	['as' => 'user.forgot.post', 'uses' => 'UserController@postResetpass']);
Route::get('/get_out',			['as' => 'user.logout', 'uses' => 'UserController@postLogout']);

Route::get('/edit', 			['as' => 'user.edit', 'middleware' => 'auth', 'uses' => 'UserController@getEditProfile']);
Route::post('/edit', 			['as' => 'user.edit.post', 'middleware' => 'auth', 'uses' => 'UserController@postEditProfile']);

Route::get('/edit-contact',		['as' => 'user.editcontact', 'middleware' => 'auth', 'uses' => 'UserController@editContactInfo']);
Route::post('/edit-contact',	['as' => 'user.editcontact.post', 'middleware' => 'auth', 'uses' => 'UserController@postEditContactInfo']);

Route::get('/add_portfolio', ['as' => 'user.portfolio.add', 'middleware' => 'auth', 'uses' => 'UserController@getAddPorfolioItem']);
Route::post('/add_portfolio', ['as' => 'user.portfolio.add.post', 'middleware' => 'auth', 'uses' => 'UserController@postAddPortfolioItem']);

/*Videos*/
Route::group(array('prefix' => 'videos'), function(){
	Route::get('/',				 ['as' => 'videos.index', 'uses' => 'VideoController@index']);
	Route::get('/create',		 ['as' => 'videos.create', 'uses' => 'VideoController@create']);
});
/*Article*/
Route::group(array('prefix' => 'article'), function(){
	Route::get('/{slug}',	 		['as' => 'article', 'uses' => 'PublicController@show']);
	Route::post('/comment/{id}',	['as' => 'article.comment', 'uses' => 'PublicController@postComment']);
});

Route::get('/category/{slug}', 		['as' => 'category', 'uses' => 'PublicController@category']);

/*Contact*/
Route::group(array('prefix' => 'contact'), function(){
	Route::get('/',			 		['as' => 'contact', 'uses' => 'PublicController@getContact']);
	Route::post('/',		 		['as' => 'contact.post', 'uses' => 'PublicController@postContact']);
});

Route::get('/search',			 	['as' => 'search', 'uses' => 'PublicController@search']);

Route::get('/page/{slug}',		 	['as' => 'page', 'uses' => 'PageController@show']);
Route::get('/lesson/{slug}',		['as' => 'lesson', 'uses' => 'LessonController@show']);

/*-------FORUMS---------*/
Route::group(array('prefix' => 'forums'), function(){
	Route::get('/',				    		 	['as' => 'forum.index', 'uses' => 'ForumController@categories']);
	Route::get('/thread/{slug}',			 	['as' => 'forum.thread.index', 'uses' => 'ForumController@showThread']);
	Route::post('/topic/reply/{slug}',	 		['as' => 'forum.topic.post', 'middleware' => 'auth', 'uses' => 'ForumController@postReply']);
	Route::get('/topic/{slug}',			 		['as' => 'forum.topic.index', 'uses' => 'ForumController@showTopic']);
	Route::get('/new_topic/{thread}',	 		['as' => 'forum.new.topic', 'middleware' => 'auth', 'uses' => 'ForumController@getCreateTopic']);
	Route::post('/new_topic/{thread}',	 		['as' => 'forum.new.topic.post', 'middleware' => 'auth', 'uses' => 'ForumController@postCreateTopic']);
	Route::get('/new_thread/{cat}',		 		['as' => 'forum.new.thread', 'middleware' => 'auth', 'uses' => 'ForumController@getCreateThread']);
	Route::post('/new_thread/{cat}',		 	['as' => 'forum.new.thread.post', 'middleware' => 'auth', 'uses' => 'ForumController@postCreateThread']);

	Route::get('/topic_status/{id}',		 				['as' => 'forum.topic.status', 'middleware' => 'auth', 'uses' => 'ForumController@topicStatus']);
	Route::get('/delete_post/{id}',			 				['as' => 'forum.post.delete', 'middleware' => 'auth', 'uses' => 'ForumController@deletePost']);
	Route::get('/topic_edit/{topic_slug}/{id}',			 	['as' => 'forum.post.edit', 'middleware' => 'auth', 'uses' => 'ForumController@getEditPost']);
	Route::post('/topic_edit/{topic_slug}/{id}',		 	['as' => 'forum.post.edit.send', 'middleware' => 'auth', 'uses' => 'ForumController@postEditPost']);

});
/*-------FORUMS---------*/
Route::group(array('prefix' => 'profile'), function(){
	Route::get('/{id}',				    		 	['as' => 'profile.index', 'middleware' => 'auth','uses' => 'UserController@show']);
	Route::get('/edit-portfolio/{id}',				['as' => 'profile.portfolio.item', 'middleware' => 'auth', 'uses' => 'UserController@editPortfolioItem']);
	Route::post('/edit-portfolio/{id}',				['as' => 'post.profile.portfolio.item', 'middleware' => 'auth','uses' => 'UserController@postEditPortfolioItem']);
});

Route::group(array('prefix' => 'jobs'), function(){
	Route::get('/',				    		 	['as' => 'jobs.index', 'uses' => 'JobController@index']);
	Route::get('/create',				    	['as' => 'jobs.create', 'uses' => 'JobController@create']);
});

Route::get('/sitemap', function()
{
	$file = public_path(). "/sitemap.xml";
	if (file_exists($file)) {
    	$content = file_get_contents($file);
    	return Response::make($content, 200, array('content-type'=>'application/xml'));
	}
});

/*Admin*/
Route::group(array('prefix' => 'admin8S7YW3'), function(){
	Route::get('/', 								['as' => 'dashboard', 'middleware' => 'auth', 'uses' => 'Admin\AdminController@index']);
	Route::get('/articles',							['as' => 'admin.articles', 'middleware' => 'auth', 'uses' => 'Admin\AdminArticlesController@index']);
	Route::get('/article/new', 						['as' => 'admin.create.article', 'middleware' => 'auth', 'uses' => 'Admin\AdminArticlesController@createArticle']);
	Route::post('/article/new', 					['as' => 'admin.create.article.post', 'middleware' => 'auth', 'uses' => 'Admin\AdminArticlesController@postArticle']);
	Route::get('/edit/article/{id}', 				['as' => 'admin.edit.article', 'middleware' => 'auth', 'uses' => 'Admin\AdminArticlesController@editArticle']);
	Route::post('/edit/article/{id}',				['as' => 'admin.edit.article.post', 'middleware' => 'auth', 'uses' => 'Admin\AdminArticlesController@postEditArticle']);

	Route::get('/delete/article/{id}',	['as' => 'admin.delete.article', 'middleware' => 'auth', 'uses' => 'Admin\AdminArticlesController@delete']);

	Route::post('/upload-img', 			['as' => 'admin.upload.img', 'middleware' => 'auth', 'uses' => 'Admin\AdminArticlesController@uploadImage']);

	/*Categories*/
	Route::get('/categories', 			['as' => 'admin.categories', 'middleware' => 'auth', 'uses' => 'Admin\AdminArticlesController@categories']);
	Route::post('/categories', 			['as' => 'admin.categories.post', 'middleware' => 'auth', 'uses' => 'Admin\AdminArticlesController@postCategory']);
	Route::get('/categories/delete/{id}', 	['as' => 'admin.categories.del', 'middleware' => 'auth', 'uses' => 'Admin\AdminArticlesController@deleteCategory']);

	/*Pages*/
	Route::group(array('prefix' => 'pages'), function(){
		Route::get('/', 				['as' => 'admin.pages', 'middleware' => 'auth', 'uses' => 'Admin\AdminPagesController@index']);
		Route::get('/new', 				['as' => 'admin.pages.create', 'middleware' => 'auth', 'uses' => 'Admin\AdminPagesController@create']);
		Route::post('/new', 			['as' => 'admin.pages.create.post', 'middleware' => 'auth', 'uses' => 'Admin\AdminPagesController@store']);
		Route::get('/edit/{id}',		['as' => 'admin.pages.edit', 'middleware' => 'auth', 'uses' => 'Admin\AdminPagesController@edit']);
		Route::post('/edit/{id}',		['as' => 'admin.pages.edit.post', 'middleware' => 'auth', 'uses' => 'Admin\AdminPagesController@update']);
		Route::get('/delete/{id}', 		['as' => 'admin.pages.delete', 'middleware' => 'auth', 'uses' => 'Admin\AdminPagesController@destroy']);
	});
	/*Lessons*/
	Route::group(array('prefix' => 'lessons'), function(){
		Route::get('/', 				['as' => 'admin.lessons', 'middleware' => 'auth', 'uses' => 'Admin\AdminLessonsController@index']);
		Route::get('/new', 				['as' => 'admin.lessons.create', 'middleware' => 'auth', 'uses' => 'Admin\AdminLessonsController@create']);
		Route::post('/new/post',		['as' => 'admin.lessons.create.post', 'middleware' => 'auth', 'uses' => 'Admin\AdminLessonsController@store']);
		Route::get('/delete/{id}',		['as' => 'admin.lessons.delete', 'middleware' => 'auth', 'uses' => 'Admin\AdminLessonsController@destroy']);
		Route::get('/edit/{id}',		['as' => 'admin.lessons.edit', 'middleware' => 'auth', 'uses' => 'Admin\AdminLessonsController@edit']);
		Route::post('/edit/{id}',		['as' => 'admin.lessons.edit.post', 'middleware' => 'auth', 'uses' => 'Admin\AdminLessonsController@update']);
	});
	/*Contact*/
	Route::group(array('prefix' => 'contact'), function(){
		Route::get('/', 				['as' => 'admin.contact', 'middleware' => 'auth', 'uses' => 'Admin\AdminContactController@index']);
		
		Route::get('/read/{id}',		['as' => 'admin.contact.read', 'middleware' => 'auth', 'uses' => 'Admin\AdminContactController@read']);
		Route::post('/reply/{id}',		['as' => 'admin.contact.responde', 'middleware' => 'auth', 'uses' => 'Admin\AdminContactController@replyToMail']);

		Route::get('/mark-read/{id}', 	['as' => 'admin.contact.markread', 'middleware' => 'auth', 'uses' => 'Admin\AdminContactController@markRead']);
		Route::get('/delete/{id}', 		['as' => 'admin.contact.delete', 'middleware' => 'auth', 'uses' => 'Admin\AdminContactController@destroy']);
	});

	/*Comments*/
	Route::group(array('prefix' => 'comments'), function(){
		Route::get('/', 				['as' => 'admin.comments', 'middleware' => 'auth', 'uses' => 'Admin\AdminCommentsController@index']);
		Route::get('/edit/{id}', 		['as' => 'admin.comments.edit', 'middleware' => 'auth', 'uses' => 'Admin\AdminCommentsController@edit']);
		Route::post('/edit/{id}', 		['as' => 'admin.comments.update', 'middleware' => 'auth', 'uses' => 'Admin\AdminCommentsController@update']);
		Route::get('/mark-spam/{id}',	['as' => 'admin.spam.mark', 'middleware' => 'auth', 'uses' => 'Admin\AdminCommentsController@markSpam']);
	});

	/*Forum Categories*/
	Route::group(array('prefix' => 'forums'), function(){
		Route::get('/cats', 				['as' => 'admin.forum.categories', 'middleware' => 'auth', 'uses' => 'Admin\AdminForumsController@categories']);
		Route::get('/edit_cat/{id}', 		['as' => 'admin.forum.edit_category', 'middleware' => 'auth', 'uses' => 'Admin\AdminForumsController@editCategory']);
		Route::post('/edit_cat/{id}', 		['as' => 'admin.forum.edit_category', 'middleware' => 'auth', 'uses' => 'Admin\AdminForumsController@postEditCategory']);

	});

	Route::group(array('prefix' => 'announcements'), function(){
		Route::get('/', 				['as' => 'admin.announcements', 'middleware' => 'auth', 'uses' => 'Admin\AdminAnnouncementsController@index']);
		Route::get('/edit/{id}', 		['as' => 'admin.edit.announcements', 'middleware' => 'auth', 'uses' => 'Admin\AdminAnnouncementsController@getEdit']);
		Route::post('/edit/{id}', 		['as' => 'admin.post.edit.announcements', 'middleware' => 'auth', 'uses' => 'Admin\AdminAnnouncementsController@postEdit']);
		Route::get('/delete/{id}',	 	['as' => 'admin.delete.announcements', 'middleware' => 'auth', 'uses' => 'Admin\AdminAnnouncementsController@delete']);

		Route::get('/create', 			['as' => 'admin.create.announcements', 'middleware' => 'auth', 'uses' => 'Admin\AdminAnnouncementsController@create']);
		Route::post('/create', 			['as' => 'admin.post.create.announcements', 'middleware' => 'auth', 'uses' => 'Admin\AdminAnnouncementsController@store']);
	});

	Route::group(array('prefix' => 'references'), function(){
		Route::get('/create', 			['as' =>'admin.create.references', 'middleware' => 'auth', 'uses' => 'Admin\AdminReferencesController@create']);
		Route::post('/create', 			['as' =>'admin.post.references', 'middleware' => 'auth', 'uses' => 'Admin\AdminReferencesController@store']);
	});
	
	Route::group(array('prefix' => 'users'), function(){
		Route::get('/', 			['as' =>'admin.users', 'middleware' => 'auth', 'uses' => 'UserController@index']);
		Route::get('/edit/{id}',	['as' =>'admin.users.edit', 'middleware' => 'auth', 'uses' => 'UserController@adminEditUser']);
		Route::post('/edit/{id}',	['as' =>'admin.users.edit.post', 'middleware' => 'auth', 'uses' => 'UserController@adminPostEditUser']);
	});

});

Route::group(array('before' => 'auth'), function ()
{
    Route::get('/laravel-filemanager', 'Tsawler\Laravelfilemanager\controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', 'Tsawler\Laravelfilemanager\controllers\LfmController@upload');
    // list all lfm routes here...
});