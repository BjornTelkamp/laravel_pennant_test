<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Laravel\Pennant\Feature;

class TestController extends Controller
{
    public function index()
    {
        $scope = Session::getId();
        $variant = Feature::value('ab-test-layout', $scope);

        return view('test', ['variant' => $variant]);
    }
}
