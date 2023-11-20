<?php
// Programer Name: CHOW WEN LONG
// Program Name: TableController.php
// Description: To manage functions for table 
// First Written on: 20/4/2023
// Edited on: 20/6/2023

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TableController extends Controller
{
    public function showCustomerTable($tableName)
    {
        // Define the selected columns and their renamed display names
        $columnMapping = [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'zip_code' => 'Zip Code',
            'country' => 'Country',
            'identification_number' => 'Identification Number(IC)',
            'gender' => 'Gender',
        ];

        // Retrieve the data from the table for the selected columns
        $data = DB::table($tableName)->select(array_keys($columnMapping))->get();

        // Pass the column mapping, data, and the renamed display names to the view
        return view('staff.clientlist', compact('columnMapping', 'data'));
    }   

    public function showCustomerPoliciesTable($tableName)
    {
        // Define the selected columns and their renamed display names
        $columnMapping = [
            'id' => 'ID',
            'customer_id' => 'cid',
            'premium' => 'Premium',
            'insurance_type' => 'Insurance Type',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'identification_number' => 'Identification Number(IC)',
            'gender' => 'Gender',
            'car_plate' => 'Car Plate',
            'expired_date' => 'Expired Date',
            'registered_date' => 'Registered Date',
        ];

        // Retrieve the data from the table for the selected columns
        $data = DB::table($tableName)->select(array_keys($columnMapping))->get();

        // Pass the column mapping, data, and the renamed display names to the view
        return view('policy.policylist', compact('columnMapping', 'data'));
    }   

    public function showCompaniesPoliciesTable($tableName)
    {
        // Define the selected columns and their renamed display names
        $columnMapping = [
            'id' => 'ID',
            'company_number' => 'Company Number',
            'premium' => 'Premium',
            'insurance_type' => 'Insurance Type',                                 
            'expired_date' => 'Expired Date',
            'registered_date' => 'Registered Date',
        ];

        // Retrieve the data from the table for the selected columns
        $data = DB::table($tableName)->select(array_keys($columnMapping))->get();

        // Pass the column mapping, data, and the renamed display names to the view
        return view('policy.companies_policylist', compact('columnMapping', 'data'));
    }   

    public function showExpensesTable($tableName)
    {
        // Define the selected columns and their renamed display names
        $columnMapping = [
            'id' => 'ID',
            'invoice_number' => 'Invoice Number',
            'amount' => 'Amount',
            'expenses_type' => 'Expenses Type',
            'description' =>'Description',                                             
            'created_at' => 'Created Date',
        ];

        // Retrieve the data from the table for the selected columns
        $data = DB::table($tableName)->select(array_keys($columnMapping))->get();

        // Pass the column mapping, data, and the renamed display names to the view
        return view('admin.expenses', compact('columnMapping', 'data'));
    }   

    public function showSalesTable($tableName)
    {

        
        
        $query = "
                    SELECT
                    sales.id,
                    CONCAT(customers_policies.first_name , ' ' , customers_policies.last_name ) AS name,
                    customers_policies.identification_number AS ic_companynumber,
                    customers_policies.insurance_type,                    
                    customers_policies.premium AS premium,
                    sales.service_tax,
                    sales.stamp_duty,
                    sales.created_at
                    FROM
                        sales
                    LEFT JOIN
                        customers_policies ON sales.policy_id = customers_policies.id
                    LEFT JOIN
                        companies_policies ON sales.companypolicy_id = companies_policies.id
                    WHERE companies_policies.id IS NULL
                    
                    UNION
                    
                    SELECT
                        sales.id,
                        NULL AS name,
                        companies_policies.company_number AS ic_companynumber,
                        companies_policies.insurance_type,
                        companies_policies.premium AS premium,
                        sales.service_tax,
                        sales.stamp_duty,
                        sales.created_at
                    FROM
                        sales
                    LEFT JOIN
                        customers_policies ON sales.policy_id = customers_policies.id
                    LEFT JOIN
                        companies_policies ON sales.companypolicy_id = companies_policies.id
                    WHERE customers_policies.id IS NULL;";

            $data = DB::select($query);
          
            // Pass the data to the view
            return view('admin.sales', compact('data'));
    }

    public function showUsersTable($tableName)
    {
        // Define the selected columns and their renamed display names
        $columnMapping = [
            'id' => 'ID',
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'password' =>'Password',                                             
            'role' => 'Role',
        ];

        // Retrieve the data from the table for the selected columns
        $data = DB::table($tableName)->select(array_keys($columnMapping))->get();

        // Pass the column mapping, data, and the renamed display names to the view
        return view('admin.user_management', compact('columnMapping', 'data'));
    }   

}
