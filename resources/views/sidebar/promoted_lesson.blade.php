@if( isset($promotedSidebar) )
<aside class="sidebar">
	<section class="{{ $promotedSidebar->slug }}">
		<h4><a href="{{ route('lesson', $promotedSidebar->slug) }}">{{ $promotedSidebar->name }}</a></h4>
	</section>
</aside>
@endif