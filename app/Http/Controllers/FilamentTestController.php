<?php

namespace App\Http\Controllers;

use App\Filament\Resources\CompanySettingResource;
use Illuminate\Http\Request;

class FilamentTestController extends Controller
{
    public function testResource()
    {
        try {
            $resource = new CompanySettingResource();
            $model = $resource::getModel();
            $navigationLabel = $resource::getNavigationLabel();
            $navigationIcon = $resource::getNavigationIcon();
            $navigationGroup = $resource::getNavigationGroup();
            
            return response()->json([
                'status' => 'success',
                'resource_info' => [
                    'class' => get_class($resource),
                    'model' => $model,
                    'navigation_label' => $navigationLabel,
                    'navigation_icon' => $navigationIcon,
                    'navigation_group' => $navigationGroup,
                    'pages' => $resource::getPages(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
}
