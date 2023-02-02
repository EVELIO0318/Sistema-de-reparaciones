<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=Order::where('status',0)->get();
        return view("orders.index")->with('orders',$orders);
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
                'customer' => ['required'],
                'sim' => ['required'],
                'charger' => ['required'],
                'damage' => ['required'],
                'device' => ['required', 'max:255'],
                'errors' => ['required', 'max:255'],
                'price' => ['required'],
                
            ]
        );

        // $newprice=substr($request->get('price'),3);
        $newprice=str_replace(',','', substr($request->get('price'),3));
        $order=new Order();
        $order->client_id=$request->get('customer');
        $order->brand=$request->get('device');
        $order->sim=$request->get('sim');
        $order->charger=$request->get('charger');
        $order->damage=$request->get('damage');
        $order->errors=$request->get('errors');
        $order->price=$newprice;
        $order->save();

        $idreturn=$order->id;
        return response()->json(['response' => $idreturn]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $newprice=str_replace(',','', substr($request->get('price'),3));
        $order->update([
            'client_id' => $request->customer,
            'brand'=>$request->device,
            'sim'=>$request->sim,
            'charger'=>$request->charger,
            'damage'=>$request->damage,
            'errors'=>$request->errors,
            'errors'=>$request->errors,
            'price'=>$newprice
        ]);
        return redirect('/orders')->with(['success' => 'Order Actualizada Exitosamente']);
    }

    public function saveJob(Request $request, Order $order)
    {
        
        $request->validate(
            [
                'info' => ['required']
            ]
        );

        $order->status =$request->get("statusJobOrder");
        $order->diagnostic =$request->get("info");
        $order->save();
        
        if ($request->statusJobOrder==0) {
            return redirect('/orders')->with(['warning' => 'Estado del equipo cambiado,Favor Repararlo']);
        }else{
            return redirect('/ordersReady')->with(['success' => 'Reparación completada exitosamente']);
        }
    }
    
    public function ready()
    {
        $orders=Order::where('status',1)->get();
        // dd($orders);
        return view("orders.ready")->with('orders',$orders);
    }

    public function pdf(Order $order)
    {
        return view("orders.pdf")->with("orderData",$order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
    
}
