<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function createCustomer(Request $request)
    {
        $customer = new Customer([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'information' => $request->information,
        ]);
        $customer->save();

        return response()->json('Customer created');
    }

    public function getCustomers()
    {
        $user = Auth::user();
        $customers = Customer::all();
        return response()->json($customers);
    }

    public function deleteCustomer($id)
    {
        $customer = Customer::find($id);

        abort_unless($customer, 404);

        $customer->delete();


        return response()->json('Customer deleted');
    }
}
