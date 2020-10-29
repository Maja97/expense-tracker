<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/fe810109aa.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Actor">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.3.1/css/flag-icon.min.css" rel="stylesheet" />
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="./styles/login.css">
</head>

<body>

    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <img onclick="setLanguage('hr')" id="flag-hr" src="https://www.countryflags.io/hr/flat/48.png">
            <img onclick="setLanguage('en')" id="flag-en" src="https://www.countryflags.io/gb/flat/48.png">
            <div class="card">
                <div class="card-header">
                    <h3 id="title"></h3>
                    <ul class="nav nav-tabs nav-fill card-header-tabs justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" id="login-form-link"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="register-form-link"></a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <form id="login-form" style="display: block" method="post">
                        <div class="input-group form-group">
                            <input type="text" class="form-control username" name="username" id="loginUsername">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                            </div>
                        </div>
                        <div class="input-group form-group">
                            <input type="password" class="form-control password" name="pwd" id="loginPwd" autocomplete="on">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                        </div>
                        <div class="row align-items-center remember" name="remember">
                            <input type="checkbox" id="remember">
                            <label id="rememberme"></label>
                        </div>
                        <div id="loginMsg"></div>
                        <div class="form-group d-flex justify-content-center">
                            <input type="submit" class="btn login-btn" id="loginBtn" name="action">
                        </div>
                    </form>
                    <form id="register-form" style="display: none" method="post">
                        <div class="input-group mx-auto form-group">
                            <input type="text" class="form-control full-name" name="fullname" id="fullname" placeholder="Full name">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                        </div>
                        <div class="input-group mx-auto form-group">
                            <input type="text" class="form-control email" name="email" id="email" placeholder="Email address">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                        </div>
                        <div class="input-group mx-auto form-group">
                            <label for="validationDefault01"></label>
                            <input type="text" class="form-control username" name="username" id="username">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                            </div>
                        </div>
                        <div class="input-group mx-auto form-group">
                            <input type="password" class="form-control password" name="pwd" id="pwd" autocomplete="on">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                        </div>
                        <div class="input-group mx-auto form-group">
                            <input type="password" class="form-control confirm-password" name="confirmpwd" id="confirmpwd" autocomplete="on">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span><br>
                            </div><br>
                        </div>
                        <div id="regMsg"></div>
                        <div class="form-group d-flex justify-content-center">
                            <input type="submit" class="btn register-btn" id="regBtn">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        <div id="noAcc"></div>
                        <a id="regHere" href="#"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./scripts/switch_login_register.js"></script>
    <script src="./scripts/switch_language.js"></script>
    <script>
        $(document).ready(function() {


            $('input').on('focus', function() {
                $('#regMsg').text("")
                $('#loginMsg').text("")
            })

            $('#loginBtn').on('click', function(e) {
                e.preventDefault()
                var username = $('#loginUsername').val()
                var password = $('#loginPwd').val()
                var remember = $('#remember').prop('checked')

                if (username != "" && password != "") {

                    $.post(
                        "./controller/login.php", {
                            username: username,
                            password: password,
                            remember: remember
                        },
                        function(result) {

                            var dataResult = JSON.parse(result)

                            if (dataResult.statusCode == 404) {
                                $('#loginMsg').text(x.wrongNameOrPwd)
                            } else {
                                location.href = "./pages/main.php"
                            }
                        }
                    );

                } else {
                    $('#loginMsg').text(x.fillAllFields)
                }

            })

            $('#regBtn').on('click', function(e) {
                e.preventDefault()
                var fullname = $('#fullname').val()
                var username = $('#username').val()
                var email = $('#email').val()
                var password = $('#pwd').val()
                var confirmpassword = $('#confirmpwd').val()

                if (fullname == "" || email == "" || password == "" || confirmpassword == "") {
                    $('#regMsg').text(x.fillAllFields)
                    clearFields()
                } else if (password != confirmpassword) {
                    $('#regMsg').text(x.noPwdMatch)
                } else if (!validateEmail(email)) {
                    $('#regMsg').text(x.enterValidMail)
                } else if (!validateUsername(username)) {
                    $('#regMsg').text(x.validUsernameMsg)
                } else if (!validatePassword(password)) {
                    $("#regMsg").text(x.validPwdMsg)
                } else {
                    $.ajax({
                        url: "./controller/register.php",
                        type: "POST",
                        data: {
                            fullname: fullname,
                            username: username,
                            email: email,
                            password: password
                        },
                        success: function(result) {
                            var dataResult = JSON.parse(result)
                            if (dataResult.statusCode == 409) {
                                $('#regMsg').text(x.usernametaken)
                                $("#username").val("")
                            } else if (dataResult.statusCode == 422) {
                                $('#regMsg').text(x.emailtaken)
                                $("email").val("")
                            } else if (dataResult.statusCode == 200) {
                                location.href = "./index.php"
                            }
                        }
                    })
                }
            })
        })

        function clearFields() {
            $('#fullname').val("")
            $('#username').val("")
            $('#email').val("")
            $('#pwd').val("")
            $('#confirmpwd').val("")
        }

        function validateEmail(mail) {
            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
            return mailformat.test(mail);
        }

        function validateUsername(name) {
            var usernameformat = /^(?=.*?[a-z])(?=.*?[0-9]).{6,}$/
            return usernameformat.test(name)
        }

        function validatePassword(pwd) {
            var pwdformat = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/
            return pwdformat.test(pwd)
        }
    </script>
    <?php
    if (isset($_COOKIE['username']) and isset($_COOKIE['pwd'])) {
        $username = $_COOKIE['username'];
        $pwd  = $_COOKIE['pwd'];
        echo "
                <script>
                    document.getElementById('loginUsername').value = '$username';
                    document.getElementById('loginPwd').value  = '$pwd';
                </script>
            ";
    }
    ?>
</body>

</html>