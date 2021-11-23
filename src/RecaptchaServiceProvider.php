<?php

namespace haugen86\Recaptcha;

use App\Listeners\ValidateFormSubmission;
use haugen86\Recaptcha\Tags\RecaptchaTag;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Statamic\Providers\AddonServiceProvider;

class RecaptchaServiceProvider extends AddonServiceProvider
{

    protected $viewNamespace = 'recaptcha';

    protected $listen = [
        'Statamic\Events\FormSubmitted' => [
            'haugen86\Recaptcha\Listeners\ValidateFormSubmission',
        ]
    ];

    protected $tags = [
        RecaptchaTag::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Recaptcha::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'recaptcha');
    }
}
