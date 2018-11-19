@extends('main')

@section('title', '| Register')

@section('content')

<div class="row">
    <div class="col-md-6 mx-auto">
        {!! Form::open() !!}

        {{ Form::label('name', "Name:") }}
        {{ Form::text('name', null, ['class'=>'form-control']) }}

        {{ Form::label('email', "Email:") }}
        {{ Form::text('email', null, ['class'=>'form-control']) }}

        {{ Form::label('password', "Password:") }}
        {{ Form::text('password', null, ['class'=>'form-control']) }}

        {{ Form::label('password_confirmation', 'Confirm Password') }}
        {{ Form::password('password_confirmation', ['class'=>'form-control mb-3']) }}

        {{ Form::submit('Register', ['class'=>'form-control']) }}

        {!! Form::close() !!}
    </div>
</div>

@endsection