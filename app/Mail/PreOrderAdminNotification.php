<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PreOrderAdminNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $preOrder;

    public function __construct($preOrder)
    {
        $this->preOrder = $preOrder;
    }

    public function build()
    {
        return $this->subject('New PreOrder Notification')
            ->view('emails.preorder.admin_notification') // Your email template
            ->with([
                'preOrder' => $this->preOrder
            ]);
    }
}
