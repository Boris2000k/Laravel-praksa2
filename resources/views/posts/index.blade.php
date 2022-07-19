@extends('layout')

@section('content')
<div class="row">
    <div class="col-8">


        @forelse ($posts as $post)
            <p>
                
                <h3>
                    @if($post->trashed())
                        <del>
                    @endif
                    <a class="{{ $post->trashed() ? 'text-muted' : '' }}" }} href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
                    @if($post->trashed())
                        </del>
                    @endif
                </h3>

                @updated(['date'=>$post->created_at, 'name' => $post->user->name])
                @endupdated


                @if($post->comments_count)
                    <p clas>{{ $post->comments_count }} comments</p>
                @else
                    <p>No comments yet!</p>
                @endif
                
                @if(!$post->trashed())
                    @can('update',$post)
                        <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                            class="btn btn-primary mb-3">
                            Edit
                        </a>
                    @endcan
                @endif

                {{-- @cannot('delete',$post)
                    <p>You can't delete this post!</p>
                @endcannot --}}

                @can('delete',$post)
                    <form method="POST" class="fm-inline"
                        action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                        @csrf
                        @method('DELETE')

                        <input type="submit" value="Delete!" class="btn btn-primary"/>
                    </form>
                @endcan
            </p>
        @empty
            <p>No blog posts yet!</p>
        @endforelse
    </div>
        <div class="col-4">
            <div class="container">
                <div class="row">
                    @card(['title'=>'Most Commented'])
                    @slot('subtitle')
                    What people are currently taking about
                    @endslot
                    @slot('items')
                    @foreach($mostCommented as $post)
                    <a href="{{ route('posts.show',['id' => $post->id]) }}"> 
                        <li class="list-group-item">{{ $post->title }}</li>
                    </a>
                    
                @endforeach
                    @endslot
                @endcard
                </div>

                <div class="row mt-4">
                    @card(['title'=>'Most Active'])
                        @slot('subtitle')
                        Users with most posts written
                        @endslot
                        @slot('items', collect($mostActive)->pluck('name'))
                    @endcard
                </div>
                
                <div class="row mt-4">
                    @card(['title'=>'Most Active Last Month'])
                        @slot('subtitle')
                        Users with most posts written in the month
                        @endslot
                        @slot('items', collect($mostActiveLastMonth)->pluck('name'))
                    @endcard
                
                </div>
            </div>
    </div>
</div>
@endsection('content')