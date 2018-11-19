@extends('main')

@section('title', '| Edit Tag')

@section('content')


{!! Form::model($tag, ['route'=>['tags.update', $tag->id], 'method'=>"PUT"]) !!}
<div class="row">
	<div class="col-md-8 mx-auto">

		{{ Form::label('name', 'Title:') }}
		{{ Form::text('name', null, ['class'=>'form-control']) }}

		{{ Form::submit('Save Changes', ['class'=>'btn btn-success mt-3']) }}

	</div>
</div>
{!! Form::close() !!}


@endsection