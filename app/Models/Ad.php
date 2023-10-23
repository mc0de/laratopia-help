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
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ad extends Model implements HasMedia
{
    use HasFactory, HasAdvancedFilter, SoftDeletes, Tenantable, InteractsWithMedia, Auditable;

    public $table = 'ads';

    protected $appends = [
        'file',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'project_id',
        'title',
        'content',
        'statues',
        'team_id',
    ];

    public const STATUES_RADIO = [
        'in progress' => 'In Progress',
        'published'   => 'Published',
        'scheduled'   => 'Scheduled',
    ];

    public $orderable = [
        'id',
        'project.name',
        'title',
        'content',
        'created_at',
        'statues',
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
        'statues',
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
        return $this->belongsToMany(Adcategory::class);
    }

    public function getFileAttribute()
    {
        return $this->getMedia('ad_file')->map(function ($item) {
            $media        = $item->toArray();
            $media['url'] = $item->getUrl();

            return $media;
        });
    }

    public function getStatuesLabelAttribute($value)
    {
        return static::STATUES_RADIO[$this->statues] ?? null;
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
