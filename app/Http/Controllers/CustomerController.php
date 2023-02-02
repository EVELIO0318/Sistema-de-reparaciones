<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers=Customer::all();
        return view("customers.customers")->with('customers',$customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'max:255'],
                'phone' => ['required', 'max:9'],
                
            ]
        );

        $customer=new Customer();
        $customer->name=$request->get('name');
        $customer->tel=$request->get('phone');
        $customer->save();
        return redirect('/customers')->with(['success' => 'Cliente registrado correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $customer->update([
            'name' => $request->name,
            'tel'=>$request->phone,
        ]);

        return redirect('/customers')->with(['success' => 'Cliente Actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect('/customers')->with(['success' => 'Cliente Eliminado correctamente']);
    }

    public function CustomerList()
    {
        $customers=Customer::all();
        return $customers;
    }

    public function saveCustomerSimple(Request $request)
    {

        $validator = Validator::make($request->all(), 
            [
                'name' => ['required', 'max:255', 'unique:customers'],
                'phone' => ['required', 'max:9'],
            ],
            [
                'name.required' => 'Agrega el nombre del Cliente.',
                'name.max' =>'Nombre demasiado Largo',
                'name.unique' => 'Este cliente ya existe',
                'phone.required' => 'Agregue Número de telefono',
                'phone.max' => 'Número Invalido'
            ],
    );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()
            ]);
        }

        $customer=new Customer();
        $customer->name=$request->get('name');
        $customer->tel=$request->get('phone');
        $customer->save();

        $LastCustomer = Customer::where("name",$request->get('name'))->first();
        // dd($LastCustomer);
        return response()->json(['data'=>$LastCustomer]);
    }
}
