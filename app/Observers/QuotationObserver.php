<?php

namespace App\Observers;

use App\Models\Quotation;
use App\Models\User;
use App\Notifications\DataChangeEmailNotification;
use Notification;

class QuotationObserver
{
    public function created(Quotation $quotation): void
    {
        $payload = [
            'action' => 'created',
            'model'  => sprintf('%s#%s', get_class($quotation), $quotation->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }

    public function updated(Quotation $quotation): void
    {
        $payload = [
            'action' => 'updated',
            'model'  => sprintf('%s#%s', get_class($quotation), $quotation->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }

    public function deleted(Quotation $quotation): void
    {
        $payload = [
            'action' => 'deleted',
            'model'  => sprintf('%s#%s', get_class($quotation), $quotation->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }
}
