@if ($hide_badge)
    <style>.grecaptcha-badge { visibility: collapse !important }</style>
@endif

<script src="https://www.google.com/recaptcha/api.js?render={{ $siteKey }}" defer></script>
<script>
    const siteKey = '{{ $siteKey }}';
</script>