<?php

// Programer Name: CHOW WEN LONG
// Program Name: PolicyController.php
// Description: To manage functions for policy 
// First Written on: 20/4/2023
// Edited on: 20/6/2023


namespace App\Http\Controllers;

use App\Models\Policy;
use App\Models\Customer;
use App\Models\CompaniesPolicy;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PolicyController extends Controller
{
    public function store(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'identification_number' => 'required',
            'car_plate' => $request->input('insurance_type') === 'Car Insurance' ? 'required' : '',
            'insurance_type' => 'required|not_in:Select Insurance Type',
            'premium' => 'required|numeric',
            'expired_date' => 'required|date',
            'registered_date' => 'required|date',
            'gender' => 'required',
        ]);

        // Store the customer policy record
        $policy = new Policy;
        $policy->customer_id = $id;
        $policy->first_name = $request->input('first_name');
        $policy->last_name = $request->input('last_name');
        $policy->identification_number = $request->input('identification_number');
        $policy->car_plate = $request->input('car_plate');
        $policy->insurance_type = $request->input('insurance_type');
        $policy->premium = $request->input('premium');
        $policy->expired_date = $request->input('expired_date');
        $policy->registered_date = $request->input('registered_date');
        $policy->gender = $request->input('gender');

        $policy->save();
        
        $sales = new Sales;
        $sales->policy_id = $policy -> id;      
        
        // Save the customer record
        
        $sales->save();

        // Redirect back to the form or any other desired page
        return redirect()->back()->with('success', 'New Customer Policy added successfully!');
    }


    public function update(Request $request, $id)
{
    try {
        // Find the policy record by ID
        $policy = Policy::findOrFail($id);

        // Validate the form data
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'identification_number' => 'required',
            'car_plate' => $request->input('insurance_type') === 'Car Insurance' ? 'required' : '',
            'insurance_type' => 'required|not_in:Select Insurance Type',
            'premium' => 'required|numeric',
            'expired_date' => 'required|date',
            'registered_date' => 'required|date',
            'gender' => 'required',
        ]);

        // Update the policy record
        $policy->first_name = $request->input('first_name');
        $policy->last_name = $request->input('last_name');
        $policy->identification_number = $request->input('identification_number');
        $policy->car_plate = $request->input('car_plate');
        $policy->insurance_type = $request->input('insurance_type');
        $policy->premium = $request->input('premium');
        $policy->expired_date = $request->input('expired_date');
        $policy->registered_date = $request->input('registered_date');
        $policy->gender = $request->input('gender');

        // Save the updated policy record
        $policy->save();

        // Redirect back to the form or any other desired page
        return redirect()->route('policy.edit',['id' => $policy->id])->with('success', 'Customer Policy updated successfully!');
    } catch (Exception $e) {
        // Log or display the caught exception
        dd($e);
    }
}

public function company_policy_store(Request $request)
{
    // Validate the form data
    $request->validate([
        'company_number' => 'required|unique:companies_policies,company_number',
        'car_plate' => $request->input('insurance_type') === 'Car Insurance' ? 'required' : '',
        'insurance_type' => 'required|not_in:Select Insurance Type',
        'premium' => 'required|numeric',
        'expired_date' => 'required|date',
        'registered_date' => 'required|date',
    ], [
        'company_number.unique' => 'The company number already exists.',
    ]);
    
    // Create a new policy record
    $company_policy = new CompaniesPolicy;
    $company_policy->company_number = $request->input('company_number');
    $company_policy->premium = $request->input('premium');
    $company_policy->insurance_type = $request->input('insurance_type');
    $company_policy->expired_date = $request->input('expired_date');
    $company_policy->registered_date = $request->input('registered_date');

    
    // Save the company policy record
    $company_policy->save();
    $company_id = $company_policy->id;

    $sales = New Sales;
    $sales->companypolicy_id = $company_id;

    $sales->save();
    // Redirect back to the form or any other desired page
    return redirect()->back()->with('success', 'Company policy created successfully!');
}


public function company_policy_update(Request $request, $id)
{
try {
    // Find the customer record by ID
    $company = CompaniesPolicy::findOrFail($id);

    // Validate the form data
    $request->validate([
        'company_number' => 'required',
        'car_plate' => $request->input('insurance_type') === 'Car Insurance' ? 'required' : '',
        'insurance_type' => 'required|not_in:Select Insurance Type',
        'premium' => 'required|numeric',
        'expired_date' => 'required|date',
        'registered_date' => 'required|date',
    ]);

    // Update the company policy record
    $company_policy = new CompaniesPolicy;
    $company_policy->company_number = $request->input('company_number');
    $company_policy->premium = $request->input('premium');
    $company_policy->insurance_type = $request->input('insurance_type');
    $company_policy->expired_date = $request->input('expired_date');
    $company_policy->registered_date = $request->input('registered_date');

    
    // Save the updated customer record
    $company_policy->save();
    
    // Redirect back to the form or any other desired page
    return redirect()->route('company_policy.edit',['id' => $customer->id])->with('success', 'Company policy updated successfully!');
} catch (Exception $e) {
    // Log or display the caught exception
    dd($e);
}
}
}
