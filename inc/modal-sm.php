<div class="modal modal-sm flex" style="background-color: <?= $_SESSION['modal_sm']['modal_color'] ?>">
    <?= $_SESSION['modal_sm']['name'] == 'success' ? "<i class='fa-regular fa-circle-check'></i>" : "<i class='fa-solid fa-exclamation'></i>" ?>
    <p class="modal-text"><?= $_SESSION['modal_sm']['modal_message'] ?></p>
</div>