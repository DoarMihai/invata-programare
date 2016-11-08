@extends('layouts.master')

@section('content')
	<div class="page-title">
		<img src="{{ asset('uploads/pages/contact.png') }}" alt="">Contact
	</div>
	<div class="contact">
		<span class="about">
			Salut, ai vre-o nelamurire legata de site, ai probleme in vizualizarea continutului sau doar vrei sa-mi spui ceva grozav poti folosi formularul acesta, dar pentru intrebari tehnice legate de materialele scrise pe site te rog sa scrii in comentarii sau in sectiunea de intrebari si raspunsuri (Q&A), astfel incat cei ce mai intalnesc aceasta problema sa gaseasca rezolvare la o simpla cautare.
		</span>
		<hr>

		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		@if(Session::has('success'))
			<div class="alert alert-success">{{ Session::get('success') }}</div>
		@endif

		<form action="{{ route('contact.post') }}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		{!! Honeypot::generate('my_name', 'my_time') !!}
			<div class="form-group half-row">
				<label for="name">Nume*</label>
				<input type="text" name="name" id="name" class="form-control" required="required">
			</div>
			<div class="form-group half-row">
				<label for="">Email*</label>
				<input type="email" name="email" id="email" class="form-control" required="required">
			</div>
			<div class="form-group half-row">
				<label for="subject">Subiect*</label>
				<select name="subject" id="subject" class="form-control" required="required">
					<option value="1">Ceva Grozav</option>
					<option value="2">Eroare pe site</option>
					<option value="3">Legat de tutoriale</option>
					<option value="4">Altceva</option>
				</select>
			</div>
			<div class="form-group half-row">
				<label for="code">Cod de securitate</label>
				<input type="text" name="code" id="code" class="form-control" required="required">
				<br>
				<img src="{{ asset('img/c.jpg') }}" alt="">
			</div>
			<div class="form-group">
				<label for="message">Mesaj</label>
				<textarea name="message" id="message" cols="30" rows="4" class="form-control" required="required"></textarea>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary pull-right" value="Trimite!">
			</div>
			<div class="clearfix"></div>
		</form>
	</div>
@endsection