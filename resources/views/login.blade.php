<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Happy Skin</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}" />
</head>

<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">

                        <!-- <div class="col-lg-6"> -->
                        <div class="card-body p-md-5 mx-md-4">

                            <div class="text-center">
                                <img src="./assets/images/logo2.png" style="width: 100px; padding-bottom:10px;" alt="logo">

                            </div>

                            <form action="{{route('user.login')}}" method="POST" >
                                @csrf
                                <p>Please login to your account</p>

                                <div class="form-outline mb-4">
                                    <input type="email" class="form-control" name="email" placeholder=" email address" />
                                    <label class="form-label" for="form2Example11">email</label>
                                </div>


                                <div class="form-outline mb-4">
                                    <input type="password"  name="password" class="form-control" />
                                    <label class="form-label" for="form2Example22">Password</label>
                                </div>

                                <div class="text-center pt-1 mb-5 pb-1">
                                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Log
                                        in</button>

                                </div>


                            </form>

                        </div>



                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>