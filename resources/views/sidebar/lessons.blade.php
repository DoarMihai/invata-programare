<section>
<h4>Cuprins</h4>
<ul>
	@foreach($lessons as $lesson)
		<li><a href="{{ route('article', getArticle($lesson->article_id)->slug) }}">{{ getArticle($lesson->article_id)->name }}</a></li>
	@endforeach
</ul>
</section>