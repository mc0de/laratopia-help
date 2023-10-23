<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\User;
use App\Notifications\DataChangeEmailNotification;
use Notification;

class PostObserver
{
    public function created(Post $post): void
    {
        $payload = [
            'action' => 'created',
            'model'  => sprintf('%s#%s', get_class($post), $post->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }

    public function updated(Post $post): void
    {
        $payload = [
            'action' => 'updated',
            'model'  => sprintf('%s#%s', get_class($post), $post->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }

    public function deleted(Post $post): void
    {
        $payload = [
            'action' => 'deleted',
            'model'  => sprintf('%s#%s', get_class($post), $post->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }
}
