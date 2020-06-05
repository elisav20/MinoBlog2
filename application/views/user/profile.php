<section class="col-md-9 posts">
    <?php if ($count_posts == 0): ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active"><?=$author['firstname'] . ' ' . $author['lastname'] ?></li>
        </ol>
    </nav>

    <h1 class="text-center mb-3 vh-100">No posts added</h1>

    <? else: ?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">
                <?=$author['firstname'] . ' ' . $author['lastname']?>
            </li>
        </ol>
    </nav>

    <?php foreach($posts as $post): ?>

    <div class="post">
        <div class="row">
            <div class="col-lg-5 col-xl-4">

                <div class="view overlay rounded z-depth-1-half mb-lg-0 mb-4">
                    <img class="img-fluid" src="/public/images/posts/<?=$post['photo'];?>" alt="Sample image">
                    <a href="post.php">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>

            </div>

            <div class="col-lg-7 col-xl-8 post__content">

                <a class="post__title" href="/post/<?=$post["id"];?>"><?=$post["title"];?></a>

                <div class="post__info">
                    <span class="post__date">
                        <?=date("F j, Y",strtotime($post["date"])); ?></span>
                    <a class="post__author" href="/profile/<?=$post["id_user"]?>">
                        <?=$author['firstname'] . ' ' . $author['lastname'] ?>
                    </a>
                    <span class="post__comments-quantity">
                        <?php
                            if ($post["comments_count"] == 0)
                                echo 'No comments';
                            else
                                echo $post["comments_count"] . ' comments'
                        ?>
                    </span>
                    <div class="post__category">Posted in <a href="#">
                            <?=$post["category"]; ?></a>
                    </div>
                </div>

                <p class="post__text">
                    <?php
                        $text = $post["text"];
                        $text = strip_tags($text);
                        $text = substr($text, 0, 350);
                        $text = rtrim($text, "!,.-");
                        $text = substr($text, 0, strrpos($text, ' '));
                        echo $text."… ";
                    ?>
                </p>

                <a class="btn btn--black" href="/post/<?=$post["id"]; ?>">Read More</a>

            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- /.post -->
    <?php
        endforeach;
        endif;
    ?>

</section>
<!-- /.posts -->