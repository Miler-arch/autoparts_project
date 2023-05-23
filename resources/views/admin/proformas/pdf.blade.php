<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proforma</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }
        body {
            margin: 3cm 0.2cm 2cm -0.5cm;
        }
        th, td { 
            padding-top: 2px !important;
            padding-bottom: 2px !important;
        }
    </style>
</head>
<body style="font-size:10px;">
    <div class="container mt-4">
        <div class="row">
            <div class="text-center">
                <h6>IMPORTADORA DE REPUESTOS Y ACCESORIOS PARA<br>
                CAMIÓN VOLVO</h6>
                Av. CHAPARE N° 4647 Urbanización La Huerta 16 Zona Quintanilla Sacaba<br>
                Telf.: 4724542 Cel.: 70761715-7979904 E-MAil: planeta-camion@hotmail.com
            </div>
            <div class="text-center">
                <h4>PROFORMA N°. Guia {{ str_pad($proforma->id, 4, "0", STR_PAD_LEFT) }}</h4>
            </div>
            <div class="col-md-12">
                <table class="table" border="1">
                    <tr>
                        <td width="20%">Cochabamba</td>
                        <td colspan="3">{{ date("d", strtotime($proforma->sale_date)) }} - {{ date("m", strtotime($proforma->sale_date)) }} - {{ date("Y", strtotime($proforma->sale_date)) }}</td>
                        <td colspan="2">Talonario: {{ $proforma->saleDetails[0]->talonario }}</td>
                    </tr>
                    <tr>
                        <td>Señor(es)</td>
                        <td colspan="3"> {{ $proforma->client->name }} </td>
                        <td colspan="2">
                            {{ ($proforma->saleDetails->count() > 0)? "Destino: ".$proforma->saleDetails[0]->destino : "Destino: S/C"}}
                        </td>
                  
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table" border="1">
                    <thead>
                      <tr>
                        <th scope="col" width="2%">N°.</th>
                        <th scope="col" width="15%">CÓDIGO</th>
                        <th scope="col" width="5%">CANT.</th>
                        <th scope="col">CONCEPTO</th>
                        <th scope="col" width="12%">P/U</th>
                        <th scope="col" width="13%">SUBTOTAL</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($saleDetails as $index => $item)
                        <tr>
                            <th scope="row" align="right">{{ $index + 1 }}</th>
                            <td>{{ $item->code }}</td>
                            <td align="right">{{ $item->quantity }}</td>
                            <td>{{ $item->name }}</td>
                            <td align="right">{{ $item->price }}</td>
                            <td align="right">{{ ($item->subtotal)? sprintf("%.02f", $item->subtotal):"" }}</td>
                        </tr>
                        @endforeach
                    
                        <tr>
                            <td scope="row" colspan="4">Depositar a Cuenta de Zoila Diaz - BNB No de Cta 3500778015 - BANCO SOL  No Cta 1761383000001</td>
                            <td>TOTAL Bs.</td>
                            <td align="right">{{ sprintf("%.02f", $subtotal) }}</td>
                        </tr>
                        <tr>
                            <td scope="row" colspan="2">N°. de cajas</td>
                            <td>{{ $proforma->number_box }}</td>
                            <td>Responsable: {{ Auth::user()->name }}</td>
                            <td>TOTAL US$</td>
                            <td align="right"></td>
                        </tr>
                        <tr>
                            <td scope="row" colspan="2">Fecha Vencimiento </td>
                            <td colspan="2">{{ date("d", strtotime($proforma->fech_venc)) }} - {{ date("m", strtotime($proforma->fech_venc)) }} - {{ date("Y", strtotime($proforma->fech_venc)) }}</td>
                            <td>T/CAMBIO</td>
                            <td align="right"></td>
                        </tr>
                        <tr><td scope="row" colspan="2">Transporte: </td>
                            <td scope="row" colspan="4">{{$proforma->transport}}</td>
                        </tr>
                        <tr><td scope="row" colspan="2">Encargado: </td>
                            <td scope="row" colspan="4">{{$proforma->encargado}}</td></tr>
                        <tr><td scope="row" colspan="2">Crédito: </td>
                            <td scope="row" colspan="4">{{$proforma->credit_days}}</td></tr>
                        <tr><td scope="row" colspan="2" align="right">FIRMA<br><br></td><td colspan="4"></td></tr>
                        <tr><td scope="row" colspan="2" align="right">RECIBÍ CONFORME<br><br></td><td colspan="4"></td></tr>
                        <tr><td scope="row" colspan="2" align="right">CI<br></td><td colspan="4"></td></tr>
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