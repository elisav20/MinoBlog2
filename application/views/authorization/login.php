<div class="col-9 mt-5">
    <form action="/authorization/login" method="post">

        <div class="md-form mb-5">
            <i class="fas fa-user prefix grey-text"></i>
            <input type="text" id="login-username" name="login-username" class="form-control">
            <label for="login-username">Your Username</label>
        </div>

        <div class="md-form mb-4">
            <i class="fas fa-lock prefix grey-text"></i>
            <input type="password" id="login-pass" name="login-pass" class="form-control">
            <label for="login-pass">Your
                password</label>
        </div>

        <div class="d-flex justify-content-center mb-3">
            <input type="submit" class="btn btn-default submitBtn" value="LOGIN">
        </div>

        <p class="font-small grey-text text-center">Don't have an account?
            <a href="/register" class="cyan-text ml-1 font-weight-bold"> Sign up</a>
        </p>

    </form>
</div>