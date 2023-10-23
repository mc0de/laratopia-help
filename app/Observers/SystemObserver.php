<?php

namespace App\Observers;

use App\Models\System;
use App\Models\User;
use App\Notifications\DataChangeEmailNotification;
use Notification;

class SystemObserver
{
    public function created(System $system): void
    {
        $payload = [
            'action' => 'created',
            'model'  => sprintf('%s#%s', get_class($system), $system->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }

    public function updated(System $system): void
    {
        $payload = [
            'action' => 'updated',
            'model'  => sprintf('%s#%s', get_class($system), $system->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }

    public function deleted(System $system): void
    {
        $payload = [
            'action' => 'deleted',
            'model'  => sprintf('%s#%s', get_class($system), $system->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }
}
