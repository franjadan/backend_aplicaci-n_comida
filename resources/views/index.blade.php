@extends('layout')

@section('title', "Inicio")

@section('content')
    <!--Donde voy a colocar los gráficos-->
    <div class="row justify-content-md-center">
        <div id="first_chart" style="width:100%; height:400px;"></div>     
    </div>
    <div class="row">
        <div id="second_chart"  style="width:50%; height:400px;"></div>
        <div id="third_chart" style="width:50%; height:400px;"></div>
    </div>
@endsection

@section('analytics')
    <script type="text/javascript">

        //Array de meses
        var monthsArray = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

        //Obtengo el mes y el año actual con los datos que recibe la vista
        var month = <?php echo $month; ?>;
        month = monthsArray[month - 1];
        var year = <?php echo $year; ?>;

        //Obtengo los datos enviados a la vista
        var products = <?php echo $products; ?>;
        var months = <?php echo $months; ?>;
        var categories = <?php echo $categories; ?>;

        google.charts.load('current', {'packages':['corechart']});

        google.charts.setOnLoadCallback(drawChart); //Función que va a dibujar los gráficos

        function drawChart()
        {
            //Añado los datos al gráfico
            var data = google.visualization.arrayToDataTable(months);
            var options = {
            title : 'Pedidos del ' + year
            };

            //Dibujo el gráfico
            var chart = new google.visualization.LineChart(document.getElementById('first_chart'));
            chart.draw(data, options);

            //Añado los datos al gráfico
            data = google.visualization.arrayToDataTable(categories);
            options = {
            title : 'Categorías vendidas en ' + month
            };

            //Dibujo el gráfico
            chart = new google.visualization.PieChart(document.getElementById('second_chart'));
            chart.draw(data, options);

            //En caso de no haber datos cambio el mensaje que muestra por defecto
            if(data.getNumberOfRows() == 0){
                $("text").last().html("No hay ventas en " + month);
            }

            //Añado los datos al gráfico
            data = google.visualization.arrayToDataTable(products);
            options = {
            title : 'Productos vendidos en ' + month
            };

            //Dibujo el gráfico
            chart = new google.visualization.PieChart(document.getElementById('third_chart'));
            chart.draw(data, options);

            //En caso de no haber datos cambio el mensaje que muestra por defecto
            if(data.getNumberOfRows() == 0){
                $("text").last().html("No hay ventas en " + month);
            }
        }
    </script>
@endsection

