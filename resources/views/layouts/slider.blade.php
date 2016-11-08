<div class="carousel slide" id="myCarousel">
    <div class="carousel-inner">
        <div class="item active">
                <ul class="thumbnails">
                	@foreach($random_lessons as $lesson)
                        <li class="col-sm-3">
    						<div class="fff">
								<div class="thumbnail">
									<a href="{{ route('lesson', $lesson->slug) }}"><img src="{{ asset('uploads/lessons/pictures/'.$lesson->picture) }}" alt=""></a>
									<hr>
									<h4><a href="{{ route('lesson', $lesson->slug) }}">{{ $lesson->name }}</a></h4>
								</div>
								<div class="caption">
									<!-- <h4>{{ $lesson->name }}</h4> -->
									<!-- <p>{{ $lesson->description }}</p> -->
									<!-- <a class="btn btn-mini" href="{{ route('lesson', $lesson->slug) }}">» Read More</a> -->
								</div>
                            </div>
                        </li>
                	@endforeach

                </ul>
          </div>
    </div>                             
</div>
<br>