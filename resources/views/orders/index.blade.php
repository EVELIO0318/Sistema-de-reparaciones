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
            <a data-toggle="modal" data-target="#modalOrders" onclick="AddOrder()" class="btn btn-primary">Crear Orden</a>
        </div>
        <div class="card-body">
            @if (count($errors)>0)
                @foreach($errors->all() as $error)
                    @php
                        flash()->addError($error, __('error'));
                    @endphp
                @endforeach
            @endif
            <table id="Listorders" class="table table-striped table-bordered mt-4 shadow-lg text-center">
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
                        <th scope="col">Ver Orden(PDF)</th>
                        <th scope="col">Editar</th>
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
                            <td> <a class="btn btn-danger btnShowError" id="btnShowError" message="{{$order->errors}}">Ver Prob.</a></td>
                            <td>L. {{number_format($order->price,2)}}</td>
                            <td><a class="btn btn-warning btnState" idOrder="{{$order->id}}" state="{{$order->status}}"><i class="far fa-clock"></i></a></td>                            
                            <td>
                                <a href="#" onclick="pdfgenerate({{$order->id}})" target="_blank" id="btnpdf" class="btn btn-success"><i class="fas fa-file-pdf"></i></a>
                            </td>
                            <td>
                                <a class="btn btn-info" onclick="EditModal({{$order->id}},{{$order->customer->id}},'{{$order->brand}}',{{$order->sim}},{{$order->charger}},'{{$order->damage}}','{{$order->errors}}',{{$order->price}})" id="btnEdit" data-toggle="modal" data-target="#modalOrders"><i class="fas fa-edit"></i></a>
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

<div class="modal fade" id="modalOrders" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="/saveOrder" id="modalOrder" state="new">
                @csrf
                    <div class="modal-header" style="background: #3c8dbc; color: white;">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Orden</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">

                        <div class="form-group">
                            <div class="input-group row ml-0">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                </div>
                                <select name="customer" required aria-required="true" placeholder="Seleccione Cliente" id="customer" class="form-control @error('customer') is-invalid @enderror" value="{{ old('customer') }}" autofocus>
                                    <option value="">Seleccione Un cliente</option>
                                </select>
                                <span class="input-group-addon">
                                    <button type="button" class="btn btn-primary ml-2 btn-sm" data-toggle="modal" data-target="#Customers">Agregar Cliente</button>
                                </span>
                                {{-- <input id="name" type="text" placeholder="Ingrese el Nombre del Cliente" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus> --}}
                                @error('customer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-laptop"></i></span>
                                </div>
                                <input id="device" type="text" placeholder="Ingrese el Modelo y Marca del Dispositivo" class="form-control @error('device') is-invalid @enderror" name="device" value="{{ old('device') }}" required autocomplete="device" autofocus>
                                @error('device')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 

                        <div class="row justify-content-start form-group">
                            <div class="col-4 mt-2">
                                <p>¿Posee SIM?</p>
                            </div>
                            <div class="input-group col-4">
                                <div class="input-group-prepend" style="height: 80%">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-sim-card"></i></span>
                                </div>
                                <select name="sim" id="sim" class="form-control @error('sim') is-invalid @enderror" value="{{ old('sim') }}" autofocus>
                                    <option value="1">Sí</option>
                                    <option value="0" selected="selected">No</option>
                                </select>
                                @error('sim')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 


                        <div class="row justify-content-start form-group">
                            <div class="col-4 mt-2">
                                <p>¿Deja Cargador?</p>
                            </div>
                            <div class="input-group col-4">
                                <div class="input-group-prepend" style="height: 80%">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-battery-half"></i></span>
                                </div>
                                <select name="charger" id="charger" class="form-control @error('charger') is-invalid @enderror" value="{{ old('charger') }}" autofocus>
                                    <option value="1">Sí</option>
                                    <option value="0" selected="selected">No</option>
                                </select>
                                @error('charger')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row justify-content-start form-group">
                            <div class="col-4 mt-2">
                                <p>¿Tiene detalles?</p>
                            </div>
                            <div class="input-group col-4">
                                <div class="input-group-prepend" style="height: 80%">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-house-damage"></i></span>
                                </div>
                                <select name="damage" id="damage" class="form-control @error('damage') is-invalid @enderror" value="{{ old('damage') }}" autofocus>
                                    <option value="Sí">Sí</option>
                                    <option value="No">No</option>
                                    <option value="De Uso" selected="selected">De uso</option>
                                </select>
                                @error('damage')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-3">
                                <textarea style="resize: none; overflow:scroll" name="errors" id="errors" cols="30" rows="5" placeholder="Ingrese los Detalles del Problema" class="form-control @error('errors') is-invalid @enderror" value="{{ old('errors') }}" required autocomplete="errors" autofocus></textarea>
                                @error('errors')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-money-check-alt"></i></span>
                                </div>
                                <input id="price" type="text" placeholder="Precio Estimado" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>
                                @error('price')
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

<div class="modal fade" id="Customers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="#" id="modalCustomers">
                @csrf
                    <div class="modal-header" style="background: #3c8dbc; color: white;">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Clientes</h5>
                        <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
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
                                    <input id="namecustomer" type="text" placeholder="Ingrese el Nombre del Cliente" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
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
                                    <input id="phonecustomer"  placeholder="Ingrese el Telefono del cliente" data-inputmask='"mask": "9999-9999"' data-mask type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
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
@endsection
@section('js')
    <script>
        let select=document.getElementById('customer');
        const ButtonShowProblems=document.querySelectorAll('.btnShowError');
        const BtnState=document.querySelectorAll('.btnState');
        const SaveCustomer=document.getElementById('modalCustomers');
        const myModalEl = document.getElementById('Customers');
        const ModalOrderForm=document.getElementById('modalOrder');
        const FormSaveJob=document.getElementById('modalSaveJob');
        const ModalInfo=document.getElementById('saveJob');
        let phone = document.getElementById('phonecustomer');
        let element = document.getElementById('price');
        
        $(document).ready(function(){
            masks();
            $("#Listorders").DataTable({
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

            loadCustomer();
        });

        function masks() { 
            let maskOptionsPhone = {
                mask: '0000-0000'
            };
            let maskPhone = IMask(phone, maskOptionsPhone);
            let maskOptions = {
                mask: [
                    { mask: '' },
                    {
                        mask: 'L. num',
                        lazy: false,
                        blocks: {
                            num: {
                                mask: Number,
                                scale: 2,
                                thousandsSeparator: ',',
                                digits: 2,
                                padFractionalZeros: true,
                                radix: '.',
                                mapToRadix: ['.'],
                            }
                        }
                    }
                ]
            };
            let mask = IMask(element, maskOptions);


            
        }

        function loadCustomer() { 
            fetch('/CustomerList', {
                method:'POST',
                mode: 'cors',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            .then(response => response.json())
            .then(function(result){
                // console.log(result[0].id);
                for (value in result){
                    var option=document.createElement("option");
                    option.text=result[value].name;
                    option.value=result[value].id+"{{ old('customer') == "+result[value].id+" ? 'selected' : '' }}";
                    select.add(option);
                }
            })
            .catch(function (error) {
            console.log(error);
            });
        }

        ButtonShowProblems.forEach(button => {
            button.addEventListener("click",function (){ 
                let message=this.getAttribute("message");
                Swal.fire(
                    message,
                    'Diagnóstico',
                    'info'
                );
            });
        });

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

        ModalOrderForm.addEventListener("submit",function (e) { 
            e.preventDefault();
            
            const stateForm=this.getAttribute("state");
            
            if (stateForm=='new') {
                let url=this.action;
                const dataForm=new FormData(ModalOrderForm);
                fetch(url, {
                    method:'POST',
                    mode: 'cors',
                    body: dataForm,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Accept':'application/json'
                    }
                })
                .then(response => response.json())
                .then(function(result){
                    if (result.hasOwnProperty('errors')) {
                        let message=result['errors'];
                        message.forEach(error => {
                            flasher.error(error);
                        })
                    }else{
                        console.log(result['response']);
                        pdfgenerate(result['response']);
                        location.reload();
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            }else{
                ModalOrderForm.submit();
            }
        });

        SaveCustomer.addEventListener("submit",function (e) {
            e.preventDefault();
            const data = new FormData(SaveCustomer);
            fetch('/saveCustomerSimple', {
                method:'POST',
                mode: 'cors',
                body: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept':'application/json'
                }
            })
            .then(response => response.json())
            .then(function(result){
                if (result.hasOwnProperty('errors')) {
                    let message=result['errors'];
                    message.forEach(error => {
                        flasher.error(error);
                    })
                }else{
                    NewCustomer=result['data'];
                    var option=document.createElement("option");
                    option.text=NewCustomer['name'];
                    option.value=NewCustomer['id'];
                    select.add(option);
                    select.value=NewCustomer['id'];
                    SaveCustomer.reset();
                    document.getElementById("close").click();
                    flasher.success("Cliente agregado con éxito");
                    
                }
            })
            .catch(function (error) {
            console.log(error);
            });
            
        });
    
        function EditModal(id,CustomerID,brand,sim,charger,damage,error,price) { 
            console.log(damage);
            ModalOrderForm.setAttribute('action', '/EditOrder/'+id);
            ModalOrderForm.setAttribute('state', 'update');
            document.getElementById('exampleModalLongTitle').innerText ='Editar Orden';
            select.value=CustomerID;
            document.getElementById('device').value=brand;
            document.getElementById('sim').value=sim;
            document.getElementById('charger').value=charger;
            document.getElementById('damage').value=damage;
            document.getElementById('errors').value=error;
            document.getElementById('price').value=price;
            masks();
        }

        function AddOrder() { 
            ModalOrderForm.setAttribute('action', '/saveOrder');
            ModalOrderForm.setAttribute('state', 'new');
            document.getElementById('exampleModalLongTitle').innerText="Agregar Cliente";
            select.value="";
            document.getElementById('device').value="";
            document.getElementById('sim').value=0;
            document.getElementById('charger').value=1;
            document.getElementById('damage').value='De Uso';
            document.getElementById('errors').value="";
            document.getElementById('price').value="";
        }

        function pdfgenerate(id) { 
            window.open('pdf/'+id,"_blank");
        }
    </script>
@endsection