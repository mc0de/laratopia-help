<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Website;
use App\Notifications\DataChangeEmailNotification;
use Notification;

class WebsiteObserver
{
    public function created(Website $website): void
    {
        $payload = [
            'action' => 'created',
            'model'  => sprintf('%s#%s', get_class($website), $website->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }

    public function updated(Website $website): void
    {
        $payload = [
            'action' => 'updated',
            'model'  => sprintf('%s#%s', get_class($website), $website->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }

    public function deleted(Website $website): void
    {
        $payload = [
            'action' => 'deleted',
            'model'  => sprintf('%s#%s', get_class($website), $website->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }
}
