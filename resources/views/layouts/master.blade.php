@include('layouts.header')<!-- TOP GENERAL ALERT -->
@if(\Illuminate\Support\Facades\Session::get('info'))
    <div class="alert alert-info top-general-alert">
        <span>{{ \Illuminate\Support\Facades\Session::get('info') }}</span>
        <a type="button" class="close">&times;</a>
    </div>
    @endif
            <!-- END TOP GENERAL ALERT -->

    <!-- TOP BAR -->
    <div class="top-bar" style='background-color:#ECECEC;'>
        <div class="container">
            <div class="row">
                <!-- logo -->
                <div class="col-md-4 col-xs-8 col-sm-8 logo">
                    <a href="#" class="main-nav-toggle">
                        <img src="/assets/img/ova.png" alt="OVA Un" style="height:28px;"/>
                    </a>

                    <h1 class="sr-only">OVA Un</h1>
                </div>
                <!-- end logo -->
                <div class="col-md-8 col-xs-4 col-sm-4">
                    <div class="top-bar-right">
                        <!-- responsive menu bar icon -->
                        <a href="#" class="hidden-md hidden-lg main-nav-toggle"><i class="fa fa-bars"></i></a>
                        <!-- end responsive menu bar icon -->

                    </div>

                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /top -->
    <!-- BOTTOM: LEFT NAV AND RIGHT MAIN CONTENT -->
    <div class="bottom">
        <div class="container">
            <div class="row">
                @if(\Illuminate\Support\Facades\Session::has('musteri.hesapkod'))
                @include('layouts.menu')
                @endif
                <!-- content-wrapper -->
                <div class="col-md-10 content-wrapper">
                    <!-- main -->
                    <div class="content">
                        <div class="main-header" style='margin:10px 0 10px 0;'>
                            <h2>
                                <a href="/musteri" class="modallink" data-title="{{ \Illuminate\Support\Facades\Session::get('musteri.unvan') }}" data-target="#bilgi">
                                    {{ \Illuminate\Support\Facades\Session::get('musteri.unvan') }}
                                </a>
                            </h2>
                            <em>@yield('title')</em>
                        </div>
<hr style='margin:2px 0 2px'>
                        @if(session()->has('mesaj'))
                            <div class="alert alert-success" role="alert">{{ session('mesaj') }}</div>
                            @endif
                        <div class="main-content">
                            @yield('content')

                        </div>
                        <!-- /main-content -->
                    </div>
                    <!-- /main -->
                </div>
                <!-- /content-wrapper -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- END BOTTOM: LEFT NAV AND RIGHT MAIN CONTENT -->
    @include('layouts.footer')