<?php
session_start();

require __DIR__ . '/inc/functions.php';

if (!isset($_SESSION['admin'])) {
    redirect('login.php');
};

$title = 'ZBank | Pridėti Sąskaitą';
$active = 'add-acc';

if (!file_exists(__DIR__ . '/users.json')) {
    $users = [];
} else {
    $users = (array) json_decode(file_get_contents(__DIR__ . '/users.json'));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $id = $_POST['id'] ?? '';
    $iban = $_POST['iban'] ?? '';

    $newUser = [
        "id" => generateID($users),
        "bank_acc" => $iban,
        "money" => 0
    ];

    if (preg_match('/^[a-zA-ZąčęėįšųūžĄČĘĖĮŠŲŪŽ\'\s]{4,}$/', $name)) {
        $newUser['name'] = $name;
    } else {
        $_SESSION['modal_sm'] = [
            'name' => 'error',
            'modal_place' => 'name',
            'modal_message' => 'Nevalidus vardas',
            'modal_color' => '#f01616',
        ];
        redirect('add-account.php');
    }

    if (preg_match('/^[a-zA-ZąčęėįšųūžĄČĘĖĮŠŲŪŽ\'\s]{4,}$/', $surname)) {
        $newUser['surname'] = $surname;
    } else {
        $_SESSION['modal_sm'] = [
            'name' => 'error',
            'modal_place' => 'surname',
            'modal_message' => 'Nevalidi pavardė',
            'modal_color' => '#f01616',
        ];
        redirect('add-account.php');
    }

    if (preg_match('/^[1-6]\d{2}(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01])\d{4}$/', $id)) {
        if (validateIDNum($users, $id)) {
            $newUser['id_num'] = $id;
        } else {
            $_SESSION['modal_sm'] = [
                'name' => 'error',
                'modal_place' => 'id',
                'modal_message' => 'Asmens kodas jau egzistuoja',
                'modal_color' => '#f01616',
            ];
            redirect('add-account.php');
        }
    } else {
        $_SESSION['modal_sm'] = [
            'name' => 'error',
            'modal_place' => 'id',
            'modal_message' => 'Nevalidus asmens kodas',
            'modal_color' => '#f01616',
        ];
        redirect('add-account.php');
    }

    $users[] = (object) $newUser;
    file_put_contents(__DIR__ . '/users.json', json_encode($users));

    $_SESSION['modal'] = [
        'name' => 'success',
        'modal_message' => 'Naujas klientas sėkmingai pridėtas',
        'modal_color' => '#35bd0f',
    ];

    redirect('accounts.php');
}

require(__DIR__ . '/inc/header.php');
?>

<div class="wrapper flex flex-col">
    <main class="main-add-account container">
        <div class="admin flex">
            <i class="fa-solid fa-user"></i>
            <?= $_SESSION['admin'] ?>
        </div>
        <form action="http://localhost:8080/intro/personal-projects/php-zbank/add-account.php" method="post" class="form flex flex-col">
            <h1 class="title">Nauja sąskaita</h1>
            <div class="form-info grid">
                <div class="form-name-container input-container">
                    <label for="name" class="label">Vardas</label>
                    <input type="text" name="name" class="input form-input" id="name">
                    <?php if (isset($_SESSION['modal_sm']) && $_SESSION['modal_sm']['modal_place'] == 'name') :
                        require(__DIR__ . '/inc/modal-sm.php');
                        unset($_SESSION['modal_sm']);
                    endif ?>
                </div>
                <div class="form-surname-container input-container">
                    <label for="surname" class="label">Pavardė</label>
                    <input type="text" name="surname" class="input form-input" id="surname">
                    <?php if (isset($_SESSION['modal_sm']) && $_SESSION['modal_sm']['modal_place'] == 'surname') :
                        require(__DIR__ . '/inc/modal-sm.php');
                        unset($_SESSION['modal_sm']);
                    endif ?>
                </div>
                <div class="form-id-container input-container">
                    <label for="id" class="label">Asmens kodas</label>
                    <input type="text" name="id" class="input form-input" id="id">
                    <?php if (isset($_SESSION['modal_sm']) && $_SESSION['modal_sm']['modal_place'] == 'id') :
                        require(__DIR__ . '/inc/modal-sm.php');
                        unset($_SESSION['modal_sm']);
                    endif ?>
                </div>
                <div class="form-id-container input-container">
                    <label for="iban" class="label">IBAN</label>
                    <input type="text" name="iban" class="input form-input" id="iban" value="<?= generateIBAN($users) ?>" readonly>
                    <?php if (isset($_SESSION['modal_sm']) && $_SESSION['modal_sm']['modal_place'] == 'id') :
                        require(__DIR__ . '/inc/modal-sm.php');
                        unset($_SESSION['modal_sm']);
                    endif ?>
                </div>
            </div>
            <div class="form-btns">
                <a href="http://localhost:8080/intro/personal-projects/php-zbank/add-account.php" class="btn form-delete-btn">atšaukti</a>
                <button type="submit" class="btn form-submit-btn">išsaugoti</button>
            </div>
        </form>
    </main>

    <?php require(__DIR__ . '/inc/footer.php'); ?>
</div>

</body>

</html>