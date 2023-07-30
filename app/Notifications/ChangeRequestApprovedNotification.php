<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChangeRequestApprovedNotification extends Notification
{
    use Queueable;

    protected $changeRequest;

    /**
     * Create a new notification instance.
     */
    public function __construct($changeRequest)
    {
        $this->changeRequest = $changeRequest;
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Change Request Approved')
                    ->line('Your change request has been approved.')
                    ->action('View Change Request', route('change_requests.show', $this->changeRequest->id))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
