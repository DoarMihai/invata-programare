<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Page;
use App\User;
use App\UsersEducation;
use App\UsersContact;
use App\Portfolio;
use App\forumPosts;
use App\LoginTrack;
use App\forumTopics;
use App\Message;
use App\UserBan;
use Validator;
use Input;
use Hash;
use Auth;
use Redirect;
use Mail;
use File;
use Log;
use Session;

class UserController extends Controller
// class UserController extends MasterController
{

    public function index(User $u)
    {
        if(Auth::check() && Auth::user()->class == 10){
            $users = $u->where('id', '<>', Auth::user()->id)->get();
            return view('admin.users.index', compact('users'));
        }
    }

    public function show(User $user, forumPosts $p, forumTopics $ft, $id)
    {
        $data = $user->with('contact')->where('id', '=', $id)->first();
        $forumPosts = $p->with('topics')->where('posted_by', '=', $id)->get();
        $topics = $ft->where('posted_by', '=', $id)->get();

        $posts = [];
        foreach($forumPosts as $topic){
            $posts[$topic['topic_id']] = $topic;
        }

        return view('profile.show', compact('data', 'posts', 'topics'));
    }

    public function getRegister()
    {
        if(Auth::check()) {
            return Redirect::to('/profile/'.Auth::user()->id)->with('flash_notice', 'You are already logged in!');
        }
        return view('auth.user_register');
    }


    public function postRegister()
    {
        $validator = Validator::make(Input::all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'my_name'   => 'honeypot',
            'my_time'   => 'required|honeytime:5'            
        ]);        

        if($validator->fails()){
            return redirect()
                        ->route('user.register.post')
                        ->withErrors($validator)
                        ->withInput();            
        }
        //send mail

        /*if(Input::get('name') == 'admin' || Input::get('name') == 'administrator' || Input::get('email') == 'admin' || Input::get('email') == 'administrator'){
            die('Go away!');
        }*/

        //create account
        User::create([
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'password' => Hash::make(Input::get('password')),
            'about' =>  filter_var(Input::get('about') ,FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH),
            'status' => 0
            //avatar
        ]);

        Session::flash('falsh_msg', 'Your new account was created! Your account will be activated by an Admin soon!');
        //redirect to login
        return redirect()->route('user.login');
    }

    public function getLogin()
    {
        if(Auth::check()) {
            return Redirect::to('/profile/'.Auth::user()->id)->with('flash_notice', 'You are already logged in!');
        }
        return view('auth.user_login');
    }

    public function postLogin(LoginTrack $lt)
    {
        if (Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')])) {
            // Authentication passed...
            
            if(Auth::user()->status == 0){

                $lt->create([
                 'user_id' => Auth::user()->id,
                 'browser' => $ud['name']." - ".$ud['version'],
                 'os' => $ud['platform'],
                 'ip' => $_SERVER['REMOTE_ADDR'],
                 'json_data' => json_encode($ud),
                 'acc_type' => Auth::user()->status
                ]);

                
                Auth::logout();
                return redirect()->route('user.login')
                    ->with('message', 'Your account must be verified by an admin.')
                    ->withInput();        
            }

            $ud = $this->getBrowser();

            $lt->create([
             'user_id' => Auth::user()->id,
             'browser' => $ud['name']." - ".$ud['version'],
             'os' => $ud['platform'],
             'ip' => $_SERVER['REMOTE_ADDR'],
             'json_data' => json_encode($ud),
             'acc_type' => Auth::user()->status
            ]);

            return redirect()->route('profile.index', Auth::user()->id);
        }else{
            //no good credentials, redirect back with error
            return redirect()->route('user.login')
                ->with('message', 'Your username/password combination was incorrect')
                ->withInput();        
        }
    }

    public function getEditProfile(User $u)
    {
        $data = $u->with('education')->where('id', '=', Auth::user()->id)->first();
        return view('auth.edit_acc', compact('data'));
    }

    public function postEditProfile()
    {
        if (Input::hasFile('avatar')) {

            $file = Input::file('avatar');

        	$extension = File::extension($file->getClientOriginalName());

        	$extensions = ['png', 'jpg', 'jpeg', 'gif', 'bmp'];

        	if(!in_array($extension, $extensions)){
	            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	                $ip = $_SERVER['HTTP_CLIENT_IP'];
	            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	            } else {
	                $ip = $_SERVER['REMOTE_ADDR'];
	            }
	            $user_agent = $_SERVER['HTTP_USER_AGENT'];           		
        		//log him
    	        Log::useDailyFiles(storage_path().'/logs/unauthorize-upload.log');
	            Log::info("Restricted user info: Id: ".Auth::user()->id." Ip: $ip Agent: $user_agent \n");
        		//delete his account

	            User::where('id', '=', Auth::user()->id)->update(['status' => 0]);
	            UserBan::create([
	            	'user_id' => Auth::user()->id,
	            	'user_ip' => $ip,
	            	'email' => Auth::user()->email
	            ]);
        		//ban him
         		Auth::logout();
	            return redirect()->route('user.login')
    	            ->with('message', 'Can\'t touch this!')
        	        ->withInput();
        	}

            $nweN = time().'.'.$extension;

            $file->move(public_path() . '/uploads/users', $nweN);
            $fileToDb = $nweN;

            User::where('id', '=', Auth::user()->id)->update([
                'name' => htmlentities(Input::get('name')),
                'email' => htmlentities(Input::get('email')),
                'about' => htmlentities(Input::get('about')),            
                'pic' => $fileToDb
            ]);

        }else{
            User::where('id', '=', Auth::user()->id)->update([
                'name' => htmlentities(Input::get('name')),
                'email' => htmlentities(Input::get('email')),
                'about' => htmlentities(Input::get('about')),            
            ]);
        }

        $usr = User::with('education')->where('id', '=', Auth::user()->id)->first();
        if(isset($data->education[0])){
            $updateArr = [];
            if(Input::get('education_name') != ''){
                $updateArr['name'] = htmlentities(Input::get('education_name'));
            }
            if(Input::get('education_start') != ''){
                $updateArr['started'] = htmlentities(Input::get('education_start'));
            }
            if(Input::get('education_end') != ''){
                $updateArr['ended'] = htmlentities(Input::get('end'));
            }
            # check if he already has education, if so we edit it
            UsersEducation::where('user', Auth::user()->id)->update($updateArr);
        }else{
            # else we insert it
            $updateArr = [];
            if(Input::get('education_name') != ''){
                $updateArr['name'] = htmlentities(Input::get('education_name'));
            }
            if(Input::get('education_start') != ''){
                $updateArr['started'] = htmlentities(Input::get('education_start'));
            }
            if(Input::get('education_end') != ''){
                $updateArr['ended'] = htmlentities(Input::get('end'));
            }
            $updateArr['user'] = Auth::user()->id;
            # check if he already has education, if so we edit it
            UsersEducation::insert($updateArr);
            
        }

        return redirect()->route('user.edit');
    }


    public function getAddPorfolioItem()
    {
        return view('auth.portfolio_add');
    }

    public function editPortfolioItem(Portfolio $p, $id)
    {
        $data = $p->where('user_id', '=', Auth::user()->id)->where('id', '=', $id)->first();
        return view('profile.edit_portfolio', compact('data'));
    }

    public function postEditPortfolioItem(Portfolio $p, $id)
    {
        $validator = Validator::make(Input::all(), [
            'name' => 'required|min:3',
            'description' => 'required',
            'skills' => 'required',
            'link' => 'url',
            'my_name'   => 'honeypot',
            'my_time'   => 'required|honeytime:5'
        ]);

        if($validator->fails()){
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();            
        }

        if (Input::hasFile('pic')) {
            $file = Input::file('pic');
            $file->move(base_path() . 'public_html/uploads/portfolios/'.Auth::user()->id.'/', $file->getClientOriginalName());
            $fileToDb = $file->getClientOriginalName();

            $extension = File::extension($file->getClientOriginalName());

            $extensions = ['png', 'jpg', 'jpeg', 'gif', 'bmp'];

            if(!in_array($extension, $extensions)){
                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } else {
                    $ip = $_SERVER['REMOTE_ADDR'];
                }
                $user_agent = $_SERVER['HTTP_USER_AGENT'];                  
                //log him
                Log::useDailyFiles(storage_path().'/logs/unauthorize-upload.log');
                Log::info("Restricted user info: Id: ".Auth::user()->id." Ip: $ip Agent: $user_agent \n");
                //delete his account

                User::where('id', '=', Auth::user()->id)->update(['status' => 0]);
                UserBan::create([
                    'user_id' => Auth::user()->id,
                    'user_ip' => $ip,
                    'email' => Auth::user()->email
                ]);
                //ban him
                Auth::logout();
                return redirect()->route('user.login')
                    ->with('message', 'Can\'t touch this!')
                    ->withInput();                  
                
            }

        }else{
            $fileToDb = '';
        }

        $update = [
            'user_id' => Auth::user()->id,
            'name' => Input::get('name'),
            'description' => Input::get('description'),
            'skills' => Input::get('skills'),
            'link' => Input::get('link'),
        ];

        if($fileToDb != ''){
            $update['pic'] = $fileToDb;
        }

        $p->where('id', $id)->wher('user_id', '=', Auth::user()->id)->update($update);

        return redirect()->route('profile.index', Auth::user()->id);
    }

    public function postAddPortfolioItem(Portfolio $p)
    {
        $validator = Validator::make(Input::all(), [
            'name' => 'required|min:3',
            'description' => 'required',
            'skills' => 'required',
            'link' => 'url',
            // 'pic' => 'mimes:jpeg,png',
            'my_name'   => 'honeypot',
            'my_time'   => 'required|honeytime:5'            
        ]);  

        if($validator->fails()){
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();            
        }

        if (Input::hasFile('pic')) {
            $file = Input::file('pic');
            $file->move(base_path() . 'public_html/uploads/portfolios/'.Auth::user()->id.'/', $file->getClientOriginalName());
            $fileToDb = $file->getClientOriginalName();

            $extension = File::extension($file->getClientOriginalName());

            $extensions = ['png', 'jpg', 'jpeg', 'gif', 'bmp'];

            if(!in_array($extension, $extensions)){
                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } else {
                    $ip = $_SERVER['REMOTE_ADDR'];
                }
                $user_agent = $_SERVER['HTTP_USER_AGENT'];                  
                //log him
                Log::useDailyFiles(storage_path().'/logs/unauthorize-upload.log');
                Log::info("Restricted user info: Id: ".Auth::user()->id." Ip: $ip Agent: $user_agent \n");
                //delete his account

                User::where('id', '=', Auth::user()->id)->update(['status' => 0]);
                UserBan::create([
                    'user_id' => Auth::user()->id,
                    'user_ip' => $ip,
                    'email' => Auth::user()->email
                ]);
                //ban him
                Auth::logout();
                return redirect()->route('user.login')
                    ->with('message', 'Can\'t touch this!')
                    ->withInput();                  
                
            }            
        }else{
            $fileToDb = '';
        }

        $p->create([
            'user_id' => Auth::user()->id,
            'name' => htmlentities(Input::get('name')),
            'description' => htmlentities(Input::get('description')),
            'skills' => htmlentities(Input::get('skills')),
            'link' => filter_var(Input::get('link'), FILTER_VALIDATE_URL) != false ? Input::get('link') : '',
            'pic' => $fileToDb
        ]);

        return redirect()->route('profile.index', Auth::user()->id);
    }

    public function getResetpass()
    {
        if(Auth::check()) {
            return Redirect::to('/profile/'.Auth::user()->id)->with('flash_notice', 'You are already logged in!');
        }        
        return view('auth.recover');
    }

    public function postLogout()
    {
        Auth::logout();
        return redirect()->route('user.login')
            ->with('message', 'We hope to see you soon!')
            ->withInput();   
    }

    public function postResetpass(User $u)
    {
        $user = $u->where('email', Input::get('email'))->first();
        if($user && $user->count() && $user->status == 1){
            //user found
            $newPass = Hash::make($this->generateRandomString());//hash this
            //update the database
            $user->where('email', Input::get('email'))->update(['password' => $newPass]);
            //send email to user
            Mail::send('emails.recover_pass', ['user' => $user->name, 'new_pass' => $this->generateRandomString()], function ($m) use ($user) {
                $m->from('mihai@invata-programare.ro', 'Recuperare parola Invata-Programare');
                $m->to(Input::get('email'), $user->name)->subject('Recuperare parola Invata-Programare!');
            });            
            //redirect to login with message
            Session::flash('falsh_msg', 'Your new password was sent via email!');
            return redirect()->route('user.forgot')
                ->with('message', 'Your new password was sent via email!');
        }else{
            //not found, redirect back with error
            return redirect()->route('user.forgot')
                ->with('message', 'Your email was not found in our database!')
                ->withInput();          
        }
    }

    public function storeMessage()
    {
        # code...
    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }  

    public function moveForumItem()
    {
        # code...
    }

    public function editContactInfo(UsersContact $u)
    {
        $info = $u->where('user_id', '=', Auth::user()->id)->first();
        return view('profile/contact_info', compact('info'));
    }

    public function postEditContactInfo(UsersContact $u)
    {
        $info = $u->where('user_id', '=', Auth::user()->id)->first();

        if(isset($info) && $info){
            # check if this user already has info and update it
            $arr = [];
            if(Input::get('facebook') != null && Input::get('facebook') != ''){
                if(filter_var(Input::get('facebook'), FILTER_VALIDATE_URL) != false){
                    $arr['facebook'] = Input::get('facebook');
                }
            }
            if(Input::get('twitter') != null && Input::get('twitter') != ''){
                if(filter_var(Input::get('twitter'), FILTER_VALIDATE_URL) != false){
                    $arr['twitter'] = Input::get('twitter');
                }
            }
            if(Input::get('gplus') != null && Input::get('gplus') != ''){
                if(filter_var(Input::get('gplus'), FILTER_VALIDATE_URL) != false){
                    $arr['gplus'] = Input::get('gplus');
                }
            }
            if(Input::get('linkedin') != null && Input::get('linkedin') != ''){
                if(filter_var(Input::get('linkedin'), FILTER_VALIDATE_URL) != false){
                    $arr['linkedin'] = Input::get('linkedin');
                }
            }
            if(Input::get('skype') != null && Input::get('skype') != ''){
                if(filter_var(Input::get('skype'), FILTER_VALIDATE_URL) != false){
                    $arr['skype'] = Input::get('skype');
                }
            }
            $arr['user_id'] = Auth::user()->id;

            $info->update($arr);
            return redirect()->route('user.editcontact')->with('status', 'Profile updated!');;

        }else{
            $arr = [];
            if(Input::get('facebook') != null && Input::get('facebook') != ''){
                $arr['facebook'] = Input::get('facebook');
            }
            if(Input::get('twitter') != null && Input::get('twitter') != ''){
                $arr['twitter'] = Input::get('twitter');
            }
            if(Input::get('gplus') != null && Input::get('gplus') != ''){
                $arr['gplus'] = Input::get('gplus');
            }
            if(Input::get('linkedin') != null && Input::get('linkedin') != ''){
                $arr['linkedin'] = Input::get('linkedin');
            }
            if(Input::get('skype') != null && Input::get('skype') != ''){
                $arr['skype'] = Input::get('skype');
            }
            $arr['user_id'] = Auth::user()->id;
            $u->insert($arr);

            return redirect()->route('user.editcontact')->with('status', 'Profile updated!');;
            # or insert it
        }
    }

    private function getBrowser() 
    { 
        $u_agent = $_SERVER['HTTP_USER_AGENT']; 
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
        { 
            $bname = 'Internet Explorer'; 
            $ub = "MSIE"; 
        } 
        elseif(preg_match('/Firefox/i',$u_agent)) 
        { 
            $bname = 'Mozilla Firefox'; 
            $ub = "Firefox"; 
        } 
        elseif(preg_match('/Chrome/i',$u_agent)) 
        { 
            $bname = 'Google Chrome'; 
            $ub = "Chrome"; 
        } 
        elseif(preg_match('/Safari/i',$u_agent)) 
        { 
            $bname = 'Apple Safari'; 
            $ub = "Safari"; 
        } 
        elseif(preg_match('/Opera/i',$u_agent)) 
        { 
            $bname = 'Opera'; 
            $ub = "Opera"; 
        } 
        elseif(preg_match('/Netscape/i',$u_agent)) 
        { 
            $bname = 'Netscape'; 
            $ub = "Netscape"; 
        } 

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }
            else {
                $version= $matches['version'][1];
            }
        }
        else {
            $version= $matches['version'][0];
        }

        // check if we have a number
        if ($version==null || $version=="") {$version="?";}

        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
    } 


}