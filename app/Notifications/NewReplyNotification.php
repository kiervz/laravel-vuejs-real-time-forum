<?php

namespace App\Notifications;

use App\Http\Resources\ReplyResource;
use App\Models\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewReplyNotification extends Notification
{
    use Queueable;

    public $reply;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'reply_id' => $this->reply->id,
            'replyBy' => $this->reply->user->name,
            'body' => $this->reply->body,
            'path' => $this->reply->question->path,
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'reply_id' => $this->reply->id,
            'replyBy' => $this->reply->user->name,
            'body' => $this->reply->body,
            'path' => $this->reply->question->path,
            'created_at' => $this->reply->created_at->format('F j - h:i A'),
            'reply' => new ReplyResource($this->reply),
        ]);
    }
}
