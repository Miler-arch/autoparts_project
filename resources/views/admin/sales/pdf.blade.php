<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 8 PDF</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body style="font-size:10px;">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <h2>DETALLE DE VENTA No. {{ str_pad($sale->id, 4, "0", STR_PAD_LEFT) }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                CLIENTE: {{ $sale->client->name }}<br>
                FECHA: {{ date_format(date_create($sale->sale_date), 'd-m-Y [H:i:s]') }}

                <table class="table" border="1">
                    <caption>Lista de Productos</caption>
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">CODIGO</th>
                        <th scope="col">CONCEPTO</th>
                        <th scope="col">CANTIDAD</th>
                        <th scope="col">P/U</th>
                        <th scope="col">SUBTOTAL</th>
                        <th scope="col">DESTINO</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($saleDetails as $item)
                        <tr>
                            <th scope="row">{{ $item->id }}</th>
                            <td>{{ $item->codigo }}</td>
                            <td>{{ $item->name }}</td>
                            <td align="right">{{ $item->quantity }}</td>
                            <td align="right">{{ $item->price }}</td>
                            <td align="right">{{ $item->subtotal }}</td>
							<td> {{ $item->destino }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td scope="row" colspan="5" align="right">TOTAL Bs</td>
                            <td align="right">{{ $subtotal }}</td>
                            <td></td>
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