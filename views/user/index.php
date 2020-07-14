<?php
/**
 * @var $this \System\Web\View
 * @var $users array
 */

$this->title = 'User index page';
?>
<div class="row">
    <?php if (!empty($users)) : ?>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <th scope="row"><?= $user->id ?></th>
                    <td><?= $user->name ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->created_at ?></td>
                    <td><?= $user->updated_at ?></td>
                    <th scope="col">
                        <a href="#" class="btn btn-warning">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </th>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="float-left">Список пользователей пустой, добавьте первого пользователя.</div>
    <?php endif; ?>

</div>
