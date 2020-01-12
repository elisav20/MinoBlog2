<div class="col-md-8 offset-2">

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Edit</th>
                <th scope="col">Name</th>
                <th scope="col">Count posts</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
            <tr>
                <th scope="row">
                    <a class="text-danger" href="/admin/deletecategory/<?=$category['id_category']?>"
                        title="Delete category" onclick="return confirm('Do you want to delete?')">
                        <i class="far fa-trash-alt fa-2x"></i>
                    </a>
                </th>
                <td><?=$category['name']?></td>
                <td>
                    <span class="badge badge-primary badge-pill px-2"><?=$category['posts_count']?></span>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="statusMsg mb-3"></div>
    <form action="/admin/categories" method="post" class="d-flex submitForm">
        <input type="text" id="category_name" name="category_name" class="form-control mr-3"
            placeholder="Category name...">
        <button type="submit"><i class="fas fa-plus text-success fa-2x"></i></button>
    </form>
</div>