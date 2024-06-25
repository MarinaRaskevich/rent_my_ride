<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row h-100">
        <div class="col-2 bg-white">
            <?php include __DIR__ . '/../templates/navbar.php'; ?>
        </div>
        <div class="col-10" id="content">
            <div class="row h-100 d-flex justify-content-center align-items-center">
                <div class="col-8">
                    <form action="?page=categories/add" method="POST">
                        <label for="newCategoryName" class="form-label fw-bold mb-2">Entrez une nouvelle catégorie</label>
                        <input type="text" id="newCategoryName" name="newCategoryName" class="form-control">
                        <button type="submit" class="btn btn-primary mt-2">Ajouter</button>
                    </form>
                    <div class="error text-danger"><?php if (isset($errors['newCategoryName'])) {
                                                        foreach ($errors['newCategoryName'] as $error) {
                                                            echo $error;
                                                        }
                                                    } ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>