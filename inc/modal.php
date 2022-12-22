<div class="modal flex" style="background-color: <?= $_SESSION['modal']['modal_color'] ?>">
    <?= $_SESSION['modal']['name'] == 'success' ? "<i class='fa-regular fa-circle-check'></i>" : "<i class='fa-solid fa-exclamation'></i>" ?>
    <p class="modal-text"><?= $_SESSION['modal']['modal_message'] ?></p>
</div>