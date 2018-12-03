<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    public function test_unauthenticated_users_may_not_add_replies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('/threads/some-channel/1/replies', []);
    }

    public function test_an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->signIn();

        $thread = factory(Thread::class)->create();
        $reply = factory(Reply::class)->make();
        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }


    public function test_an_reply_require_body()
    {
        $this->withExceptionHandling()->signIn();

        $thread = factory(Thread::class)->create();
        $reply = factory(Reply::class)->make(['body' => null]);
        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->get($thread->path() . '/replies')
            ->assertSessionHasErrors('body');
    }

    public function test_unauthenticated_users_can_not_create_threads()
    {
        $this->withExceptionHandling();

        $this->get('/threads/create')
            ->assertRedirect('/login');

        $this->post('/threads', [])
            ->assertRedirect('/login');;
    }

    public function test_user_can_create_threads()
    {
        $this->signIn();

        $thread = factory(Thread::class)->make();
        $response = $this->post('/threads', $thread->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    public function publish_a_thread($overwrite = [])
    {
        $this->withExceptionHandling()->signIn();

        $thread = factory(Thread::class)->make($overwrite);

        return $this->post('/threads', $thread->toArray());
    }

    public function test_thread_requires_a_title()
    {
        $this->publish_a_thread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    public function test_thread_requires_a_body()
    {
        $this->publish_a_thread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    public function test_thread_requires_a_valid_channel()
    {
        factory('App\Channel', 2)->create();

        $this->publish_a_thread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publish_a_thread(['channel_id' => 999])
            ->assertSessionHasErrors('channel_id');
    }
}
