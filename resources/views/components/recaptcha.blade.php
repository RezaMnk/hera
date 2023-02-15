<input type='hidden' name='recaptcha_token' id='recaptcha_token'>

@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_RECAPTCHA_SITE_KEY') }}"></script>
    <script>
        function submit_form(e) {
            let loading = document.querySelector('.captcha-loading');

            loading.classList.remove('d-none');

            grecaptcha.ready(function() {
                grecaptcha.execute('{{ env('GOOGLE_RECAPTCHA_SITE_KEY') }}', {action: 'submit'}).then(function(token) {
                    document.getElementById("recaptcha_token").value = token;
                    e.submit();
                });
            });
        }
    </script>
@endpush
