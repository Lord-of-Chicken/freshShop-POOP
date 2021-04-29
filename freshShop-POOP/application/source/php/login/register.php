<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/php/login/db.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/php/login/function.php'; ?>

<?php
$errors = array();


if (!empty($_POST)) {


    if (empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
        $errors['username'] = "Username is not valide";
    } else {
        $req = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        $req->execute([$_POST['username']]);
        $user = $req->fetch();

        if ($user) {
            $errors['username'] = 'Username already exist !';
        }
    }

    if (empty($_POST['firstname']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['firstname'])) {
        $errors['firstname'] = "firstname is not valide";
    }

    if (empty($_POST['lastname']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['lastname'])) {
        $errors['lastname'] = "lastname is not valide";
    }


    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email is not valide";
    } else {
        $req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $req->execute([$_POST['email']]);
        $user = $req->fetch();
        if ($user) {
            $errors['email'] = 'E-Mail already exist !';
        }
    }


    if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
        $errors['password'] = "Invalid password";
    }

    if (empty($errors)) {
        $req = $pdo->prepare("INSERT INTO users SET username = ?, email = ?, firstname = ?, lastname = ?, password = ?");
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $req->execute([$_POST['username'], $_POST['email'], $_POST['firstname'], $_POST['lastname'], $password,]);
    }
    debug($errors);

} ?>


<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/php/header.php'; ?>


    <div class="contact-box-main">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-sm-12">
                    <div class="contact-form-right">

                        <h2>Register : Please Fill in All the Blanks</h2>

                        <form method="POST" action="" id="registerForm">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="username" name="username"
                                               placeholder="Your username" value="" required
                                               data-error="Please enter your username"/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="email" name="email"
                                               placeholder="Your email" value="" required
                                               data-error="Please enter your email"/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="firstname" name="firstname"
                                               placeholder="Your fist name" value="" required
                                               data-error="Please enter Your fist name"/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="lastname" name="lastname"
                                               placeholder="Your last name" value="" required
                                               data-error="Please enter Your last name"/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="password" name="password"
                                               placeholder="Your password" value="" required
                                               data-error="Please enter Your password"/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="password_confirm"
                                               name="password_confirm" placeholder="Your password confirmation" value=""
                                               required data-error="Please enter Your password confimation"/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="submit-button text-center">
                                <button class="btn hvr-hover" id="submit" type="submit">submit</button>
                                <div id="registerSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>

                        </form>


                    </div>
                </div>


            </div>
        </div>
    </div>


<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/php/footer.php';