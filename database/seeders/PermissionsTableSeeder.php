<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'auth_profile_edit',
            ],
            [
                'id'    => 2,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 3,
                'title' => 'permission_create',
            ],
            [
                'id'    => 4,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 5,
                'title' => 'permission_show',
            ],
            [
                'id'    => 6,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 7,
                'title' => 'permission_access',
            ],
            [
                'id'    => 8,
                'title' => 'role_create',
            ],
            [
                'id'    => 9,
                'title' => 'role_edit',
            ],
            [
                'id'    => 10,
                'title' => 'role_show',
            ],
            [
                'id'    => 11,
                'title' => 'role_delete',
            ],
            [
                'id'    => 12,
                'title' => 'role_access',
            ],
            [
                'id'    => 13,
                'title' => 'user_create',
            ],
            [
                'id'    => 14,
                'title' => 'user_edit',
            ],
            [
                'id'    => 15,
                'title' => 'user_show',
            ],
            [
                'id'    => 16,
                'title' => 'user_delete',
            ],
            [
                'id'    => 17,
                'title' => 'user_access',
            ],
            [
                'id'    => 18,
                'title' => 'client_area_access',
            ],
            [
                'id'    => 19,
                'title' => 'project_create',
            ],
            [
                'id'    => 20,
                'title' => 'project_edit',
            ],
            [
                'id'    => 21,
                'title' => 'project_show',
            ],
            [
                'id'    => 22,
                'title' => 'project_delete',
            ],
            [
                'id'    => 23,
                'title' => 'project_access',
            ],
            [
                'id'    => 24,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 25,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 26,
                'title' => 'team_create',
            ],
            [
                'id'    => 27,
                'title' => 'team_edit',
            ],
            [
                'id'    => 28,
                'title' => 'team_show',
            ],
            [
                'id'    => 29,
                'title' => 'team_delete',
            ],
            [
                'id'    => 30,
                'title' => 'team_access',
            ],
            [
                'id'    => 31,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 32,
                'title' => 'user_alert_edit',
            ],
            [
                'id'    => 33,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 34,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 35,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 36,
                'title' => 'post_create',
            ],
            [
                'id'    => 37,
                'title' => 'post_edit',
            ],
            [
                'id'    => 38,
                'title' => 'post_show',
            ],
            [
                'id'    => 39,
                'title' => 'post_delete',
            ],
            [
                'id'    => 40,
                'title' => 'post_access',
            ],
            [
                'id'    => 41,
                'title' => 'design_create',
            ],
            [
                'id'    => 42,
                'title' => 'design_edit',
            ],
            [
                'id'    => 43,
                'title' => 'design_show',
            ],
            [
                'id'    => 44,
                'title' => 'design_delete',
            ],
            [
                'id'    => 45,
                'title' => 'design_access',
            ],
            [
                'id'    => 46,
                'title' => 'video_create',
            ],
            [
                'id'    => 47,
                'title' => 'video_edit',
            ],
            [
                'id'    => 48,
                'title' => 'video_show',
            ],
            [
                'id'    => 49,
                'title' => 'video_delete',
            ],
            [
                'id'    => 50,
                'title' => 'video_access',
            ],
            [
                'id'    => 51,
                'title' => 'ad_create',
            ],
            [
                'id'    => 52,
                'title' => 'ad_edit',
            ],
            [
                'id'    => 53,
                'title' => 'ad_show',
            ],
            [
                'id'    => 54,
                'title' => 'ad_delete',
            ],
            [
                'id'    => 55,
                'title' => 'ad_access',
            ],
            [
                'id'    => 56,
                'title' => 'setting_access',
            ],
            [
                'id'    => 57,
                'title' => 'postcategory_create',
            ],
            [
                'id'    => 58,
                'title' => 'postcategory_edit',
            ],
            [
                'id'    => 59,
                'title' => 'postcategory_show',
            ],
            [
                'id'    => 60,
                'title' => 'postcategory_delete',
            ],
            [
                'id'    => 61,
                'title' => 'postcategory_access',
            ],
            [
                'id'    => 62,
                'title' => 'videocategory_create',
            ],
            [
                'id'    => 63,
                'title' => 'videocategory_edit',
            ],
            [
                'id'    => 64,
                'title' => 'videocategory_show',
            ],
            [
                'id'    => 65,
                'title' => 'videocategory_delete',
            ],
            [
                'id'    => 66,
                'title' => 'videocategory_access',
            ],
            [
                'id'    => 67,
                'title' => 'adcategory_create',
            ],
            [
                'id'    => 68,
                'title' => 'adcategory_edit',
            ],
            [
                'id'    => 69,
                'title' => 'adcategory_show',
            ],
            [
                'id'    => 70,
                'title' => 'adcategory_delete',
            ],
            [
                'id'    => 71,
                'title' => 'adcategory_access',
            ],
            [
                'id'    => 72,
                'title' => 'package_create',
            ],
            [
                'id'    => 73,
                'title' => 'package_edit',
            ],
            [
                'id'    => 74,
                'title' => 'package_show',
            ],
            [
                'id'    => 75,
                'title' => 'package_delete',
            ],
            [
                'id'    => 76,
                'title' => 'package_access',
            ],
            [
                'id'    => 77,
                'title' => 'studio_create',
            ],
            [
                'id'    => 78,
                'title' => 'studio_edit',
            ],
            [
                'id'    => 79,
                'title' => 'studio_show',
            ],
            [
                'id'    => 80,
                'title' => 'studio_delete',
            ],
            [
                'id'    => 81,
                'title' => 'studio_access',
            ],
            [
                'id'    => 82,
                'title' => 'support_access',
            ],
            [
                'id'    => 83,
                'title' => 'motion_create',
            ],
            [
                'id'    => 84,
                'title' => 'motion_edit',
            ],
            [
                'id'    => 85,
                'title' => 'motion_show',
            ],
            [
                'id'    => 86,
                'title' => 'motion_delete',
            ],
            [
                'id'    => 87,
                'title' => 'motion_access',
            ],
            [
                'id'    => 88,
                'title' => 'website_create',
            ],
            [
                'id'    => 89,
                'title' => 'website_edit',
            ],
            [
                'id'    => 90,
                'title' => 'website_show',
            ],
            [
                'id'    => 91,
                'title' => 'website_delete',
            ],
            [
                'id'    => 92,
                'title' => 'website_access',
            ],
            [
                'id'    => 93,
                'title' => 'market_research_create',
            ],
            [
                'id'    => 94,
                'title' => 'market_research_edit',
            ],
            [
                'id'    => 95,
                'title' => 'market_research_show',
            ],
            [
                'id'    => 96,
                'title' => 'market_research_delete',
            ],
            [
                'id'    => 97,
                'title' => 'market_research_access',
            ],
            [
                'id'    => 98,
                'title' => 'quotation_create',
            ],
            [
                'id'    => 99,
                'title' => 'quotation_edit',
            ],
            [
                'id'    => 100,
                'title' => 'quotation_show',
            ],
            [
                'id'    => 101,
                'title' => 'quotation_delete',
            ],
            [
                'id'    => 102,
                'title' => 'quotation_access',
            ],
            [
                'id'    => 103,
                'title' => 'application_create',
            ],
            [
                'id'    => 104,
                'title' => 'application_edit',
            ],
            [
                'id'    => 105,
                'title' => 'application_show',
            ],
            [
                'id'    => 106,
                'title' => 'application_delete',
            ],
            [
                'id'    => 107,
                'title' => 'application_access',
            ],
            [
                'id'    => 108,
                'title' => 'system_create',
            ],
            [
                'id'    => 109,
                'title' => 'system_edit',
            ],
            [
                'id'    => 110,
                'title' => 'system_show',
            ],
            [
                'id'    => 111,
                'title' => 'system_delete',
            ],
            [
                'id'    => 112,
                'title' => 'system_access',
            ],
            [
                'id'    => 113,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 114,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 115,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 116,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 117,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 118,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 119,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 120,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 121,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 122,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 123,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 124,
                'title' => 'task_create',
            ],
            [
                'id'    => 125,
                'title' => 'task_edit',
            ],
            [
                'id'    => 126,
                'title' => 'task_show',
            ],
            [
                'id'    => 127,
                'title' => 'task_delete',
            ],
            [
                'id'    => 128,
                'title' => 'task_access',
            ],
            [
                'id'    => 129,
                'title' => 'task_calendar_access',
            ],
            [
                'id'    => 130,
                'title' => 'system_calendar_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
