
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet"> --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">   

<div class="p-5 form-row">
    {{-- <h1 class="h4 text-gray-900 mb-4">Add Customer</h1> --}}
    <form class="user">
        <div class="form-group form-custom">
            <label class="text-gray-900">Invoice Number</label>
            <input type="invoice_number" class="form-control form-control-user  @error('invoice_number') is-invalid @enderror" value="{{ isset($expenses) ? $expenses->invoice_number : old('invoice_number') }}" name ="invoice_number"
                id="Inputinvoice_number" aria-describedby="invoice_numberHelp"
                placeholder="Enter Invoice Number...">

                @error('invoice_number')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror

        </div>
        
        <div class="form-group form-custom">
            <label class="text-gray-900">Amount</label>
            <input type="amount" class="form-control form-control-user  @error('amount') is-invalid @enderror" value="{{ isset($expenses) ? $expenses->amount : old('amount') }}" name ="amount"
                id="Inputamount" aria-describedby="amountHelp"
                placeholder="Enter Amount...">

                @error('amount')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror

        </div>

        <div class="form-group form-custom">
            <label class="text-gray-900">Expenses Type</label>
            <div class="dropdown mb-4">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   
                    @if (isset($expenses))
                        {{ $expenses->expenses_type }}
                    @elseif (old('expenses_type'))
                        {{ old('expenses_type') }}
                    @else
                        Select Expenses Type
                    @endif
                
            </button>
                <input type="hidden" name="expenses_type" value="{{ isset($expenses) ? $expenses->expenses_type : old('expenses_type') }}">
                <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" name="expenses_type" onclick="selectExpensesType('Rent/Lease Expenses')" value="Rent/Lease Expenses">Rent/Lease Expenses</a>
                    <a class="dropdown-item" name="expenses_type" onclick="selectExpensesType('Utilities')" value="Utilities">Utilities</a>
                    <a class="dropdown-item" name="expenses_type" onclick="selectExpensesType('Office Supplies')" value="Office Supplies">Office Supplies</a>
                    <a class="dropdown-item" name="expenses_type" onclick="selectExpensesType('Technology Expenses')" value="Technology Expenses">Technology Expenses</a>
                    <a class="dropdown-item" name="expenses_type" onclick="selectExpensesType('Marketing and Advertising')" value="Marketing and Advertising">Marketing and Advertising</a>
                    <a class="dropdown-item" name="expenses_type" onclick="selectExpensesType('Insurance Priemiums')" value="Insurance Priemiums">Insurance Priemiums</a>
                    <a class="dropdown-item" name="expenses_type" onclick="selectExpensesType('Employee Salaries and Benefits')" value="Employee Salaries and Benefits">Employee Salaries and Benefits</a>
                    <a class="dropdown-item" name="expenses_type" onclick="selectExpensesType('Professional Serices')" value="Professional Serices">Professional Serices</a>
                    <a class="dropdown-item" name="expenses_type" onclick="selectExpensesType('Travel and Entertainment')" value="Travel and Entertainment">Travel and Entertainment</a>
                    <a class="dropdown-item" name="expenses_type" onclick="selectExpensesType('Licensing and Certifications')" value="Licensing and Certifications">Licensing and Certifications</a>
                    <a class="dropdown-item" name="expenses_type" onclick="selectExpensesType('Training and Education')" value="Training and Education">Training and Education</a>
                    <a class="dropdown-item" name="expenses_type" onclick="selectExpensesType('Miscellaneous Expenses')" value="Miscellaneous Expenses">Miscellaneous Expenses</a>

                </div>
                @error('expenses_type')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="form-group form-custom" style="width:100%;">
            <label class="text-gray-900">Description</label>
            <textarea type="description" class="form-control form-control-user  @error('description') is-invalid @enderror" value="{{isset($expenses) ? $expenses->description : old('description')}}" name ="description"
                id="Inputdescription" aria-describedby="descriptionHelp" style="height:10rem;"
                placeholder="Enter Description...">@if(isset($expenses)){{$expenses->description}}@endif</textarea>

                @error('description')
                    <div class="invalid-feedback">
                    {{$message}}
                    </div>
                @enderror                                                
        </div>              
        
        <button type="submit" class="btn btn-primary btn-user btn-sm form-group btn-block">
            @if (isset($expenses))
                Save
            @else
                Add
            @endif
        </button>
        
        <a href="{{ route('admin.expenses',['tableName' => 'expenses']) }}" class="btn btn-primary btn-user btn-sm form-group btn-block">Cancel</a>

        @if (session('message'))
            <div class="text-success">
                {{ session('message') }}
            </div>
        @endif
        
    </form>
</div>
<script type="text/javascript">
    function selectExpensesType(expenses_type) {
        document.querySelector('button.dropdown-toggle').textContent = expenses_type;
        document.querySelector('input[name="expenses_type"]').value = expenses_type;
    }
        

    $(document).ready(function() {
    // Get the initial selected insurance type
    var initialExpensesType = document.querySelector('button.dropdown-toggle').textContent;
   
    // Call the selectExpensesType function with the initial insurance type
    selectExpensesType(initialExpensesType);
});
</script>