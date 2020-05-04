@extends('layouts.master')

@section('title')
    Sipariş
@stop


@section('content')
    <div class="row">
        <div class="col-md-12">
            {!! Form::open([
                    'data-remote',
                    'route'=>"siparis",
                    'data-validate-form'=>true,
                    'data-success-message'=> 'Kaydedildi',
                    'data-failed-message'=> 'Hata',
                    'data-validation-message' => 'Tum alanlar gerekli',
                    'data-success-trigger' => "KalemListe()"]) !!}

            @include('_ust')
             <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-plus"></i> Ekle</button>
            </div>
            @include('_form')



            {!! Form::close() !!}
            @include('errors.list')
        </div>


    </div>
    <div class="row">
        <div class="col-md-12" id="kalemler">

        </div>
    </div>
@endsection

@section('scripts')
    <script>

        function UrunSec(kod, ad) {
            $('#malad').val(ad);
            $('#malkod').val(kod);
        }
        $(document).ready(function(){
            id = $('#sevk').val();
            SevkAdres(id);
            TarihHesap();
                });
        jQuery("#teslim").datetimepicker({
                                             datepicker: true,
                                             timepicker: false,
                                             yearStart:{{ date('Y') }},
                                             yearEnd:{{ date('Y')+1 }},
                                             mask: '39/19/9999', format: 'd/m/Y',
                                             onShow: function (ct) {
                                                 this.setOptions({
                                                                     minDate: '{{ date('d/m/Y')  }}'
                                                                 })
                                             }

                                         });

        function TarihHesap(){
            ops = $('#opsiyon').val();
            $.ajax({
                url: '/siparis/opsiyon',
                type: 'GET',
                data: {ops:ops},
                success: function (result) {
                    $("#tarih_hesap").html(result);
                }
            });
        }

        function UrunFiyat(kod){
            $.ajax({
                url: '/siparis/urunfiyat',
                type: 'GET',
                data: {kod:kod},
                success: function (result) {
                    veri = $.parseJSON(result);
                    $("#urun_fiyat").val(veri.liste);
                    $("#oran").val(veri.iskonto);
                    $("#fiyat").val(veri.fiyat);
                    $("#kdv").val(veri.kdv);

                }
            });
        }

        function SevkAdres(hsp){
            $.ajax({
                url: '/siparis/urunsevk',
                type: 'GET',
                data: {hsp:hsp},
                success: function (result) {
                    $("#sevkAdres").html(result);
                }
            });
        }

        function IskontoHesap(){

            var $fiyat = $('#fiyat').val();
            var $urun_fiyat = $('#urun_fiyat').val();
            if($urun_fiyat>0){
                $iskonto = ($urun_fiyat - $fiyat) *100/$urun_fiyat;

                $('#oran').val($iskonto.toFixed(2));
            }

        }

        function FiyatHesap(){
            var $iskonto = $('#oran').val();
            var $urun_fiyat = $('#urun_fiyat').val();
            if($urun_fiyat>0){
                var $fiyat = $urun_fiyat - ($urun_fiyat * $iskonto) /100;

                $('#fiyat').val($fiyat.toFixed(2));
            }
        }

        function KalemListe(){
            $.ajax({
                url: '/siparis/kalem',
                type: 'GET',
                success: function (result) {
                    $("#kalemler").html(result);
                }
            });
        }

    </script>
@endsection