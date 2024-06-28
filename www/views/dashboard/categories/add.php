<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-2 bg-white">
            <?php include __DIR__ . '/../templates/navbar.php'; ?>
        </div>
        <div class="col-12 col-lg-10 pt-3" id="content">
            <?php include __DIR__ . '/../../partials/message.php'; ?>
            <div class="row h-100 d-flex justify-content-center align-items-center">
                <div class="col-8">
                    <form action="?page=categories/add" method="POST">
                        <label for="newCategoryName" class="form-label fw-bold mb-2">Entrez une nouvelle catégorie</label>
                        <input type="text" id="newCategoryName" name="newCategoryName" class="form-control" value="<?= $data['newCategoryName'] ?? '' ?>" required>
                        <button type="submit" class="btn btn-primary mt-2">Ajouter</button>
                    </form>
                    <span class="text-danger small"><?= $errors['newCategoryName'][0] ?? '' ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>