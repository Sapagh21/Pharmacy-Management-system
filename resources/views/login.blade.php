<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="icon" href="{{asset('images/logo2.png')}}" type="image/x-icon">

    <link rel="stylesheet" href="{{asset('style/General.css')}}">
    <link rel="stylesheet" href="{{asset('style/login.css')}}">
    
    <script type="module" src={{asset("src/script.js")}}></script>
</head>

<body>
    <!-- forget password pop-up -->
    <div class="forgot-pass-card">
        <div class="card-content">
            <div class="close link">x</div>
            <span>Focus and you will Evantually Remember it 💙</span>
        </div>
    </div>

    <!-- Container to keep Website content centralized -->
    <div class="container">
        
     
        {{--  Lines below were in case were used cause i forgot  users and passwords  -->--}}
        {{-- <ul> 
            @foreach ($users as $user)
                <li>{{ $user->Username }} - {{ $user->Password }}</li>
            @endforeach
        </ul> --}}
        <section class="login">

            <form class="login-form" action="{{route('login')}}" method="post">
                @csrf
                <!-- Form Header Welcome -->
                <h1 class="Welcome">Welcome to <span class="phar-name">Care</span> Pharmacy</h1>

                <!-- Username and password input -->
                <input type="text" placeholder="Username" name="usern" id="login-user"   value="{{$username ?? ""}}" >
                <input type="password" placeholder="Password" name="pass" id="login-password">
                <!-- forgot pass pop-up trigger -->
                <span id="forgot" class="link">Forgot password?</span>

                <!-- Submit (login) button -->
                <button id="log-in" class="slide-anim" type="submit">
                    <span class="login-text">Log in</span>
                    <div class="slider"></div>
                </button>

                <?= $Error ?? ""?>
            </form>

        </section>
    </div>

</body>

</html>