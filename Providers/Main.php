<?php

namespace Modules\AutoDocumentNumber\Providers;

use App\Http\Controllers\Api\Document\Documents;
use Illuminate\Support\ServiceProvider as Provider;
use Illuminate\Support\Facades\Route;
use Modules\AutoDocumentNumber\Http\Middleware\DocumentLinkMiddleware;

class Main extends Provider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {

        //add DocumentLinkMiddleware
        Route::get('api/documents/{document}', [Documents::class, 'show'])
            ->name('api.documents.show')
            ->middleware(['api', 'date.format', 'money', 'dropzone', DocumentLinkMiddleware::class]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
