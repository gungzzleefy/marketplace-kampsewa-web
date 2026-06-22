<?php

namespace App\Events;

use App\Models\FeedbackMessage;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FeedbackMessageSent implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public function __construct(public FeedbackMessage $feedbackMessage)
    {
        $this->feedbackMessage->loadMissing('sender');
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('feedback.admin'),
            new PrivateChannel('feedback.thread.' . $this->feedbackMessage->feedback_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'feedback.message.sent';
    }

    public function broadcastWith(): array
    {
        return [
            'message' => [
                'id' => $this->feedbackMessage->id,
                'feedback_id' => $this->feedbackMessage->feedback_id,
                'sender_type' => $this->feedbackMessage->sender_type,
                'sender_name' => $this->feedbackMessage->sender?->name ?? ucfirst($this->feedbackMessage->sender_type),
                'message' => $this->feedbackMessage->message,
                'created_at' => $this->feedbackMessage->created_at->format('d M Y H:i'),
            ],
        ];
    }
}