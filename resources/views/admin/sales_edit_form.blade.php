
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet"> --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">   

<div class="p-5 form-row">
    {{-- <h1 class="h4 text-gray-900 mb-4">Add Customer</h1> --}}
    <form class="user">
        <div class="form-group form-custom">
            <label class="text-gray-900">IC/Company Number</label>
            <input type="ic_companynumber" class="form-control form-control-user  @error('ic_companynumber') is-invalid @enderror" value="{{isset($row) ? unserialize($row)->ic_companynumber : old('ic_companynumber')}}" name ="ic_companynumber"
                id="Inputic_companynumber" aria-describedby="ic_companynumberHelp"
                placeholder="" disabled>

                @error('ic_companynumber')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group form-custom">
            <label class="text-gray-900">Insurance Type</label>
            <input type="insurance_type" class="form-control form-control-user  @error('insurance_type') is-invalid @enderror" value="{{isset($row) ? unserialize($row)->insurance_type : old('insurance_type')}}" name ="insurance_type"
                id="Inputinsurance_type" aria-describedby="insurance_typeHelp"
                placeholder="" disabled>

                @error('insurance_type')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror
        </div>  

        <div class="form-group form-custom" style="width:100%;">
            <label class="text-gray-900">Premium</label>
            <input type="premium" class="form-control form-control-user  @error('premium') is-invalid @enderror" value="{{isset($row) ? unserialize($row)->premium : old('premium')}}" name ="premium"
                id="Inputpremium" aria-describedby="premiumHelp"
                placeholder="Enter premium..." disabled>

                @error('premium')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group form-custom">
            <label class="text-gray-900">Service Tax</label>
            <input type="service_tax" class="form-control form-control-user @error('service_tax') is-invalid @enderror" 
                value="{{ session('updatedServiceTax') ? session('updatedServiceTax') : ($row ? unserialize($row)->service_tax : old('service_tax')) }}" 
                name="service_tax" id="Inputservice_tax" aria-describedby="service_taxHelp" placeholder="Enter Service Tax...">
            @error('service_tax')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        
        <div class="form-group form-custom">
            <label class="text-gray-900">Stamp Duty</label>
            <input type="stamp_duty" class="form-control form-control-user @error('stamp_duty') is-invalid @enderror" 
                value="{{ session('updatedStampDuty') ? session('updatedStampDuty') : ($row ? unserialize($row)->stamp_duty : old('stamp_duty')) }}" 
                name="stamp_duty" id="Inputstamp_duty" aria-describedby="stamp_dutyHelp" placeholder="Enter Stamp Duty...">
            @error('stamp_duty')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        

        
        <div class="form-group form-custom">
            <label class="text-gray-900">Registered Date</label>
            <input type="text" id="register_datepicker" class="form-control form-control-user  @error('created_at') is-invalid @enderror" value="{{isset($row) ? unserialize($row)->created_at : old('created_at')}}" name ="created_at" 
             aria-describedby="created_atHelp"
            placeholder="Choose Register Date..." disabled>

                @error('created_at')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror
        </div>      
        
        <button type="submit" class="btn btn-primary btn-user btn-sm form-group btn-block">
            @if (isset($row))
                Save
            @else
                Add
            @endif
        </button>
        
        <a href="{{ route('admin.sales',['tableName' => 'sales'])}}" class="btn btn-primary btn-user btn-sm form-group btn-block">Cancel</a>

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
