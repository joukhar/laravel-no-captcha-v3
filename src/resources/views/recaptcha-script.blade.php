@if (config('laravel-no-captcha-v3.enable') == 'on')
    <!-- Google reCaptcha JS -->
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.google.recaptcha.site_key') }}">
    </script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('{{ config('services.google.recaptcha.site_key') }}', {
                action: 'contact'
            }).then(function(token) {
                if (token) {
                    document.getElementById('recaptcha').value = token;
                }
            });
        });
    </script>
@endif