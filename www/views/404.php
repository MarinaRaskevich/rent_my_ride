<?php ob_start(); ?>
<div class="d-flex flex-column w-100 h-100 justify-content-between align-items-center py-3">
    <img src="/public/assets/img/404.png" alt="" class="w-50">
    <p class="mb-0 fw-bold fs-3">Oups! Error 404</p>
    <p class="mb-4 fw-bold">Cette page n'existe pas</p>
    <a href="?page=home" class="btn btn-primary">Revenir à la page d'accueil</a>
</div>
<?php $content = ob_get_clean(); ?>