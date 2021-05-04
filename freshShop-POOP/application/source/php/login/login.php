<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/php/login/function.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/php/login/db.php'; ?>
<?php
if (isset($_COOKIE['remember'])) {
    $remember_token = $_COOKIE['remember'];
    $parts = explode('==', $remember_token);
    $user_id = $parts[0];
    $req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
    $req->execute([$user_id]);
    $user = $req->fetch();
    if ($user) {
        $expected = $user_id . '==' . $user->$remember_token . sha1($user_id . 'chameauxnoir');
        if ($expected == $remember_token) {
            die('reco automatique');
        }
    }
}
if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {
    $req = $pdo->prepare('SELECT * FROM users WHERE username = :username  OR email = :username');
    $req->execute(['username' => $_POST['username']]);
    $user = $req->fetch();
    if (password_verify($_POST['password'], $user->password)) {
        session_start();
        $_SESSION['auth'] = $user;
        $_SESSION['flash']['success'] = "Your are connected !";
        header('/my-account.php');
    } else {
        $_SESSION['flash']['danger'] = 'Wrong username/email or password';
    }
    if ($_POST['remember']) {
        $remember_token = str_random(250);
        $pdo->prepare('UPDATE users SET remember_token = ? WHERE id = ?')->execute([$remember_token, $user->id]);
        setcookie('remember', $users->id . '==' . $remember_token . sha1($user->id . 'chameauxnoir'), time() + 60 * 60 * 24 * 7);
    }
}
?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/php/header.php'; ?>

<?php debug($errors); ?>

<div class="contact-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <div class="contact-form-right">
                    <h1>Bonjour <?= $_SESSION['auth']->username; ?></h1>
                    <h2>Login</h2>

                    <form method="POST" id="loginForm">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="usename" name="username" placeholder="Your username or email" value="" required data-error="Please enter your username or email" />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Your password" value="" required data-error="Please enter your password" />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <input type="checkbox" id="remember" name="remember" checked />
                            <label for="remember">Remember</label>
                        </div>

                        <div class="submit-button text-center">
                            <button class="btn hvr-hover" id="submit" type="submit">submit</button>
                            <div id="msgSubmit" class="h3 text-center hidden"></div>
                            <div class="clearfix"></div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/php/footer.php';
