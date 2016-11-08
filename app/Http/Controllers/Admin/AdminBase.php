<?php 

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Log;


class AdminBase extends Controller{

	private $admins = [1];

    public function __construct()
    {
        if(Auth::user()->class != 10){
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            $user_agent = $_SERVER['HTTP_USER_AGENT'];            

            Log::useDailyFiles(storage_path().'/logs/unauthorize-access.log');
            Log::info("Restricted user info: Ip: $ip Agent: $user_agent \n");

            abort(404);
        }    
        $this->getThisMOFO();
    }

    private function getThisMOFO()
    {
    	//log mother fuckers action into database
    	//suspend his account
    	//ban his ip
    }


}