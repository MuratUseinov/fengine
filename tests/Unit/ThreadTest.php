<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
    public function test_a_thread_has_replies()
    {
        $thread = factory('App\Thread')->create();

        $this->assertInstanceOf(Collection::class, $thread->replies);
    }

    public function test_a_thread_has_a_creator()
    {
        $thread = factory('App\Thread')->create();

        $this->assertInstanceOf(User::class, $thread->creator);
    }
    public function test_a_thread_can_add_reply()
    {
        $thread = factory('App\Thread')->create();

        $thread->addReply([
            'body' => 'Foo Bar',
            'user_id' => 1,
        ]);

        $this->assertCount(1, $thread->replies);
    }
}
