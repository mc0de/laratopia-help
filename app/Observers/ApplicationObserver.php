<?php

namespace App\Observers;

use App\Models\Application;
use App\Models\User;
use App\Notifications\DataChangeEmailNotification;
use Notification;

class ApplicationObserver
{
    public function created(Application $application): void
    {
        $payload = [
            'action' => 'created',
            'model'  => sprintf('%s#%s', get_class($application), $application->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }

    public function updated(Application $application): void
    {
        $payload = [
            'action' => 'updated',
            'model'  => sprintf('%s#%s', get_class($application), $application->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }

    public function deleted(Application $application): void
    {
        $payload = [
            'action' => 'deleted',
            'model'  => sprintf('%s#%s', get_class($application), $application->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }
}
