<?php
/**
 * @var $this \System\Web\View
 * @var $user
 */

$this->title = 'User index page';
?>
<div class="row">
    <table class="table">
        <tbody>
        <tr>
            <th>ID</th>
            <th><?= $user->id ?></th>
        </tr>
        <tr>
            <th>Name</th>
            <th><?= $user->name ?></th>
        </tr>
        <tr>
            <th>Email</th>
            <th><?= $user->email ?></th>
        </tr>
        <tr>
            <th>Created At</th>
            <th><?= $user->created_at ?></th>
        </tr>
        <tr>
            <th>Updated At</th>
            <th><?= $user->updated_at ?></th>
        </tr>
        </tbody>
    </table>
</div>
