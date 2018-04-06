<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AnnotationCreated
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var \App\Annotation
     */

    public $annotation;

    public function __construct(\App\Annotation $annotation)
    {
        $this->annotation = $annotation;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
?>
<script type="text/javascript" src="{{ URL::asset('js/text_highlight.js') }}" /></script>
<script type="text/javascript">
    $(document).ready(function() {
        alert($('.content__article').html());
    });
</script>