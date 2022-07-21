@extends('layout')

@section('content')
    <div class="row">
        <div class="col-8">
            @if($post->image)
            <div style="background-image: url('{{ Storage::url($post->image->path) }}'); min-height:500px; color:white; text-align:center; background-attachment:fixed;"> </div>
            <h1 style="padding-top:100px; text-shadow: 1px 2px #000">
            @else
                <h1>
            @endif
            <h1>{{ $post->title }}
                
                @badge(['show'=> now()->diffInMinutes($post->created_at) < 30])
                New post!
                @endbadge
            
            </h1>
            <p>{{ $post->content }}</p>

            {{-- <img src="{{ asset($post->image->path) }}"/> --}}
            {{-- <img src="{{ Storage::url($post->image->path) }}"/> --}}

            @updated(['date'=>$post->created_at, 'name' => $post->user->name])
            @endupdated

            @updated(['date'=>$post->updated_at])
            Updated
            @endupdated

            @tags(['tags' => $post->tags])
            @endtags

            <p>Currently read by {{ $counter }} people</p>

            

            <h4>Comments</h4>

            @include('comments._form')

            @forelse($post->comments as $comment)
                    <p>
                        {{ $comment->content }}
                    </p>
                    @updated(['date'=>$post->created_at, 'name' => $comment->user->name])
                    @endupdated
                @empty
                    <p>No comments yet!</p>
            @endforelse
        </div>
        <div class="col-4">
        </div>
@endsection('content')