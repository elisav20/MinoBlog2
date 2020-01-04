<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href='https://fonts.googleapis.com/css?family=Dosis|Candal' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="/public/images/icon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Roboto:400,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700|Open+Sans:400,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/public/styles/style.min.css">
    <title><?=$title;?></title>
</head>

<body>
    <?php 
        include_once 'blocks/header.php';
        if ($title == 'Home'):
    ?>

    <section class="intro">
        <div class="container-fluid">
            <div class="intro__content">
                <h1 class="intro__title">Visual Speak Louder</h1>
                <p class="intro__text">This is an example of a WordPress post, you could edit this to put information
                    about
                    yourself or your site so readers know where you are coming from. You can create as many posts as you
                    like in
                    order to share with your readers what is on your mind.</p>
                <a class="btn btn--outline" href="#">Read More</a>
            </div>
        </div>
    </section>

    <?php endif; ?>

    <div class="content">
        <div class="container">
            <div class="row">
                <?php    
                    echo $content;
                    if ($this->route['action'] != 'contact' && 
                        $this->route['action'] != 'authorization' && 
                        $this->route['action'] != 'add' &&
                        $this->route['action'] != 'edit') {
                        include_once 'blocks/aside.php';
                    }
                ?>
            </div>
        </div>
    </div>
    <?php include_once 'blocks/footer.php'; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js">
    </script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/js/mdb.min.js">
    </script>
    <script src="public/scripts/main.min.js"></script>
</body>

</html>