@extends('main')

@section('title', '| All Tags')

@section('content')

<div class="row">
	<div class="col-md-8 mx-auto">
		<h1>Tags</h1>
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
				</tr>
			</thead>
			<tbody>
				@foreach($tags as $tag)
				<tr>
					<td>{{ $tag->id }}</td>
					<td><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="col-md-3">
		<div class="card mt-4">
			<div class="card-body">
				{!! Form::open(['route'=>'tags.store', 'method'=>'POST']) !!}
					<h2>New Tag</h2>

					{{ Form::label('name', 'Name:')}}
					{{ Form::text('name', null, ['class'=>'form-control'])}}

					{{ Form::submit('Create New Tag', ['class'=>'btn btn-primary btn-block mt-3'])}}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection