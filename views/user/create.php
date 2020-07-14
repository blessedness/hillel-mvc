<?php
/**
 * @var $this \System\Web\View
 */

$this->title = 'Create new user';

?>
<form method="POST">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="text"
                   class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" id="name" name="name"
                   value="<?= $_POST['name'] ?? '' ?>">
            <?php if (isset($errors['name'])): ?>
                <div class="invalid-feedback">
                    <?= $errors['name'][0]; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="text"
                   class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" id="email" name="email"
                   value="<?= $_POST['email'] ?? '' ?>">
            <?php if (isset($errors['email'])): ?>
                <div class="invalid-feedback">
                    <?= $errors['email'][0]; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </div>
</form>
