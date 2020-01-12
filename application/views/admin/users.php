<div class="row">
    <div class="card w-100">
        <h3>Blog users</h3>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Edit</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Count posts</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td scope="row">
                        <?php if ($user['username'] != 'admin'): ?>
                        <a class="text-danger" href="/admin/deleteuser/<?=$user['id']?>" title="Delete user"
                            onclick="return confirm('Do you want to delete?')"><i
                                class="far fa-trash-alt fa-2x"></i></a>
                        <?php endif; ?>
                    </td>
                    <td><?=$user['firstname']?></td>
                    <td><?=$user['lastname']?></td>
                    <td><?=$user['username']?></td>
                    <td><?=$user['posts_count']?></td>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="row justify-content-center mb-3">
            <?php echo $pagination; ?>
        </div>
    </div>
</div>