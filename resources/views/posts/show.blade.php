@extends('main')

@section('title', '| View Post')

@section('content')

<div class="row">
    <div class="col-md-8">
        <img src="{{ asset('images/'.$post->image) }}" alt="" class="img-fluid">

        <h1>{{ $post->title }}</h1>
        <p class="lead">
            {!! $post->body !!}
        </p>
        <hr>
        <div class="tags">
            @foreach($post->tags as $tag)
            <span class="badge badge-info">
                {{ $tag->name }}
            </span>
            @endforeach
        </div>
        <div id="backed-comments" class="mt-3">
            <h3>
                Comments
                 <small class="text-muted">
                     {{ $post->comments()->count() }}
                      Total
                 </small>
            </h3>

            <table class="table mt-4">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Comment</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($post->comments as $comment)
                    <tr>
                        <td>{{ $comment->name }}</td>
                        <td>{{ $comment->email }}</td>
                        <td>
                            {{ substr($comment->comment, 0, 90) }}
                            {{ strlen($comment->comment) > 100 ? "..." : '' }}
                        </td>
                        <td>
                            <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-sm btn-block btn-success">
                                <span>
                                    Edit
                                </span>
                            </a>
                            <a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-sm btn-block btn-danger">
                                <span>
                                    Delete
                                </span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-4">
        <div class="bg-light border rounded p-2">
            <dl class="dl-horizontal">
                <label>URL Slug:</label>
                <p>
                    <a href="{{ url('blog/'.$post->slug) }}">
                        {{ url('blog/'.$post->slug) }}
                    </a>
                </p>
            </dl>
            <dl class="dl-horizontal">
                <label>Category:</label>
                <p>{{ $post->category->name }}</p>
            </dl>
            <dl class="dl-horizontal">
                <label>Created At:</label>
                <p>{{ date('M j, Y h:i', strtotime($post->created_at)) }}</p>
            </dl>
            <dl class="dl-horizontal">
                <label>Last Updated:</label>
                <p>{{ date('M j, Y h:i', strtotime($post->updated_at)) }}</p>
            </dl>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('posts.edit', 'Edit', [$post->id], ['class'=>'btn btn-primary btn-block']) !!}
                </div>
                <div class="col-sm-6">

                    {!! Form::open(['route' => ['posts.destroy', $post->id], 'method'=>'DELETE']) !!}                     
                    
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-block']) !!}

                    {!! Form::close() !!}

                </div>
                <div class="col-md-12 mt-4">
                    {!! Html::linkRoute('posts.index', '<< See All Posts', null, ['class'=>'btn btn-block btn-info']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection