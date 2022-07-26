@component('mail::message')
# A Comment was posted on your blog post

<p> Hi {{ $comment->commentable->user->name }}</p>

Someone has commented on your blog post


@component('mail::button', ['url' =>  route('posts.show', ['post'=>$comment->commentable->id]) ])
View the Blog Post
@endcomponent

@component('mail::button', ['url' =>  route('users.show', ['user'=>$comment->user->id]) ])
Visit {{ $comment->user->name }} profile
@endcomponent



Thanks,<br>
{{ config('app.name') }}
@endcomponent
