<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;


class ImageUploaded implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $imageUrl;

    /**
     * Create a new event instance.
     *
     * @param string $imageUrl
     */
    public function __construct(string $imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     *
     * @return Channel
     */
    public function broadcastOn()
    {
        return new Channel('image-channel'); 
    }

    /**
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'image_url' => $this->imageUrl,
        ];
    }
}
