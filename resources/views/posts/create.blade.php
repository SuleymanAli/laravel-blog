@extends('main')

@section('title', '| Create New Post')

@section('stylesheets')
{!! Html::style('css/parsley.css') !!}
{!! Html::style('css/select2.min.css') !!}

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>
    tinymce.init({ 
        selector:'textarea',
        plugins: 'link code'
    });
</script>
@endsection

@section('content')

<div class="row">
    <div class="col-md-8 mx-auto mt-5">
        <h1>Create New Post</h1>
        {!! Form::open(['route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true]) !!}
        {{ Form::label('title', 'Title:') }}
        {{ Form::text('title', null, ['class'=>'form-control', 'required'=>'', 'maxlength'=>'255']) }}

        {{ Form::label('slug', 'Slug:') }}
        {{ Form::text('slug', null, ['class'=>'form-control', 'required'=>'', 'minlength'=>'5','maxlength'=>'255']) }}

        {{ Form::label('category_id', 'Category:') }}
        <select name="category_id" class="form-control">
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        {{ Form::label('tags', 'Tags:') }}
        <select name="tags[]" class="form-control select2" multiple="multiple">
            @foreach($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>

        {{ Form::label('featured_image', "Upload Feature Image:") }}
        {{ Form::file('featured_image') }}

        {{ Form::label('body', 'Body:', ['class'=>'mt-4']) }}
        {{ Form::textarea('body', null, ['class'=>'form-control', 'required'=>'']) }}

        {{ Form::submit('Create post', ['class'=>'btn btn-success btn-lg btn-block mt-4']) }}
        {!! Form::close() !!}
    </div>
</div>

@endsection

@section('scripts')
{!! Html::script('js/parsley.min.js') !!}
{!! Html::script('js/select2.min.js') !!}

<script type="text/javascript">
    $(".select2").select2();
</script>
@endsection