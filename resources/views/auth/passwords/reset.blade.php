@extends('main')

@section('title', '| Forgot My Password')

@section('content')

<div class="row">
	<div class="col-md-6 mx-auto">
		<div class="card">
			<div class="card-body">
				<div class="card-title">
					<h3>Reset Password</h3>
				</div>
				{!! Form::open(['url'=>'password/reset', 'method'=>'POST']) !!}
				
				{{ Form::hidden('token', $token) }}

				{{ Form::label('email', 'Email Address:') }}
				{{ Form::email('email', $email, ['class'=>'form-control']) }}

				{{ Form::label('password', 'New Password:') }}
				{{ Form::password('password', ['class'=>'form-control']) }}

				{{ Form::label('password_confirmation', 'Confrim Password:') }}
				{{ Form::password('password_confirmation', ['class'=>'form-control']) }}

				{{ Form::submit('Reset Password', ['class'=>'btn btn-primary mt-3']) }}

				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>

@endsection