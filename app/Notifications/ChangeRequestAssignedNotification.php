<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChangeRequestAssignedNotification extends Notification
{
    use Queueable;

    protected $changeRequestId;

    /**
     * Create a new notification instance.
     */
    public function __construct($changeRequestId)
    {
        $this->changeRequestId = $changeRequestId;
    }


    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Change Request Assigned')
            ->line('You have been assigned a change request.')
            ->action('View Change Request', route('change_requests.show', $this->changeRequestId))
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
