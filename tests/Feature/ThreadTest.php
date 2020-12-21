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
use Log;

class ThreadTest extends TestCase
{
    protected $user;

    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->faker = Factory::create();
        $this->channel = Channel::create(['name'=>'Test Channel','slug'=>'test-channel']);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_thread_can_be_created()
    {
        $this->actingAs($this->user);

        $response = $this->post('/discuss', [
            'title'=>'Test Title',
            'slug'=>'test-title',
            'channel_id'=>$this->channel->id,
            'body'=>'Test Body'
        ]);

        $this->assertCount(1, Thread::all());

    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_thread_can_be_retrieved()
    {
        $this->actingAs($this->user);

        $this->post('/discuss', [
            'title'=>'Test Title',
            'slug'=>'test-title',
            'channel_id'=>$this->channel->id,
            'body'=>'Test Body'
        ]);

        $thread = Thread::first();

        $this->assertEquals('Test Title', Thread::first()->title);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_thread_can_be_updated()
    {
        $this->actingAs($this->user);

        $this->post('/discuss', [
            'title'=>'Test Title',
            'slug'=>'test-title',
            'channel_id'=>$this->channel->id,
            'body'=>'Test Body'
        ]);

        $thread = Thread::first();

        $response = $this->patch($thread->path(), [
            'title' => 'New Title',
            'slug'=>'new-title',
            'channel_id'=>$this->channel->id,
            'body'=>'New Body'
        ]);

         $this->assertEquals('New Title', Thread::first()->title);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_thread_can_be_deleted()
    {
        $this->actingAs($this->user);

        $this->post('/discuss', [
            'title'=>'Test Title',
            'slug'=>'test-title',
            'channel_id'=>$this->channel->id,
            'body'=>'Test Body'
        ]);

        $thread = Thread::first();

        $response = $this->delete($thread->path());

        $this->assertCount(0, Thread::all());
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_thread_listing_can_be_retrieved()
    {
        $this->actingAs($this->user);

        $this->post('/discuss', [
            'title'=>'Test Title 1',
            'slug'=>'test-title',
            'channel_id'=>$this->channel->id,
            'body'=>'Test Body'
        ]);

        $this->post('/discuss', [
            'title'=>'Test Title 2',
            'slug'=>'test-title',
            'channel_id'=>$this->channel->id,
            'body'=>'Test Body'
        ]);

        $this->get('/discuss')
            ->assertSee('Test Title 1')
            ->assertSee('Test Title 2');

    }
}
