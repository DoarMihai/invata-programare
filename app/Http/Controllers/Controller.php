<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

// NOT READY YET

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * If user is inactive we kick it
     * @param  [type] $id     [description]
     * @param  [type] $status [description]
     * @return [type]         [description]
     */
    protected function kickUser($id, $status){
            if($status == 0){
                Auth::logout();
                return redirect()->route('user.login')
                    ->with('message', 'Your account must be verified by an admin.')
                    ->withInput();        
            }    	
    }

}
