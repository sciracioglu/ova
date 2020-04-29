@include('layouts.header')<!-- TOP GENERAL ALERT -->
@if(\Illuminate\Support\Facades\Session::get('info'))
    <div class="alert alert-info top-general-alert">
        <span>{{ \Illuminate\Support\Facades\Session::get('info') }}</span>
        <a type="button" class="close">&times;</a>
    </div>
    @endif
            <!-- END TOP GENERAL ALERT -->

    <!-- TOP BAR -->
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <!-- logo -->
                <div class="col-md-4 col-xs-8 col-sm-8 logo">
                    <a href="#" class="main-nav-toggle">
                        <img src="/assets/img/ankara_logo.png" alt="OVA Un" style="height:28px;"/>
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
                                Faturanldırılmamış Siparişlerim
                            </h2>
                        </div>
<hr style='margin:2px 0 2px;'>
                        <div class="main-content">
                             <div class="row">
                                    <div class="col-md-12" id="liste">
                                    @if(count($siparisler) > 0)
                                    <table class="table table-stripped table-condensed table-hover">
                                            <thead>
                                            <tr>

                                                <th>Evrak No</th>
                                                <th>Ünvan</th>
                                                <th>Evrak Tarihi</th>

                                                <th></th>

                                            </thead>
                                            <tbody>
                                            <?php
                                            $evraktip = \Illuminate\Support\Facades\Session::get('evraktip');
                                            ?>
                                            @foreach($siparisler as $s)
                                                <?php

                                                list($y, $a, $g) = explode('-', $s->EVRAKTARIH);

                                                ?>
                                                <tr>

                                                    <td>{{ $s->EVRAKNO }}</td>
                                                    <td>{{ $s->UNVAN }}</td>
                                                    <td>{{ $g }}.{{ $a }}.{{ $y }}</td>

                                                    <td style="text-align: right">
                                                        <a href="/siparis/detay/{!! $s->EVRAKNO !!}" class="modallink btn btn-xs btn-primary" data-title="{{ $s->EVRAKNO }}" data-target="#bilgi">
                                                           <i class="fa fa-search"></i> Detay
                                                        </a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                            @else
                                Faturalandırılmamış sipariş bulunamadı.
                            @endif




                                    </div>

                                </div>

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



