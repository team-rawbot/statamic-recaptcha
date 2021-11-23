<?php


namespace haugen86\Recaptcha;


use CoasterCms\Facades\FormMessage;
use Illuminate\Validation\ValidationException;

class Recaptcha
{


    protected $success = false;

    protected $errors;


    public function verify()
    {
        $response = (new \ReCaptcha\ReCaptcha($this->getSecret()))
            ->setScoreThreshold($this->getScoreThreshold())
            ->verify(request()->get('recaptcha_response'), request()->ip());
        if ($response->isSuccess()) {
            $this->success = true;
        } else {
            $errors = $response->getErrorCodes();
        }
       return $this;
    }

    /**
     * Check whether the response was valid
     *
     * @return bool
     */
    public function validResponse()
    {
        return $this->success;
    }

    /**
     * Check whether the response was invalid
     *
     * @return bool
     */
    public function invalidResponse()
    {
        return ! $this->validResponse();
    }

    /**
     * @throws ValidationException if the validation failed.
     */
    public function throwIfInvalid()
    {
        if ($this->invalidResponse()) {

            throw ValidationException::withMessages(['recaptcha' =>  __('recaptcha::recaptcha.validation_error')]);
        }
    }

    public function getSecret()
    {
        return config('recaptcha.secret');
    }

    public function getSiteKey()
    {
        return config('recaptcha.sitekey');
    }

    public function getScoreThreshold()
    {
        return config('recaptcha.score_threshold');
    }

    public function renderHeadTag()
    {
        return view('recaptcha::head', [
            'siteKey' => $this->getSiteKey()
        ])->render();
    }

    public function renderIndexTag()
    {
        return "<input type=\"hidden\" name=\"recaptcha_response\" value=\"\"></input>";
    }
}