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

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Actor">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../styles/main.css">
  <title>Expense tracker</title>
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
            <a id="home" class="nav-link" href=#></a>
          </li>
          <li class="nav-item mr-2 mt-1">
            <a class="my-exp nav-link" href="expenses.php"></a>
          </li>
          <li class="nav-item mr-2 mt-1">
            <a id="settings" class="nav-link" href="settings.php"></a>
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

  <div class="container-fluid">
    <div class="row">

      <main role="main" class="col-md-9 mx-auto col-lg-10 pb-4">
        <div class="welcome-text d-flex flex-column flex-fill align-items-center pb-2 mb-3">
          <h2 id="welcome"><?php echo $_SESSION['username']; ?></h2>
          <div id="check"></div>
        </div>
        <div class="row charts">

          <div id="info" class="col-md-11 mx-auto"></div>

          <div class="col-md-5">
            <canvas id="chart-area"></canvas>
          </div>
          <div class="col-md-7">
            <canvas id="lineChart" width="900" height="500"></canvas>
          </div>
          <div class="row col-md-10 ml-4 info3" style="font-size: 18px;">
            <div id="info3"></div>&nbsp;<a id="here" href="expenses.php"></a>
          </div>
        </div>
      </main>
    </div>
  </div>


  <script src="../scripts/switch_language.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
  <script>
    $(document).ready(function() {

      Chart.defaults.global.defaultFontColor = "#000000";

      var m = {
        "JAN": 0,
        "FEB": 0,
        "MAR": 0,
        "APR": 0,
        "MAY": 0,
        "JUN": 0,
        "JUL": 0,
        "AUG": 0,
        "SEP": 0,
        "OCT": 0,
        "NOV": 0,
        "DEC": 0
      }
      var c = {
        "Food": 0,
        "Household items": 0,
        "Clothing": 0,
        "Technology": 0,
        "Transportation": 0,
        "Utilities": 0,
        "Other": 0
      }
      var username = '<?php echo $_SESSION['username']; ?>';
      $.post(
        "../controller/getExpenses.php", {
          username: username
        },
        function(expenses) {

          if (expenses != "Error") {
            $("#info").css("display", "none")
            $("#chart-area").css("display", "block")
            $("#lineChart").css("display", "block")

            var categories = [];

            var expensesList = JSON.parse(expenses);
            for (var i = 0; i < expensesList.length; i++) {
              categories.push(expensesList[i].category)
              let cat = expensesList[i].category
              let price = expensesList[i].price

              if (cat == "Food") c["Food"] += parseFloat(price)
              else if (cat == "Household items") c["Household items"] += parseFloat(price)
              else if (cat == "Clothing") c["Clothing"] += parseFloat(price)
              else if (cat == "Technology") c["Technology"] += parseFloat(price)
              else if (cat == "Transportation") c["Transportation"] += parseFloat(price)
              else if (cat == "Utilities") c["Utilities"] += parseFloat(price)
              else if (cat == "Other") c["Other"] += parseFloat(price)


              var date = expensesList[i].purchase_date
              var dateParts = date.split("/")

              var dateObject = new Date(+dateParts[2], dateParts[1], +dateParts[0])
              var currentYear = new Date().getFullYear()
              if (dateObject.getFullYear() == currentYear) {
                let month = dateObject.getMonth()

                if (month == 1) m["JAN"] += parseFloat(price)
                else if (month == 2) m["FEB"] += parseFloat(price)
                else if (month == 3) m["MAR"] += parseFloat(price)
                else if (month == 4) m["APR"] += parseFloat(price)
                else if (month == 5) m["MAY"] += parseFloat(price)
                else if (month == 6) m["JUN"] += parseFloat(price)
                else if (month == 7) m["JUL"] += parseFloat(price)
                else if (month == 8) m["AUG"] += parseFloat(price)
                else if (month == 9) m["SEP"] += parseFloat(price)
                else if (month == 10) m["OCT"] += parseFloat(price)
                else if (month == 11) m["NOV"] += parseFloat(price)
                else if (month == 12) m["DEC"] += parseFloat(price)
              }
            }

            Object.keys(c).forEach(key => {
              if (c[key] == 0) delete c[key];
            });

            var ctx = document.getElementById("chart-area");
            var pieChart = new Chart(ctx, {
              type: 'doughnut',
              data: {
                labels: Object.keys(c),
                datasets: [{
                  label: 'Categories',
                  data: Object.values(c),
                  backgroundColor: [
                    '#9400D3',
                    "#4b0082",
                    '#00529B',
                    "#007CC3",
                    "#7AC142",
                    "#377B2B",
                    "#FDBB2F"
                  ],
                  borderColor: "#000000",
                  borderWidth: 1,
                }]
              },

              options: {

                title: {
                  display: true,
                  text: "Spending by category",
                  fontSize: 18
                },
                legend: {
                  display: true,
                  labels: {
                    fontColor: "#000000",
                    fontSize: 18
                  },
                  position: "right"
                }
              },

            });


            var ctx1 = document.getElementById("lineChart");
            var lineChart = new Chart(ctx1, {
              type: 'bar',
              data: {
                labels: Object.keys(m),
                datasets: [{
                  data: Object.values(m),
                  lineTension: 0,
                  backgroundColor: '#568226',
                  borderColor: '#7ed81a',
                  borderWidth: 2
                }]
              },
              options: {
                title: {
                  display: true,
                  text: 'Spending by months',
                  fontSize: 18
                },
                scales: {
                  yAxes: [{
                    ticks: {
                      beginAtZero: false
                    }
                  }]
                },
                legend: {
                  display: false,
                }
              }
            });
          } else {
            $(".info3").css("display", "none")
          }
        })
    });
  </script>
</body>

</html>