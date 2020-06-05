<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Dosis|Candal' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="/public/images/icon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Roboto:400,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700|Open+Sans:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/styles/style.css">
    <title><?=$title;?></title>
</head>

<body>
    <!-- header -->
    <div class="header" id="js-fixed-header">
        <div class="container" id="js-scroll-nav-intro">
            <div class="header__logo">
                <!-- Navbar brand -->
                <a class="navbar-brand" href="/">
                    <img src="/public/images/header__logo.png" alt="logo">
                </a>
            </div>
        </div>
        <!-- /.container -->

        <!--Navbar-->
        <nav class="navbar navbar-expand-lg navbar-light" id="js-show-nav">
            <div class="container">

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
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
                            <input class="form-control" type="text" name="post_search" id="post_search"
                                placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <span class="input-group-text rounded-right lighten-3">
                                    <i class="fas fa-search text-grey" aria-hidden="true" id="search"></i>
                                    <a href="#" id="close"><i class="fas fa-times"></i></a>
                                </span>
                            </div>
                        </div>


                        <div id="post_show"></div>
                    </form>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user mr-2"></i>My Profile </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-info"
                        aria-labelledby="navbarDropdownMenuLink-4">

                        <?php if (!isset($_COOKIE['username'])): ?>
                        <a class="dropdown-item" href="/authorization/login">Login</a>
                        <a class="dropdown-item" href="/authorization/register">Register</a>
                        <?php endif; ?>

                        <?php if (isset($_COOKIE['username'])): ?>
                        <a class="dropdown-item" href="/post/add">Add new post</a>
                        <a class="dropdown-item" href="/user/profile/<?=$id_user?>">My posts</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" id="exit_btn" href="/authorization/logout">Log out</a>
                        <?php endif; ?>

                    </div>
                </div>

            </div>
        </nav>
        <!--/.Navbar-->

    </div>
    <!-- /.header -->

    <?php
        if ($title == 'Home'):
    ?>

    <section class="intro">
        <div class="container-fluid">
            <div class="intro__content">
                <h1 class="intro__title">WELCOME ON MY BLOG</h1>
                <p class="intro__text">This is an example of a WordPress post, you could edit this to put information
                    about
                    yourself or your site so readers know where you are coming from. You can create as many posts as you
                    like in
                    order to share with your readers what is on your mind.</p>
            </div>
        </div>
    </section>

    <?php endif; ?>

    <div class="content">
        <div id="errors"></div>
        <div class="container">
            <div class="row">
                <?php echo $content; ?>

                <?php
                    $no_sidebar = ['contact', 'add', 'edit'];
                    if (!in_array($this->route['action'], $no_sidebar)):
                ?>
                <!-- .sidebar -->
                <aside class="col-md-3 sidebar mb-5">

                    <!-- .recent__posts -->
                    <section class="recent__posts">

                        <h4>Recent posts</h4>
                        <?php foreach ($recentPosts as $val): ?>
                        <div class="recent__post-info">
                            <a class="recent__post-title" href="/post/<?=$val['id']?>"><?=$val['title']?></a>
                            <div class="recent__post-date"><?=date("F j, Y",strtotime($val['date']));?></div>
                        </div>
                        <?php endforeach; ?>

                    </section>

                    <!-- .category -->
                    <section class="category">
                        <h4>Category</h4>
                        <?php foreach ($categories as $category): ?>
                        <div class="category__info">
                            <a class="category__name" href="/category/<?=$category['id_category']?>">
                                <?=$category['name']?>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </section>

                </aside>
                <!-- /.sidebar -->
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- .footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer__info">
                <div class="row">
                    <div class="col-md-3">
                        <div class="footer__recent-posts">
                            <h4>Recent posts</h4>
                            <?php foreach ($recentPosts as $val): ?>
                            <div class="footer__recent-post__info">
                                <a class="footer__recent-post__title"
                                    href="/post/<?=$val['id']?>"><?=$val['title']?></a>
                                <div class="footer__recent-post__date"><?=date("F j, Y",strtotime($val['date']));?>
                                </div>
                            </div>
                            <? endforeach; ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="footer__nav">
                            <h4>Pages</h4>

                            <a class="footer__nav-link" href="/">Home</a>
                            <a class="footer__nav-link" href="/categories">Categories</a>
                            <a class="footer__nav-link" href="#">Store</a>
                            <a class="footer__nav-link" href="/contact">Contacts</a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="footer__categories">
                            <h4>Categories</h4>

                            <div class="footer__categories-content">
                                <?php foreach ($categories as $category): ?>
                                <a class="footer__categories-item rounded-pill"
                                    href="/category/<?=$category['id_category']?>"><?=$category['name']?></a>
                                <? endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="footer__text">
                            <h4>Text widget</h4>
                            <p>We’re both adults. I can’t pretend I don’t know that person is you. I want there to be no
                                confusion. I
                                know I owe you my life. And more than that, I respect the strategy. No speeches. Short
                                speech.
                                You lost
                                your partner today. </p>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
            </div>
            <!-- /.footer__info -->

            <div class="copyright">
                <p class="copyright__text">Designed by <span>Tonjoostudio</span></p>
            </div>
        </div>
        <!-- /.container -->
    </footer>
    <!-- .footer -->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js">
    </script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/js/mdb.min.js">
    </script>
    <script src="/public/scripts/main.js"></script>
</body>

</html>