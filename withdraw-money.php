<?php
session_start();

require __DIR__ . '/inc/functions.php';

if (!isset($_SESSION['admin'])) {
    redirect('login.php');
};

$title = 'ZBank | Nuskaičiuoti Lėšų';

if (!file_exists(__DIR__ . '/users.json')) {
    $user = [];
} else {
    $users = json_decode(file_get_contents(__DIR__ . '/users.json'));
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $user = array_values(array_filter($users, fn ($el) => $el->id == $id))[0];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['amount'])) {
    $amount = (float) $_POST['amount'];

    if ($amount > $user->money) {
        $_SESSION['modal'] = [
            'name' => 'error',
            'modal_message' => 'Suma viršija turimas lėšas',
            'modal_color' => '#f01616'
        ];

        redirect("withdraw-money.php?id=$id");
    } else if ($amount > 0) {
        $user->money -= $amount;

        $users = array_map(fn ($el) => $el->id == $user->id ? $user : $el, $users);

        file_put_contents(__DIR__ . '/users.json', json_encode($users));

        $_SESSION['modal'] = [
            'name' => 'success',
            'modal_message' => 'Sėkmingai nuskaičiuotos lėšos',
            'modal_color' => '#35bd0f'
        ];

        redirect('accounts.php');
    } else {
        $_SESSION['modal'] = [
            'name' => 'error',
            'modal_message' => 'Negalima nuskaičiuoti nulinės arba negatyvios sumos',
            'modal_color' => '#f01616'
        ];

        redirect("withdraw-money.php?id=$id");
    }
}

require(__DIR__ . '/inc/header.php');
?>

<main class="main-add-money flex flex-col">
    <div class="admin flex">
        <i class="fa-solid fa-user"></i>
        <?= $_SESSION['admin'] ?>
    </div>
    <?php if (isset($_SESSION['modal'])) :
        require(__DIR__ . '/inc/modal.php');
        unset($_SESSION['modal']);
    endif ?>
    <section class="add-card flex flex-col">
        <div class="add-card-info flex">
            <p class="add-card-name"><?= $user->name . ' ' . $user->surname ?></p>
            <p class="add-card-money">&#8364;<?= number_format($user->money, 2, '.', ',') ?></p>
        </div>
        <form action="http://localhost:8080/intro/personal-projects/php-zbank/withdraw-money.php?id=<?= $id ?>" method="post" class="add-card-form flex">
            <input type="text" name="amount" class="add-card-input input" autocomplete="off" placeholder="Įveskite sumą...">
            <button type="submit" class="btn submit-btn">nuskaičiuoti</button>
        </form>
    </section>
</main>

<script>
    const input = document.querySelector('input[name="amount"]');
    window.addEventListener('DOMContentLoaded', () => input.focus());
</script>