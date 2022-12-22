<div class="modal flex" style="background-color: <?= $modal_color ?>">
    <?= $modal == 'success' ? "<i class='fa-regular fa-circle-check'></i>" : "<i class='fa-solid fa-exclamation'></i>" ?>
    <p class="modal-text"><?= $modal_message ?></p>
</div>