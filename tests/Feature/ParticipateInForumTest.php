<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    public function test_unauthenticated_users_may_not_add_replies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $response = $this->post('/threads/1/replies', []);
        if (isset($response->exception)) {
            throw $response->exception;
        }
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
        $response = $this->post('/threads', []);
        if (isset($response->exception)) {
            throw $response->exception;
        }
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
