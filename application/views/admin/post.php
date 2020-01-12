<div class="row">
    <!-- .posts -->
    <section class="posts col-8 offset-2">

        <div class="post">

            <div class="post__content">
                <h1 class="post__title post__title--single"><?php echo htmlspecialchars($data['title'], ENT_QUOTES) ?>
                </h1>

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

                    <span class="post__modify">
                        <a class="delete_post" href="/admin/delete/<?=$data['id'];?>" title="Delete post"
                            onclick="return confirm('Do you want to delete?')"><i
                                class="far fa-trash-alt delete"></i></a>
                        <a id="edit_post" href="/admin/edit/<?=$data['id'];?>" title="Edit post">
                            <i class="far fa-edit edit"></i>
                        </a>
                    </span>

                    <div class="post__category">Posted in <a href="#"><?=$data['category_name']?></a>
                    </div>
                </div>

                <img class="img-fluid mb-4" src="/public/images/posts/<?=$data['photo'];?>" alt="Sample img">

                <div class="post__text">
                    <?=$data['text'];?>
                </div>

            </div>
        </div>

    </section>
    <!-- /.posts -->
</div>
<!-- /.row -->