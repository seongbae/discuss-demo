<?php

namespace Tests\Feature;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;
use Seongbae\Discuss\Models\Channel;
use Seongbae\Discuss\Models\Thread;
use Seongbae\Discuss\Models\Reply;
use Log;

class ThreadSubscriptionTest extends TestCase
{
    protected $user, $channel, $faker, $thread, $url;

    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->faker = Factory::create();
        $this->channel = Channel::create(['name'=>'Test Channel','slug'=>'test-channel']);
        $this->thread = Thread::create(
            [
                'name'=>'Test Thread',
                'user_id'=>$this->user->id,
                'user_type'=>User::class,
                'slug'=>'test-thread',
                'channel_id'=>$this->channel->id,
                'title'=>'Test Title',
                'body'=>'Test Body1'
            ]);
        $this->url = '/discuss/'.$this->channel->slug.'/'.$this->thread->slug.'/replies';
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_subscribe_to_thread()
    {
        $this->actingAs($this->user);

        $response = $this->post($this->url, [
            'body'=>'Test Body'
        ]);

        $this->assertCount(1, Reply::all());

    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_unsubscribe_from_thread()
    {
        $this->actingAs($this->user);

        $response = $this->post($this->url, [
            'body'=>'Test Body'
        ]);

        $reply = Reply::first();

        $response = $this->patch('/replies/'.$reply->id, [
            'body'=>'Updated Body'
        ]);

         $this->assertEquals('Updated Body', Reply::first()->body);
    }

}
