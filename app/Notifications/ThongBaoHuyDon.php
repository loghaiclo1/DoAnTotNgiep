<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ThongBaoHuyDon extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Cập nhật trạng thái yêu cầu hủy đơn hàng')
            ->greeting('Xin chào ' . $notifiable->HoTen)
            ->line($this->message)
            ->action('Xem đơn hàng', url('/account'))
            ->line('Cảm ơn bạn đã mua sắm tại BookShop!');
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
