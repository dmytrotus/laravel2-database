<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {   
        $customers = DB::table('customers');

        foreach($r->all() as $key=>$value){

            if($value != null)
            {

                $arr_like = ['name', 'adress'];

                if(in_array($key, $arr_like))
                {
                    $customers->where($key, 'LIKE', "%$value%");
                }

                $arr_equal = ['gender', 'age'];
                if(in_array($key, $arr_equal))
                {
                    $customers->where($key, $value);
                }
            }
        }

        $customers = $customers->paginate(25);


        return view('adminpanel.layouts.index')
        ->with(compact('customers'));
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
    public function store(Request $r)
    {
        $r->validate([
            'new_customer_name' => 'required|max:255',
            'new_customer_adress' => 'required|max:255',
            'new_customer_gender' => 'required|max:255',
            'new_customer_age' => 'required|max:3'
        ]);

        Customers::create([
            'name' => $r->new_customer_name,
            'adress' => $r->new_customer_adress,
            'gender' => $r->new_customer_gender,
            'age' => (int)$r->new_customer_age
        ]);
        session()->flash('success', 'Użytkownik dodany');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function show(Customers $customers)
    {
        return redirect()->route('customers.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function edit(Customers $customer)
    {
        return view('adminpanel.layouts.single_customer')
        ->with(compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, Customers $customer)
    {
        $r->validate([
            'name' => 'required|max:255',
            'adress' => 'required|max:255',
            'gender' => 'required|max:255',
            'age' => 'required|max:3'
        ]);

        $customer->name = $r->name;
        $customer->adress = $r->adress;
        $customer->gender = $r->gender;
        $customer->age = $r->age;
        $customer->save();

        session()->flash('success', 'Użytkownik zaktualizowany');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customers $customer)
    {
        $customer->delete();
        session()->flash('success', 'Użytkownik usunięty');

        return redirect()->back();
    }
}
