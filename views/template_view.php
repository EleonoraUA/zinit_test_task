<!DOCTYPE HTML>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="/views/styles/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.1.0.min.js"
            integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
    <script src="/views/jquery/jquery.validationEngine.js"></script>
    <script src="/views/jquery/jquery.validationEngine-en.js"></script>
    <link rel="stylesheet" href="/views/styles/validationEngine.jquery.css"/>
    <script>
        $(document).ready(function () {
            $("#login_form").validationEngine('attach');
            $("#login_submit").click(function (event) {

                event.preventDefault();

                var email = $('#user_email').val();
                var password = $('#user_password').val();

                $.ajax({
                    url: '/Login/index/',
                    data: "email=" + email + "&password=" + password,
                    type: 'POST',
                    dataType: 'json',
                    success: function (data) {
                        if (data['status']) {
                            $('#info').append('<div class = "alert alert-success"> Success! Id:' + data['id'] + ' Last visit:' + data['last_visit'] + '</div>');
                        } else {
                            alert("Oops... Not valid email or password");
                        }
                    }
                });
            });
        });
    </script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
            <div id="info">
                <div class=" alert alert-info">
                    <h4>
                        Please log in with <b>test@example.com</b> and <b>12345</b>
                    </h4>
                </div>
            </div>
            <form name="login" action="/Login/index/" id="login_form">
                <div class="form-group">
                    <label for="user_email">Email address</label>
                    <input type="email" class="form-control validate[required, custom[email]]" id="user_email"
                           placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="user_password">Password</label>
                    <input type="password" class="form-control" id="user_password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-default" id="login_submit">Submit</button>
            </form>
        </div>
    </div>
</div>
</body>

</html>