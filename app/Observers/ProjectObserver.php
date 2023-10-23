<?php

namespace App\Observers;

use App\Models\Project;
use App\Models\User;
use App\Notifications\DataChangeEmailNotification;
use Notification;

class ProjectObserver
{
    public function created(Project $project): void
    {
        $payload = [
            'action' => 'created',
            'model'  => sprintf('%s#%s', get_class($project), $project->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }

    public function updated(Project $project): void
    {
        $payload = [
            'action' => 'updated',
            'model'  => sprintf('%s#%s', get_class($project), $project->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }

    public function deleted(Project $project): void
    {
        $payload = [
            'action' => 'deleted',
            'model'  => sprintf('%s#%s', get_class($project), $project->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }
}
