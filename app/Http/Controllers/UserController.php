<?php

// Programer Name: CHOW WEN LONG
// Program Name: UserController.php
// Description: To manage functions for user 
// First Written on: 20/4/2023
// Edited on: 20/6/2023


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use App\Models\Policy;
use App\Models\CompaniesPolicy;
use App\Models\Sales;
use App\Models\Expenses;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{
    public function login()
    {
        return view('user.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }

    public function register()
    {
        return view('user.register');
    }

    public function forgotpassword()
    {
        return view('user.forgotpassword');
    }

    public function passwordResetEmail()
    {
        return view('email.resetpasswordmail');
    }   

    public function registerUser(Request $request)
    {
            
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'password' => 'required|confirmed', 
        ]);

        // User::create($request->all());

        // dd($request ->all());
        try {
            // Insert the data into the database
            $user = new User;
            $user->name = $request->input('first_name') . ' ' . $request->input('last_name');
            $user->phone = $request->input('phone');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->role = $request->input('role','');
            $user->save();

        } catch (QueryException $e) {
            if ($e->getCode() === '23000' && $e->errorInfo[1] === 1062) {
                // Handle the duplicate entry error
                return redirect()->back()->withErrors(['email' => 'The email address is already taken.'])->withInput();
            }
        }

        return redirect()->route('user.login')->with('message','User created.');
    
        event(new Registered($user));

        // if ($user->role === 'staff') {
        //     return redirect()->route('verification.notice');
        // } else {
        //     // return redirect()->route('admin.dashboard')->with('message', "user created");
        // }
        
    }

    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $remember = $request->filled('rememberCheck');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
 
            $user = Auth::user();

            if (!$user->role) {
                // If the role is empty, log the user out and redirect to the login page
                Auth::logout();
                return redirect()->route('user.login')->withErrors([
                    'email' => 'Your account does not have a valid role.',
                ])->withInput();
            }

            return Redirect::route('staff.home')->with(compact('user'));
                                  
        }else{
            // Authentication failed
            return redirect()->back()->withErrors([
                'email' => 'Wrong Email/Password',
                'password' => ' ',
            ])->withInput();
        }

       
    }

    public function showResetForm(Request $request, $token)
    {
        $email = $request->query('email'); // Retrieve the email from the query parameter
        return view('user.resetpassword')->with(['token' => $token, 'email' => $email]);
    }
    
    public function sendPasswordResetEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();
        
        if ($user) {
            // Generate and store password reset token
            $token = Str::random(60);
            DB::table('password_reset_tokens')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => now(),
            ]);

            $url = URL::temporarySignedRoute(
                'user.passwordreset', // Route name for the password reset page
                now()->addMinutes(60), // Token expiration time (adjust as needed)
                ['email' => $user->email, 'token' => $token] // Parameters passed to the route
            );
            
                   
            // Send password reset email
            Mail::to($user->email)->send(new ResetPasswordMail($url));
    
            return back()->with('message', 'Password reset email sent.');
        }
       
        return back()->with('error','Email not found.');
    }

    public function updatePassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|confirmed', // Add the confirmed validation rule to check if password and password_confirmation are the same
    ]);

    // Get the user by email
    $user = User::where('email', $request->email)->first();

    if ($user) {
        // Update the user's password
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->route('user.login')->with('message', 'Password updated successfully.');
    }

    return back()->with('error', 'User not found.'); // Handle the case when user is not found
}


    public function showSalesChart(){
        $currentYear = date('Y');
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $expensesData = [];

        // Fetch sales for each month of the current year
        foreach ($months as $index => $month) {
            $CustomerSales = Policy::whereYear('registered_date', $currentYear)
                                ->whereMonth('registered_date', $index + 1)
                                ->get();

            $CompanySales = CompaniesPolicy::whereYear('registered_date', $currentYear)
                                ->whereMonth('registered_date', $index + 1)
                                ->get();
                            
            $CompanyTotal = $CompanySales->sum('premium');
            $customerTotal = $CustomerSales->sum('premium');
            $salesData[] = $CompanyTotal + $customerTotal;
        }       
        return $salesData;
    }

    public function calculateSalesPercentage()
    {
        // Calculate total sales from customers
        $totalCustomerSales = Policy::sum('premium');

        // Calculate total sales from companies
        $totalCompanySales = CompaniesPolicy::sum('premium');

        // Calculate the percentage of sales from customers and companies

        if($totalCustomerSales!=0 || $totalCompanySales!=0){
        $customerPercentage = round(($totalCustomerSales / ($totalCustomerSales + $totalCompanySales)) * 100);
        $companyPercentage = round(($totalCompanySales / ($totalCustomerSales + $totalCompanySales)) * 100);
        
        $salesData[] = [(double) $customerPercentage, (double) $companyPercentage];

        // Return the calculated percentages
        return $salesData;
        }
    }


    public function calTotalSalesMonth()
    {         
        $currentYear = date('Y');
        $currentMonth = date('m');

        $customerSalesMonth = Policy::whereMonth('registered_date', $currentMonth)->whereYear('registered_date', $currentYear)->get();
        $companySalesMonth = CompaniesPolicy::whereMonth('registered_date', $currentMonth)->whereYear('registered_date', $currentYear)->get();
        
        $customerSalesMonthTotal = $customerSalesMonth->sum('premium');
        $companySalesMonthTotal = $companySalesMonth->sum('premium');


        return $customerSalesMonthTotal + $companySalesMonthTotal;
    }

    public function calTotalSalesYear()
    {
         
        $currentYear = date('Y');
        $currentMonth = date('m');

        $customerSalesYear = Policy::whereYear('registered_date', $currentYear)->get();
        $companySalesYear = CompaniesPolicy::whereYear('registered_date', $currentYear)->get();

        $customerSalesYearTotal = $customerSalesYear->sum('premium');
        $companySalesYearTotal = $companySalesYear->sum('premium');

        // dd( $customerSalesYearTotal + $companySalesYearTotal);
        return $customerSalesYearTotal + $companySalesYearTotal;
    }

    public function calTotalExpensesMonth()
    {
         
        $currentYear = date('Y');
        $currentMonth = date('m');

        $expenses = Expenses::whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->get();
        $expensesTotalMonth = $expenses->sum('amount');

        return $expensesTotalMonth;
    }

    public function calTotalExpensesYear()
    {
         
        $currentYear = date('Y');
        $currentMonth = date('m');
        
        $expenses = Expenses::whereYear('created_at', $currentYear)->get();
        $expensesTotalYear = $expenses->sum('amount');

        return $expensesTotalYear;
    }

    public function showExpiredPolicies()
    {
         
        $currentYear = date('Y');
        $currentMonth = date('m');

        $expiredPolicies = Policy::whereYear('expired_date', $currentYear)
                                ->whereMonth('expired_date', $currentMonth)
                                ->with('customer') // Eager load the 'customer' relationship
                                ->get();

        if (!$expiredPolicies->isEmpty()) {
        foreach ($expiredPolicies as $policy) {
            $customerPhone = $policy->customer->phone;          
        }
        }

        return $expiredPolicies;
    }

    public function home()
    {                                              
        $expiredPolicies = $this->showExpiredPolicies();  
        $salesData = $this->showSalesChart();      
        $totalSalesMonth = $this->calTotalSalesMonth();  
        $totalSalesYear = $this->calTotalSalesYear();  
        $totalExpensesMonth = $this->calTotalExpensesMonth();  
        $totalExpensesYear = $this->calTotalExpensesYear();  
        $salesPercentage = $this->calculateSalesPercentage();
        
        return view('staff.home')->with(compact('expiredPolicies','totalSalesMonth',
         'totalSalesYear', 'totalExpensesMonth', 'totalExpensesYear','salesData', 'salesPercentage'));
    }

    public function clientlist()
    {
        return view('staff.clientlist');
    }

    public function clientadd()
    {
        return view('staff.clientadd');
    }

    public function clientedit($id)
    {
        $customer = Customer::find($id);

        return view('staff.clientadd', compact('id','customer'));
    }


    public function policylist()
    {
        return view('policy.policylist');
    }

    public function policyadd($id)
    {
        $customer = Customer::find($id);
        return view('policy.policyadd',compact('id','customer'));
    }

    public function policyedit($id)
    {
        $policy = Policy::find($id);

        return view('policy.policyadd', compact('id','policy'));
    }
    
    public function company_policylist()
    {
        return view('policy.companies_policylist');
    }

    public function company_policy_add()
    {
        return view('policy.companies_policyadd');
    }

    public function company_policy_edit($id)
    {
        $company_policy = CompaniesPolicy::find($id);

        return view('policy.companies_policyadd', compact('id','company_policy'));
    }
    
}
