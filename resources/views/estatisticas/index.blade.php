@extends('layout_admin')
@section('title','Dashboard' )
@section('content')

<?php
foreach($utilizadorespordia as $dia){
 switch ($dia->dia) {
   case '1':
        $utilizadorespordia[0]->dia ="Domingo";
        break;
    case '2':
        $utilizadorespordia[1]->dia ="Segunda-feira";
        break;
    case '3':
        $utilizadorespordia[2]->dia ="Terça-feira";
        break;
    case '4':
        $utilizadorespordia[3]->dia ="Quarta-feira";
        break;
    case '5':
        $utilizadorespordia[4]->dia ="Quinta-feira";
        break;
    case '6':
        $utilizadorespordia[5]->dia ="Sexta-feira";
        break;
    case '7':
        $utilizadorespordia[6]->dia ="Sabado";
        break;

 }
}
$dataPoints = array(
    array("label"=> $utilizadorespordia[0]->dia, "y"=> $utilizadorespordia[0]->percentagem),
    array("label"=> $utilizadorespordia[1]->dia, "y"=> $utilizadorespordia[1]->percentagem),
    array("label"=> $utilizadorespordia[2]->dia, "y"=> $utilizadorespordia[2]->percentagem),
    array("label"=> $utilizadorespordia[3]->dia, "y"=> $utilizadorespordia[3]->percentagem),
    array("label"=> $utilizadorespordia[4]->dia, "y"=> $utilizadorespordia[4]->percentagem),
    array("label"=> $utilizadorespordia[5]->dia, "y"=> $utilizadorespordia[5]->percentagem),
    array("label"=> $utilizadorespordia[6]->dia, "y"=> $utilizadorespordia[6]->percentagem)
);

?>

<script>
window.onload = function() {

    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        exportEnabled: true,
        title: {
            text: "Percentagem de pessoas por dia da semana"
        },
        subtitles: [{
            text: "%"
        }],
        data: [{
            type: "pie",
            showInLegend: "true",
            legendText: "{label}",
            indexLabelFontSize: 16,
            indexLabel: "{label} - #percent%",
            yValueFormatString: "#,##0",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

}
</script>

<div class="container-fluid">
    <h4>Estatísticas</h4>
    <!-- Content Row -->
    <div class="row">


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total de Clientes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_clientes}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Género com Mais Filmes </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{$genero_mais_filmes[0]['genero_code']}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-film fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Ganhos Mensais {{$ganhos_mensais[1]}}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$ganhos_mensais[0]}}€</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Ganhos Anuais {{$ganhos_anuais[1]}}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$ganhos_anuais[0]}}€</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Filmes mais assistidos de sempre</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <p>{{$filme_mais_visto[0]['titulo']}}</p>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <p>{{$filme_mais_visto[1]['titulo']}}</p>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <p>{{$filme_mais_visto[2]['titulo']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Filmes mais assistidos do ano </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <p>{{$filme_mais_vistoAno[0]['titulo']}}</p>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <p>{{$filme_mais_vistoAno[1]['titulo']}}</p>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <p>{{$filme_mais_vistoAno[2]['titulo']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Filmes mais assistidos do Mes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <p>{{$filme_mais_vistoMes[0]['titulo']}}</p>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <p>{{$filme_mais_vistoMes[1]['titulo']}}</p>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <p>{{$filme_mais_vistoMes[2]['titulo']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Melhores clientes de sempre</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <p>{{$cliente_melhor[0]['name']}}</p>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <p>{{$cliente_melhor[1]['name']}}</p>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <p>{{$cliente_melhor[2]['name']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    </div>
</div>


@endsection