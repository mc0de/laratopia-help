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
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Design extends Model implements HasMedia
{
    use HasFactory, HasAdvancedFilter, SoftDeletes, Tenantable, InteractsWithMedia, Auditable;

    public $table = 'designs';

    protected $appends = [
        'design',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const CONFIRMATION_RADIO = [
        'confirmed' => 'Confirmed',
        'try again' => 'Try again',
        'edit'      => 'Edit',
    ];

    public const STATUES_RADIO = [
        'in progress' => 'In Progress',
        'published'   => 'Published',
        'scheduled'   => 'Scheduled',
    ];

    protected $fillable = [
        'project_id',
        'post_id',
        'statues',
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
        'post.title',
        'created_at',
        'statues',
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
        'post.title',
        'created_at',
        'statues',
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

    public function registerMediaConversions(Media $media = null): void
    {
        $thumbnailWidth  = 50;
        $thumbnailHeight = 50;

        $thumbnailPreviewWidth  = 120;
        $thumbnailPreviewHeight = 120;

        $this->addMediaConversion('thumbnail')
            ->width($thumbnailWidth)
            ->height($thumbnailHeight)
            ->fit('crop', $thumbnailWidth, $thumbnailHeight);
        $this->addMediaConversion('preview_thumbnail')
            ->width($thumbnailPreviewWidth)
            ->height($thumbnailPreviewHeight)
            ->fit('crop', $thumbnailPreviewWidth, $thumbnailPreviewHeight);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getDesignAttribute()
    {
        return $this->getMedia('design_design')->map(function ($item) {
            $media                      = $item->toArray();
            $media['url']               = $item->getUrl();
            $media['thumbnail']         = $item->getUrl('thumbnail');
            $media['preview_thumbnail'] = $item->getUrl('preview_thumbnail');

            return $media;
        });
    }

    public function getCreatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function getStatuesLabelAttribute($value)
    {
        return static::STATUES_RADIO[$this->statues] ?? null;
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
