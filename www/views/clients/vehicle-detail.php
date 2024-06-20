<?php ob_start(); ?>
<div class="container h-100">
    <div class="row h-100">
        <div class="col-5 d-flex align-items-center">
            <img src="/public/uploads/<?= $vehicle->picture ?>" alt="" class="w-100">
        </div>
        <div class="col-7">
            <p><?= $vehicle->brand . ' ' . $vehicle->model ?></p>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>