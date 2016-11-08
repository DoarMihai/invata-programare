<?php 

use App\Article;
use App\forumTopics;
use App\forumThreads;
use App\forumPosts;
use App\User;
use App\PointsLog;
use App\UsersContact;

function createSlug($data)
{
	$search = [" ", ",", "<", ">", "?", ".", ";", ":", "[", "]", "{", "}", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "+", "/"];
    $replace = ["_", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""];
    return strtolower(str_replace($search, $replace, $data));
}

function messageSubject($id){
	switch($id){
		case 1:
			return "Ceva Grozav";
		break;
		case 2:
			return "Eroare pe site";
		break;
		case 3:
			return "Legat de tutoriale";
		break;
		default:
			return 'Altceva';
		break;
	}
}

function messageStatus($id)
{
	switch($id){
		case 0:
			return "Necitit";
		break;
		case 1:
			return "Citit";
		break;
	}
}

function getArticle($id)
{
	return Article::whereId($id)->first();
}

function snippetColor($id)
{
	switch($id){
		case 12:
			return 'snippets-page red';
		break;
		case 13:
			return 'snippets-page green';
		break;
	}
}

function getPostsNo($thread)
{
	$topics = forumTopics::whereThreadId($thread)->lists('id');
	$posts = forumPosts::whereIn('topic_id', $topics)->count();

	return $posts;
}

function lastPost($thread)
{
	$lastTopic = forumTopics::whereThreadId($thread)->orderBy('created_at', 'desc')->first();

	if( isset($lastTopic->id) ){
	$lastPost = forumPosts::whereTopicId($lastTopic->id)->orderBy('created_at', 'desc')->first();
		$data = [
			'user_id' => $lastPost->posted_by,
			// 'username' => getUser($lastPost->posted_by)->first_name.' '.getUser($lastPost->posted_by)->last_name,
			'username' => getUser($lastPost->posted_by)->name,
			'date' => $lastPost->created_at
		];
	}else{
		$data = NULL;
	}
	return $data;
}

function getUser($id)
{
    return User::with('contact')->whereId($id)->first();
}

function lastTopicPost($topic)
{
	$lastPost = forumPosts::whereTopicId($topic)->orderBy('created_at', 'desc')->first();

	if( isset($lastPost) && $lastPost->count() ){
		return ['user' => getUser($lastPost->posted_by), 'date' => $lastPost->created_at];
	}else{
		return NULL;
	}
}

function getRole($role)
{
    switch($role){
        case 1: $data = 'Junior Member'; break;
        case 2: $data = 'Member'; break;
        case 3: $data = 'Power Member'; break;
        case 4: $data = 'Legend'; break;
        case 5: $data = 'Author'; break;
        case 6: $data = 'Moderator'; break;
        case 7: $data = 'Administrator'; break;
        case 8: $data = 'Not Set'; break;
        case 9: $data = 'Not Set'; break;
        case 10: $data = 'Keymaster'; break;
    }

    return $data;
}
function usersPost($user, $type = 'no')
{
    if( $type == 'no' ){
        return forumPosts::where('posted_by', $user)->count();
    }else{
        return forumPosts::where('posted_by', $user)->get();
    }
}
function getThreadData($id){
	return forumThreads::where('id', $id)->first();
}

function givePoints($user, $points, $reason)
{
	User::where('id', $user)->increment('points', 1);
	//add reason into log
	PointsLog::create(['user_id' => $user, 'points' => $points, 'reason' => $reason]);
}

function getReputation($points)
{
	if($points > 0 && $points < 30){
		return 'Apprentice';
	}
	if($points > 30 && $points < 50){
		return 'Newbie';
	}
	if($points > 50 && $points < 75){
		return 'Junior';
	}
	if($points > 75 && $points < 100){
		return 'Middle';
	}
	if($points > 100 && $points < 120){
		return 'Mentor';
	}
	if($points > 120){
		return 'Gutu';
	}
}

function fuckOff($id)
{
	$admins = [1];
	if( !in_array($id, $admins) ){
		die('Mars in pula mea!');
	}
}

function xss_clean($data)
{
// Fix &entity\n;
$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

// Remove any attribute starting with "on" or xmlns
$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

// Remove javascript: and vbscript: protocols
$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

// Remove namespaced elements (we do not need them)
$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

do
{
	// Remove really unwanted tags
	$old_data = $data;
	$data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
}
while ($old_data !== $data);

// we are done...
return $data;
}