@extends('layouts.admin')

@section('title', 'Reporte Transferencia')
    
@section('create')

@endsection

@section('styles')
    <style type="text/css">
        .unstyled-button {
            border: none;
            padding: 0;
            background: none
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
@endsection

@section('content')
    <div class="content-wrapper">
        <div>
            <h3 class="text-center">
                Reporte de Transferencia
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel Administrador</a></li>
                    <li class="breadcrumb-item active">Reporte de Transferencia</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <table class="table" id="detalle">
                              <thead class="thead-dark">
                                <tr>
                                  <th scope="col">Almacen Origen</th>
                                  <th scope="col">Producto</th>
                                  <th scope="col">Cantidad</th>
                                  <th scope="col">Almacen Destino</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>{{ $tp->warehouse_from->name }}</td>
                                  <td>{{ $tp->product->name }}</td>
                                  <td>{{ $tp->quantity }}</td>
                                  <td>{{ $tp->warehouse_to->name }}</td>
                                </tr>
                              </tbody>
                            </table>
                            <button class="btn btn-success" id="export" type="button">Imprimir</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.5/jspdf.plugin.autotable.min.js"></script>
    <script src="https://www.jqueryscript.net/demo/export-table-json-csv-txt-pdf/src/tableHTMLExport.js"></script>
    <script>
        $(document).ready(function(){
            $("#export").click(function(){
                $("#detalle").tableHTMLExport({

                  // csv, txt, json, pdf
                  type:'pdf',

                  // file name
                  filename:'export.pdf'
                  
                });
            });
        });
    </script>
@endsection