<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Notifications\CustomDbChannel;
use Illuminate\Notifications\Messages\BroadcastMessage;
use App\User;

class MessageSent extends Notification
{
    use Queueable;

    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $url = url('/messages/convo/'.$this->message['convo_id']);
        $userfullname = User::findOrFail($this->message['user_id']);
        return [
            'user_id' => $this->message['user_id'],
            'convo_id' => $this->message['convo_id'],
            'message' => $this->message['message'],
            'link' => $url,
            'user_name' => $userfullname->name(),
            'avatar' => $userfullname->avatar
        ];
    }

        /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toBroadcast($notifiable)
    {
        $url = url('/messages/convo/'.$this->message['convo_id']);
        $userfullname = User::findOrFail($this->message['user_id']);
        return new BroadcastMessage([
            'user' => auth()->user(),
            'convo_id' => $this->message['convo_id'],
            'message' => $this->message['message'],
            'user_name' => $userfullname->name(),
            'avatar' => $userfullname->avatar
        ]);
    }
}
