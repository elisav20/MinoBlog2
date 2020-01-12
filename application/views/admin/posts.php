<div class="row">
    <div class="card w-100">
        <h3>Blog posts</h3>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Edit</th>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Date</th>
                    <th scope="col">Author</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $val): ?>
                <tr>
                    <td scope="row">
                        <a href="/admin/edit/<?=$val['id']?>"><i class="far fa-edit fa-2x mr-2"></i></a>
                        <a class="delete_post text-danger" href="/admin/delete/<?=$val['id']?>" title="Delete post"
                            onclick="return confirm('Do you want to delete?')"><i
                                class="far fa-trash-alt fa-2x"></i></a>
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
                    <td class="post__author"><?=$val['firstname'] . ' ' . $val['lastname'];?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="row justify-content-center mb-3">
            <?php echo $pagination; ?>
        </div>
    </div>
</div>