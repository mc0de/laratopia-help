<?php

namespace App\Observers;

use App\Models\Design;
use App\Models\User;
use App\Notifications\DataChangeEmailNotification;
use Notification;

class DesignObserver
{
    public function created(Design $design): void
    {
        $payload = [
            'action' => 'created',
            'model'  => sprintf('%s#%s', get_class($design), $design->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }

    public function updated(Design $design): void
    {
        $payload = [
            'action' => 'updated',
            'model'  => sprintf('%s#%s', get_class($design), $design->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }

    public function deleted(Design $design): void
    {
        $payload = [
            'action' => 'deleted',
            'model'  => sprintf('%s#%s', get_class($design), $design->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }
}
