<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Lottery;
use Illuminate\Support\ServiceProvider;
use Laravel\Pennant\Feature;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Feature::define('ab-test-layout', function (?string $scope) {
            $scope = $scope ?? Session::getId();

            Log::info('Feature Scope for ab-test-layout: ' . $scope);

            // Avoid recursive Feature::value() call
            // Check if a variant is already assigned for this scope in the features table
            $existingVariant = DB::table('features')
                ->where('name', 'ab-test-layout')
                ->where('scope', $scope)
                ->value('value');

            if ($existingVariant === null) {
                // Count total assignments to determine the order
                $assignedCount = DB::table('features')
                    ->where('name', 'ab-test-layout')
                    ->count();

                $variant = ($assignedCount % 2 === 0) ? 'variant-a' : 'variant-b';
                Log::info("New variant assigned for session {$scope}: {$variant} (Order: {$assignedCount})");
            } else {
                $variant = $existingVariant;
                Log::info("Variant retrieved for session {$scope}: {$variant}");
            }

            return $variant;
        });
    }
}
