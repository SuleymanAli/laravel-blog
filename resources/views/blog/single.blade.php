@extends('main')

@section('title', "| $post->title")

@section('content')
<div class="row">
	<div class="col-md-8 mx-auto">
		@if(isset($post->image))
		<img src="{{ asset('images/'.$post->image) }}" class="img-fluid">
		@endif
		<h1>{{ $post->title }}</h1>
		<p>{!! $post->body !!}</p>
		<hr>
		<p>Posted In: {{ $post->category->name }}</p>
	</div>
</div>
<div class="row">
	<div class="col-md-8 mx-auto">
		@foreach($post->comments as $comment)
		<div class="comment jumbotron p-4 my-3 bg-info text-white">
			<p><strong>Name: </strong>
				{{ $comment->name }}
			</p>
			<p><strong>Comment: </strong><br>
				{{ $comment->comment }}
			</p>
		</div>
		@endforeach
	</div>
</div>
<div class="row">
	<div id="comment-form" class="mx-auto">
		{{ Form::open(['route'=>['comments.store', $post->id], 'method'=>'POST']) }}

		<div class="row">
			<div class="col-md-5 ml-auto">
				{{ Form::label('name', 'Name:', ['class'=>'mt-3']) }}
				{{ Form::text('name', null, ['class'=>'form-control']) }}
			</div>
			<div class="col-md-5 mr-auto">
				{{ Form::label('email', 'Email:', ['class'=>'mt-3']) }}
				{{ Form::text('email', null, ['class'=>'form-control']) }}
			</div>
			<div class="col-md-10 mx-auto">
				{{ Form::label('comment', 'Comment:') }}
				{{ Form::textarea('comment', null, ['class'=>'form-control', 'rows'=>'5']) }}

				{{ Form::submit('Add Comment', ['class'=>'btn btn-block btn-success mt-3']) }}
			</div>
		</div>

		{{ Form::close() }}
	</div>
</div>
@endsection