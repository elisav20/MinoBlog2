<!-- content -->
<div class="statusMsg col-md-9"></div>
<!-- .posts -->
<section class="col-md-9 posts mt-4">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Traveling</a>
            </li>
            <li class="breadcrumb-item active">Post title</li>
        </ol>
    </nav>

    <div class="post">

        <div class="post__content">
            <h1 class="post__title post__title--single">Post title</h1>

            <div class="post__info">
                <span class="post__date post__date--single">02.01.2020</span>
                <span class="post__author post__author--single">Cristel Vasile</span>
                <span class="post__comments-quantity">
                    No comments
                </span>

                <span class="post__modify">
                    <a class="delete_post" id="<?=$_GET['id']?>" href="#" title="Delete post"
                        onclick="return confirm('Do you want to delete?')"><i class="far fa-trash-alt delete"></i></a>
                    <a id="edit_post" href="update_post.php?id=<?=$_GET['id']?>" title="Edit post"><i
                            class="far fa-edit edit"></i></a>
                </span>

                <div class="post__category">Posted in <a href="#">Traveling</a>
                </div>
            </div>

            <img class="img-fluid mb-4" src="public/images/posts/photographer.jpg" alt="Sample img">

            <div class="post__text">
                Post text
            </div>

        </div>
    </div>

    <!-- .comments -->
    <section class="comments">
        <h1 class="comments__number">Comments 1</h1>

        <div class="comment__content">
            <div class="comment__info">
                <span class="comment__icon">
                    <i class="fas fa-user"></i>
                </span>
                <span class="comment__username">admin_mino </span>
                <span class="comment__dot">
                    <i class="fas fa-circle"></i>
                </span>
                <span class="comment__date">02.01.2020 19:40</span>
            </div>

            <p class="comment__text">Text</p>
        </div>

        <div class="my-5">
            <h1 class="comment__leave">Leave a Comment</h1>
            <p>Your email address will not be published. Required fields are marked</p>

            <form class="px-1 mt-4" action="" method="POST">

                <div class="md-form mt-5">
                    <label for="username">Your name</label>
                    <input type="text" id="username" name="username" class="form-control" value="">
                </div>

                <div class="md-form mt-5">
                    <label for="email">Your e-mail</label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>

                <div class="md-form">
                    <label for="comment">Your comment</label>
                    <textarea class="form-control md-textarea" id="comment" name="comment" rows="4"></textarea>
                </div>

                <div class="text-center mt-4">
                    <input class="btn btn-default" type="submit" id="add_comment" value="Post">
                </div>

            </form>

        </div>

    </section>
    <!-- /.comments -->

</section>
<!-- /.posts -->