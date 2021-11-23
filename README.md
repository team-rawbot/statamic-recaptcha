# Recaptcha
Add google recaptcha v3 to your statamic forms. This package is inspired by [aryehraber/statamic-captcha](https://github.com/aryehraber/statamic-captcha/).


## Installation
```
composer require haugen86/statamic-recaptcha
 ```

Publish the config file:

```
 php please vendor:publish --tag=recaptcha-config
```

Once the config file is in place, be sure to remember to update your secret and sitekey with the ones from google recaptcha console. Also remember to specify which forms that should use recaptcha.

You can also specify which threshold recaptcha should use. 1 is the strictest, while 0.1 is the least strict.

```php
<?php

return [
    'forms'           => ['contact'],
    'sitekey'         => env('RECAPTCHA_SITEKEY', ''),
    'secret'          => env('RCAPTCHA_SECRET', ''),
    'score_threshold' => 0.5
];
```

## Usage

```html
<head>
    <title>My Awesome Site</title>

    {{ recaptcha:head }}
</head>
<body>
    {{ form:contact }}

        <!-- Add your fields like normal -->

        {{ recaptcha }}

        {{ if error:recaptcha }}
          <p>{{ error:recaptcha }}</p>
        {{ /if }}

    {{ /form:contact }}
</body>
```

This will automatically render the Captcha element on the page. After the form is submitted, the addon will temporarily halt the form from saving while the Captcha service verifies that the request checks out. If all is good, the form will save as normal, otherwise an error will be added to the `{{ errors }}` object.

Remember that you will need some local javascript to update your form data with the response from recaptcha

```javascript
 <script>
      function onClick(e) {
        e.preventDefault();
       
        grecaptcha.ready(() => {
            grecaptcha.execute(siteKey, {action: 'submit'}).then(async (tok) => {
                await document.querySelectorAll('form input[name="recaptcha_response"]').forEach((item) => {
                    item.value = tok;
                });
    
               // you can now trigger your form, and submit it.
        });
      }
  </script>
```