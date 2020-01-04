<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="/public/images/icon.ico">
    <link href='https://fonts.googleapis.com/css?family=Dosis|Candal' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700|Open+Sans:400,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/public/styles/style.min.css">
    <title>Mino Admin Panel</title>
</head>

<body>
    <?php if ($this->route['action'] != 'login'): ?>
    <div id="viewport">
        <!-- Sidebar -->
        <div id="sidebar">
            <div class="sidebar__header">
                <a class="navbar-brand px-3" href="/admin/dashboard">
                    <img src="/public/images/header__logo.png" alt="logo">
                </a>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a href="#" class="nav-link">
                        <i class="fas fa-th-large"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-file-alt"></i>
                        <span>Posts</span>
                    </a>
                </li>
                <li class="nav-item mb-auto">
                    <a href="#" class="nav-link">
                        <i class="fas fa-list-ul"></i>
                        <span>Categories</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" id="exit_btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Exit</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Content -->
        <div id="content">

            <header class="navbar navbar-default content__header">
                <div class="container-fluid">
                    <a class="page-title" href="#">Dashboard</a>

                    <div class="dropdown admin">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuMenu" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-shield"></i> Admin Mino
                        </button>
                        <div class="dropdown-menu text-justify" aria-labelledby="dropdownMenuMenu">
                            <a href="/post/add" class="dropdown-item">Add New Post</a>
                            <a href="#" class="dropdown-item">Logout</a>
                        </div>
                    </div>

                </div>
            </header>

            <div class="container-fluid admin__content">
                <?php echo $content; ?>
            </div>


        </div>
        <?php endif; ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js">
        </script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js">
        </script>
        <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js">
        </script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/js/mdb.min.js">
        </script>
        <script src="/public/scripts/main.min.js"></script>

</body>

</html>