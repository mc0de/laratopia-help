<?php

namespace App\Providers;

use App\Models\Ad as AdModel;
use App\Models\Application as ApplicationModel;
use App\Models\Design as DesignModel;
use App\Models\MarketResearch as MarketResearchModel;
use App\Models\Motion as MotionModel;
use App\Models\Post as PostModel;
use App\Models\Project as ProjectModel;
use App\Models\Quotation as QuotationModel;
use App\Models\Studio as StudioModel;
use App\Models\System as SystemModel;
use App\Models\Team as TeamModel;
use App\Models\Video as VideoModel;
use App\Models\Website as WebsiteModel;
use App\Observers\AdObserver;
use App\Observers\ApplicationObserver;
use App\Observers\DesignObserver;
use App\Observers\MarketResearchObserver;
use App\Observers\MotionObserver;
use App\Observers\PostObserver;
use App\Observers\ProjectObserver;
use App\Observers\QuotationObserver;
use App\Observers\StudioObserver;
use App\Observers\SystemObserver;
use App\Observers\TeamObserver;
use App\Observers\VideoObserver;
use App\Observers\WebsiteObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,

        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot()
    {
        ProjectModel::observe(ProjectObserver::class);
        PostModel::observe(PostObserver::class);
        DesignModel::observe(DesignObserver::class);
        VideoModel::observe(VideoObserver::class);
        AdModel::observe(AdObserver::class);
        TeamModel::observe(TeamObserver::class);
        StudioModel::observe(StudioObserver::class);
        MotionModel::observe(MotionObserver::class);
        WebsiteModel::observe(WebsiteObserver::class);
        MarketResearchModel::observe(MarketResearchObserver::class);
        QuotationModel::observe(QuotationObserver::class);
        ApplicationModel::observe(ApplicationObserver::class);
        SystemModel::observe(SystemObserver::class);
    }
}
