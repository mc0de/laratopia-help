<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Video;
use App\Notifications\DataChangeEmailNotification;
use Notification;

class VideoObserver
{
    public function created(Video $video): void
    {
        $payload = [
            'action' => 'created',
            'model'  => sprintf('%s#%s', get_class($video), $video->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }

    public function updated(Video $video): void
    {
        $payload = [
            'action' => 'updated',
            'model'  => sprintf('%s#%s', get_class($video), $video->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }

    public function deleted(Video $video): void
    {
        $payload = [
            'action' => 'deleted',
            'model'  => sprintf('%s#%s', get_class($video), $video->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }
}
