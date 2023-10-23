<nav class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6">
    <div class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">
        <button class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent" type="button" onclick="toggleNavbar('example-collapse-sidebar')">
            <i class="fas fa-bars"></i>
        </button>
        <a class="md:block text-left md:pb-2 text-blueGray-700 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0" href="{{ route('admin.home') }}">
            {{ trans('panel.site_title') }}
        </a>
        <div class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden" id="example-collapse-sidebar">
            <div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-300">
                <div class="flex flex-wrap">
                    <div class="w-6/12">
                        <a class="md:block text-left md:pb-2 text-blueGray-700 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0" href="{{ route('admin.home') }}">
                            {{ trans('panel.site_title') }}
                        </a>
                    </div>
                    <div class="w-6/12 flex justify-end">
                        <button type="button" class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent" onclick="toggleNavbar('example-collapse-sidebar')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>

            <form class="mt-6 mb-4 md:hidden">
                <div class="mb-3 pt-0">
                    @livewire('global-search')
                </div>
            </form>

            <!-- Divider -->
            <div class="flex md:hidden">
                @if(file_exists(app_path('Http/Livewire/LanguageSwitcher.php')))
                    <livewire:language-switcher />
                @endif
            </div>
            <hr class="mb-6 md:min-w-full" />
            <!-- Heading -->

            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                <li class="items-center">
                    <a href="{{ route("admin.home") }}" class="{{ request()->is("admin") ? "sidebar-nav-active" : "sidebar-nav" }}">
                        <i class="fas fa-tv"></i>
                        {{ trans('global.dashboard') }}
                    </a>
                </li>

                @can('user_management_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("admin/permissions*")||request()->is("admin/roles*")||request()->is("admin/users*")||request()->is("admin/audit-logs*")||request()->is("admin/teams*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-users">
                            </i>
                            {{ trans('cruds.userManagement.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('permission_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/permissions*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.permissions.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-unlock-alt">
                                        </i>
                                        {{ trans('cruds.permission.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/roles*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.roles.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-briefcase">
                                        </i>
                                        {{ trans('cruds.role.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/users*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.users.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-user">
                                        </i>
                                        {{ trans('cruds.user.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/audit-logs*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.audit-logs.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-file-alt">
                                        </i>
                                        {{ trans('cruds.auditLog.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('team_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/teams*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.teams.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-users">
                                        </i>
                                        {{ trans('cruds.team.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('client_area_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("admin/projects*")||request()->is("admin/posts*")||request()->is("admin/designs*")||request()->is("admin/videos*")||request()->is("admin/ads*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon far fa-address-book">
                            </i>
                            {{ trans('cruds.clientArea.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('project_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/projects*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.projects.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                        </i>
                                        {{ trans('cruds.project.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('post_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/posts*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.posts.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                        </i>
                                        {{ trans('cruds.post.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('design_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/designs*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.designs.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                        </i>
                                        {{ trans('cruds.design.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('video_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/videos*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.videos.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                        </i>
                                        {{ trans('cruds.video.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('ad_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/ads*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.ads.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                        </i>
                                        {{ trans('cruds.ad.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('user_alert_access')
                    <li class="items-center">
                        <a class="{{ request()->is("admin/user-alerts*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.user-alerts.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-bell">
                            </i>
                            {{ trans('cruds.userAlert.title') }}
                        </a>
                    </li>
                @endcan
                @can('setting_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("admin/postcategories*")||request()->is("admin/videocategories*")||request()->is("admin/adcategories*")||request()->is("admin/packages*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-cogs">
                            </i>
                            {{ trans('cruds.setting.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('postcategory_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/postcategories*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.postcategories.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                        </i>
                                        {{ trans('cruds.postcategory.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('videocategory_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/videocategories*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.videocategories.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                        </i>
                                        {{ trans('cruds.videocategory.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('adcategory_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/adcategories*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.adcategories.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                        </i>
                                        {{ trans('cruds.adcategory.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('package_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/packages*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.packages.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                        </i>
                                        {{ trans('cruds.package.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('support_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("admin/studios*")||request()->is("admin/motions*")||request()->is("admin/websites*")||request()->is("admin/market-researchs*")||request()->is("admin/quotations*")||request()->is("admin/applications*")||request()->is("admin/systems*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-cogs">
                            </i>
                            {{ trans('cruds.support.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('studio_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/studios*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.studios.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                        </i>
                                        {{ trans('cruds.studio.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('motion_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/motions*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.motions.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                        </i>
                                        {{ trans('cruds.motion.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('website_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/websites*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.websites.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                        </i>
                                        {{ trans('cruds.website.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('market_research_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/market-researchs*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.market-researchs.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                        </i>
                                        {{ trans('cruds.marketResearch.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('quotation_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/quotations*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.quotations.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                        </i>
                                        {{ trans('cruds.quotation.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('application_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/applications*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.applications.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                        </i>
                                        {{ trans('cruds.application.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('system_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/systems*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.systems.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                        </i>
                                        {{ trans('cruds.system.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('task_management_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("admin/task-statuses*")||request()->is("admin/task-tags*")||request()->is("admin/tasks*")||request()->is("admin/task-calendars*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-list">
                            </i>
                            {{ trans('cruds.taskManagement.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('task_status_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/task-statuses*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.task-statuses.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-server">
                                        </i>
                                        {{ trans('cruds.taskStatus.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('task_tag_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/task-tags*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.task-tags.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-server">
                                        </i>
                                        {{ trans('cruds.taskTag.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('task_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/tasks*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.tasks.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-briefcase">
                                        </i>
                                        {{ trans('cruds.task.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('task_calendar_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/task-calendars*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.task-calendars.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-calendar">
                                        </i>
                                        {{ trans('cruds.taskCalendar.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('system_calendar_access')
                    <li class="items-center">
                        <a class="{{ request()->is("admin/system-calendars*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.system-calendars.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon far fa-calendar">
                            </i>
                            {{ trans('cruds.systemCalendar.title') }}
                        </a>
                    </li>
                @endcan
                <li class="items-center">
                    <a class="{{ request()->is("admin/messages*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.messages.index") }}">
                        <i class="far fa-fw fa-envelope c-sidebar-nav-icon">
                        </i>
                        {{ __('global.messages') }}
                        @if($unreadConversations['all'])
                            <span class="text-xs bg-rose-500 text-white px-2 py-1 rounded-xl font-bold float-right">
                                {{ $unreadConversations['all'] }}
                            </span>
                        @endif
                    </a>
                </li>

                @if(file_exists(app_path('Http/Controllers/Auth/UserTeamController.php')))
                    <li class="items-center">
                        <a href="{{ route("team.show") }}" class="{{ request()->is("team") ? "sidebar-nav-active" : "sidebar-nav" }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-user-friends"></i>
                            {{ trans('global.my_team') }}
                        </a>
                    </li>
                @endif


                @if(file_exists(app_path('Http/Controllers/Auth/UserProfileController.php')))
                    @can('auth_profile_edit')
                        <li class="items-center">
                            <a href="{{ route("profile.show") }}" class="{{ request()->is("profile") ? "sidebar-nav-active" : "sidebar-nav" }}">
                                <i class="fa-fw c-sidebar-nav-icon fas fa-user-circle"></i>
                                {{ trans('global.my_profile') }}
                            </a>
                        </li>
                    @endcan
                @endif

                <li class="items-center">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();" class="sidebar-nav">
                        <i class="fa-fw fas fa-sign-out-alt"></i>
                        {{ trans('global.logout') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>