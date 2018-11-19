@extends('main')

@section('title', '| Edit Post')


@section('stylesheets')
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

{!! Form::model($post, ['route' => ['posts.update', $post->id], 'method'=>'PUT', 'files'=>true]) !!}
<div class="row">
    <div class="col-md-8">
        {{ Form::label('title', 'Title:') }}
        {{ Form::text('title', null, ["class"=>"form-control"]) }}

        {{ Form::label('slug', 'Slug:', ['class'=>'my-2']) }}
        {{ Form::text('slug', null, ['class'=>'form-control']) }}

        {{ Form::label('category_id', 'Category:', ['class'=>'my-2']) }}
        {{ Form::select('category_id', $categories, null, ['class'=>'form-control']) }}

        {{ Form::label('tags', 'Tags:', ['class'=>'my-2']) }}
        {{ Form::select('tags[]', $tags, null, ['class'=>'form-control select2', 'multiple'=>'multiple']) }}

        {{ Form::label('featured_image', "Upload Feature Image:") }}
        {{ Form::file('featured_image') }}

        {{ Form::label('body', 'Body:', ["class"=>'my-2']) }}
        {{ Form::textarea('body', null, ["class"=> "form-control"]) }}
    </div>
    
    <div class="col-md-4">
        <div class="bg-light border rounded p-2">
            <dl class="dl-horizontal">
                <dt>Created At:</dt>
                <dd>{{ date('M j, Y h:i', strtotime($post->created_at)) }}</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Last Updated:</dt>
                <dd>{{ date('M j, Y h:i', strtotime($post->updated_at)) }}</dd>
            </dl>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('posts.show', 'Cancel', [$post->id], ['class'=>'btn btn-danger btn-block']) !!}
                </div>
                <div class="col-sm-6">
                    {{ Form::submit('Save Changes', ['class'=>'btn btn-success btn-block'])}}
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

@endsection

@section('scripts')

{!! Html::script('js/select2.min.js') !!}

<script type="text/javascript">
    $(".select2").select2();
</script>

@endsection