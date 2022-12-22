<?php
session_start();

$title = 'ZBank | Sąskaitų Sąrašas';
$_SESSION['admin'] = 'Jonas';

if (!isset($_SESSION['admin'])) {
    header('Location: href="http://localhost:8080/intro/personal-projects/php-zbank/login.php"');
    die;
}

if (!file_exists(__DIR__ . '/users.json')) {
    $users = [];
} else {
    $users = json_decode(file_get_contents(__DIR__ . '/users.json'));
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $users = array_filter((array) $users, fn ($user) => $user->id != $id);
    file_put_contents(__DIR__ . '/users.json', json_encode($users));
}

require(__DIR__ . '/inc/header.php');
?>

<main class="main-account">
    <div class="container flex flex-col" style="align-items: flex-start; justify-content: flex-start">
        <h1 class="title">Sveiki, <?= $_SESSION['admin'] ?></h1>
        <?php if (count($users) != 0) :
            foreach ($users as $i => $user) : ?>
                <article class="user">
                    <div class="user-header flex">
                        <div class="user-header-info flex">
                            <p class="acc-name"><?= $user->surname . ', ' . $user->name ?></p>
                            <p class="acc-money">&#8364;<?= $user->money ?></p>
                        </div>
                        <div class="user-header-buttons">
                            <a href="http://localhost:8080/intro/personal-projects/php-zbank/add-money.php?id=<?= $user->id ?>" class="btn add-btn">pridėti lėšų</a>
                            <a href="http://localhost:8080/intro/personal-projects/php-zbank/withdraw-money.php?id=<?= $user->id ?>" class="btn withdraw-btn">nuskaičiuoti lėšas</a>
                            <a href="http://localhost:8080/intro/personal-projects/php-zbank/accounts.php?id=<?= $user->id ?>" class="btn remove-btn">ištrinti</a>
                        </div>
                        <i class="fa-solid fa-chevron-down btn-expand"></i>
                    </div>
                    <div class="user-footer flex">
                        <p class="acc-id"><span class="highlight">ID: </span><?= $user->id ?></p>
                        <p class="acc-idnum"><span class="highlight">Asmens Kodas: </span><?= $user->id_num ?></p>
                        <p class="acc-bank"><span class="highlight">Sąskaitos Nr. : </span><?= $user->bank_acc ?></p>
                    </div>
                </article>
            <?php endforeach ?>
        <?php endif ?>
    </div>
    <?php require(__DIR__ . '/inc/footer.php'); ?>
</main>

</body>

</html>