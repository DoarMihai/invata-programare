<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Log;

// NOT READY YET

class MasterController extends Controller
{

	private function validateXSS()
	{
		# code...
	}

	private function kick($user)
	{
		# code...
	}

	protected function kickInactive()
	{
     	if(Auth::user()->status == 0){
     		Auth::logout();
            return redirect()->route('user.login')
	            ->with('message', 'Your account must be verified by an admin.')
    	        ->withInput();        
     	}	
    }
	
}