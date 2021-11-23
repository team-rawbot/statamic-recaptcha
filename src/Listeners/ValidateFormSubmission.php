<?php

namespace haugen86\Recaptcha\Listeners;

use haugen86\Recaptcha\Recaptcha;
use Statamic\Events\FormSubmitted;
use Statamic\Forms\Submission;

class ValidateFormSubmission
{
    protected $recaptcha;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Recaptcha $recaptcha)
    {
        $this->recaptcha = $recaptcha;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(FormSubmitted $event)
    {
        /** @var Submission */
        $submission = $event->submission;

        if (! $this->shouldVerify($submission)) {
            return null;
        }

        $this->recaptcha->verify()->throwIfInvalid();

        return null;
    }

    protected function shouldVerify(Submission $submission)
    {
        return in_array($submission->form()->handle(), config('recaptcha.forms', []));
    }
}