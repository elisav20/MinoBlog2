<div class="col-md-9">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Categories</li>
        </ol>
    </nav>

    <ul class="list-group list-group-flush mb-3">
        <?php foreach ($categories as $category): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a class="text-dark font-weight-bold"
                href="/category/<?=$category['id_category']?>"><?=$category['name']?></a>
            <span class="badge badge-primary badge-pill">
                <?=$category['posts_count']?>
            </span>
        </li>
        <?php endforeach; ?>
    </ul>
</div>