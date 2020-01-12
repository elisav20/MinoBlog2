<section class="col-md-9 posts">

    <?php foreach ($list as $val): ?>
    <div class="post">
        <div class="row">
            <div class="col-lg-5 col-xl-4">

                <div class="view overlay rounded z-depth-1-half mb-lg-0 mb-4">
                    <img class="img-fluid" src="/public/images/posts/<?=$val['photo']?>" alt="Sample image">

                    <a href="/post/<?=$val['id']?>">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>

            </div>

            <div class="col-lg-7 col-xl-8 post__content">

                <a class="post__title" href="/post/<?=$val['id']?>"><?=$val['title']?></a>

                <div class="post__info">
                    <span class="post__date"><?=date("F j, Y",strtotime($val['date']));?></span>
                    <a class="post__author" href="/profile/<?=$val['id_user']?>">
                        <?=$val['firstname'] . ' ' . $val['lastname'];?>
                    </a>
                    <span class="post__comments-quantity">
                        <?php
                            if ($val['comments_count'] == 0) 
                                echo 'No comments';
                            else
                                echo $val['comments_count']. ' comments';
                        ?>
                    </span>
                    <div class="post__category">Posted in
                        <a href="/category/<?=$val['category']?>">
                            <?=$val['category_name']?>
                        </a>
                    </div>
                </div>

                <p class="post__text">
                    <?php 
                        $text = $val['text'];
                        $text = strip_tags($text);
                        $text = substr($text, 0, 350);
                        $text = rtrim($text, "!,.-");
                        $text = substr($text, 0, strrpos($text, ' '));
                        echo $text."… "; 
                    ?>
                </p>

                <a class="btn btn--black" href="/post/<?=$val['id']?>">Read More</a>

            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.post -->
    <?php endforeach; ?>

    <div class="row justify-content-center mb-3">
        <?php echo $pagination; ?>
    </div>

</section>
<!-- /.posts -->