var x
getLanguage()
var lang = localStorage.getItem("language")
setLanguage(lang)

function getLanguage() {
    (localStorage.getItem('language') == null) ? setLanguage('en') : false;
    $.ajax({
        url: (location.pathname === '/web-projekt/index.php') ? "./language/" + localStorage.getItem('language') + '.json' : "../language/" + localStorage.getItem('language') + '.json',
        dataType: 'json', async: false, dataType: 'json',
        success: function (lang) { x = lang }
    })
}

function setLanguage(lang) {
    var flagCro = document.getElementById("flag-hr")
    var flagEng = document.getElementById("flag-en")

    if (lang === 'hr') {
        flagCro.style.right = "65px"
        flagCro.style.width = "56px"
        flagEng.style.width = "auto"
        
    } else {
        
        flagCro.style.right = "72px"
        flagCro.style.width = "auto"
        flagEng.style.width = "56px"
    }
    localStorage.setItem('language', lang)
    getLanguage()

    if (location.pathname === '/web-projekt/index.php') {
        $('#title').text(x.title)
        $("#login-form-link").text(x.signIn)
        $("#register-form-link").text(x.register)
        $("#rememberme").text(x.remember)
        $("#noAcc").text(x.noAcc)
        $("#regHere").text(x.regHere)
        $(".login-btn").val(x.login)
        $(".username").attr("placeholder", x.phUsername)
        $(".password").attr("placeholder", x.phPassword)
        $(".confirm-password").attr("placeholder", x.phConfirmPassword)
        $(".register-btn").val(x.register)
        $(".full-name").attr("placeholder", x.fullName)
        $(".email").attr("placeholder", x.email)
        $("#regMsg").text("")
        $('#loginMsg').text("")
    } else if (top.location.pathname === '/web-projekt/pages/main.php') {
        setNavBarLang()
        $("#info").text(x.info)
        var original = $("#welcome").text()
        var result = original.substr(original.indexOf(" ") + 1);
        $("#welcome").text(x.welcome + result)
        $("#info3").text(x.info3)
        $("#here").text(x.here)
        $("#check").text(x.check)
    } else if (top.location.pathname === '/web-projekt/pages/expenses.php') {
        setNavBarLang()
        $('#from').text(x.from)
        $('#to').text(x.to)
        $(".category").text(x.category)
        $(".item").text(x.item)
        $(".date").text(x.date)
        $(".amount").text(x.amount)
        $("#item").attr("placeholder",x.phItem)
        $("#price").attr("placeholder",x.phPrice)
        $("#addExpense").text(x.addExpense)
        $(".converter").text(x.currConverter)
        $("#convert").text(x.convert)
        $("#add").text(x.new)
        $("#food").text(x.food)
        $("#clothing").text(x.clothing)
        $("#house").text(x.house)
        $("#tech").text(x.tech)
        $("#transport").text(x.transport)
        $("#utilities").text(x.utilities)
        $("#other").text(x.other)
        $(".Foo").text(x.food)
        $(".Hou").text(x.house)
        $(".Clo").text(x.clothing)
        $(".Uti").text(x.utilities)
        $(".Oth").text(x.other)
        $(".Tec").text(x.tech)
        $(".Tra").text(x.transport)
    }
    else if (top.location.pathname === '/web-projekt/pages/settings.php') {
        setNavBarLang()
        $("#changePassword").text(x.changePassword)
        $("#changePwd").text(x.changePwd)
        $("#deleteAccount").text(x.deleteAccount)
        $("#settings1").text(x.settings)
        $("#oldPwd").attr("placeholder",x.enterOld)
        $("#newPwd").attr("placeholder",x.enterNew)
        $("#newPwd1").attr("placeholder",x.enterNewAgain)
        $(".message").text("")
    }

}

function setNavBarLang() {
    $("#home").text(x.home)
    $(".my-exp").text(x.myExp)
    $("#settings").text(x.settings)
    $("#title").text(x.title)
    $("#logOut").text(x.logout)
}