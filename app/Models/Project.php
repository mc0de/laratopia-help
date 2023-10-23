<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use App\Traits\Auditable;
use App\Traits\Tenantable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use Auditable, HasAdvancedFilter, HasFactory, SoftDeletes, Tenantable;

    public $table = 'projects';

    public const STATUES_RADIO = [
        'active' => 'Active',
        'hold'   => 'Hold',
        'closed' => 'Closed',
    ];

    protected $dates = [
        'created_at',
        'start_date',
        'end_date',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'owner_id',
        'start_date',
        'end_date',
        'statues',
        'team_id',
    ];

    public $orderable = [
        'id',
        'name',
        'owner.name',
        'created_at',
        'start_date',
        'end_date',
        'statues',
        'updated_at',
        'deleted_at',
        'team.name',
    ];

    public $filterable = [
        'id',
        'name',
        'owner.name',
        'created_at',
        'package.name',
        'start_date',
        'end_date',
        'statues',
        'assignees.email',
        'updated_at',
        'deleted_at',
        'team.name',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function package()
    {
        return $this->belongsToMany(Package::class);
    }

    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('project.date_format')) : null;
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? Carbon::createFromFormat(config('project.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getEndDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('project.date_format')) : null;
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value ? Carbon::createFromFormat(config('project.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getStatuesLabelAttribute($value)
    {
        return static::STATUES_RADIO[$this->statues] ?? null;
    }

    public function assignees()
    {
        return $this->belongsToMany(User::class);
    }

    public function getUpdatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function getDeletedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
