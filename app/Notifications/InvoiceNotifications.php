<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoiceNotifications extends Notification
{
    use Queueable;
    private $invoice_id;
    private $byUser;
    private $title;
    public function __construct($invoice_id, $byUser, $title)
    {
        $this->invoice_id = $invoice_id;
        $this->byUser = $byUser;
        $this->title = $title;
    }
    public function via(object $notifiable): array
    {
        return ['database'];
    }


    public function toDatabase($notifiable)
    {
        return [
            'invoice_id' => $this->invoice_id,
            'byUser' => $this->byUser,
            'title' => $this->title,
        ];
    }
}
