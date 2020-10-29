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

  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Actor">

  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <link rel="stylesheet" type="text/css" href="../styles/main.css">
  <title>Expense tracker</title>
  <style>
    html,
    body {
      background-image: url("../img/background1.jpg");
      background-size: cover;
      background-repeat: no-repeat;
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
            <a class="my-exp nav-link" href=#></a>
          </li>
          <li class="nav-item mr-2 mt-1">
            <a id="settings" class="nav-link" href="settings.php"></a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li id="logout" class="nav-item mr-2 mt-1">
            <a id="logOut" class="nav-link" href="../controller/logout.php"></a>
          </li>
          <li class="nav-item mr-2">
            <img onclick="setLanguage('hr')" id="flag-hr" src="https://www.countryflags.io/hr/flat/48.png">
            <img onclick="setLanguage('en')" id="flag-en" src="https://www.countryflags.io/gb/flat/48.png">
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">

        <div class="table-wrapper mt-5">

          <table id="expenses" class="table table-scroll table-striped table-dark">
            <thead>
              <tr>
                <th class="item"></th>
                <th class="category"></th>
                <th class="date"></th>
                <th class="amount"></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-md-6">
        <form class="form-horizontal mx-4 mt-4">

          <h4 id="addExpense" class="d-flex justify-content-center"></h4>
          <div class="row">
            <div class="col-25">
              <label for="item" class="item"></label>
            </div>
            <div class="col-75">
              <input type="text" class="form-control" id="item" name="item">
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="selectType" class="category"></label>
            </div>
            <div class="col-75">
              <select id="category" multiple class="form-control">
                <option id="food" value="Food"></option>
                <option id="clothing" value="Clothing"></option>
                <option id="house" value="Household items"></option>
                <option id="tech" value="Technology"></option>
                <option id="transport" value="Transportation"></option>
                <option id="utilities" value="Utilities"></option>
                <option id="other" value="Other"></option>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="price" class="amount"></label>
            </div>
            <div class="col-75">
              <input type="number" class="form-control" id="price" name="price">
            </div>
            <div class="mt-3 ml-2"> HRK</div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="date" class="date"></label>
            </div>
            <div class="col-75">
              <input type="date" id="date" name="date" value="2020-07-01">
            </div>
          </div>
          <div class="row row-last">
            <div class="message"></div>
            <button id="add" type="button" class="btn btn-success ml-auto">
          </div>

          <div class="grid">
            <div class="row">
              <div class="converter col-md-12 d-flex justify-content-center font-weight-bold mb-3"></div>
              <div class="col-md-3">
                <label for="amount" class="amount"></label>
                <input type="number" class="form-control" id="amount" name="amount">
              </div>
              <div class="col-md-4">
                <label for="currency1" id="from"></label>
                <select class="form-control" id="currency1">
                  <option value="1">AUD</option>
                  <option value="2" selected>EUR</option>
                  <option value="3">GBP</option>
                  <option value="4">HRK</option>
                  <option value="5">HUF</option>
                  <option value="6">USD</option>
                </select>
              </div>
              <div class="col-md-1 mt-4">
                <a class="text-success exchange"> <i class='fas fa-exchange-alt'></i></a>
              </div>
              <div class="col-md-4">
                <label for="currency2" id="to"></label>
                <select class="form-control" id="currency2">
                  <option value="1">AUD</option>
                  <option value="2">EUR</option>
                  <option value="3">GBP</option>
                  <option value="4" selected>HRK</option>
                  <option value="5">HUF</option>
                  <option value="6">USD</option>
                </select>
              </div>
            </div>

            <div class="row convert">
              <div id="converted" class="ml-3"></div>
              <button id="convert" type="button" class=" btn btn-success ml-auto"></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>


  <script src="../scripts/switch_language.js"></script>
  <script>
    $(document).ready(function() {
      
      document.querySelector("#date").valueAsDate = new Date();

      var username = '<?php echo $_SESSION['username']; ?>'


      $.post(
        "../controller/getExpenses.php", {
          username: username
        },
        function(expenses) {
          var categories = {
            "Food": x.food,
            "Clothing": x.clothing,
            "Household items": x.house,
            "Technology": x.tech,
            "Transportation": x.transport,
            "Utilities": x.utilities,
            "Other": x.other
          }
          if (expenses != "Error") {
            var expensesList = JSON.parse(expenses);
            for (var i = 0; i < expensesList.length; i++) {
              let category = categories[expensesList[i].category]
              var tableRow = "<tr id='row" + expensesList[i].id + "'><td>"
              tableRow += expensesList[i].item
              tableRow += "</td><td class='" + expensesList[i].category.slice(0, 3) + "'>"

              tableRow += category
              tableRow += "</td><td>"
              tableRow += expensesList[i].purchase_date
              tableRow += "</td><td>"
              tableRow += expensesList[i].price
              tableRow += "</td><td><button type='button' onClick='deleteItem(" + expensesList[i].id + ")' class='btn btn-default'><i class='fa fa-trash'></i></button></td></tr>"

              $("#expenses").append(tableRow)
            }
          }
        }
      );

      $('#add').on('click', function(e) {
        e.preventDefault()
        $(".message").text("")
        var username = '<?php echo $_SESSION['username']; ?>'
        var item = $('#item').val()
        var category = $("#category option:selected").val();

        var price = $("#price").val()
        var date = new Date($("#date").val());
        day = date.getDate();
        month = date.getMonth() + 1;
        year = date.getFullYear();
        var d = [day, month, year].join('/');

        if (item != "" && price != "" && category != "") {
          $.ajax({
            url: "../controller/insert.php",
            type: "POST",
            data: {
              item: item,
              username: username,
              price: price,
              date: d,
              category: category
            },
            success: function(result) {
              var categories = {
                "Food": x.food,
                "Clothing": x.clothing,
                "Household items": x.house,
                "Technology": x.tech,
                "Transportation": x.transport,
                "Utilities": x.utilities,
                "Other": x.other
              }
              if (result != "Error") {
                var tableRow = "<tr id='row" + result + "'><td>"
                tableRow += item
                tableRow += "</td><td class='" + category.slice(0, 3) + "'>"
                tableRow += categories[category]
                tableRow += "</td><td>"
                tableRow += d
                tableRow += "</td><td>"
                tableRow += price
                tableRow += "</td><td><button type='button' onClick='deleteItem(" + result + ")' class='btn btn-default'><i class='fa fa-trash'></i></button></td></tr>"

                $("#expenses").append(tableRow)

              } else {
                alert("Failed to create new entry!")
              }
            }
          })
        } else {
          $(".message").text("Fill in all the fields!")
        }

      })

      $(".exchange").on("click", function() {
        var one = $("#currency1").val();
        var two = $("#currency2").val();

        $("#currency1").val(two);
        $("#currency2").val(one);
      })


      $("#convert").on("click", function() {

        var req = new XMLHttpRequest();
        req.open("GET", "https://api.exchangeratesapi.io/latest", false);
        req.send(null);
        var jsonObject = JSON.parse(req.responseText);
        var result;
        var amount = $("#amount").val()

        if (!amount) {
          $("#converted").text("Please input the amount to convert!");
        } else {
          var one = $("#currency1 option:selected").text();
          var two = $("#currency2 option:selected").text();
          if (one == two) {
            result = amount
          } else if (one == 'EUR') {
            result = amount * jsonObject.rates[two]
          } else if (two == 'EUR') {
            result = amount / jsonObject.rates[one]
          } else {
            result = (amount / jsonObject.rates[one]) * jsonObject.rates[two]
          }
          $("#converted").text("Result: " + parseFloat(result).toFixed(4));
        }
      })

    })

    function deleteItem(id) {
      $.ajax({
        url: "../controller/deleteItem.php",
        type: "POST",
        data: {
          id: id
        },
        success: function(result) {
          var dataResult = JSON.parse(result)
          if (dataResult.statusCode == 500) {
            alert("Item couldn't be deleted, try again")
          } else if (dataResult.statusCode == 200) {
            $("#row" + id).remove()
          }
        }
      })
    }
  </script>
</body>

</html>