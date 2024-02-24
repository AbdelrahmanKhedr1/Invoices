<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddInvoice extends Notification
{
    use Queueable;

    private $invoice_id;
    private $invoice_number;
    private $creater ;
    /**
     * Create a new notification instance.
     */
    public function __construct($invoice_id,$invoice_number,$creater)
    {
        $this->invoice_id = $invoice_id;
        $this->invoice_number = $invoice_number;
        $this->creater = $creater;
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
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable)
    {
        return [
            'creater' => $this->creater,
            'invoice_id' => $this->invoice_id,
            'invoice_number' => $this->invoice_number,
        ];
    }
}
