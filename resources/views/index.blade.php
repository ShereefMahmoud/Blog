<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> {{ $title }}</title>

    <link rel="shortcut icon" href="{{ url('assets/images/fav.jpg') }}">
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/fontawsom-all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/style.css') }}" />
</head>

<body>
    <div class="container-fluid ">

                <div class=" no-pdding login-box">
                    <div class="row no-margin w-100 bklmj">
                        <div class="col-lg-6 col-md-6 log-det">

                            <h2>Login</h2>


                            <div class="row no-margin past">
                                <p>Dont Have an Account? <span>Create your Account</span> </p>
                            </div>


                        <form action="{{ url("/Dologin") }}" method="POST">

                            @csrf
                            <div class="text-box-cont">
                                @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">
                                    <ul>
                                        <li>{{ $error }}</li>
                                    </ul>
                                </div>

                                @endforeach

                                @if (session()->get('Message'))

                                <div class="alert alert-danger">
                                    <ul>
                                        <li>{{ session()->get('Message') }}</li>
                                    </ul>
                                </div>
                                @endif

                                <div class="input-group mb-3">

                                    <input type="email" class="form-control" name="email" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" value="{{ old('email') }}">
                                </div>
                                 <div class="input-group mb-3">

                                    <input type="password" class="form-control" name="password" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="row no-margin">
                                    <p class="forget-p">Forget Password ?</p>
                                </div>
                                <div class="right-bkij mb-3">
                                    <button type="submit" class="btn btn-success btn-round">sign In</button>
                                </div>
                                <br>
                                <div class="row linkoi">
                                  <div class="col-sm-5">
                                      <p>Or login with</p>
                                  </div>
                                   <div class="col-sm-7">
                                       <ul>
                                            <li><i class="fab fa-facebook-f"></i></li>
                                            <li><i class="fab fa-twitter"></i></li>

                                        </ul>
                                   </div>
                                </div>
                            </div>
                        </form>



                        </div>
                        <div class="col-lg-6 col-md-6 box-de">
                            <div class="ditk-inf">
                                <h2 class="w-100">Welcome </h2>
                                <p> If You Want To Show All Blogs<br> clicking the Show Blogs Button</p>
                                <a href="{{ url('/') }}"><button type="button" class="btn btn-outline-light" style="width: 110px">Show Blogs</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</body>

<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/script.js"></script>


</html>
