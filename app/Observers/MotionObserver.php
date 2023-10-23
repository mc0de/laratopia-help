<?php

namespace App\Observers;

use App\Models\Motion;
use App\Models\User;
use App\Notifications\DataChangeEmailNotification;
use Notification;

class MotionObserver
{
    public function created(Motion $motion): void
    {
        $payload = [
            'action' => 'created',
            'model'  => sprintf('%s#%s', get_class($motion), $motion->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }

    public function updated(Motion $motion): void
    {
        $payload = [
            'action' => 'updated',
            'model'  => sprintf('%s#%s', get_class($motion), $motion->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }

    public function deleted(Motion $motion): void
    {
        $payload = [
            'action' => 'deleted',
            'model'  => sprintf('%s#%s', get_class($motion), $motion->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }
}
