@extends('layouts.principal')
@section('module')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Modúlo de Ordenes</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item active">Ordenes</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <a data-toggle="modal" data-target="#orders" onclick="AddOrder()" class="btn btn-primary">Crear Orden</a>
        </div>
        <div class="card-body">
            @if (count($errors)>0)
                @foreach($errors->all() as $error)
                    @php
                        flash()->addError($error, __('error'));
                    @endphp
                @endforeach
            @endif
            <table id="orders" class="table table-striped table-bordered mt-4 shadow-lg">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Marca y Modelo</th>
                        <th scope="col">¿Tiene SIM?</th>
                        <th scope="col">¿Cargador?</th>
                        <th scope="col">Detalles fisicos?</th>
                        <th scope="col">Ver Problemas</th>
                        <th scope="col">¿Precio Estimado?</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Fecha de Ent.</th>
                        <th scope="col">Trabajo Realizado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->customer->name}}</td>
                            <td>{{$order->brand}}</td>
                            @if($order->sim==1)
                                <td>Sí</td>
                            @else
                                <td>No</td>
                            @endif
                            @if($order->charger==1)
                                <td>Sí</td>
                            @else
                                <td>No</td>
                            @endif
                            <td>{{$order->damage}}</td>
                            <td> <a class="btn btn-danger btnShowError" id="btnShowError" onclick="ShowMessage('{{$order->errors}}',0)">Ver Prob.</a></td>
                            <td>L. {{number_format($order->price,2)}}</td>
                            <td><a class="btn btn-success btnState" idOrder="{{$order->id}}" state="{{$order->status}}"><i class="far fa-check-circle"></i></a></td>
                            <td>{{$order->updated_at->format('d-m-Y')}}</td>
                            <td> <a class="btn btn-success btnShowError" id="btnShowError" onclick="ShowMessage('{{$order->diagnostic}}',1)">Ver Rep.</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

<div class="modal fade" id="saveJob" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="#" id="modalSaveJob">
                @csrf
                    <div class="modal-header" style="background: #3c8dbc; color: white;">
                        <h5 class="modal-title" id="exampleModalLongTitle">Confirmar reparación</h5>
                        <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group">
                                <label>¿Que se le realizo al Equipo?</label>
                                <div class="input-group mb-3">
                                    <textarea style="resize: none; overflow:scroll" name="info" id="info" cols="30" rows="5" placeholder="Ingrese los Detalles de la Reparación" class="form-control @error('info') is-invalid @enderror" value="{{ old('info') }}" required autocomplete="info" autofocus></textarea>
                                    @error('info')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <input type="hidden" id="statusJobOrder" name="statusJobOrder" value="1">
                                </div>
                            </div>
        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default mr-auto" data-dismiss="modal">Salir</button>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="BtnModal" class="btn btn-primary">
                                        {{ __('Confirmar') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@section('js')
    <script>
        const BtnState=document.querySelectorAll('.btnState');
        const FormSaveJob=document.getElementById('modalSaveJob');
        $(document).ready(function(){
            $("#orders").DataTable({
                responsive: true,
                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ Ordenes",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando Ordenes del _START_ al _END_ de un total de _TOTAL_",
                    "sInfoEmpty":      "Mostrando Ordenes del 0 al 0 de un total de 0",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ Ordenes)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
        
                },
            });
        });


        function ShowMessage(message,functions) {  
            if (functions==0) {
                Swal.fire(
                    message,
                    'Diagnóstico',
                    'info'
                );
            }else{
                Swal.fire(
                    message,
                    'Diagnóstico',
                    'success'
                );
            }
        }


        BtnState.forEach(button=>{
            button.addEventListener("click", function() { 
                let msg="";
                let state=this.getAttribute("state");
                let idOrder=this.getAttribute("idOrder");

                if (state==0) {
                    msg="¿Desea Confirmar esta reparación?"
                }else{
                    msg="¿Desea Cambiar de estado esta reparación?"
                }
                Swal.fire({
                    title: '¿Esta seguro?',
                    text: msg,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Confirmar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        FormSaveJob.setAttribute('action', '/saveJob/'+idOrder);
                        if (state==0) {
                            new bootstrap.Modal(ModalInfo,{}).show();
                        }else{
                            document.getElementById('info').value="En Proceso";
                            document.getElementById('statusJobOrder').value=0;
                            FormSaveJob.submit();
                        }
                    }
                })
            });
        });
    </script>
@endsection