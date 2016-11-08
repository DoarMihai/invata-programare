<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Job;

class JobController extends Controller
{
	public function index(Job $list){
		$jobs = $list->paginate(12);

		return view('jobs.index');
	}
	
	public function show(Job $item, $id){

	}

	public function create(){ 
		return view('jobs.create');
	}
	
	public function store(){

	}
}
