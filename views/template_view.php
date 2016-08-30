<!DOCTYPE HTML>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../styles/bootstrap.min.css">
    <script   src="https://code.jquery.com/jquery-3.1.0.min.js"   integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="   crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
            <form name="login_form" action="/Login/index/">
                <div class="form-group">
                    <label for="user_email">Email address</label>
                    <input type="email" class="form-control" id="user_email" placeholder="Email">
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

<script>
    $("#login_submit").click(function (event) {

        event.preventDefault();

        var email = $('#user_email').val();
        var password = $('#user_password').val();

        $.ajax({
            url: '/Login/index/',
            data: "email="+email+"&password="+password,
            type: 'POST',
            dataType: 'json',
            success: function(data){
                if (data['status']) {
                    alert("You have successfully logged in");
                } else {
                    alert("Oops... Not valid email or password");
                }
            }
        });
    });
</script>
</html>