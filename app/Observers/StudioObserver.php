<?php

namespace App\Observers;

use App\Models\Studio;
use App\Models\User;
use App\Notifications\DataChangeEmailNotification;
use Notification;

class StudioObserver
{
    public function created(Studio $studio): void
    {
        $payload = [
            'action' => 'created',
            'model'  => sprintf('%s#%s', get_class($studio), $studio->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }

    public function updated(Studio $studio): void
    {
        $payload = [
            'action' => 'updated',
            'model'  => sprintf('%s#%s', get_class($studio), $studio->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }

    public function deleted(Studio $studio): void
    {
        $payload = [
            'action' => 'deleted',
            'model'  => sprintf('%s#%s', get_class($studio), $studio->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }
}
