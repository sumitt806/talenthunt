<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- General CSS Files -->
    <link href="{{ mix('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ mix('assets/css/font-awesome.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ mix('assets/web/css/style.css') }}">
    <link rel="stylesheet" href="{{ mix('assets/web/css/components.css')}}">
</head>

<body>
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="login-brand">
                        <img src="{{ mix('assets/img/infyom-logo.png') }}" alt="logo" width="100"
                             class="shadow-light">
                    </div>
                    @yield('content')
                    <div class="simple-footer">
                        Copyright &copy; {{ config('app.name') }} {{ date('Y') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- General JS Scripts -->
<script src="{{ mix('assets/js/jquery.min.js') }}"></script>
<script src="{{ mix('assets/js/popper.min.js') }}"></script>
<script src="{{ mix('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ mix('assets/js/jquery.nicescroll.js') }}"></script>
<script src="{{ mix('assets/js/moment.min.js') }}"></script>

<!-- JS Libraies -->

<!-- Template JS File -->
<script src="{{ mix('assets/web/js/stisla.js') }}"></script>
<script src="{{ mix('assets/web/js/scripts.js') }}"></script>
<!-- Page Specific JS File -->
</body>
</html>
