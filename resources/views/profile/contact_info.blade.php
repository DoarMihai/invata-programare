@extends('layouts.master')

@section('title', Auth::user()->name."'s contact info" )

@section('content')
<div class="profile-page">
	<div class="row">
		<div class="col-md-12">
			<div class="lesson-page">

			<?php // var_dump($info); ?>

				@if (session('status'))
				    <div class="alert alert-success">
				        {{ session('status') }}
				    </div>
				@endif			

				<form action="{{ route('user.editcontact.post') }}" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<label for="">Facebook</label>
						<input type="text" name="facebook" class="form-control" placeholder="Facebook" value="{{ isset($info->facebook) && $info->facebook != null && $info->facebook != '' ? $info->facebook : '' }}">
					</div>
					<div class="form-group">
						<label for="">Twitter</label>
						<input type="text" name="twitter" class="form-control" placeholder="Twitter" value="{{ isset($info->twitter) && $info->twitter != null && $info->twitter != '' ? $info->twitter : '' }}">
					</div>
					<div class="form-group">
						<label for="">Google+</label>
						<input type="text" name="gplus" class="form-control" placeholder="Google+" value="{{ isset($info->gplus) && $info->gplus != null && $info->gplus != '' ? $info->gplus : '' }}">
					</div>
					<div class="form-group">
						<label for="">LinkedIn</label>
						<input type="text" name="linkedin" class="form-control" placeholder="Linked In" value="{{ isset($info->linkedin) && $info->linkedin != null && $info->linkedin != '' ? $info->linkedin : '' }}">
					</div>
					<div class="form-group">
						<label for="">Skype</label>
						<input type="text" name="skype" class="form-control" placeholder="Skype" value="{{ isset($info->skype) && $info->skype != null && $info->skype != '' ? $info->skype : '' }}">
					</div>
					<span class="pull-right">
						<a href="{{ route('profile.index', Auth::user()->id) }}" class="btn btn-default">Cancel</a>
						<input type="submit" value="Edit" class="btn btn-primary">
					</span>
					<div class="clearfix"></div>
				</form>
      		</div>
    	</div>
  	</div>
</div>
@endsection
