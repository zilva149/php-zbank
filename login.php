<?php
session_start();

require __DIR__ . '/inc/functions.php';

if (isset($_SESSION['admin'])) {
    redirect('accounts.php');
};

$title = 'ZBank | Prisijungimas';
$isLogin = true;


if (!file_exists(__DIR__ . '/admins.json')) {
    $admins = [];
} else {
    $admins = (array) json_decode(file_get_contents(__DIR__ . '/admins.json'));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $pass = md5($_POST['pass']) ?? '';

    foreach ($admins as $admin) {
        if ($admin->email == $email && $admin->psw == $pass) {
            $_SESSION['admin'] = $admin->name;
            redirect('accounts.php');
        }
    }

    $_SESSION['modal'] = [
        'name' => 'error',
        'modal_message' => 'Neteisingas el. paštas arba slaptažodis',
        'modal_color' => '#f01616'
    ];

    redirect('login.php');
}

require(__DIR__ . '/inc/header.php');
?>

<main class="main-login flex flex-col">
    <form action="http://localhost:8080/intro/personal-projects/php-zbank/login.php" method="post" class="form flex flex-col">
        <h1 class="title">Prisijungimas</h1>
        <?php if (isset($_SESSION['modal'])) :
            require(__DIR__ . '/inc/modal.php');
            unset($_SESSION['modal']);
        endif ?>
        <div class="form-info grid">
            <div class="input-container" style="grid-column: 1 / span 2;">
                <label for="email" class="label">El. paštas</label>
                <input type="email" name="email" class="input form-input" id="email">
            </div>
            <div class="input-container" style="grid-column: 1 / span 2;">
                <label for="pass" class="label">Slaptažodis</label>
                <input type="password" name="pass" class="input form-input" id="pass">
            </div>
        </div>
        <div class="form-btns">
            <a href="http://localhost:8080/intro/personal-projects/php-zbank/add-account.php" class="btn form-delete-btn">atšaukti</a>
            <button type="submit" class="btn form-submit-btn">išsaugoti</button>
        </div>
    </form>
    <?php require(__DIR__ . '/inc/footer.php'); ?>
</main>

</body>

</html>