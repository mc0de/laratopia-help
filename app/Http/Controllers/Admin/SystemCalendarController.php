<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Studio;
use App\Models\Website;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => Project::class,
            'date_field' => 'start_date',
            'field'      => 'name',
            'prefix'     => 'Start',
            'suffix'     => '',
            'route'      => 'admin.projects.edit',
        ],
        [
            'model'      => Project::class,
            'date_field' => 'end_date',
            'field'      => 'name',
            'prefix'     => 'End',
            'suffix'     => '',
            'route'      => 'admin.projects.edit',
        ],
        [
            'model'      => Studio::class,
            'date_field' => 'date',
            'field'      => 'title',
            'prefix'     => 'Studio',
            'suffix'     => '',
            'route'      => 'admin.studios.edit',
        ],
        [
            'model'      => Website::class,
            'date_field' => 'created_at',
            'field'      => 'title',
            'prefix'     => 'website',
            'suffix'     => '',
            'route'      => 'admin.websites.edit',
        ],
    ];

    public function index()
    {
        abort_if(Gate::denies('system_calendar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = [];

        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];

                if (! $crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => sprintf(
                        '%s %s %s',
                        trim($source['prefix']),
                        $model->{$source['field']},
                        trim($source['suffix']),
                    ),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model),
                ];
            }
        }

        return view('admin.system-calendar.index', compact('events'));
    }
}
