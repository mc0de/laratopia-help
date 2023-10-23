<?php

namespace App\Listeners;

use App\Notifications\AssignedToProjectNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendEmailToProjectAssignees
{
    public function handle(object $event): void
    {
        $project   = $event->project;
        $assignees = $project->assignees()->get();

        Notification::send(
            $assignees,
            new AssignedToProjectNotification($project)
        );
    }
}
