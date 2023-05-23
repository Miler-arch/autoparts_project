<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Kardex</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        @page {
            margin: 1cm !important;
            font-family: Arial;
        }
        body {
            margin: 1cm 1cm 1cm 1cm !important;
        }
        th, td { 
            padding-top: 2px !important;
            padding-bottom: 2px !important;
        }
    </style>
</head>
<body style="font-size:10px;">
    <div class=""> {{-- container mt-4 --}}
        <div class="row">
            <div style="text-align: center">
                <h4>KARDEX FISICO Y VALORADO</h4>
            </div>
            <div class="col-md-12">
                <b>ALMACEN:</b> {{ $warehouse->id }} - {{ $warehouse->name }}
                <b>PROVEEDOR:</b> {{ $product->provider->name }}<br>
                <b>CODIGO:</b> <span style="font-size: 24px;">{{ $product->codigo }}</span> &nbsp;&nbsp;&nbsp; <b>PRODUCTO:</b> {{ $product->name }}<br><br>
                <b>ITEM:</b> <span>______________________<br>
                
                <table class="table" border="1" width="100%">
                    <caption>LISTA DE MOVIMIENTOS</caption>
                    <thead>
                      <tr>
                        <th scope="col" width="30%">DETALLE</th>
                        <th scope="col">{{ $product->name }}</th>
                        <th scope="col" colspan="3">CONTROL FISICO</th>
                        <th scope="col" colspan="4">CONTROL VALORADO</th>
                        <th scope="col" colspan="3">CODIGO</th>
                        <th scope="col" colspan="2">{{ $product->codigo }}</th>
                      </tr>
                      <tr>
                        <th scope="col" width="30%">FECHA</th>
                        <th scope="col">DESCRIPCION</th>
                        <th scope="col">ENTRADA</th>
                        <th scope="col">SALIDA</th>
                        <th scope="col">SALDO</th>
                        <th scope="col">Bs<br>US$</th>
                        <th scope="col">COSTO<br>UNITARIO</th>
                        <th scope="col">COSTO<br>TOTAL</th>
                        <th scope="col">DESTINO</th>
                        <th scope="col">GUIA No.</th>
                        <th scope="col">DOC.</th>
                        <th scope="col">CLIENTE /<br>PROVEEDOR</th>
                        <th scope="col">TAL. No.</th>
                        <th scope="col">NOMBRE</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="30%"></td>
                            <td align="right">COMPRA</td>
                            <td align="right">{{ $warehouse->quantity_original }}</td>
                            <td align="right"></td>
                            <td align="right">{{ $warehouse->quantity_original }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @foreach ($existencias as $item)
                        <tr>
                            <td width="30%">{{ $item->created_at }}</td>
                            <td align="right">{{ $item->tipo }}</td>
                            <td align="right">
                                @if($item->tipo =='INGRESO')
                                    {{ $item->quantity }}
                                @endif
                            </td>
                            <td align="right">
                                @if($item->tipo == 'SALIDA')
                                    {{ $item->quantity }}
                                @endif
                            </td>
                            <td align="right">{{ $item->saldo }}</td>
                            <td></td>
                            <td align="right">{{ $item->price }}</td>
                            <td align="right">{{ number_format($item->quantity * $item->price, 2) }}</td>
                            <td>{{ $item->destino }}</td>
                            <td>
                                @if($item->guia !== ' ')
                                    {{ str_pad($item->guia, 4, "0", STR_PAD_LEFT) }}
                                @endif
                            </td>
                            <td>{{ $item->nrocompra }}</td>
                            <td>{{ $item->cliente }}</td>
                            <td>{{ $item->talonario }}</td>
                            <td></td>
                        </tr>
                        @endforeach
                        <tr>
                            <td scope="row" colspan="4" align="right">SALDO FINAL</td>
                            <td align="right">{{ $subtotal }}</td>
                            <td colspan="9"></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <table class="table" border="1">
                    <caption>ESTADO EN TODOS LOS ALMACENES</caption>
                    <thead>
                      <tr>
                        <th scope="col">ALMACEN</th>
                        <th scope="col">CANT. INICIAL</th>
                        <th scope="col">CANT. FINAL</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($allWarehouses as $wh)
                        <tr>
                            <td>{{ $wh->name }}</td>
                            <td align="right">{{ $wh->quantity_original }}</td>
                            <td align="right">{{ $wh->quantity }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td scope="row" align="right">TOTAL</td>
                            <td align="right">{{ $totalOriginal }}</td>
                            <td align="right">{{ $totalFinal }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>