<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ElectionStarted extends Notification implements ShouldQueue
{
    use Queueable;

    protected $electionName;
    protected $endDate;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $electionName = 'Election', $endDate = null)
    {
        $this->electionName = $electionName;
        $this->endDate = $endDate;
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
        $message = (new MailMessage)
            ->subject('Election Has Started - Cast Your Vote Now!')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('The **' . $this->electionName . '** has officially started!')
            ->line('You can now cast your vote for the available positions.');

        if ($this->endDate) {
            $message->line('Voting ends on: **' . $this->endDate . '**');
        }

        return $message
            ->action('Vote Now', route('vote.index'))
            ->line('Make sure to cast your vote before the election ends!')
            ->line('Thank you for your participation.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'election_name' => $this->electionName,
            'end_date' => $this->endDate,
        ];
    }
}
