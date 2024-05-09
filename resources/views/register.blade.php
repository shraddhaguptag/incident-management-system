<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Include CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=myMap"></script>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" id="registrationForm">
                            @csrf
    
                            <!-- Radio button for user type -->
                            <div class="form-group">
                                <label for="user_type">User Type</label><br>
                                <input type="radio" name="user_type" value="Individual"> Individual
                                <input type="radio" name="user_type" value="Enterprise"> Enterprise
                                <input type="radio" name="user_type" value="Government"> Government
                            </div>
    
                            <!-- First Name and Last Name -->
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input id="first_name" type="text" class="form-control" name="first_name"  autofocus>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input id="last_name" type="text" class="form-control" name="last_name" >
                            </div>
    
                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email"  >
                            </div>
    
                            <!-- Phone Number -->
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input id="phone_number" type="text" class="form-control" name="phone_number"  >
                            </div>
    
                            <!-- Address, Pin code, City, Country -->
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input id="address" type="text" class="form-control" name="address"  >
                            </div>
                            <div class="form-group">
                                <label for="pin_code">Pin code</label>
                                <input id="pin_code" type="text" class="form-control" name="pin_code"  >
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input id="city" type="text" class="form-control" name="city"  >
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input id="country" type="text" class="form-control" name="country"  >
                            </div>
    
                            <!-- Password and Confirm Password -->
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control" name="password"  >
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"  >
                            </div>
    
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

<!-- JavaScript Validation -->
<script>

    function initializeAutocomplete() {
        var input = document.getElementById('pin_code');
        var options = {
            types: ['(regions)'] // Restrict to regions (postal codes)
        };

        var autocomplete = new google.maps.places.Autocomplete(input, options);

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            var addressComponents = place.address_components;

            var city = '';
            var country = '';

            for (var i = 0; i < addressComponents.length; i++) {
                var component = addressComponents[i];
                if (component.types.includes('locality')) {
                    city = component.long_name;
                } else if (component.types.includes('country')) {
                    country = component.long_name;
                }
            }

            document.getElementById('city').value = city;
            document.getElementById('country').value = country;
        });
    }

    google.maps.event.addDomListener(window, 'load', initializeAutocomplete);

    $(document).ready(function () {
        $('#registrationForm').submit(function () {
         var errors = false;
            var fields = ['first_name', 'last_name', 'email', 'phone_number', 'address', 'pin_code', 'city', 'country', 'password', 'password_confirmation'];

            fields.forEach(function(field) {
                var element = document.getElementById(field);
                if (element.value.trim() === '') {
                    errors = true;
                    console.log("errors");
                    element.classList.add('is-invalid');
                } else {
                    element.classList.remove('is-invalid');
                }
            });

            if (errors) {
                event.preventDefault();
            }
        //    

       

           var password = $('input[name="password"]').val();
           var confirmPassword = $('input[name="password_confirmation"]').val();
            if (password !== confirmPassword) {
                alert('Passwords do not match.');
                return false;
            }
            return true;
        });
    });
</script>

</body>
</html>
