<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserResetPasswordNotification extends Notification
{
    use Queueable;

    private $token;

    /**
     * Create a new notification instance.
     *
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
//            ->view('auth.passwords.mail')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('تغییر رمز عبور')
            ->greeting('با سلام')
            ->line('این ایمیل بنا به درخواست شما برای تغییر رمز عبور ارسال شده است .')
            ->action('لینک تغییر رمز عبور', route('password.reset', $this->token))
            ->line('اگر چنین در خواستی از طرف شما ارسال نشده است، آن را نادیده بگیرید.');
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
            //
        ];
    }
}
