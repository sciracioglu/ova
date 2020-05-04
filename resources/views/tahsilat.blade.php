@extends('layouts.master')

@section('title')
    Tahsilat
@endsection

@section('content')
<div id='app'>
    <table class="table table-stripped table-condensed table-hover">
        <thead>
            <tr>
                <th>Evrak Yıl</th>
                <th style="text-align: right;">Evrak Tutar</th>
                <th style="text-align: right;">Tutar</th>
            </tr>
        </thead>
        <tbody>
            <div v-for='yil in yillar'>
                <tr style="cursor:pointer;" @click='yil=yil.yil'>
                    <td >@{{ yil.yil }}</td>
                    <td style="text-align: right;" v-text='format(yil.evrak_tutar)'></td>
                    <td style="text-align: right;" v-text='format(yil.tutar)'></td>
                </tr>
                <div v-if='yil && ay.yil === yil' v-for='ay in aylar'>
                    <tr style="cursor:pointer;" @click='ay=ay.ay'>
                        <td >@{{ ay.ay }}</td>
                        <td style="text-align: right;" v-text='format(ay.evrak_tutar)'></td>
                        <td style="text-align: right;" v-text='format(ay.tutar)'></td>
                    </tr>
                </div>
            </div>
        </tbody>
    </table>
</div>
@endsection
@section('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
var vue = new Vue({
    el:'#app',
    data:{
        yil:null,
        ay:null,
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