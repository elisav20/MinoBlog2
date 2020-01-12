<div class="row mb-5">
    <div class="col-4">
        <div class="card">
            <h3 class="card__title">Blog Posts</h3>
            <div class="card__info"><?=$postsCount?></div>
            <div class="card__icon card__icon-posts">
                <i class="fas fa-file-alt"></i>
            </div>
            <a class="card__link" href="/admin/posts/1">
                <i class="fas fa-arrow-right mr-2"></i>See all
            </a>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <h3 class="card__title">Blog Categories</h3>
            <div class="card__info"><?=$categoriesCount?></div>
            <div class="card__icon card__icon-categories">
                <i class="fas fa-list-ul"></i>
            </div>
            <a class="card__link" href="/admin/categories">
                <i class="fas fa-arrow-right mr-2"></i>See all
            </a>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <h3 class="card__title">Blog Users</h3>
            <div class="card__info"><?=$usersCount?></div>
            <div class="card__icon card__icon-users">
                <i class="fas fa-users"></i>
            </div>
            <a class="card__link" href="/admin/users/1">
                <i class="fas fa-arrow-right mr-2"></i>See all
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="card w-100">
        <h3>Your recent blog posts</h3>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Edit</th>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($adminPosts as $val): ?>
                <tr>
                    <td scope="row">
                        <a class="text-danger mr-2" href="/admin/delete/<?=$val['id']?>" title="Delete Post"
                            onclick="return confirm('Do you want to delete?')">
                            <i class="far fa-trash-alt fa-2x"></i>
                        </a>
                        <a href="/admin/edit/<?=$val['id']?>" title="Edit Post"><i class="far fa-edit fa-2x"></i></a>
                    </td>
                    <td>
                        <img style="width: 200px" class="img-fluid" src="/public/images/posts/<?=$val['photo']?>"
                            alt="Sample image">
                    </td>
                    <td>
                        <a class="post__title" href="/admin/post/<?=$val['id']?>"><?=$val['title']?></a>
                    </td>
                    <td class="post__category"><?=$val['category_name']?></td>
                    <td class="post__date"><?=date("F j, Y",strtotime($val['date']));?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>