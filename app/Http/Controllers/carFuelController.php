<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\carFuel;
use Carbon\Carbon;
use DB;

class carFuelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    
    public function store(Request $request){
        $carFuel = new carFuel;
        Validator::make($request->all(), [
            'amount' => ['required', 'string', 'max:255'],
            'provider' => ['required', 'string', 'max:255'],
        ])->validate();
        $carFuel->scheduled_amount = $request->input('amount');
        $carFuel->provider = $request->input('provider');
        $carFuel->fill_date = Carbon::now()->format('Y-m-d'); 
        $carFuel->schedule_date = Carbon::now()->format('Y-m-d');
        $carFuel->provider_Id = '1';
        $carFuel->user_Id = '1';
        $carFuel->car_Id = $request->input('amount');

        $carFuel->save();

        return redirect()->route('serial')->with('success', 'Updated Successfully');
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
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
