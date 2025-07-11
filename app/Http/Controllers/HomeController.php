<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Service;
use App\Models\WaterTariff;
use App\Models\HeroBanner;
use App\Models\Branch;

class HomeController extends Controller
{
    public function index()
    {
        // Company data is now provided globally by CompanyDataServiceProvider
        $herobanners = HeroBanner::active()->orderBy('sort_order')->get();
        $news = News::published()->latest('published_at')->take(6)->get();
        $services = Service::active()->orderBy('sort_order')->take(6)->get();

        return view('home', compact('herobanners', 'news', 'services'));
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
        return view('tariff', compact('tariffs'));
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
