<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Reset implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $b_message;
    public $channel_name;
    public $request;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($channel_name, $request, $b_message)
    {
        $this->b_message = $b_message;
        $this->channel_name = $channel_name;
        $this->request = $request;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel($this->channel_name);
    }
}
