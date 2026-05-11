<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\AgentController as AdminAgentController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PartnerSiteController;
use App\Http\Controllers\Admin\SocialLinkController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [AgentController::class, 'index'])->name('home');
Route::get('/super-agent', [AgentController::class, 'byType'])->defaults('type', 'super-agent')->name('super-agent');
Route::get('/agent', [AgentController::class, 'byType'])->defaults('type', 'agent')->name('agent');
Route::get('/admin-list', [AgentController::class, 'byType'])->defaults('type', 'admin')->name('admin-list');
Route::get('/customer-service', [AgentController::class, 'byType'])->defaults('type', 'customer-service')->name('customer-service');

// Sitemap
Route::get('/sitemap.xml', function () {
    $urls = ['/', '/super-agent', '/agent', '/admin-list', '/customer-service'];
    $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach ($urls as $i => $path) {
        $xml .= "  <url>\n";
        $xml .= "    <loc>" . url($path) . "</loc>\n";
        $xml .= "    <changefreq>" . ($i === 0 ? 'daily' : 'weekly') . "</changefreq>\n";
        $xml .= "    <priority>" . ($i === 0 ? '1.0' : ($i <= 2 ? '0.9' : '0.8')) . "</priority>\n";
        if ($i === 0) $xml .= "    <lastmod>" . now()->toAtomString() . "</lastmod>\n";
        $xml .= "  </url>\n";
    }
    $xml .= '</urlset>';
    return response($xml, 200)->header('Content-Type', 'application/xml');
})->name('sitemap');

// Admin auth
Route::prefix('panel')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            $total     = \App\Models\Agent::count();
            $byType    = \App\Models\Agent::selectRaw('type, count(*) as count')->groupBy('type')->get();
            return view('admin.dashboard', compact('total', 'byType'));
        })->name('dashboard');

        Route::resource('agents', AdminAgentController::class);
        Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
        Route::resource('social-links', SocialLinkController::class);
        Route::resource('partner-sites', PartnerSiteController::class);
    });
});
