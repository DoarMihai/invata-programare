@extends('layouts.master')

@section('content')
	<div class="contact {{ $pageData->slug }}">
		{!! $pageData->content !!}
	</div>
@endsection