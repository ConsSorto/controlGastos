@extends('layouts.app')
@section('script0', "https://www.gstatic.com/charts/loader.js")
@section('script-inline')
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Tipo de gasto', 'Gasto'],
                    @foreach($alldata as $data)
                ['{{$data->TipoGasto}}',{{$data->Gasto}}],
                @endforeach
            ]);

            var options = {
                title: 'Grafico de Gastos'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
@endsection
@section('content')
<div class="row">
<table class="table table-hover table-responsive-xs">
    <thead>
        <tr>
            <th>
                Fecha Inicial
            </th>
            <th>
                Fecha Final
            </th>
            <th>
                Activo
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                {{$expense_control->initialDate->format('d/m/y')}}
            </td>
            <td>
                {{$expense_control->finalDate->format('d/m/y')}}
            </td>
            <td>
                @if($expense_control->active == 1)
                    <span class="oi oi-check">
                    </span>
                @endif
            </td>
        </tr>
    </tbody>
</table>
</div>
<div class="row">
    <table class="table table-hover table-responsive-xs">
        <thead>
            <tr>
                <th>
                    Limite
                </th>
                <th>
                    Gasto
                </th>
                <th>
                    Ahorro
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {{$expense_control->limit}}
                </td>
                <td>
                    {{$expense_control->spent}}
                </td>
                <td>
                    <div @if($expense_control->saving >= 0)
                        class = "text-primary"
                    @else 
                        class = "text-secondary"
                    @endif> 
                        {{$expense_control->saving}}
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
    <div class="card">
        <div class="card-body" align="center">
            <div id="piechart" style="width:100%; height:100%;">
            </div>
        </div>
    </div>
@endsection
