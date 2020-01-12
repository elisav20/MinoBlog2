<!-- .posts -->
<section class="col-md-9 posts">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/category/<?=$data['category']?>"><?=$data['category_name']?></a>
            </li>
            <li class="breadcrumb-item active"><?=$data['title']?></li>
        </ol>
    </nav>

    <div class="post">

        <div class="post__content">
            <h1 class="post__title post__title--single"><?=$data['title']?></h1>

            <div class="post__info">
                <span class="post__date post__date--single"><?=date("F j, Y",strtotime($data['date']));?></span>
                <span
                    class="post__author post__author--single"><?=$data['firstname'] . ' ' . $data['lastname'];?></span>
                <span class="post__comments-quantity">
                    <?php
                            if ($data['comments_count'] == 0) 
                                echo 'No comments';
                            else
                                echo $data['comments_count']. ' comments';
                        ?>
                </span>

                <?php 
                    if($_COOKIE['username'] && $data["id_user"] == $id_user): 
                ?>

                <span class="post__modify">
                    <a class="delete_post" href="/delete/<?=$data['id']?>" title="Delete post"
                        onclick="return confirm('Do you want to delete?')"><i class="far fa-trash-alt delete"></i></a>
                    <a id="edit_post" href="/edit/<?=$data['id']?>" title="Edit post"><i
                            class="far fa-edit edit"></i></a>
                </span>

                <?php endif; ?>

                <div class="post__category">Posted in <a
                        href="/category/<?=$data['category']?>"><?=$data['category_name']?></a>
                </div>
            </div>

            <img class="img-fluid mb-4" src="/public/images/posts/<?=$data['photo'];?>" alt="Sample img">

            <div class="post__text">
                <?=$data['text'];?>
            </div>

        </div>
    </div>

    <!-- .comments -->
    <section class="comments">
        <h1 class="comments__number">Comments <?=$data['comments_count']?></h1>

        <?php foreach ($comments as $comment): ?>
        <div class="comment__content">
            <div class="comment__info">
                <span class="comment__icon">
                    <i class="fas fa-user"></i>
                </span>
                <span class="comment__username"><?=$comment['username']?></span>
                <span class="comment__dot">
                    <i class="fas fa-circle"></i>
                </span>
                <span class="comment__date"><?=date("d.m.y H:i",strtotime($comment['date']));?></span>
            </div>

            <p class="comment__text"><?=$comment['comment']?></p>
        </div>
        <?php endforeach; ?>

        <div class="my-5">
            <h1 class="comment__leave">Leave a Comment</h1>
            <p>Your email address will not be published. Required fields are marked</p>

            <form class="px-1 mt-4 submitForm" action="/post/<?=$data['id'];?>" method="POST">

                <div class="md-form mt-5">
                    <label for="username">Your name</label>
                    <input type="text" id="username" name="username" class="form-control"
                        value="<?php if($_COOKIE['username']) echo  $_COOKIE['username']?>">
                </div>


                <div class="md-form mt-5">
                    <label for="email">Your e-mail</label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>

                <div class="md-form">
                    <label for="comment">Your comment</label>
                    <textarea class="form-control md-textarea" id="comment" name="comment" rows="4"></textarea>
                </div>

                <div class="statusMsg mb-3"></div>

                <div class="text-center mt-4">
                    <input class="btn btn-default submitBtn" type="submit" value="Post">
                </div>

            </form>

        </div>

    </section>
    <!-- /.comments -->

</section>
<!-- /.posts -->