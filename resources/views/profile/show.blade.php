@extends('layouts.master')

@section('title', $data->name."'s profile - ".$defaultTitle )

@section('content')
<div class="profile-page">
<div class="row">
	<div class="col-md-12">
		<div class="lesson-page">
			{{ $data->name }}
			@if(Auth::check())
			<span class="pull-right hide">
				<a href="" data-toggle="modal" data-target="#myModal"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
			</span>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="lesson-page">
			<div class="profile-avatar">
				<img src="{{ isset($data->pic)  && !empty($data->pic) ? asset('uploads/users/'.$data->pic) : asset('img/no-avatar.png') }}" alt="" class="img img-responsive">				
			</div>
			<span class="profile-title">Educatie</span>
				<span class="education-list">
					@foreach($data->education as $edu)
						{{ $edu->name }}
					@endforeach
				</span>
			<span class="profile-title">Munca</span>
			<span class="profile-title">Reputatie</span>
				@if($data->points > 0 && $data->points < 30)
					<strong>Apprentice</strong>
				@elseif($data->points > 30 && $data->points < 50)	
					<strong>Newbie</strong>
				@elseif($data->points > 50 && $data->points < 75)	
					<strong>Junior</strong>
				@elseif($data->points > 75 && $data->points < 100)	
					<strong>Middle</strong>
				@elseif($data->points > 100 && $data->points < 120)	
					<strong>Mentor</strong>
				@elseif($data->points > 120)	
					<strong>Guru</strong>
				@endif
			<span class="profile-title">
				Contact
				@if($data->id == Auth::user()->id)
					<span class="pull-right">
						<a href="{{ route('user.editcontact') }}" style="font-weight: 300;"><i class="fa fa-pencil"></i> Edit</a>
					</span>
				@endif
			</span>
				@if(isset($data->contact) && $data->contact != null && isset($data->contact[0]))
					@if(isset($data->contact[0]->facebook) && $data->contact[0]->facebook != null)
						<a href="{{ $data->contact[0]->facebook }}" target="_blank"><img src="{{ asset('img/social/fb.png') }}" alt="Facebook account" width="30"></a>
					@endif
					@if(isset($data->contact[0]->twitter) && $data->contact[0]->twitter != null)
						<a href="{{ $data->contact[0]->twitter }}" target="_blank"><img src="{{ asset('img/social/tw.png') }}" alt="Twitter account" width="30"></a>
					@endif
					@if(isset($data->contact[0]->gplus) && $data->contact[0]->gplus != null)
						<a href="{{ $data->contact[0]->gplus }}" target="_blank"><img src="{{ asset('img/social/gp.png') }}" alt="Google plus account" width="30"></a>
					@endif
					@if(isset($data->contact[0]->linkedin) && $data->contact[0]->linkedin != null)
						<a href="{{ $data->contact[0]->linkedin }}" target="_blank"><img src="{{ asset('img/social/li.png') }}" alt="LinkedIn account" width="30"></a>
					@endif
					@if(isset($data->contact[0]->skype) && $data->contact[0]->skype != null)
						<a href="{{ $data->contact[0]->skype }}" target="_blank"><img src="{{ asset('img/social/sk.png') }}" alt="Skype account" width="30"></a>
					@endif
				@else
					<em>No Info</em>
				@endif
				<?php //var_dump($data->contact->toArray()); ?>

		</div>
	</div>
	<div class="col-md-8">
		<div class="lesson-page">
			@if($data->about != '')
				{{ $data->about }}
			@else
				<em>Utilizatorul nu a completat acest camp!</em>
			@endif	
		</div>
		
		<div>
		  <!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
		    	<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-star-o"></i> Portofoliu</a></li>
		    	<li role="presentation"><a href="#posts" aria-controls="posts" role="tab" data-toggle="tab"><i class="fa fa-folder-o"></i> Forum</a></li>
		  	</ul>
		  <!-- Tab panes -->
			<div class="tab-content profile-tabs">
		    	<div role="tabpanel" class="tab-pane active" id="home">
		
					@if($data->portfolios && $data->portfolios->count())
						@foreach($data->portfolios as $item)
							<div class="lesson-page">
								@if( Auth::check() && Auth::user()->id == $item->user_id )
									<a href="{{ route('profile.portfolio.item', $item->id) }}" class="pull-right"><i class="fa fa-pencil"></i> Edit Item</a>
								@endif
								<h4>{{ $item->name }}</h4>
								<img src="{{ asset('uploads/portfolios/'.$data->id.'/'.$item->pic) }}" alt="" class="img img-responsive">
								<strong>Descriere</strong>
									<p>{{ $item->description }}</p>
								<strong>Tehnologii folosite</strong>
									<p>{{ $item->skills }}</p>
								@if($item->link)
								<strong>Link</strong>
									<a href="{{ $item->link }}" target="_blank">Adresa site</a>
								@endif
							</div>
							<hr>
						@endforeach
					@else
						<em>Acest utilizator nu a postat in portofoliu</em>	
					@endif

		    	</div>
		    	<div role="tabpanel" class="tab-pane" id="posts">
		    		<br>
		    		<h3>Topicuri Create</h3>
		    		<hr>
		    			@if(isset($topics) && count($topics) > 0)
		    				@foreach($topics as $topic)
			    			<div class="profile-topic">
				    			<div class="row">
				    				<div class="col-md-8">
				    					<a href="{{ route('forum.topic.index', $topic->slug) }}">{{ $topic->name }}</a> <br>
				    					<em>{{ strlen($topic->description) > 40 ? substr($topic->description, 0, 40).'...' : $topic->description }}</em>
				    					<br><strong>Thread: </strong> <a href="">{{ getThreadData($topic->thread_id)->name }}</a>
				    				</div>
				    				<div class="col-md-4">
				    					<small>
				    						Creat de <a href="{{ route('profile.index', $topic->posted_by) }}">{{ getUser($topic->posted_by)->name }}</a> {{ $topic->created_at->diffForHumans() }}
				    					</small>
				    				</div>
				    			</div>	
			    			</div>		    				
		    				@endforeach
		    				<br>
		    			@else
		    				<em>Acest utilizator nu a creat un topic inca.</em>
		    			@endif
		    		<h3>Am postat in</h3>
		    		<hr>
			    		@if(isset($posts) && $posts != '')
		    				@foreach($posts as $post)
		    				@if(getUser($post['topics']['posted_by']) !== null && $post['topics']['created_at'] !== null)
			    			<div class="profile-topic">
				    			<div class="row">
				    				<div class="col-md-8">
				    					<a href="{{ route('forum.topic.index', $post['topics']['slug']) }}">{{ $post['topics']['name'] }}</a> <br>
				    					<em>{{ strlen($post['topics']['description']) > 40 ? substr($post['topics']['description'], 0, 40).'...' : $post['topics']['description'] }}</em>
				    					<br><strong>Thread: </strong> <a href="">{{ getThreadData($post['topics']['thread_id'])->name }}</a>
				    				</div>
				    				<div class="col-md-4">
				    					<small>
				    						Creat de <a href="{{ route('profile.index', $post['topics']['posted_by']) }}">{{ getUser($post['topics']['posted_by']) !== null ? getUser($post['topics']['posted_by'])->name : 'Unknown' }}</a> {{ $post['topics']['created_at'] !== null ? $post['topics']['created_at']->diffForHumans() : '' }}
				    					</small>
				    				</div>
				    			</div>	
			    			</div>
			    			@endif
		    				@endforeach
			    		@endif
		    	</div>
		  	</div>
		</div>

	<?php /*
		@if($data->portfolios && $data->portfolios->count())
			@foreach($data->portfolios as $item)
				<div class="lesson-page">
					@if( Auth::check() && Auth::user()->id == $item->user_id )
						<a href="{{ route('profile.portfolio.item', $item->id) }}" class="pull-right"><i class="fa fa-pencil"></i> Edit Item</a>
					@endif
					<h4>{{ $item->name }}</h4>
					<img src="{{ asset('uploads/portfolios/'.$data->id.'/'.$item->pic) }}" alt="" class="img img-responsive">
					<strong>Descriere</strong>
						<p>{{ $item->description }}</p>
					<strong>Tehnologii folosite</strong>
						<p>{{ $item->skills }}</p>
					@if($item->link)
					<strong>Link</strong>
						<a href="{{ $item->link }}" target="_blank">Adresa site</a>
					@endif
				</div>
			@endforeach
		@endif
		*/ ?>
	</div>
</div>
</div>
<br>

<!-- Message Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Trimite mesaj</h4>
      </div>
      <div class="modal-body">
        <form action="">
        	<div class="form-group">
        		<label for="">Subiect</label>
        		<input type="text" name="subject" class="form-control" placeholder="Subiect">
        	</div>
        	<div class="form-group">
        		<label for="">Mesaj</label>
        		<textarea name="message" id="" cols="30" rows="4" class="form-control" placeholder="Mesajul"></textarea>
        	</div>
        	<div class="form-group">
        		<label for="">Fisier</label>
        		<br><small><em>Daca vrei sa ii trimiti un fisier il poti atasa aici! (sunt acceptate: png, jpg, bmp, zip si psd)</em></small>
        		<input type="file" name="thefile">
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Inchide</button>
        <button type="button" class="btn btn-primary">Trimite</button>
      </div>
    </div>
  </div>
</div>

@endsection
