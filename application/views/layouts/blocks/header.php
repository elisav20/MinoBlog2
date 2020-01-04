<!-- header -->
<div class="header">
    <div class="container">
        <div class="header__logo">
            <!-- Navbar brand -->
            <a class="navbar-brand" href="/">
                <img src="/public/images/header__logo.png" alt="logo">
            </a>
        </div>
    </div>
    <!-- /.container -->

    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?php if ($title == 'Home') {echo 'active';}?>">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item <?php if ($title == 'Categories') {echo 'active';}?>">
                        <a class="nav-link" href="/categories">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Store</a>
                    </li>
                    <li class="nav-item <?php if ($title == 'Contact') {echo 'active';}?>">
                        <a class="nav-link" href="/contact">Contacts</a>
                    </li>
                </ul>
                <form class="form-inline">
                    <div class="input-group md-form mt-0 mb-0 form-sm form-2">
                        <input class="form-control" type="text" name="post_search" id="post_search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <span class="input-group-text rounded-right lighten-3">
                                <i class="fas fa-search text-grey" aria-hidden="true" id="search"></i>
                                <a href="#" id="close"><i class="fas fa-times"></i></a>
                            </span>
                        </div>

                        <div id="post_show"></div>
                </form>
            </div>

            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user mr-2"></i>My Profile </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">

                    <a class="dropdown-item" href="/authorization">Login</a>
                    <a class="dropdown-item" href="/post/add">Add new post</a>
                    <a class="dropdown-item" href="#">My posts</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" id="exit_btn" href="#">Log out</a>

                </div>
            </div>

        </div>
    </nav>
    <!--/.Navbar-->

</div>
<!-- /.header -->