<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Hinaloe\LineNotify\Message\LineMessage;

class LineNotification extends Notification// implements ShouldQueue
{
    use Queueable;
    
    /** @var User  */
    protected $user;
    
    /**
     * Create a new notification instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user  = $user;
    }
    
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['line'];
    }
    
    /**
     * @param mixed $notifable callee instance
     * @return LineMessage 
     */
    public function toLine($notifable)
    {
        return (new LineMessage())->message('New user: ' . $this->user->name)
            ->imageUrl('https://example.com/sample.jpg') // With image url (jpeg only)
            ->imageFile('/path/to/image.png') // With image file (png/jpg/gif will convert to jpg)
            ->sticker(40, 2); // With Sticker
    }
}