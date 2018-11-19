@extends('main')

@section('title', '| Delete Comment')

@section('content')

	<div class="row">
		<div class="col-md-8 mx-auto">
			<h1>DELETE THIS COMMENT?</h1>
			<p>
				<strong>
					Name: {{ $comment->name }} <br>
				</strong>
				<strong>
					Email: {{ $comment->email }} <br>
				</strong>
				<strong>
					Comment: {{ $comment->comment }} <br>
				</strong>
			</p>

			{{ Form::open(['route'=>['comments.destroy', $comment->id], 'method'=> 'DELETE']) }}

			{{ Form::submit('YES DELETE THIS COMMENT', ['class'=>'btn btn-lg btn-block btn-danger']) }}

			{{ Form::close() }}
		</div>
	</div>

@endsection