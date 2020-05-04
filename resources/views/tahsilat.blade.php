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
                <td style="text-align: center;">@{{ $yil }}</td>
                <td style="text-align: right;">@{{ evrak_tutar }}</td>
                <td style="text-align: right;">@{{ tutar }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
var vue = new Vue({
    el:'#app',
    body:{
        yillar:{!! $yillar !!},
        aylar:{!! $aylar !!},
        tahsilatlar:{!! $tahsilatlar !!},
    }
})
</script>
@endsection