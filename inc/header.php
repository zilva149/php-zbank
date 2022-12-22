<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <!-- font awesome -->
    <link href="./node_modules/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- custom css -->
    <link rel="stylesheet" href="./assets/css/main.css">
</head>

<body class="flex" style="justify-content: flex-start;">

    <?php if (!isset($isLogin)) : ?>
        <header class="header">
            <div class="container">
                <div class="header-logo">ZBank</div>
                <nav class="nav flex flex-col">
                    <a href="http://localhost:8080/intro/personal-projects/php-zbank/accounts.php" class="nav-link <?= $active == 'acc-list' ? 'active' : '' ?>">
                        <i class="fa-solid fa-list-ul"></i>
                        sąskaitų sąrašas
                    </a>
                    <a href="http://localhost:8080/intro/personal-projects/php-zbank/add-account.php" class="nav-link <?= $active == 'add-acc' ? 'active' : '' ?>">
                        <i class="fa-solid fa-address-book"></i>
                        pridėti sąskaitą
                    </a>
                </nav>
                <div class="contacts">
                    <h4 class="contacts-title">kontaktai</h4>
                    <div class="contacts-info">
                        <p class="contacts-number">
                            <i class="fa-solid fa-phone"></i>
                            +370 00 00000
                        </p>
                        <p class="contacts-location">
                            <i class="fa-solid fa-location-dot"></i>
                            pensininkų g. 14-3, Vilnius
                        </p>
                        <p class="contacts-hours">
                            <i class="fa-solid fa-clock"></i>
                            pr - pn 09-18, št - sk 10-17
                        </p>
                    </div>
                </div>
                <button class="logout-btn"><a href=<?= $_SERVER['PHP_SELF'] . '?logout' ?>>
                        <i class="fa-solid fa-right-from-bracket"></i>
                        log out
                    </a></button>
            </div>
        </header>
    <?php endif ?>