<?php
session_start();

require __DIR__ . '/inc/functions.php';

if (!isset($_SESSION['admin'])) {
    redirect('login.php');
};

$title = 'ZBank | Sąskaitų Sąrašas';
$active = 'acc-list';

if (!file_exists(__DIR__ . '/users.json')) {
    $users = [];
} else {
    $users = (array) json_decode(file_get_contents(__DIR__ . '/users.json'));
    usort($users, fn ($a, $b) => $a->surname <=> $b->surname);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id'])) {
    foreach ($users as $key => $user) {
        if ($user->id == $_GET['id'] && $user->money <= 0) {
            $_SESSION['modal'] = [
                'name' => 'success',
                'modal_message' => 'Sąskaita sėkmingai ištrinta',
                'modal_color' => '#35bd0f'
            ];
            unset($users[$key]);
        } else if ($user->id == $_GET['id']) {
            $_SESSION['modal'] = [
                'name' => 'error',
                'modal_message' => 'Sąskaitos, kurioje yra pinigų, negalima ištrinti',
                'modal_color' => '#f01616'
            ];
        }
    }

    file_put_contents(__DIR__ . '/users.json', json_encode(array_values((array) $users)));
    redirect('accounts.php');
}

require(__DIR__ . '/inc/header.php');
?>

<div class="wrapper flex flex-col">
    <main class="container">
        <div class="admin flex">
            <button class="burger-menu">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="admin-info flex">
                <i class="fa-solid fa-user"></i>
                <?= $_SESSION['admin'] ?>
            </div>
        </div>
        <?php if (isset($_SESSION['modal'])) :
            require(__DIR__ . '/inc/modal.php');
            unset($_SESSION['modal']);
        endif ?>
        <?php if (count($users) != 0) : ?>
            <section class="users grid">
                <?php foreach ($users as $i => $user) : ?>
                    <article class="user grid">
                        <p class="acc-name"><?= $user->surname . ', ' . $user->name ?></p>
                        <p class="acc-id"><span class="highlight">ID: </span><?= $user->id ?></p>
                        <p class="acc-idnum"><span class="highlight">Asmens kodas: </span><?= $user->id_num ?></p>
                        <p class="acc-iban"><span class="highlight">Sąskaitos Nr.: </span><?= $user->bank_acc ?></p>
                        <p class="acc-money">&#8364;<?= number_format($user->money, 2, '.', ',') ?></p>
                        <div class="user-btns flex">
                            <a href="http://localhost:8080/intro/personal-projects/php-zbank/add-money.php?id=<?= $user->id ?>" class="btn plus-btn">
                                <i class="fa-solid fa-plus"></i>
                            </a>
                            <a href="http://localhost:8080/intro/personal-projects/php-zbank/withdraw-money.php?id=<?= $user->id ?>" class="btn minus-btn">
                                <i class="fa-solid fa-minus"></i>
                            </a>
                            <form action="http://localhost:8080/intro/personal-projects/php-zbank/accounts.php?id=<?= $user->id ?>" method="post">
                                <button type="submit" class="btn delete-btn">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </article>
                <?php endforeach ?>
            </section>
        <?php else : ?>
            <h1 class="empty">Sąskaitų nėra</h1>
        <?php endif ?>
    </main>

    <?php require(__DIR__ . '/inc/footer.php'); ?>
</div>

<script>
    const plusBtns = document.querySelectorAll('.plus-btn');
    const minusBtns = document.querySelectorAll('.minus-btn');
    const deleteBtns = document.querySelectorAll('.delete-btn');

    window.addEventListener('DOMContentLoaded', () => {
        const width = window.innerWidth;
        if (width >= 992) {
            plusBtns.forEach((btn) => {
                btn.innerHTML = 'pridėti';
            });
            minusBtns.forEach((btn) => {
                btn.innerHTML = 'nuskaičiuoti';
            });
            deleteBtns.forEach((btn) => {
                btn.innerHTML = 'ištrinti';
            });
        } else {
            plusBtns.forEach((btn) => {
                btn.innerHTML = `<i class="fa-solid fa-plus"></i>`;
            });
            minusBtns.forEach((btn) => {
                btn.innerHTML = `<i class="fa-solid fa-minus"></i>`;
            });
            deleteBtns.forEach((btn) => {
                btn.innerHTML = `<i class="fa-solid fa-trash"></i>`;
            });
        }
    });

    window.addEventListener('resize', () => {
        const width = window.innerWidth;
        if (width >= 992) {
            plusBtns.forEach((btn) => {
                btn.innerHTML = 'pridėti';
            });
            minusBtns.forEach((btn) => {
                btn.innerHTML = 'nuskaičiuoti';
            });
            deleteBtns.forEach((btn) => {
                btn.innerHTML = 'ištrinti';
            });
        } else {
            plusBtns.forEach((btn) => {
                btn.innerHTML = `<i class="fa-solid fa-plus"></i>`;
            });
            minusBtns.forEach((btn) => {
                btn.innerHTML = `<i class="fa-solid fa-minus"></i>`;
            });
            deleteBtns.forEach((btn) => {
                btn.innerHTML = `<i class="fa-solid fa-trash"></i>`;
            });
        }
    });
</script>

</body>

</html>