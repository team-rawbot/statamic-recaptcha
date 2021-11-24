<?php

namespace haugen86\Recaptcha\Tags;

use haugen86\Recaptcha\Recaptcha;
use Statamic\Tags\Tags;
use Statamic\Support\Html;

class RecaptchaTag extends Tags
{
    protected static $handle = 'recaptcha';

    protected $recaptcha;


    public function __construct(Recaptcha $recaptcha)
    {
        $this->recaptcha = $recaptcha;
    }

    /**
     * The {{ recaptcha }} tag
     *
     * @return string
     */
    public function index()
    {
        return $this->recaptcha->renderIndexTag();
    }

    public function disclaimer()
    {
        if (! $disclaimer = config('recaptcha.disclaimer')) {
            $disclaimer = $this->recaptcha->getDefaultDisclaimer();
        }

        return Html::markdown($disclaimer);
    }


    /**
     * The {{ recaptcha:head }} tag
     *
     * @return string
     */
    public function head()
    {
        return $this->recaptcha->renderHeadTag();
    }
}