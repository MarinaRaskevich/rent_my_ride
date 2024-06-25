<?php
$flash = getFlash();
if (!empty($flash)) : ?>
    <div class="alert alert-dismissible fade show alert-<?= $flash["type"] ?>" role="alert">
        <strong> <?= $flash["message"] ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>