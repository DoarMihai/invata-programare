<section>
	<h4>Search</h4>
	<form action="{{ route('search') }}" method="GET">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
        	<div class="search">
				<input type="text" class="form-control input-sm" maxlength="64" placeholder="Search" name="term"/>
 				<button type="submit" class="btn btn-primary btn-sm">Search</button>
			</div>
		</div>
	</form>
</section>