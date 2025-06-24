<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanySetting;
use App\Models\News;
use App\Models\Service;
use App\Models\WaterTariff;

class HomeController extends Controller
{
    public function index()
    {
        $company = CompanySetting::current();
        $news = News::published()->latest('published_at')->take(6)->get();
        $services = Service::active()->orderBy('sort_order')->take(6)->get();

        return view('home', compact('company', 'news', 'services'));
    }

    public function about()
    {
        $company = CompanySetting::current();
        return view('about.index', compact('company'));
    }

    public function aboutHistory()
    {
        $company = CompanySetting::current();
        return view('about.history', compact('company'));
    }

    public function aboutVisionMission()
    {
        $company = CompanySetting::current();
        return view('about.vision-mission', compact('company'));
    }

    public function aboutOrganization()
    {
        $company = CompanySetting::current();
        return view('about.organization', compact('company'));
    }

    public function tariff()
    {
        $company = CompanySetting::current();
        $tariffs = WaterTariff::active()->current()->orderBy('sort_order')->get();
        return view('tariff', compact('company', 'tariffs'));
    }

    public function waterQuality()
    {
        $company = CompanySetting::current();
        return view('water-quality', compact('company'));
    }

    public function contact()
    {
        $company = CompanySetting::current();
        return view('contact', compact('company'));
    }

    public function complaint()
    {
        $company = CompanySetting::current();
        return view('complaint', compact('company'));
    }

    public function checkBill()
    {
        $company = CompanySetting::current();
        return view('check-bill', compact('company'));
    }

    public function downloadCenter()
    {
        $company = CompanySetting::current();
        return view('download-center', compact('company'));
    }

    public function documentation()
    {
        $company = CompanySetting::current();
        return view('documentation', compact('company'));
    }
}
