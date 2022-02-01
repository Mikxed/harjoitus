<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function createCustomer(Request $request)
    {
        // Validointi asiakaskenttiin. Jos ilmenee virheitä, validate() metodi palauttaa 422 errorin
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'information' => 'required',
        ]);

        // Asiakkaan luonti
        $customer = new Customer([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'information' => $request->information,
        ]);
        $customer->save();

        return response()->json('Asiakas luotu!');
    }

    public function editCustomer(Request $request)
    {
        // Validointi asiakaskenttiin. Jos ilmenee virheitä, validate() metodi palauttaa 422 errorin
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'information' => 'required',
        ]);

        $customer = Customer::find($request->id);
        
        // Asiakkaan muokkaus
        $customer->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'information' => $request->information,
        ]);
    }

    public function getCustomers()
    {
        // Tähän tulisi autentikointi seuraavalla tapaa, jos kirjautuminen olisi käytössä.
        // $user = Auth::user();
        // if (!$user) abort(403, 'No access');

        $customers = Customer::all();

        // Jos asiakkaiden haussa ilmenee ongelma, niin palauttaa 500 errorin
        abort_unless($customers, 500);

        return $customers;
    }

    public function deleteCustomer($id)
    {
        $customer = Customer::find($id);

        // Jos poistettavaa asiakasta ei löydy niin palauttaa 404 errorin
        abort_unless($customer, 404);

        $customer->delete();


        return response()->json('Asiakas poistettu!');
    }
}
