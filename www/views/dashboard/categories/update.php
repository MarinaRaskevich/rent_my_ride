<?php ob_start(); ?>
<div class="row h-100 d-flex justify-content-center align-items-center">
    <div class="col-8">
        <form method="post">
            <label for="name" class="form-label fw-bold mb-2">Entrez un nouveau nom de catégorie</label>
            <input class="form-control" type="text" name="name" id="name" maxlength="50" value="<?= $oneName->name ?>">
            <button type="submit" class="btn btn-primary mt-2">Modifier</button>
        </form>
    </div>
</div>
<?php $content = ob_get_clean(); ?>