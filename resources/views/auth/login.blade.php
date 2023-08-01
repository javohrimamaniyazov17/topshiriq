<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
    <link rel="stylesheet" href="{{ asset('assets/login.css')}} ">

</head>

<body>
    <!-- partial:index.partial.html -->
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form class="login" action="{{ url('login')}}" method="post">
                  @csrf
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="email" required name="email" class="login__input" placeholder="Email">
                        @error('email')
                            <div>{{email}}</div>
                        @enderror
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" required name="password" class="login__input" placeholder="Password">
                    </div>
                    <button type="submit" class="button login__submit">
                        <span class="button__text">Log In</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                </form>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>
    <!-- partial -->

</body>

</html>
