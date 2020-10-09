<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomersApiController extends Controller
{   

    protected $token = 'ffsdf3c34t34t3';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {   

        if( $this->token != $r->header('token') )
        {
            return response()->json([
                'message' => 'Błąd autoryzacji'
            ], 401);
        }

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

        $customers = $customers->get();


        return response()->json([
                'success' => true,
                'message' => $customers

        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {   
        if( $this->token != $r->header('token') )
        {
            return response()->json([
                'message' => 'Błąd autoryzacji'
            ], 401);
        }
        

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

        return response()->json([
                'success' => true,
                'message' => 'Użytkownik dodany'

        ], 201);
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

        return response()->json([
                'success' => true,
                'message' => 'Użytkownik Zaktualizowany'

        ], 200);
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
        
        return response()->json([
                'success' => true,
                'message' => 'Użytkownik usunięty'

        ], 200);
    }

    public function edit( Request $r, $customer )
    {   
        if( $this->token != $r->header('token') )
        {
            return response()->json([
                'message' => 'Błąd autoryzacji'
            ], 401);
        }

        $customer = Customers::find($customer);

        return response()->json([
                'success' => true,
                'message' => $customer
            ], 200);
    }
}
