@extends('main')

@section('title', '| Forgot My Password')

@section('content')

<div class="row">
	<div class="col-md-6 mx-auto">
		<div class="card">
			<div class="card-body">
				<div class="card-title">
					<h3>Reset Password With Email</h3>
				</div>
				{!! Form::open(['url'=>'password/email', 'method'=>'POST']) !!}

				{{ Form::label('email', 'Email Address:') }}
				{{ Form::email('email', null, ['class'=>'form-control']) }}

				{{ Form::submit('Reset Password', ['class'=>'btn btn-primary mt-3']) }}

				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>

@endsection