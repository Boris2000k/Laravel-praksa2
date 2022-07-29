<?php

namespace Tests\Feature;

use App\BlogPost;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Comment;

class ApiPostCommentsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNewBlogPostDoesNotHaveComments()
    {
        $this->blogPost();

        $response = $this->json('GET','api/v1/posts/1/comments');

        $response->assertStatus(200);
    }

    public function testBlogPostHas10Comments()
    {
        $this->blogPost()
        ->each(function (BlogPost $post){
            $post->comments()->saveMany(
                factory(Comment::class,10)->make([
                    'user_id' => $this->user()->id
                ])
                );
        });

        $response = $this->json('GET', 'api/v1/posts/2/comments');

        $response->assertStatus(200)->assertJsonCount(10);
    }

    public function testAddingCommentsWhenNotAuthenticated()
    {
        $this->blogPost();

        $response = $this->json('POST','api/v1/posts/3/comments',[
            'content'=>'Hello'
        ]);
        
        $response->assertStatus(401);
    }

    // public function testAddingCommentsWhenAuthenticated()
    // {
    //     $this->blogPost();

    //     $response = $this->actingAs($this->user(),'api')->json('POST','api/v1/posts/4/comments',[
    //         'content'=>'Hello'
    //     ]);
        
    //     $response->assertStatus(201);
    
    // }

    // public function testAddingCommentWithInvalidData()
    // {
    //     $this->blogPost();

    //     $response = $this->actingAs($this->user(),'api')->json('POST','api/v1/posts/5/comments',[
    //         'content'=>''
    //     ]);
        
    //     $response->assertStatus(422)
    //     ->assertJson([
    //         "message" => "The given data was invalid."
    //     ]);
    // }
}