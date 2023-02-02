@extends('layouts.principal')
@section('module')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Modúlo de Clientes</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item active">Clientes</li>
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
            <a data-toggle="modal" data-target="#Customers" onclick="AddCustomer()" class="btn btn-primary">Crear</a>
        </div>
        <div class="card-body">
            @if (count($errors)>0)
                @foreach($errors->all() as $error)
                    @php
                        flash()->addError($error, __('error'));
                    @endphp
                @endforeach
            @endif
            <table id="customers" class="table table-striped table-bordered mt-4 shadow-lg">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{$customer->id}}</td>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->tel}}</td>
                            <td>
                                <form action="{{route('customers.DeleteCustomer',$customer->id)}}" method="post" class="formdelete">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-info" id="btnEdit" onclick="EditModal({{$customer->id}},'{{$customer->name}}','{{$customer->tel}}','Edit')" data-toggle="modal" data-target="#Customers"><i class="fas fa-edit"></i></a>
                                    {{-- este es el submit que hace accion del formulario, el boton de abajo --}}
                                    <button type="submit" id="btnDelete" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
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

<div class="modal fade" id="Customers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="/saveCustomer" id="modalCustomers">
                @csrf
                    <div class="modal-header" style="background: #3c8dbc; color: white;">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Clientes</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">

                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input id="name" type="text" placeholder="Ingrese el Nombre del Cliente" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-mobile"></i></span>
                                    </div>
                                    <input id="phone"  placeholder="Ingrese el Telefono del cliente" data-inputmask='"mask": "9999-9999"' data-mask type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>    
        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default mr-auto" data-dismiss="modal">Salir</button>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="BtnModal" class="btn btn-primary">
                                        {{ __('Guardar') }}
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
@endsection
@section('js')
    <script>
        let CustomerEdit=document.getElementById('btnEdit');
        let ModalCustomer=document.getElementById('modalCustomers');
        const FormDeleteCustomer=document.querySelectorAll('.formdelete');
        $(document).ready(function(){
            var element = document.getElementById('phone');
            var maskOptions = {
                mask: '0000-0000'
            };
            var mask = IMask(element, maskOptions);

            $("#customers").DataTable({
                responsive: true,
                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ Clientes",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando Clientes del _START_ al _END_ de un total de _TOTAL_",
                    "sInfoEmpty":      "Mostrando Clientes del 0 al 0 de un total de 0",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ Clientes)",
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
    
        function EditModal(id,name,phone,) { 
            ModalCustomer.setAttribute('action', '/EditCustomer/'+id);
            document.getElementById('exampleModalLongTitle').innerText ='Editar Cliente';
            document.getElementById('name').value=name;
            document.getElementById('phone').value=phone;
            // document.getElementById('btnModal').innerText="Actualizar";
        }

        function AddCustomer() { 
            ModalCustomer.setAttribute('action', '/saveCustomer');
            document.getElementById('exampleModalLongTitle').innerText="Agregar Cliente";
            document.getElementById('name').value="";
            document.getElementById('phone').value=""; 
        }

        FormDeleteCustomer.forEach(form => {
            form.addEventListener("submit",function (e) {
                e.preventDefault();
                Swal.fire({
                title: '¿Esta seguro?',
                text: 'Que desea Eliminar Este Cliente, Esta acción no se puede deshacer',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar!'
                }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
                })
            });
        });
    </script>
@endsection