<?php

use App\Models\Feedback;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('feedback.admin', function ($user) {
    return (int) $user->type === 1;
});

Broadcast::channel('feedback.thread.{feedback}', function ($user, Feedback $feedback) {
    $isCustomerOwner = (int) $user->id === (int) $feedback->id_user;
    $isDeveloper = (int) $user->type === 1;

    return $isCustomerOwner || $isDeveloper;
});