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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['id'])) {
        foreach ($users as $key => $user) {
            if ($user->id == $_GET['id'] && $user->money == 0) {
                unset($users[$key]);
                $_SESSION['modal'] = [
                    'name' => 'success',
                    'modal_message' => 'Sąskaita sėkmingai ištrinta',
                    'modal_color' => '#35bd0f'
                ];
            } else {
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
}

require(__DIR__ . '/inc/header.php');
?>

<main class="main-account">
    <div class="container flex flex-col">
        <div class="admin flex">
            <i class="fa-solid fa-user"></i>
            <?= $_SESSION['admin'] ?>
        </div>
        <?php if (isset($_SESSION['modal'])) :
            require(__DIR__ . '/inc/modal.php');
            unset($_SESSION['modal']);
        endif ?>
        <?php if (count($users) != 0) :
            foreach ($users as $i => $user) : ?>
                <article class="user flex flex-col">
                    <div class="user-header flex">
                        <div class="user-header-info flex">
                            <p class="acc-name"><?= $user->surname . ', ' . $user->name ?></p>
                            <p class="acc-money">&#8364;<?= number_format($user->money, 2, '.', ',') ?></p>
                        </div>
                        <div class="user-header-buttons flex" style="gap: 10px">
                            <form action="http://localhost:8080/intro/personal-projects/php-zbank/add-money.php?id=<?= $user->id ?>" method="post">
                                <button class="btn">pridėti lėšų</button>
                            </form>
                            <form action="http://localhost:8080/intro/personal-projects/php-zbank/withdraw-money.php?id=<?= $user->id ?>" method="post">
                                <button class="btn">nuskaičiuoti lėšas</button>
                            </form>
                            <form action="http://localhost:8080/intro/personal-projects/php-zbank/accounts.php?id=<?= $user->id ?>" method="post">
                                <button class="btn">ištrinti</button>
                            </form>
                        </div>
                    </div>
                    <div class="user-footer flex">
                        <p class="acc-id"><span class="highlight">ID: </span><?= $user->id ?></p>
                        <p class="acc-idnum"><span class="highlight">Asmens kodas: </span><?= $user->id_num ?></p>
                        <p class="acc-bank"><span class="highlight">IBAN: </span><?= $user->bank_acc ?></p>
                    </div>
                </article>
            <?php endforeach ?>
        <?php endif ?>
    </div>
    <?php require(__DIR__ . '/inc/footer.php'); ?>
</main>

</body>

</html>