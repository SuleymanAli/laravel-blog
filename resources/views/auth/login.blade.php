@extends('main')

@section('title', '| Login')

@section('content')

<div class="row">
    <div class="col-lg-5 col-md-8 col-sm-12 mx-auto">
        {!! Form::open() !!}

        {{ Form::label('email', 'Email:')}}
        {{ Form::email('email', null, ['class'=>'form-control']) }}

        {{ Form::label('password', "Password:", ['class'=>'mt-3']) }}
        {{ Form::password('password', ['class'=>'form-control mb-3']) }}

        {{ Form::checkbox('remember') }}
        {{ Form::label('remember', 'Remember Me')}}

        {{ Form::submit('Login', ['class'=>'btn btn-block btn-danger mt-3']) }}

        <p class="mt-3">
            <a href="{{ url('password/reset') }}">
                Forgot Password
            </a>
        </p>

        {!! Form::close() !!}
    </div>
</div>

@endsection