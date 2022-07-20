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