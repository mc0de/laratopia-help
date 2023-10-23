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

class Post extends Model
{
    use HasFactory, HasAdvancedFilter, SoftDeletes, Tenantable, Auditable;

    public $table = 'posts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const CONFIRMATION_RADIO = [
        'confirmed' => 'confirmed',
        'try again' => 'Try again',
        'edit'      => 'Edit',
    ];

    public const STATUS_RADIO = [
        'published'   => 'Published',
        'scheduled'   => 'Scheduled',
        'in progress' => 'In Progress',
    ];

    protected $fillable = [
        'project_id',
        'title',
        'content',
        'status',
        'confirmation',
        'note',
        'review',
        'team_id',
    ];

    public const REVIEW_RADIO = [
        'not bad'   => 'Not Good',
        'good'      => 'Good',
        'very good' => 'Very Good',
        'excellent' => 'Excellent',
        'brillent'  => 'Brillent',
    ];

    public $orderable = [
        'id',
        'project.name',
        'title',
        'content',
        'created_at',
        'status',
        'confirmation',
        'note',
        'review',
        'updated_at',
        'deleted_at',
        'team.name',
    ];

    public $filterable = [
        'id',
        'project.name',
        'title',
        'content',
        'created_at',
        'category.name',
        'status',
        'confirmation',
        'note',
        'review',
        'updated_at',
        'deleted_at',
        'team.name',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function category()
    {
        return $this->belongsToMany(Postcategory::class);
    }

    public function getStatusLabelAttribute($value)
    {
        return static::STATUS_RADIO[$this->status] ?? null;
    }

    public function getConfirmationLabelAttribute($value)
    {
        return static::CONFIRMATION_RADIO[$this->confirmation] ?? null;
    }

    public function getReviewLabelAttribute($value)
    {
        return static::REVIEW_RADIO[$this->review] ?? null;
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
