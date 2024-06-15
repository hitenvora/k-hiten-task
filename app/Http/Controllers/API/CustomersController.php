<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\Customer;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\AdminCustomerModels;
use App\Models\Cart;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $customers = Customer::orderBy('id', 'DESC')->orderBy('id', 'DESC')->get();
        // $customers = AdminCustomerModels::orderBy('id', 'DESC')->orderBy('id', 'DESC')->get();
        // return CustomerResource::collection($customers);
        $customers = AdminCustomerModels::orderBy('id', 'DESC')->get();
        return CustomerResource::collection($customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cart = Cart::where('cart_id', $request->input('cart_Id'))->first();
        // $customer = new Customer;

        $customer = new AdminCustomerModels();

		// $customer->name = $request->input('name');
		$customer->first_name = $request->input('name');
		$customer->cart_id = $cart->id;
		$customer->contact_number = $request->input('contact_no');
        $cart->employee_id = 0 ;
        $cart->save();
        $customer->save();

        return response()->json($customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = AdminCustomerModels::findOrFail($id);
        return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CustomerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        // $customer = Customer::findOrFail($id);
        $customer = AdminCustomerModels::findOrFail($id);

		// $customer->name = $request->input('name');
		$customer->first_name = $request->input('name');
		$customer->contact_no = $request->input('contact_no');
        $customer->save();

        return response()->json($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $customer = Customer::findOrFail($id);
        $customer = AdminCustomerModels::findOrFail($id);
        $customer->delete();

        return response()->json(null, 204);
    }
}
