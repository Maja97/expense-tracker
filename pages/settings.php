<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.3.1/css/flag-icon.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Actor">
  <link rel="stylesheet" type="text/css" href="../styles/main.css">
  <title>Settings</title>
  <style>
    html,
    body {
      background-image: url("../img/background.jpg");
      background-size: cover;
    }
  </style>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-sm navbar-toggleable-sm border-bottom box-shadow">
      <div class="container-fluid">
        <a id="title" class="navbar-brand pr-3 border-right" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav">
          <li class="nav-item mt-1">
            <a id="home" class="nav-link" href="main.php"></a>
          </li>
          <li class="nav-item mr-2 mt-1">
            <a class="my-exp nav-link" href="expenses.php"></a>
          </li>
          <li class="nav-item mr-2 mt-1">
            <a id="settings" class="nav-link" href=#></a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li id="logout" class="nav-item mr-2 mt-1">
            <a id="logOut" class="nav-link" href="../controller/logout.php"></a>
          </li>
          <li class="nav-item">
            <img onclick="setLanguage('hr')" id="flag-hr" src="https://www.countryflags.io/hr/flat/48.png">
            <img onclick="setLanguage('en')" id="flag-en" src="https://www.countryflags.io/gb/flat/48.png">
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <form class="form-horizontal settings-form mx-auto mt-4 px-5">


    <i class="d-flex justify-content-end fa fa-gears" style="font-size:40px"></i>
    <h3 id="settings1" class="d-flex justify-content-center"></h3>

    <div class="row">
      <h5 id="changePassword" class="col-md-7"></h5>
    </div>
    <div class="row">
      <div class="col-md-7">
        <input type="text" class="form-control" id="oldPwd" name="oldPwd">
      </div>
    </div>
    <div class="row">
      <div class="col-md-7">
        <input type="text" class="form-control" id="newPwd" name="newPwd">
      </div>
    </div>
    <div class="row">
      <div class="col-md-7">
        <input type="text" class="form-control" id="newPwd1" name="newPwd1">
      </div>
    </div>

    <div class="row ">
      <div class="col-md-3">
        <button id="changePwd" type="button" class="btn btn-success ml-auto"></button>
      </div>
      <div class="message"></div>
    </div>

    <div class="row ">
      <div class="col-md-12 d-flex justify-content-end">
        <button id="deleteAccount" type="button" class="btn btn-danger ml-auto"></button>
      </div>

  </form>

  <script src="../scripts/switch_language.js"></script>
</body>

<script>
  $(document).ready(function() {
        var username = '<?php echo $_SESSION['username']; ?>'

        $('input').on('focus', function() {
          $('.message').text("")
        })

        $('#deleteAccount').on('click', function(e) {
          e.preventDefault()
          var p = prompt(x.prompt, x.phUsername);
          if (p === username) {
            $.ajax({
              url: "../controller/deleteAccount.php",
              type: "POST",
              data: {
                username: username
              },
              success: function(result) {
                if (result != "Error") {
                  alert(x.deleted)
                  location.href = "../index.php"
                } else {
                  alert(x.notDeleted)
                }
              }
            })
          } else alert(x.notDeleted)
        })


        $('#changePwd').on('click', function(e) {
          e.preventDefault()
          var oldPwd = $("#oldPwd").val()
          var newPwd = $("#newPwd").val()
          var newPwd1 = $("#newPwd1").val()
          if (newPwd != "" && oldPwd != "" && newPwd1 != "") {
            $(".message").text("")
            if (newPwd == newPwd1) {
              if (validatePassword(newPwd)) {
                $.ajax({
                  url: "../controller/changePassword.php",
                  type: "POST",
                  data: {
                    username: username,
                    oldPwd: oldPwd,
                    newPwd: newPwd
                  },
                  success: function(result) {
                    var dataResult = JSON.parse(result);

                    if (dataResult.statusCode == 401) {
                      $(".message").text(x.invalidCurrent)
                    } else if (dataResult.statusCode == 200) {
                      $("#oldPwd").val("")
                      $("#newPwd").val("")
                      $("#newPwd1").val("")
                      $(".message").text(x.changed)
                    } else if (dataResult.statusCode == 400) {
                      $(".message").text(x.wrong)
                    }
                  }
                })
              } else {
                $(".message").text(x.validPwdMsg)
              }
            } else {
              $(".message").text(x.mustMatch)
            }
          } else $(".message").text(x.fillAllFields)

        })
      })

      function validatePassword(pwd) {
        var pwdformat = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/
        return pwdformat.test(pwd)
      }
</script>


</html>