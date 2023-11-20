<?php

// Programer Name: CHOW WEN LONG
// Program Name: AdminController.php
// Description: To manage functions for admin 
// First Written on: 20/4/2023
// Edited on: 20/6/2023

namespace App\Http\Controllers;
use App\Models\Sales;
use App\Models\Expenses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
// use  Illuminate\Validation\Validator;

class AdminController extends Controller
{
    //
    public function sales()
    {
        return view('admin.sales');
    }

    public function sales_edit($id,Request $request)
    {
        $sales = Sales::find($id);    
        $row = $request->query('row');     
       
        return view('admin.sales_edit', compact('id', 'row'));
    }

    public function expenses()
    {
        return view('admin.expenses');
    }

    public function expenses_add()
    {
        return view('admin.expenses_add');
    }

    public function expenses_edit($id)
    {
        $expenses = Expenses::find($id);             
       
        return view('admin.expenses_add', compact('id','expenses'));
    }

    public function expenses_store(Request $request)
    {
        $request->validate([
            'invoice_number' => 'required',
            'amount' => 'required|numeric',           
            'expenses_type' => 'required|not_in:Select Expenses Type',            
        ]);

        // Store the Expenses Record record
        $expenses = new Expenses;
        $expenses->invoice_number = $request->input('invoice_number');
        $expenses->amount = $request->input('amount');
        $expenses->expenses_type = $request->input('expenses_type');
        $expenses->description = $request->input('description');        

        // Save the customer record
        $expenses->save();

        // Redirect back to the form or any other desired page
        return redirect()->back()->with('success', 'New Expenses Record added successfully!');
    }


    public function expenses_update(Request $request, $id)
    {
        try {
            // Find the expenses record by ID
            $expenses = Expenses::findOrFail($id);

            // Validate the form data
            $request->validate([
                'invoice_number' => 'required',
                'amount' => 'required|numeric',           
                'expenses_type' => 'required|not_in:Select Expenses Type',            
            ]);

            // Update the expenses record       
            $expenses->invoice_number = $request->input('invoice_number');
            $expenses->amount = $request->input('amount');
            $expenses->expenses_type = $request->input('expenses_type');
            $expenses->description = $request->input('description');        

            // Save the updated expenses record
            $expenses->save();

            // Redirect back to the form or any other desired page
            return redirect()->route('expenses.edit',['id' => $expenses->id])->with('success', 'Expenses Record updated successfully!');
        } catch (Exception $e) {
            // Log or display the caught exception
            dd($e);
        }
    }

    public function sales_update(Request $request, $id)
    {
        try {
            // Find the sales record by ID
            $sales = Sales::findOrFail($id);
            $row = $request->query('row');     
            // Validate the form data
            $request->validate([
                'service_tax' => 'required|numeric|between:0,9999999.99',
                'stamp_duty' => 'required|numeric|between:0,9999999.99',
            
            ], [
                'service_tax.numeric' => 'The service tax must be a valid numeric value with up to 2 decimal places.',
                'service_tax.between' => 'The service tax must be between 0 and 9999999.99.',
                'stamp_duty.numeric' => 'The stamp duty must be a valid numeric value with up to 2 decimal places.',
                'stamp_duty.between' => 'The stamp duty must be between 0 and 9999999.99.',
            ]);

            // Update the sales record
            $sales->service_tax = $request->input('service_tax');
            $sales->stamp_duty = $request->input('stamp_duty');        

            // Save the updated sales record
            $sales->save();

            // dd($request->service_tax);
            // Redirect back to the form or any other desired page
            return redirect()->route('sales.edit', ['id' => $sales->id, 'row' => $row])->with([
                'success' => 'Sales Record updated successfully!',
                'updatedServiceTax' => $sales->service_tax,
                'updatedStampDuty' => $sales->stamp_duty,
            ]);
        } catch (Exception $e) {
            // Log or display the caught exception
            dd($e);
        }
    }

    public function users_update(Request $request, $id)
    {
        try {
            // Find the users record by ID
            $users = User::findOrFail($id);

            // Validate the form data
            $request->validate([
                'name' => 'required',
                'phone' => 'required|numeric',
                'email' => [
                    'email',
                    Rule::unique('users')->ignore($users->id, 'id'), // Ignore the current user's email
                ],
                'role' => 'required',
            ]);

            // Update the users record       
            $users->name = $request->input('name');
            $users->phone = $request->input('phone');
            $users->email = $request->input('email');
            $users->role = $request->input('role');        

            // Set the role to an empty value if it is 'Select Role'
            $users->role = ($request->input('role') === 'Select Role') ? '' : $request->input('role');

            // Save the updated users record
            $users->save();

            // Redirect back to the form or any other desired page
            return redirect()->route('users.edit',['id' => $users->id])->with('success', 'Users Record updated successfully!');
        } catch (Exception $e) {
            // Log or display the caught exception
            dd($e);
        }
    }

    public function users_delete($id)
    {
        $users = User::find($id);

        if (!$users) {
            return redirect()->route('admin.users',['tableName' =>'users'])->with('error', 'User Record not found.');
           
        }
      
        $users->delete();

        return redirect()->route('admin.users',['tableName' =>'users'])->with('success', 'User Record deleted successfully.');
    }

    public function users_edit($id)
    {
        $users = User::find($id);             
       
        return view('admin.user_management_edit', compact('id','users'));
    }
}
