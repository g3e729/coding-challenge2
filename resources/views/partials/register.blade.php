<div id="register-block" class="card mb-5 d-none">
    <div class="card-header">{{ __('Register') }}</div>

    <div class="card-body">
        <form id="register" action="#">
            <div class="form-group row">
                <label for="nameReg" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="nameReg" type="text" class="form-control" name="name" value="" required autocomplete="email">
                </div>
            </div>

            <div class="form-group row">
                <label for="emailReg" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="emailReg" type="email" class="form-control" name="email" value="" required autocomplete="email">
                </div>
            </div>

            <div class="form-group row">
                <label for="passwordReg" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="passwordReg" type="password" class="form-control" name="password" required autocomplete="current-password">
                </div>
            </div>

            <div class="form-group row">
                <label for="passwordConfirmReg" class="col-md-4 col-form-label text-md-right">{{ __('Re-type Password') }}</label>

                <div class="col-md-6">
                    <input id="passwordConfirmReg" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    var nameRegInput = $('#nameReg');
    var emailRegInput = $('#emailReg');
    var passwordRegInput = $('#passwordReg');
    var passwordConfirmRegInput = $('#passwordConfirmReg');

    $('#register').submit(function (e) {
        e.preventDefault();

        $.register({
            name: nameRegInput.val(),
            email: emailRegInput.val(),
            password: passwordRegInput.val(),
            password_confirmation: passwordConfirmRegInput.val()
        });
    });
</script>