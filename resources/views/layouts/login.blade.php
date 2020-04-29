@include('layouts.header')
<body>
<div class="full-page-wrapper page-login text-center">

    <div class="inner-page">

        <div class="logo">
            <a href="/">
                <img src="/assets/img/ova_golge.png" alt="OVA Un" />
            </a>
        </div>


        <div class="login-box center-block">
            @yield('form')
        </div>
    </div>
    <br>
    <br>
    <br>
    <footer class="footer">&copy; {{ date('Y') }} <img src="/assets/img/aragonit.png" width="100" /></footer>

</div>

<!-- Javascript -->
<script type="text/javascript" src="/assets/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/js/modernizr.js"></script>

</body>

</html>