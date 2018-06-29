<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Customer;
use App\Http\Requests\CreateCustomerRequest;
class CustomersController extends Controller
{
    public function all()
    {
        $customers = Customer::all();
        return response()->json([
            "customers" => $customers
        ], 200);
    }
    public function get($id)
    {
        $customer = Customer::whereId($id)->first();
        return response()->json([
            "customer" => $customer
        ], 200);
    }
    public function new(CreateCustomerRequest $request)
    {
        $customer = Customer::create($request->only(["name", "email", "phone"]));
        return response()->json([
            "customer" => $customer
        ], 200);
    }
    public function edit(CreateCustomerRequest $request, $id)
    {
       
        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;

        $customer->save();
        

        return response()->json([
            "customer" => $customer
        ], 200);
    }
    public function delete(Request $request,$id)
    {
       
        
        if(Customer::findOrFail($id)->delete()){
            return response()->json([
                "customer" => "Nice!!"
            ], 200);
        }else{
            return response()->json([
                "customer" => "Asneira"
            ], 404);
        }
      
        

        
    }
}
