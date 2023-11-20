{{-- Datepicker --}}
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">   

<div class="p-5 form-row">
    {{-- <h1 class="h4 text-gray-900 mb-4">Add policy</h1> --}}
    <form class="user">
        <div class="form-group form-custom">
            <label class="text-gray-900">First Name</label>
            <input type="first_name" class="form-control form-control-user  @error('first_name') is-invalid @enderror" value="{{ isset($policy) ? $policy->first_name : (isset($customer) ? $customer->first_name : old('first_name')) }}
            " name ="first_name"
                id="Inputfirst_name" aria-describedby="first_nameHelp"
                placeholder="Enter First Name...">

                @error('first_name')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror

        </div>
        <div class="form-group form-custom">
            <label class="text-gray-900">Last Name</label>
            <input type="last_name" class="form-control form-control-user  @error('last_name') is-invalid @enderror" value="{{ isset($policy) ? $policy->last_name : (isset($customer) ? $customer->last_name : old('last_name')) }}
            " name ="last_name"
                id="Inputlast_name" aria-describedby="last_nameHelp"
                placeholder="Enter Last Name...">

                @error('last_name')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group form-custom">
            <label class="text-gray-900">Identification Number(IC)</label>
            <input type="identification_number" class="form-control form-control-user  @error('identification_number') is-invalid @enderror" value="{{ isset($policy) ? $policy->identification_number : (isset($customer) ? $customer->identification_number : old('identification_number')) }}
            " name ="identification_number"
                id="Inputidentification_number" aria-describedby="identification_numberHelp"
                placeholder="Enter Identification Number...">

                @error('identification_number')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group form-custom">
            <label class="text-gray-900">Car Plate</label>
            <input type="car_plate" class="form-control form-control-user  @error('car_plate') is-invalid @enderror" value="{{isset($policy) ? $policy->car_plate : old('car_plate')}}" name ="car_plate"
                id="Inputcar_plate" aria-describedby="car_plateHelp"
                placeholder="" @if(isset($policy) && $policy->insurance_type != 'Car Insurance') disabled @endif  >

                @error('car_plate')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror
        </div>
        
        <div class="form-group form-custom">
            <label class="text-gray-900">Insurance Type</label>
            <div class="dropdown mb-4">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   
                    @if (isset($policy))
                        {{ $policy->insurance_type }}
                    @elseif (old('insurance_type'))
                        {{ old('insurance_type') }}
                    @else
                        Select Insurance Type
                    @endif
                
            </button>
                <input type="hidden" name="insurance_type" value="{{ isset($policy) ? $policy->insurance_type : old('insurance_type') }}">
                <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" name="insurance_type" onclick="selectInsuranceType('Car Insurance')" value="Car Insurance">Car Insurance</a>
                    <a class="dropdown-item" name="insurance_type" onclick="selectInsuranceType('Fire')" value="Fire">Fire</a>
                    <a class="dropdown-item" name="insurance_type" onclick="selectInsuranceType('Personal Accident')" value="Personal Accident">Personal Accident</a>
                    <a class="dropdown-item" name="insurance_type" onclick="selectInsuranceType('Workman Compensation')" value="Workman Compensation">Workman Compensation</a>
                    <a class="dropdown-item" name="insurance_type" onclick="selectInsuranceType('Marine/Transit')" value="Marine/Transit">Marine/Transit</a>
                </div>
                @error('insurance_type')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="form-group form-custom" style="width:100%">
            <label class="text-gray-900">Premium</label>
            <input type="premium" class="form-control form-control-user  @error('premium') is-invalid @enderror" value="{{isset($policy) ? $policy->premium : old('premium')}}" name ="premium"
                id="Inputpremium" aria-describedby="premiumHelp"
                placeholder="Enter Premium...">

                @error('premium')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group form-custom">
            <label class="text-gray-900">Registered Date</label>
            <input type="text" id="register_datepicker" class="form-control form-control-user  @error('registered_date') is-invalid @enderror" value="{{isset($policy) ? $policy->registered_date : old('registered_date')}}" name ="registered_date" 
             aria-describedby="registered_dateHelp"
            placeholder="Choose Register Date...">

                @error('registered_date')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group form-custom">
            <label class="text-gray-900">Expired Date</label>
            <input type="text" id="expired_datepicker" class="form-control form-control-user  @error('expired_date') is-invalid @enderror" value="{{isset($policy) ? $policy->expired_date : old('expired_date')}}" name ="expired_date" 
            aria-describedby="expired_dateHelp"
            placeholder="" >

                @error('expired_date')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group form-custom">
            <label class="text-gray-900">Gender</label>
            <div class="dropdown mb-4">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   
                    @if (isset($policy))
                        {{ $policy->gender }}
                    
                    @elseif (isset($customer))
                    {{ $customer->gender }}
                    @elseif (old('gender'))
                        {{ old('gender') }}
                    @else
                        Select Gender
                    @endif
                
            </button>
                <input type="hidden" name="gender" value="{{ isset($policy) ? $policy->gender : (isset($customer) ? $customer->gender : old('gender')) }}">
                <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" name="gender" onclick="selectGender('Female')" value="Female">Female</a>
                    <a class="dropdown-item" name="gender" onclick="selectGender('Male')" value="Male">Male</a>
                </div>
                @error('gender')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary btn-user btn-sm form-group btn-block">
            @if (isset($policy))
                Save
            @else
                Add
            @endif
        </button>
        
        @if (Route::is('policy.edit'))
            <a href="{{route('customers.policy', ['tableName' => 'customers_policies'])}}" class="btn btn-primary btn-user btn-sm form-group btn-block">Cancel</a>
        @else
        <a href="{{route('staff.client',['tableName'=>'customers'])}}" class="btn btn-primary btn-user btn-sm form-group btn-block">Cancel</a>
        @endif
   
       

        @if (session('message'))
            <div class="text-success">
                {{ session('message') }}
            </div>
        @endif
        
    </form>
</div>
<script type="text/javascript">
    function selectGender(gender) {
        document.querySelector('button.dropdown-toggle').textContent = gender;
        document.querySelector('input[name="gender"]').value = gender;
    }

    
    function selectInsuranceType(insurance_type) {
        document.querySelector('button.dropdown-toggle').textContent = insurance_type;
        document.querySelector('input[name="insurance_type"]').value = insurance_type;
        
        var carPlateField = document.getElementById('Inputcar_plate');

        if (insurance_type.trim() === 'Car Insurance') {
            
            carPlateField.removeAttribute('disabled');  
            carPlateField.placeholder = 'Enter Car Plate...';
        } else {
          
            carPlateField.setAttribute('disabled', 'disabled');
            carPlateField.value = '';
            carPlateField.placeholder = 'None';
        }
    }

    $(document).ready(function() {
    // Get the initial selected insurance type
    var initialInsuranceType = document.querySelector('button.dropdown-toggle').textContent;
   
    // Call the selectInsuranceType function with the initial insurance type
    selectInsuranceType(initialInsuranceType);
});
</script>
<script>

    $('#register_datepicker').datepicker(
        {
            dateFormat: 'yy-mm-dd',
            onSelect: function (date, datepicker) {
                var expirationDate = new Date(date);
                expirationDate.setFullYear(expirationDate.getFullYear() + 1);
               console.log(expirationDate);
               var formattedExpirationDate = formatDate(expirationDate);
               $("#expired_datepicker").val(formattedExpirationDate);
            }
        }
   );

function formatDate(date) {
    var year = date.getFullYear();
    var month = ("0" + (date.getMonth() + 1)).slice(-2);
    var day = ("0" + date.getDate()).slice(-2);
    return year + "-" + month + "-" + day;
}

</script>

