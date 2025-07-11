<?php

namespace App\Http\Controllers;

use App\Models\CompanySetting;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testCompanySetting()
    {
        $company = CompanySetting::current();
        
        if (!$company) {
            return response()->json([
                'status' => 'error',
                'message' => 'No company setting found. Please run seeder first.',
                'suggestion' => 'Run: php artisan db:seed --class=CompanySettingSeeder'
            ]);
        }
        
        return response()->json([
            'status' => 'success',
            'data' => [
                'company_name' => $company->company_name,
                'company_tagline' => $company->company_tagline,
                'phone' => $company->phone,
                'email' => $company->email,
                'has_logo' => $company->getFirstMediaUrl('logo') ? true : false,
                'logo_url' => $company->getFirstMediaUrl('logo'),
                'social_media' => $company->social_media,
                'statistics' => [
                    'years_experience' => $company->years_experience,
                    'customers_served' => $company->customers_served,
                    'water_quality_percentage' => $company->water_quality_percentage,
                    'service_availability' => $company->service_availability,
                ],
                'mission_points_count' => is_array($company->mission_points) ? count($company->mission_points) : 0,
                'core_values_count' => is_array($company->core_values) ? count($company->core_values) : 0,
                'hero_slides' => $company->hero_slides,
                'hero_slides_count' => is_array($company->hero_slides) ? count($company->hero_slides) : 0,
                'active_hero_slides' => is_array($company->hero_slides) ? 
                    array_filter($company->hero_slides, fn($slide) => $slide['is_active'] ?? false) : [],
            ]
        ]);
    }
}
