<div class="row mb-5">
    <div class="col-4">
        <div class="card">
            <h3 class="card__title">Blog Posts</h3>
            <div class="card__info">8</div>
            <div class="card__icon card__icon-posts">
                <i class="fas fa-file-alt"></i>
            </div>
            <a class="card__link" href="?module=posts&action=read">
                <i class="fas fa-arrow-right mr-2"></i>See all
            </a>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <h3 class="card__title">Blog Categories</h3>
            <div class="card__info">5</div>
            <div class="card__icon card__icon-categories">
                <i class="fas fa-list-ul"></i>
            </div>
            <a class="card__link" href="?module=categories&action=read">
                <i class="fas fa-arrow-right mr-2"></i>See all
            </a>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <h3 class="card__title">Blog Users</h3>
            <div class="card__info">3</div>
            <div class="card__icon card__icon-users">
                <i class="fas fa-users"></i>
            </div>
            <a class="card__link" href="?module=users&action=read">
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
                <tr>
                    <td scope="row">
                        <a href="#"><i class="far fa-edit fa-2x"></i></a>
                    </td>
                    <td>
                        <img style="width: 200px" class="img-fluid" src="../public/images/posts/photographer.jpg"
                            alt="Sample image">
                    </td>
                    <td>
                        <a class="post__title" href="#">Post title</a>
                    </td>
                    <td class="post__category">Traveling</td>
                    <td class="post__date">02.01.2020</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>