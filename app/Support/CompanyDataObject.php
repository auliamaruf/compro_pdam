<?php

namespace App\Support;

class CompanyDataObject
{
    public $companyProfile;
    public $brandingSetting;
    public $heroSection;
    public $companyHistory;
    public $companyMetric;
    
    // Company data properties
    public $company_name;
    public $company_tagline;
    public $address;
    public $phone;
    public $email;
    public $website;
    public $emergency_phone;
    public $whatsapp_cs;
    public $about_us;
    public $vision;
    public $mission;
    public $company_description;
    public $vision_description;
    public $mission_points;
    public $core_values;
    public $social_media;
    public $office_hours;
    public $logo;
    public $logo_white;
    public $favicon;
    public $primary_color;
    public $secondary_color;
    public $accent_color;
    public $brand_description;
    public $hero_title;
    public $hero_subtitle;
    public $hero_cta_primary;
    public $hero_cta_secondary;
    public $hero_description;
    public $hero_slides;
    public $company_history;
    public $milestones;
    public $history_timeline;
    public $achievements;
    public $years_experience;
    public $customers_served;
    public $water_quality_percentage;
    public $service_availability;
    public $organization_structure;
    public $organizational_culture;
    
    public function __construct($companyProfile, $brandingSetting, $heroSection, $companyHistory, $companyMetric, $organizationStructure, $organizationalCulture)
    {
        $this->companyProfile = $companyProfile;
        $this->brandingSetting = $brandingSetting;
        $this->heroSection = $heroSection;
        $this->companyHistory = $companyHistory;
        $this->companyMetric = $companyMetric;
        
        // Set properties from CompanyProfile
        $this->company_name = $companyProfile?->company_name;
        $this->company_tagline = $companyProfile?->company_tagline;
        $this->address = $companyProfile?->address;
        $this->phone = $companyProfile?->phone;
        $this->email = $companyProfile?->email;
        $this->website = $companyProfile?->website;
        $this->emergency_phone = $companyProfile?->emergency_phone;
        $this->whatsapp_cs = $companyProfile?->whatsapp_cs;
        $this->about_us = $companyProfile?->about_us;
        $this->vision = $companyProfile?->vision;
        $this->mission = $companyProfile?->mission;
        $this->company_description = $companyProfile?->company_description;
        $this->vision_description = $companyProfile?->vision_description;
        $this->mission_points = $companyProfile?->mission_points ?? [];
        $this->core_values = $companyProfile?->core_values ?? [];
        $this->social_media = $companyProfile?->social_media ?? [];
        $this->office_hours = $companyProfile?->office_hours ?? [];

        // Set properties from BrandingSetting
        $this->logo = $brandingSetting?->logo;
        $this->logo_white = $brandingSetting?->logo_white;
        $this->favicon = $brandingSetting?->favicon;
        $this->primary_color = $brandingSetting?->primary_color ?? '#2563eb';
        $this->secondary_color = $brandingSetting?->secondary_color ?? '#1e40af';
        $this->accent_color = $brandingSetting?->accent_color ?? '#10B981';
        $this->brand_description = $brandingSetting?->brand_description;

        // Set properties from HeroSection
        $this->hero_title = $heroSection?->hero_title;
        $this->hero_subtitle = $heroSection?->hero_subtitle;
        $this->hero_cta_primary = $heroSection?->hero_cta_primary;
        $this->hero_cta_secondary = $heroSection?->hero_cta_secondary;
        $this->hero_description = $heroSection?->hero_description;
        $this->hero_slides = $heroSection?->hero_slides ?? [];

        // Set properties from CompanyHistory
        $this->company_history = $companyHistory?->company_history;
        $this->milestones = $companyHistory?->milestones ?? [];
        $this->history_timeline = $companyHistory?->history_timeline ?? [];
        $this->achievements = $companyHistory?->achievements ?? [];

        // Set properties from CompanyMetric
        $this->years_experience = $companyMetric?->years_experience;
        $this->customers_served = $companyMetric?->customers_served;
        $this->water_quality_percentage = $companyMetric?->water_quality_percentage;
        $this->service_availability = $companyMetric?->service_availability;

        // Set properties from OrganizationStructure
        $this->organization_structure = $organizationStructure;
        $this->organizational_culture = $organizationalCulture;
    }
    
    public function getFirstMediaUrl($collection = 'default')
    {
        switch($collection) {
            case 'logo':
                return $this->brandingSetting?->getFirstMediaUrl('logo') ?? '';
            case 'logo_white':
                return $this->brandingSetting?->getFirstMediaUrl('logo_white') ?? '';
            case 'favicon':
                return $this->brandingSetting?->getFirstMediaUrl('favicon') ?? '';
            case 'about_image':
                return $this->companyProfile?->getFirstMediaUrl('about_image') ?? '';
            case 'hero_background':
                return $this->heroSection?->getFirstMediaUrl('hero_background') ?? '';
            default:
                // Try branding first, then company profile
                return $this->brandingSetting?->getFirstMediaUrl($collection) ?? 
                       $this->companyProfile?->getFirstMediaUrl($collection) ?? '';
        }
    }
}
