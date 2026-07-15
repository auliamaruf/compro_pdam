<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Service;
use App\Models\WaterTariff;
use App\Models\FixedCost;
use App\Models\HeroBanner;
use App\Models\Branch;
use App\Models\Partnership;
use App\Models\Faq;

class HomeController extends Controller
{
    public function index()
    {
        // Company data is now provided globally by CompanyDataServiceProvider
        $herobanners = \Illuminate\Support\Facades\Cache::rememberForever('home_herobanners', function () {
            return HeroBanner::active()->orderBy('sort_order')->get();
        });
        
        $newsByType = \Illuminate\Support\Facades\Cache::remember('home_news_by_type', 3600, function () {
            $types = News::published()->select('type')->whereNotNull('type')->distinct()->pluck('type');
            $data = [];
            foreach ($types as $type) {
                $data[$type] = News::where('type', $type)->published()->latest('published_at')->take(3)->get();
            }
            
            // If no types exist, fallback to getting latest news in general
            if ($types->isEmpty()) {
                $data['berita'] = News::published()->latest('published_at')->take(3)->get();
            }
            
            return $data;
        });
        
        $services = \Illuminate\Support\Facades\Cache::rememberForever('home_services', function () {
            return Service::active()->orderBy('sort_order')->take(6)->get();
        });
        
        $partnerships = \Illuminate\Support\Facades\Cache::rememberForever('home_partnerships', function () {
            return Partnership::active()->ordered()->get();
        });

        $faqs = \Illuminate\Support\Facades\Cache::rememberForever('home_faqs', function () {
            return Faq::where('is_active', true)->orderBy('order')->get();
        });

        $customerInfos = \App\Models\CustomerInfo::where('is_active', true)
            ->where(function($query) {
                $query->whereNull('display_until')
                      ->orWhere('display_until', '>', now());
            })
            ->orderBy('published_date', 'desc')
            ->take(3)
            ->get();

        return view('home', compact('herobanners', 'newsByType', 'services', 'partnerships', 'faqs', 'customerInfos'));
    }

    public function about()
    {
        return view('about.index');
    }

    public function aboutHistory()
    {
        $company = \App\Models\CompanySetting::current();
        return view('about.history', compact('company'));
    }

    public function aboutVisionMission()
    {
        return view('about.vision-mission');
    }

    public function aboutOrganization()
    {
        $organizations = \App\Models\OrganizationStructure::getGroupedByLevel();
        return view('about.organization', compact('organizations'));
    }

    public function tariff()
    {
        $tariffs = WaterTariff::active()->current()->orderBy('sort_order')->get();
        $fixedCosts = FixedCost::active()->orderedByCategory()->get();
        return view('tariff', compact('tariffs', 'fixedCosts'));
    }

    public function waterQuality()
    {
        return view('water-quality');
    }

    public function contact()
    {
        return view('contact');
    }

    public function complaint()
    {
        return view('complaint');
    }

    public function checkBill()
    {
        return view('check-bill');
    }

    public function downloadCenter()
    {
        return view('download-center');
    }

    public function documentation()
    {
        return view('documentation');
    }

    public function branches()
    {
        $branches = Branch::with('headOfBranch')->cabang()->active()->ordered()->get();
        $unitIkk = Branch::with('headOfBranch')->unitIkk()->active()->ordered()->get();
        return view('about.branches', compact('branches', 'unitIkk'));
    }
}
