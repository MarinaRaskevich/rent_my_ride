<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row h-100">
        <div class="col-2 bg-white">
            <?php include __DIR__ . '/templates/navbar.php'; ?>
        </div>
        <div class="col-10" id="content"></div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>