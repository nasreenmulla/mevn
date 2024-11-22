<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Freelancer's platform control-panel">
    <meta name="keywords" content="Freelancer,clients,work online">
    <meta name="author" content="Ahmed abubaker">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MEVN</title>

    <style>
       form{
           padding-left:20px;
           padding-right:20px;
       }
    </style>

    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />

    <link
      href="https://fonts.googleapis.com/css?family=Titillium+Web:400,600,700"
      rel="stylesheet"
    />

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('LOGO.png') }}">

    <!-- link to Poppins font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!-- links to fontawesome -->
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcomePage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icons/flaticon.css') }}">

    <!-- link to bootstrap files -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-4.3.1-dist/bootstrap-4.3.1-dist/css/bootstrap.min.css') }}">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Latest minified jquery libarary -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<body style="overflow-x: hidden!important;background:#f8f8fb!important;">

   <div class="container d-flex" style="height:95vh">
       <div class="row justify-content-center align-items-center h-100 w-100">
            <div class="col-lg-5 align-self-center">
                <div class="profileCardHeader p-4">
                    <div class="d-flex justify-content-start">
                    <div class="wellcomeMessage">
                        <h5 class="pl-3 text-center high-weight">Welcome Back !</h5>
                        <h5 class="pl-3">Smart Medical System Schedule</h5>
                    </div>
                    </div>
                    <div class="d-flex justify-content-end">
                    <img src="{{ asset('LOGO.png') }}" width="40%" height="60px">
                    </div>
                </div>
                <div class="profileCardBody" style="position:relative;box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1)!important;">
                    <div class="d-fex justify-content-start">
                        <img class="img-circle profileCardImage" style="background:#eff2f7;" src="{{ asset('loginlogo.svg') }}" width="50px" height="50px">
                    </div>
                    <form method="POST" action="{{ route('login') }}">

                        @csrf

                        <div class="form-group">
                                <label class="text-muted" style="text-align:left!important;width:100%;">User Name</label>
                                <input onchange="getLocations(this.value)" type="text" class="text-left form-control @error('username') is-invalid @enderror" placeholder="User Name" name="username" value="{{ old('username') }}" required>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group w-100">
                                <label class="text-muted" style="text-align:left!important;width:100%;">Password</label>
                                <input type="password" class="text-left form-control @error('password') is-invalid @enderror" name="password" placeholder="*******" required>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group w-100">
                                <label class="text-muted" style="text-align:left!important;width:100%;">Location</label>
                                <select class="text-left form-control @error('location') is-invalid @enderror" name="location" id="location" required>
                                </select>

                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="d-flex m-3">

                            <label class="form-check-label ml-4" for="rememberME">
                                Remember me
                            </label>

                            <input type="checkbox" name="rememberME" id="rememberME" >

                        </div>
                        <button class="btn btn-primary w-100 waves-effect high-weight"> 
                            Signin
                        </button>
                    </form>
                    </div>
            </div>
       </div>
   </div>
   <style>
       input{
           box-shadow: none!important;
       }
   </style>
   <script>
        function getLocations(username){ 
            var settings = {
                url: "/locations/"+username,
                method: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                
                
                success: function (response) {
                    let options = '';
                    for(let x of response){
                        options += '<option>'+x.loc_name_e+'</option>';  
                    }  
                    $('#location').html(options);
                }
            }
            alert(JSON.stringify(settings, null, 4));
            $.ajax(settings);
        }
   </script>
</body>
