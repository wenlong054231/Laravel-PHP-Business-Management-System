<?php

// Programer Name: CHOW WEN LONG
// Program Name: CustomerController.php
// Description: To manage functions for customer 
// First Written on: 20/4/2023
// Edited on: 20/6/2023

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required|numeric',
            'country' => 'required',
            'gender' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new customer record
        $customer = new Customer;
        $customer->first_name = $request->input('first_name');
        $customer->last_name = $request->input('last_name');
        $customer->email = $request->input('email');
        $customer->phone = $request->input('phone');
        $customer->address = $request->input('address');
        $customer->city = $request->input('city');
        $customer->state = $request->input('state');
        $customer->zip_code = $request->input('zip_code');
        $customer->country = $request->input('country');
        $customer->gender = $request->input('gender');

        // Save the customer record
        $customer->save();

        // Redirect back to the form or any other desired page
        return redirect()->back()->with('success', 'Customer added successfully!');
    }


    public function update(Request $request, $id)
    {
        try {
            // Find the customer record by ID
            $customer = Customer::findOrFail($id);

            // Validate the form data
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|numeric',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zip_code' => 'required|numeric',
                'country' => 'required',
                'gender' => 'required',
            ]);

            // Update the customer record
            $customer->first_name = $request->input('first_name');
            $customer->last_name = $request->input('last_name');
            $customer->email = $request->input('email');
            $customer->phone = $request->input('phone');
            $customer->address = $request->input('address');
            $customer->city = $request->input('city');
            $customer->state = $request->input('state');
            $customer->zip_code = $request->input('zip_code');
            $customer->country = $request->input('country');
            $customer->gender = $request->input('gender');

            // Save the updated customer record
            $customer->save();

            // Redirect back to the form or any other desired page
            return redirect()->route('customer.edit',['id' => $customer->id])->with('success', 'Customer updated successfully!');
        } catch (Exception $e) {
            // Log or display the caught exception
            dd($e);
        }
    }

   
}
