<?php

namespace App\Http\Controllers;

use App\ModelsExtended\Asset;
use App\Repositories\Maps\GoogleMaps\GoogleMapAddressAnalyzer;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __invoke(Request $request)
    {

    }

    public function getAsset(): Asset
    {
        return Asset::first();
    }
}
