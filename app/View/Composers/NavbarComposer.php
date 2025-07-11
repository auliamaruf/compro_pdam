<?php

namespace App\View\Composers;

use App\Models\Service;
use App\Models\WaterTariff;
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

        // Company data is now provided globally by CompanyDataServiceProvider
        // No need to manually fetch it here

        $view->with([
            'navbarServices' => $navbarServices,
            'navbarTariffs' => $navbarTariffs,
        ]);
    }
}
