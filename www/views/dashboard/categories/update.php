<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row h-100">
        <div class="col-2 bg-white">
            <?php include __DIR__ . '/../templates/navbar.php'; ?>
        </div>
        <div class="col-10" id="content">
            <div class="row h-100 d-flex justify-content-center align-items-center">
                <div class="col-8">
                    <form method="post">
                        <label for="name" class="form-label fw-bold mb-2">Entrez un nouveau nom de catégorie</label>
                        <input class="form-control" type="text" name="name" id="name" maxlength="50" value="<?= $category->name ?>">
                        <button type="submit" class="btn btn-primary mt-2">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>