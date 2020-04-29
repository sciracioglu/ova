@extends('layouts.master')

@section('title')

    Sipariş Listesi
@stop


@section('content')
    <div class="row">
        <div class="col-md-12" id="liste">


        </div>

    </div>
@endsection

@section('scripts')
<script>
    $( document ).ready(function() {
       SiparisListe();
    });

    function SiparisListe(){

        $.ajax({
                   url: '/siparis/liste',
                   type: 'GET',
                   data: {},
                   success: function (result) {
                       $("#liste").html(result);
                   }
               });
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