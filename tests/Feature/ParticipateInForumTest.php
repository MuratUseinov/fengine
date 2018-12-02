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
        $this->post('/threads/1/replies', []);
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


    public function test_unauthenticated_users_can_not_create_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('/threads', []);
    }

    public function test_unauthenticated_users_can_not_see_create_thread_page()
    {
        $this->withExceptionHandling()
            ->get('/threads/create')
            ->assertRedirect('/login');
    }

    public function test_user_can_create_threads()
    {
        $this->signIn();

        $thread = factory(Thread::class)->make();
        $this->post('/threads', $thread->toArray());

        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
