<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/php/login/function.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/php/login/db.php'; ?>

<?php $errors = array();?>


<?php
if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {

    $req = $pdo->prepare('SELECT * FROM users WHERE username = :username  OR email = :username');
    $req->execute(['username' => $_POST['username']]);
    $user = $req->fetch();
    if (password_verify($_POST['password'], $user->password)) {
        session_start([
            'cookie_lifetime' => 86400,
        ]);
        $_SESSION['auth'] = $user;
        $_SESSION['flash']['success'] = "Your are connected !";
    }

}
?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/php/header.php'; ?>

<?php    debug($errors);?>


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
                                    <input type="text" class="form-control" id="usename" name="username"
                                           placeholder="Your username or email" value="" required
                                           data-error="Please enter your username or email"/>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="Your password" value="" required
                                           data-error="Please enter your password"/>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
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


<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/php/footer.php'; ?>