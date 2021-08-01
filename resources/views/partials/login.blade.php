<div id="login-block" class="card mb-5 d-none">
    <div class="card-header">{{ __('Login') }}</div>

    <div class="card-body">
        <form id="login" action="#">
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="maximillia57@example.com" required autocomplete="email">
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    var emailInput = $('#email');
    var passwordInput = $('#password');

    $('#login').submit(function (e) {
        e.preventDefault();

        $.login({email: emailInput.val(), password: passwordInput.val()});
    });
</script>