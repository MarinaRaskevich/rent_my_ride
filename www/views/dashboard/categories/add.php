<?php ob_start(); ?>

<div class="row h-100 d-flex justify-content-center align-items-center">
    <div class="col-8">
        <form method="POST">
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

<?php $content = ob_get_clean(); ?>