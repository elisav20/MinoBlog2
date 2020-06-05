<div class="col-9 mt-5">
    <form action="/authorization/register" method="post" class="submitForm mb-5" id="form">

        <div class="md-form mb-5">
            <i class="fas fa-signature prefix grey-text"></i>
            <input type="text" id="signup-firstname" name="signup-firstname" class="form-control">
            <label for="signup-firstname">Firstname</label>
        </div>

        <div class="md-form mb-5">
            <i class="fas fa-signature prefix grey-text"></i>
            <input type="text" id="signup-lastname" name="signup-lastname" class="form-control">
            <label for="signup-lastname">Lastname</label>
        </div>

        <div class="md-form mb-5">
            <i class="fas fa-user prefix grey-text"></i>
            <input type="text" id="signup-username" name="signup-username" class="form-control">
            <label for="signup-username">Username</label>
        </div>

        <div class="md-form mb-5">
            <i class="fas fa-envelope prefix grey-text"></i>
            <input type="email" id="signup-email" name="signup-email" class="form-control">
            <label for="signup-email">Email</label>
        </div>

        <div class="md-form mb-4">
            <i class="fas fa-lock prefix grey-text"></i>
            <input type="password" id="signup-pass" name="signup-pass" class="form-control">
            <label for="signup-pass">Password</label>
        </div>

        <div class="d-flex justify-content-center mb-3">
            <input type="submit" class="btn btn-default submitBtn" value="REGISTER">
        </div>

        <p class="font-small grey-text text-center">Have an account?
            <a href="/login" class="cyan-text ml-1 font-weight-bold"> Log in</a>
        </p>

    </form>
</div>