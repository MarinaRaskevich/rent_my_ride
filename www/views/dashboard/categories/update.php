<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row h-100">
        <?php include __DIR__ . '/../templates/navbar.php'; ?>
        <div class="col-12 col-lg-10 pt-3" id="content">
            <div class="row h-100 d-flex justify-content-center align-items-center">
                <div class="col-8">
                    <form method="post">
                        <div>
                            <label for="categoryName" class="form-label fw-bold mb-2">Entrez un nouveau nom de catégorie</label>
                            <input class="form-control" type="text" name="categoryName" id="categoryName" maxlength="50" value="<?= $category->name ?>" required>
                            <span class="text-danger small"><?= $errors['categoryName'][0] ?? '' ?></span>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>