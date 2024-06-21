<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Send_Document extends Notification
{
    use Queueable;
    private $document_Id;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->document_Id = $document_Id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
   

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
   public function toDatabase($notifiable){
    return [
        'data' => $this->details['body']    
    ];  
   }
}
