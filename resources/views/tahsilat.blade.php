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
                <th>Evrak Tutar</th>
                <th>Tutar</th>
            </tr>
        </thead>
        <tbody>
            <tr style="cursor:pointer;" v-for='yil in yillar'>
                <td >@{{ yil.yil }}</td>
                <td style="text-align: right;" v-text='format(yil.evrak_tutar)'></td>
                <td style="text-align: right;" v-text='format(yil.tutar)'></td>
            </tr>
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