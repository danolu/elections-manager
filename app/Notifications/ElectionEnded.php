<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ElectionEnded extends Notification implements ShouldQueue
{
    use Queueable;

    protected $electionName;
    protected $resultsAvailable;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $electionName = 'Election', bool $resultsAvailable = false)
    {
        $this->electionName = $electionName;
        $this->resultsAvailable = $resultsAvailable;
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
            ->subject('Election Has Ended - Thank You for Voting!')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('The **' . $this->electionName . '** has officially ended.')
            ->line('Thank you for your participation!');

        if ($this->resultsAvailable) {
            $message->line('The results are now available.')
                ->action('View Results', route('results'));
        } else {
            $message->line('Results will be announced soon. Stay tuned!');
        }

        return $message->line('We appreciate your engagement in the democratic process.');
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
            'results_available' => $this->resultsAvailable,
        ];
    }
}
