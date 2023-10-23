<?php

namespace App\Observers;

use App\Models\MarketResearch;
use App\Models\User;
use App\Notifications\DataChangeEmailNotification;
use Notification;

class MarketResearchObserver
{
    public function created(MarketResearch $marketResearch): void
    {
        $payload = [
            'action' => 'created',
            'model'  => sprintf('%s#%s', get_class($marketResearch), $marketResearch->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }

    public function updated(MarketResearch $marketResearch): void
    {
        $payload = [
            'action' => 'updated',
            'model'  => sprintf('%s#%s', get_class($marketResearch), $marketResearch->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }

    public function deleted(MarketResearch $marketResearch): void
    {
        $payload = [
            'action' => 'deleted',
            'model'  => sprintf('%s#%s', get_class($marketResearch), $marketResearch->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }
}
