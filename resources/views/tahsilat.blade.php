@extends('layouts.master')

@section('title')
    Tahsilat
@endsection

@section('content')
<div id='app'>
    <div v-for='yil in yillar' class="row">
        <div class="col-md-2" >
            <span v-text='yil.yil'></span>
        </div>
        <div class="col-md-2" style="text-align:right;">
            Evrak Tutar : <span  v-text='format(yil.evrak_tutar)'></span>
        </div>
        <div class="col-md-2" style="text-align:right;">
            Tutar : <span v-text='format(yil.tutar)'></span>
        </div>
        <div v-if='yil != 0 && ay.yil === yil' v-for='ay in aylar' class="row">
            <div class="col-md-2" >
                <span v-text='ay.ay'></span>
            </div>
            <div class="col-md-2" style="text-align:right;">
                Evrak Tutar : <span  v-text='format(ay.evrak_tutar)'></span>
            </div>
            <div class="col-md-2" style="text-align:right;">
                Tutar : <span v-text='format(ay.tutar)'></span>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
var vue = new Vue({
    el:'#app',
    data:{
        yil:0,
        ay:0,
        yillar:{!! $yillar !!},
        aylar:{!! $aylar !!},
        tahsilatlar:{!! $tahsilatlar !!},
    },
    methods:{
        format(rakam){
                return  numeral(rakam) . format('0,0.00');
            },
    }
});
</script>
@endsection