<?php

namespace App\Observers;

use App\Models\Ad;
use App\Models\User;
use App\Notifications\DataChangeEmailNotification;
use Notification;

class AdObserver
{
    public function created(Ad $ad): void
    {
        $payload = [
            'action' => 'created',
            'model'  => sprintf('%s#%s', get_class($ad), $ad->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }

    public function updated(Ad $ad): void
    {
        $payload = [
            'action' => 'updated',
            'model'  => sprintf('%s#%s', get_class($ad), $ad->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }

    public function deleted(Ad $ad): void
    {
        $payload = [
            'action' => 'deleted',
            'model'  => sprintf('%s#%s', get_class($ad), $ad->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }
}
