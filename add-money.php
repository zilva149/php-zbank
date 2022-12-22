<?php
session_start();

$title = 'ZBank | Pridėti lėšų';
$_SESSION['admin'] = 'Jonas';

if (!isset($_SESSION['admin'])) {
    header('Location: href="http://localhost:8080/intro/personal-projects/php-zbank/login.php"');
    die;
}

if (!file_exists(__DIR__ . '/users.json')) {
    $user = [];
} else {
    $users = json_decode(file_get_contents(__DIR__ . '/users.json'));
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $user = array_values(array_filter($users, fn ($el) => $el->id == $id))[0];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = (float) $_POST['amount'];
    if ($amount > 0) {
        (float) $user->money = number_format($user->money + $amount, 2, '.', ',');

        $users = array_map(fn ($el) => $el->id == $user->id ? $user : $el, $users);

        file_put_contents(__DIR__ . '/users.json', json_encode($users));

        $modal = 'success';
        $modal_message = 'sėkmingai pridėta lėšų';
        $modal_color = '#35bd0f';
    } else {
        $modal = 'error';
        $modal_message = 'negalima pridėti nulinės arba negatyvios sumos!';
        $modal_color = '#f01616';
    }
}

require(__DIR__ . '/inc/header.php');
?>

<main class="main-add-money flex flex-col">
    <?php if (isset($modal)) :
        require(__DIR__ . '/inc/modal.php');
    endif ?>
    <section class="add-card flex flex-col">
        <div class="add-card-info flex">
            <p class="add-card-name"><?= $user->name . ' ' . $user->surname ?></p>
            <p class="add-card-money">&#8364;<?= $user->money ?></p>
        </div>
        <form action="http://localhost:8080/intro/personal-projects/php-zbank/add-money.php?id=<?= $id ?>" method="post" class="add-card-form flex">
            <input type="text" name="amount" class="add-card-input input" autocomplete="off" placeholder="Įveskite sumą...">
            <button type="submit" class="btn submit-btn">
                <i class="fa-regular fa-plus"></i>
            </button>
        </form>
    </section>
</main>