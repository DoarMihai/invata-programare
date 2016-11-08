@extends('admin.layouts.master')

@section('page', 'Reply to contact mail')

@section('content')
	<div class="col-md-12">
		<div class="admin-bg">
			<div class="contact-form">
				<div class="row">
					<div class="col-md-12">
						@if(Session::get('flash_notice'))
							<div class="alert alert-success">Emailul tau a fost trimis!</div>
						@endif
						<div class="title">
							<h4>Mesaj trimis de <a href="">{{ $item->name }}</a> on {{ $item->sent_on }}</h4>
						</div>
						<strong>Subiect: </strong> {{ messageSubject($item->subject) }} <br>
						<strong>Mesaj: </strong> {{ $item->message }}
					</div>
				</div>
				@if(isset($replies) && $replies->count())
					<hr>
					<strong>Mesaj: </strong> {{ $replies[0]->message }}
				@endif
				<hr>
				<div class="row">
					<div class="col-md-12">
						<form action="{{ route('admin.contact.responde', $item->id) }}" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label for="">Subject</label>
								<input type="text" class="form-control" name="subject" value="Re: {{ messageSubject($item->subject) }}">
							</div>
							<div class="form-group">
								<label for="">Mesaj</label>
								<textarea name="mesaj" id="" cols="30" rows="10" class="form-control">Reply: {{ $item->message }}</textarea>
							</div>
							<div class="form-group">
								<span class="pull-right">
									<a href="" class="btn btn-danger">Ban IP/Email</a>
									<a href="{{ route('admin.contact') }}" class="btn btn-default">Cancel</a>
									<input type="submit" value="Send Reply" class="btn btn-primary">
								</span>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection