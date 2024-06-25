@extends('layout_public')
@section('content')
<div class="container mt-5 mb-5">
    <div>Título:{{ $lugares[0]['titulo']}}</div>
    <div>Sala:{{ $lugares[0]['nome']}}</div>
    <div>Data:{{ $lugares[0]['data']}}</div>
    <div>Horário Início:{{ $lugares[0]['horario_inicio']}}</div>
    <form method="POST" action="{{route('carrinho.store_pedido')}}" class="form-group" enctype="multipart/form-data">
        <input type="hidden" name="titulo_filme" value="{{ $lugares[0]['titulo']}}">
        <input type="hidden" name="sala_nome" value="{{ $lugares[0]['nome']}}">
        <input type="hidden" name="sessao_id" value="{{ $lugares[0]['sessoes_id']}}">
        <div class="table-responsive" style="border:2px solid #e6e6e6">
            <table class="table">
                <tbody class="script">
                    <!-- loop -->
                    @csrf
                    @for($i = 0; $i < count($lugares); $i++) @if ($i==0 ) <tr>
                        <td class="text-center" style="border-bottom-width:0px">
                            @if ($lugar_ocupado[$i]==1)
                            <img src="http://projetoainet.test/img/Ocupado.png">
                            @else

                            <?php
                          echo' <img src="http://projetoainet.test/img/Livre.png">';
                          echo '<input type="checkbox" name="lugar[]" value="'.$lugares[$i]['lugar_id'].' '.$lugares[$i]['fila'].''.$lugares[$i]['posicao'].'" >';
                                ?>
                            @endif
                        </td>
                        @elseif($lugares[$i]['fila'] !=$lugares[$i-1]['fila'])
                        </tr>
                        <tr>
                            <td class="text-center" style="border-bottom-width:0px">
                                @if ($lugar_ocupado[$i]==1)
                                <img src="http://projetoainet.test/img/Ocupado.png">
                                @else

                                <?php
                            echo' <img src="http://projetoainet.test/img/Livre.png">';
                                      echo '<input type="checkbox" name="lugar[]" value="'.$lugares[$i]['lugar_id'].' '.$lugares[$i]['fila'].''.$lugares[$i]['posicao'].'" >';
                                      ?>
                                @endif
                            </td>


                            @else
                            <td class="text-center" style="border-bottom-width:0px">
                                @if ($lugar_ocupado[$i]==1)
                                <img src="http://projetoainet.test/img/Ocupado.png">
                                @else
                                <?php
                            echo' <img src="http://projetoainet.test/img/Livre.png">';
                            echo '<input type="checkbox" name="lugar[]" value="'.$lugares[$i]['lugar_id'].' '.$lugares[$i]['fila'].''.$lugares[$i]['posicao'].'" >';
                            ?>

                                @endif
                            </td>
                            @endif
                            @endfor
                </tbody>
            </table>
        </div>
        <div class="mt-2 mb-2">
            <button type="submit" class="btn btn-primary">Adicionar ao Carrinho</button>
        </div>
    </form>
</div>
@endsection