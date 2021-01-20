<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LastLeave implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $h_name;
    public $f_number;
    public $b_number;
    public $b_message;
    public $channel_name;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($channel_name, $h_name, $f_number, $b_number, $b_message)
    {
        $this->h_name = $h_name;
        $this->f_number = $f_number;
        $this->b_number = $b_number;
        $this->b_message = $b_message;
        $this->channel_name = $channel_name;
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
