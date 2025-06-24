<?php

namespace App\View\Composers;

use App\Models\Service;
use App\Models\WaterTariff;
use App\Models\CompanySetting;
use Illuminate\View\View;

class NavbarComposer
{
    public function compose(View $view): void
    {
        $navbarServices = Service::forNavbar()
            ->select('id', 'name', 'slug', 'navbar_label', 'navbar_icon', 'navbar_order', 'is_navbar_featured', 'category')
            ->get()
            ->groupBy('category');

        $navbarTariffs = WaterTariff::forNavbar()
            ->select('id', 'customer_type', 'min_usage', 'max_usage', 'rate_per_m3', 'navbar_label', 'navbar_icon', 'navbar_order', 'is_navbar_featured')
            ->get()
            ->groupBy('customer_type');

        $company = CompanySetting::current();

        $view->with([
            'navbarServices' => $navbarServices,
            'navbarTariffs' => $navbarTariffs,
            'company' => $company
        ]);
    }
}
