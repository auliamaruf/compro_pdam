<?php

namespace App\Http\Controllers;

use App\Models\WaterSource;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WaterSourceController extends Controller
{
    /**
     * Display a listing of water sources.
     */
    public function index(): View
    {
        $waterSources = WaterSource::active()
            ->ordered()
            ->get();

        return view('water-sources.index', compact('waterSources'));
    }

    /**
     * Display the specified water source.
     */
    public function show(WaterSource $waterSource): View
    {
        // Pastikan water source aktif
        if (!$waterSource->is_active) {
            abort(404);
        }

        return view('water-sources.show', compact('waterSource'));
    }
}
