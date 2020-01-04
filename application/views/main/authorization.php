<div class="col-12 d-flex justify-content-center mt-5">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                aria-selected="true">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                aria-selected="false">Register</a>
        </li>
    </ul>
</div>

<div class="col-8 offset-2 mb-5">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <form>
                <div class="md-form mb-5">
                    <i class="fas fa-user prefix grey-text"></i>
                    <input type="text" id="login-username" name="login-username" class="form-control">
                    <label for="login-username">Your
                        username</label>
                </div>

                <div class="md-form mb-4">
                    <i class="fas fa-lock prefix grey-text"></i>
                    <input type="password" id="login-pass" name="login-pass" class="form-control">
                    <label for="login-pass">Your
                        password</label>
                </div>

                <div class="alert alert-danger" id="log_error"></div>
                <div class="d-flex justify-content-center">
                    <a class="btn btn-default" id="log_user">LOGIN</a>
                </div>
            </form>
        </div>

        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <form class="mb-5">
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
                    <input type="email" id="signup-email" name="signup-email" class="form-control validate">
                    <label data-error="wrong" for="signup-email">Email</label>
                </div>

                <div class="md-form mb-4">
                    <i class="fas fa-lock prefix grey-text"></i>
                    <input type="password" id="signup-pass" name="signup-pass" class="form-control">
                    <label for="signup-pass">Password</label>
                </div>
                <div class="alert alert-danger" id="reg_error"></div>
                <div class="alert alert-success" id="reg_success">Success! Please Sign In!</div>
                <div class="d-flex justify-content-center">
                    <a class="btn btn-default" id="reg_user">Sign Up</a>
                </div>
            </form>
        </div>
    </div>
</div>