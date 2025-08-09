<?php

namespace App\Notifications;

use App\Models\Position;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VoteConfirmation extends Notification implements ShouldQueue
{
    use Queueable;

    protected $position;
    protected $candidateNames;

    /**
     * Create a new notification instance.
     */
    public function __construct(Position $position, array $candidateNames)
    {
        $this->position = $position;
        $this->candidateNames = $candidateNames;
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
            ->subject('Vote Confirmation - ' . $this->position->name)
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Your vote has been successfully recorded for the position: **' . $this->position->name . '**');

        if (count($this->candidateNames) > 0) {
            $message->line('You voted for: ' . implode(', ', $this->candidateNames));
        }

        return $message
            ->line('Thank you for participating in the election!')
            ->action('View Results', route('results'))
            ->line('If you did not cast this vote, please contact the election administrator immediately.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'position_id' => $this->position->id,
            'position_name' => $this->position->name,
            'candidates' => $this->candidateNames,
        ];
    }
}
