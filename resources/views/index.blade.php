<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="utf-8">
    <title>MEVN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .invalid{
            border: 1px solid red!important;
            z-index:1!important;
        }

        th{
            min-width:330px;
            max-width:330px;
        }   

        .hoursTD{
            min-width:85px!important;
            max-width:85px!important;
            z-index:1!important;
        }   

        .columns{
            min-width:330px;
            max-width:330px;
        }   

        thead th{
            position: sticky; top: 0;
            z-index:1!important;
        }
        
        .hoursTD{
            position: sticky; left: -4px!important;background:#fff;
        }
        
        .modal-content{
            width:55vw!important;
            justify-self: center!important;
        }

        .barBox {
            min-height: 10px!important;
            min-width: 10px!important;
            max-width: 10px!important;
            max-height: 10px!important;
        }
        
        .bg-button {
            background-color: #e6ece0!important;
        }
        
        .NEW {
            background-color: #e9e3c3 !important;
        }
        
        .BOOKED {
            background-color: #8c54ac!important;
        }
        
        .REVISIT {
            background-color: #e4f6f5!important;
        }
        
        .WAITING {
            background-color: #f5f4af!important;
        }
        
        .button-color {
            color: #8e9186!important;
        }
        
        .NOSHOW {
            background-color: #fc840c!important;
        }
        
        .CONFIRMED {
            background-color: #0000ff!important;
        }
        
        .VISITCLOSED {
            background-color: #009900!important;
        }
        
        .bordered {
            border: .6px solid #676a60!important;
            padding: 1px;
        }
        
        .bg-nav {
            height: 25px;
            background-color: #dde0d5;
        }
        
        .bg-nav h4 {
            position: relative;
            top: -6px;
        }
        
        .border-top-right-radius {
            border-top-right-radius: 8px!important;
            border-bottom-right-radius: 8px!important;
        }
        
        .border-top-left-radius {
            border-top-left-radius: 8px!important;
            border-bottom-left-radius: 8px!important;
        }
        
        .disabled {
            cursor: no-drop;
        }
        
        .pointer {
            cursor: pointer;
        }
        
        .bg-container {
            background-color: #f7faef!important;
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Latest minified jquery libarary -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>

<body lang="ar">
    @php
       $startHour = 7;
       $endHour   = 12;           
    @endphp
    <!-- Modal -->
    <div class="modal fade" id="appointmentModalLong" tabindex="-1" role="dialog" aria-labelledby="appointmentModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="appointmentModalLongTitle">EVENT2</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="updateForm" action="/appointments">
                        
                        @csrf
                        
                        <div class="form-group mb-2 d-flex">
                            <label for="fileNumber" class="mt-3 pr-1 text-secondary w-25">File Number</label>
                            <input onchange="getPatient(this.value,1)" type="number" id="" name="fileNumber" class="mt-2 form-control w-75" placeholder="File Number" >
                        </div>
                        <div class="form-group mb-2 d-flex">
                            <label class="mt-3 text-secondary w-25">First Name</label>
                            <input type="text" id="firstName" name="firstName" class="mt-2 form-control w-75" placeholder="First Name" >
                        </div>
                        <div class="form-group mb-2 d-flex">
                            <label class="mt-3 text-secondary w-25">Last Name</label>
                            <input type="text" value=" " id="lastName" name="lastName" class="mt-2 form-control w-75" placeholder="Last Name" >
                        </div>
                        <div class="form-group mb-2 d-flex">
                            <label class="mt-3 text-secondary w-25">Phone</label>
                            <input type="number" id="phone" name="phone" class="mt-2 form-control w-75" placeholder="Phone" >
                        </div>
                        <div class="form-group mb-2 d-flex">
                            <label class="mt-3 text-secondary w-25">Notes</label>
                            <textarea type="text" id="notes" name="notes" class="mt-2 form-control w-75" placeholder="Notes" ></textarea>
                        </div>
                        <div class="form-group mb-2 d-flex">
                            <label class="mt-3 text-secondary w-25">Time</label>
                            <div class="d-flex w-75">
                                <input type="date" id="date" name="date" class="mt-2 form-control" >
                                <span class="mr-1 ml-1">Time from</span>
                                <input type="time" id="time" name="time" class="mt-2 form-control" >
                                <span class="mr-1 ml-1">Time to</span>
                                <input type="time" id="timeTo" name="timeTo" class="mt-2 form-control" >
                                <input type="text" id="expectedTime" name="expectedTime" class="mt-2 form-control" hidden>
                            </div>
                        </div>
                        <div class="form-group mb-2 d-flex">
                            <label class="mt-3 text-secondary w-25">Doctor</label>
                            <select class="mt-2 form-control w-75" id="doctor" name="doctor">
                                <option disabled selected value="">SELECT DOCTOR</option>
                                @foreach($doctors as $doctor)
                                     <option>{{ $doctor->doctor }}</option>  
                                @endforeach     
                            </select>
                        </div>
                        <div class="form-group mb-2 d-flex">
                            <label class="mt-3 text-secondary w-25">Status</label>
                            <select class="mt-2 form-control w-75" id="status" name="status">
                                <option>BOOKED</option>    
                                <option>NEW</option>    
                                <option>REVISIT</option>    
                                <option>CONFIRMED</option>    
                                <option value="VISITCLOSED">VISIT CLOSED</option>    
                                <option value="NOSHOW">NO SHOW</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="createSbmtBtn" class="btn btn-light bordered"><i class="fas fa-save text-primary pr-1"></i>Save</button>
                    <button type="button" class="btn btn-light bordered" onclick="reset()"><i class="fas fa-undo text-primary pr-1"></i>reset</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <!-- Button trigger modal -->
    <button hidden id="modalButton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#appointmentModalLong">
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalTitle">EVENT1</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/appointments">
                        
                        @csrf
                        
                        <div class="form-group mb-2 d-flex">
                            <label for="fileNumber" class="mt-3 pr-1 text-secondary w-25">File Number</label>
                            <input type="number" onchange="getPatient(this.value,2)" id="fileNumber2" name="fileNumber2" class="mt-2 form-control w-75" placeholder="File Number" >
                        </div>
                        <div class="form-group mb-2 d-flex">
                            <label class="mt-3 text-secondary w-25">First Name1</label>
                            <input type="text" id="firstName2" name="firstName2" class="mt-2 form-control w-75" placeholder="First Name" >1
                        </div>
                        <div class="form-group mb-2 d-flex">
                            <label class="mt-3 text-secondary w-25">Last Name</label>
                            <input type="text" value=" " id="lastName2" name="lastName2" class="mt-2 form-control w-75" placeholder="Last Name" >
                        </div>
                        <div class="form-group mb-2 d-flex">
                            <label class="mt-3 text-secondary w-25">Phone</label>
                            <input type="number" id="phone2" name="phone2" class="mt-2 form-control w-75" placeholder="Phone" >
                        </div>
                        <div class="form-group mb-2 d-flex">
                            <label class="mt-3 text-secondary w-25">Notes</label>
                            <textarea type="text" id="notes2" name="notes2" class="mt-2 form-control w-75" placeholder="Notes" ></textarea>
                        </div>
                        <div class="form-group mb-2 d-flex">
                            <label class="mt-3 text-secondary w-25">Time</label>
                            <div class="d-flex w-75">
                                <input type="date" id="date2" name="date2" class="mt-2 form-control" >
                                <span class="mr-1 ml-1">Time from</span>
                                <input type="time" id="time2" name="time2" class="mt-2 form-control" >
                                <span class="mr-1 ml-1">Time to</span>
                                <input type="time" id="timeTo2" name="timeTo2" class="mt-2 form-control" >
                                <input type="text" id="expectedTime2" name="expectedTime2" class="mt-2 form-control" hidden>
                            </div>
                        </div>
                        <div class="form-group mb-2 d-flex">
                            <label class="mt-3 text-secondary w-25">Doctor</label>
                            <select class="mt-2 form-control w-75" id="doctor2" name="doctor2">
                                <option disabled selected value="">SELECT DOCTOR</option>
                                @foreach($doctors as $doctor)
                                     <option>{{ $doctor->doctor }}</option>  
                                @endforeach     
                            </select>
                        </div>
                        <div class="form-group mb-2 d-flex">
                            <label class="mt-3 text-secondary w-25">Status</label>
                            <select class="mt-2 form-control w-75" id="status2" name="status2">
                                <option>BOOKED</option>    
                                <option>NEW</option>    
                                <option>REVISIT</option>    
                                <option>CONFIRMED</option>    
                                <option value="VISITCLOSED">VISIT CLOSED</option>    
                                <option value="NOSHOW">NO SHOW</option>    
                            </select>
                        </div>
                        <div class="form-group mb-2 d-flex">
                            <label class="mt-3 text-secondary w-25">Created date and time</label>
                            <input type="text" id="booked" name="booked" class="mt-2 form-control w-75" placeholder="Booked Time" readonly >
                            
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="updateSbmtBtn" class="btn btn-light bordered"><i class="fas fa-save text-primary pr-1"></i>Update</button>
                    <button type="button" class="btn btn-light bordered" onclick="deleteAppointment()"><i class="fa fa-remove text-primary pr-1"></i>Remove</button>
                </div>
                </form>
                
            </div>
        </div>
    </div>
    <!-- Modal -->
    <!-- Button trigger modal -->
    <button hidden id="modalButton2" type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal">
    </button>

    <div class="container-fluid bg-container">
        <div class="row bg-nav d-flex">
            <h4 class="ml-2 w-75">APPOINTMENT SCHEDULER1</h4>
            <div class="d-flex" style="position:absolute;right:20px;">
                <span class="mr-2">Welcome {{$name}}</span>
                <a href="/logout" id="logout">logout</a>
            </div>
        </div>
        <div class="row mt-2" style="overflow-x: hidden!important;">
            <div class="bordered ml-2 d-flex mt-2">
                <div class="d-flex ml-2 col-xs-12">
                    <div class="NEW barBox mt-2"></div>
                    <span>NEW</span>
                </div>
                <div class="d-flex ml-2">
                    <div class="REVISIT barBox mt-2"></div>
                    <span>REVISIT</span>
                </div>
            </div>
            <div class="bordered ml-2 d-flex row mt-2">
                <div class="d-flex  col-xs-6 col-lg-2">
                    <div class="BOOKED barBox mt-2"></div>
                    <span>BOOKED</span>
                </div>
                <div class="d-flex  col-xs-6 col-lg-2">
                    <div class="CONFIRMED barBox mt-2"></div>
                    <span>CONFIRMED</span>
                </div>
                <div class="d-flex  col-xs-6 col-lg-2">
                    <div class="WAITING barBox mt-2"></div>
                    <span>WAITING</span>
                </div>
                <div class="d-flex  col-xs-6 col-lg-3">
                    <div class="VISITCLOSED barBox mt-2"></div>
                    <span>VISIT CLOSED</span>
                </div>
                <div class="d-flex  col-xs-6 col-lg-3">
                    <div class="NOSHOW barBox mt-2"></div>
                    <span value="NOSHOW">NO SHOW</span>
                </div>
            </div>
        </div>
        <div class="row">
        @if(!$isDoctor)
            <div class="col-lg-2 col-xs-12 col-md-4 d-flex row">
                <div class="d-flex mt-3">
                    <span class="pt-3">Depar</span>
                    <select onchange="filterDoctors()" name="department" id="department" class="form-control">
                        <option selected value="ALL">ALL DEPARTMENTS</option>
                         @foreach($departments as $department)
                            @if($department->specialty == '' || $department->specialty == 'Laboratory medicine' )
                                @continue;   
                            @endif
                              <option>{{ $department->specialty }}</option>    
                         @endforeach      
                        </select>
                </div>
            </div>
            <div class="col-lg-2 col-xs-12 col-md-4 d-flex row">
                <div class="d-flex mt-3">
                    <span class="pt-3">VIEW</span>
                    <select onchange="filterDoctors()" name="doctorName" id="doctorName" class="form-control">
                        <option selected value="ALL">ALL DOCTORS</option>
                         @foreach($names as $name)
                         
                              <option>{{ $name->doctor }}</option>    
                         @endforeach 
                        </select>
                </div>
            </div>
        @endif    
            <div class="col-lg-2 col-xs-12 col-md-4 d-flex row">
                <div class="d-flex mt-3">
                    <span class="pt-3">DATE</span>
                    <input name="filterDate" id="filterDate" onchange="filterDoctors()" class="form-control" type="date">
                </div>
            </div>
            <div class="col-lg-2 col-xs-6 col-md-4 d-flex" style="max-width:110px!important;">
                <div onclick="previousMonth()" class="bg-button shadow pointer d-flex ml-2 mt-3 p-2 border-top-left-radius">
                    <i class="button-color fa fa-caret-left pt-2 5" aria-hidden="true"></i>
                    <span class="button-color" style="font-size:18px;">M</span>
                </div>
                <div onclick="previousWeek()" class="bg-button shadow pointer d-flex ml-2 mt-3 p-2 border-top-left-radius">
                    <i class="button-color fa fa-caret-left pt-2 5" aria-hidden="true"></i>
                    <span class="button-color" style="font-size:18px;">W</span>
                </div>
                <div onclick="previousDay()" class="bg-button shadow pointer d-flex ml-2 mt-3 p-2 border-top-left-radius">
                    <i class="button-color fa fa-caret-left pt-2 5" aria-hidden="true"></i>
                    <span class="button-color" style="font-size:18px;">D</span>
                </div>
            </div>
            <div onclick="today()" class="col-lg-2 col-xs-6 col-md-4 d-flex" style="max-width: 80px!important;">
                <div class="NOSHOW shadow pointer d-flex mt-3 p-2 border-top-left-radius border-top-right-radius">
                    <span style="font-size:18px;color:#fff;">TODAY</span>
                </div>
            </div>
            <div class="col-lg-2 col-xs-6 col-md-4 d-flex" style="max-width:110px!important;">
                <div onclick="nextDay()" class="bg-button shadow pointer d-flex ml-2 mt-3 p-2 border-top-right-radius">
                    <span class="button-color" style="font-size:18px;">D</span>
                    <i class="button-color fa fa-caret-right pt-2 5" aria-hidden="true"></i>
                </div>
                <div onclick="nextWeek()" class="bg-button shadow pointer d-flex ml-2 mt-3 p-2 border-top-right-radius">
                    <span class="button-color" style="font-size:18px;">W</span>
                    <i class="button-color fa fa-caret-right pt-2 5" aria-hidden="true"></i>
                </div>
                <div onclick="nextMonth()" class="bg-button shadow pointer d-flex mt-3 p-2 border-top-right-radius">
                    <span class="button-color" style="font-size:18px;">M</span>
                    <i class="button-color fa fa-caret-right pt-2 5" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="row mt-4" style="max-width:100%;overflow-x: scroll!important;padding:0px!important;max-height:75vh;margin: 0px!important;margin-top :30px !important;">
            <table class="table" id="dataTable">
                <thead class="thead-light" style="overflow-x:hidden!important;">
                    <tr>
                        <th class="heigh-weight hoursTD">TIME</th>
                        @foreach($doctors as $doctor)
                            <th class="heigh-weight text-nowrap columns">{{ $doctor->doctor }}</th>
                        @endforeach 
                    </tr>
                </thead>
                <tbody style="overflow-x:scroll!important;">
                @php 
                    $appointments_array = [];
                @endphp

                    @for($startHour;$startHour < $endHour;$startHour++)
                            @for($quarters = 00;$quarters <= 45;$quarters += 15)
                                <tr>
                                    @if($quarters == 0)
                                       <td class="border hoursTD text-nowrap">{{$startHour.":00"}} AM</td>
                                    @else
                                       <td class="border hoursTD text-nowrap">{{$startHour.":".$quarters}} AM</td>
                                    @endif
                                    @foreach($doctors as $doctor)
                                        @if(substr($doctor->shift1_sttime,0,strpos($doctor->shift1_sttime,':')) <= $startHour && substr($doctor->shift1_entime,0,strpos($doctor->shift1_entime,':')) > $startHour && (substr($doctor->shift1_sttime,0,strpos($doctor->shift1_sttime,':')) != $startHour || substr($doctor->shift1_sttime,strpos($doctor->shift1_sttime,':') + 1,strlen($doctor->shift1_sttime)) <= $quarters))
                                            @php
                                                $isSet = false;
                                            @endphp
                                            @foreach($appointments as $appointment)
                                            @if(
                                                    $appointment->doctor_name == $doctor->doctor
                                                    && 
                                                    substr($appointment->time_from,0,strpos($appointment->time_from,':')) <= $startHour
                                                    && 
                                                    (
                                                        (
                                                        substr($appointment->time_to,0,strpos($appointment->time_to,':')) > $startHour 
                                                        ||
                                                        (substr($appointment->time_to,0,strpos($appointment->time_to,':')) == $startHour
                                                        &&
                                                        (
                                                            substr($appointment->time_to,strpos($appointment->time_to,':') + 1,strlen($appointment->time_to)) >= $quarters
                                                        &&
                                                            substr($appointment->time_to,strpos($appointment->time_to,':') + 1,strlen($appointment->time_to)) != 00
                                                        )
                                                        )
                                                    )
                                                    )
                                                    &&
                                                    (
                                                        substr($appointment->time_from,0,strpos($appointment->time_from,':')) != $startHour 
                                                        ||
                                                        substr($appointment->time_from,strpos($appointment->time_from,':') + 1,strlen($appointment->time_from)) <= $quarters
                                                    )
                                                )
                                                   
                                                   @php  
                                                       $dateElements = explode('-',$appointment->schedule_date);
                                                   @endphp 

                                                   @if(($dateElements[0] < $day && $dateElements[1] <= $month) || $dateElements[1] < $month || $dateElements[2] < $year)        

                                                   <td style="position:relative;" class="border columns pl-0 pr-0 pointer text-dark NOSHOW" onclick="showUpdateForm('{{$appointment->patient_first_name}}','{{$appointment->patient_last_name}}','{{$appointment->phone}}','{{$appointment->doctor_name}}','{{$appointment->status}}','{{$appointment->schedule_date}}','{{$appointment->time_from}}','{{$appointment->file_no}}','{{$appointment->appointment_no}}','{{$appointment->time_to}}','{{$doctor->expected_time}}','{{$appointment->notes}}','{{$appointment->created_date}}')">
                                                        @if(!in_array($appointment->appointment_no,$appointments_array))
                                                            <span class="text-nowrap bg-light" style="position:relative;top:-7px;left:0px;display:block!important;min-width:100%!important;">{{ $doctor->doctor .' ('. $appointment->time_from .'/'. $appointment->time_to .') '}}</span>
                                                            <span class="text-nowrap">Patient/ {{$appointment->patient_first_name .' '. $appointment->patient_last_name}}</span>
                                                             @php 
                                                                 $bookElements=$appointment->created_date;
                                                                 $timestamp = strtotime($bookElements);
                                                                 $new_date = date("d-m-Y h:i:s", $timestamp);
                                                                 
                                                            @endphp
                                                            <span class="text-nowrap">created by : {{$appointment->created_by }}-{{$new_date}} </span>
                                                            <p class="text-nowrap">{{ $appointment->notes }}</p>
                                                            @php 
                                                                $appointments_array[count($appointments_array)] = $appointment->appointment_no;       
                                                            @endphp
                                                        @endif           
                                                   </td>

                                                   @else

                                                    <td style="position:relative;" class="border columns pl-0 pr-0 pointer text-dark {{$appointment->status}}" onclick="showUpdateForm('{{$appointment->patient_first_name}}','{{$appointment->patient_last_name}}','{{$appointment->phone}}','{{$appointment->doctor_name}}','{{$appointment->status}}','{{$appointment->schedule_date}}','{{$appointment->time_from}}','{{$appointment->file_no}}','{{$appointment->appointment_no}}','{{$appointment->time_to}}','{{$doctor->expected_time}}','{{$appointment->notes}}','{{$appointment->created_date}}')">
                                                        @if(!in_array($appointment->appointment_no,$appointments_array))
                                                            <span class="text-nowrap bg-light" style="position:relative;top:-7px;left:0px;display:block!important;min-width:100%!important;">{{ $doctor->doctor .' ('. $appointment->time_from .'/'. $appointment->time_to .') '}}</span>
                                                            <span class="text-nowrap">Patient/ {{$appointment->patient_first_name .' '. $appointment->patient_last_name}}</span>
                                                            @php 
                                                                 $bookElements=$appointment->created_date;
                                                                 $timestamp = strtotime($bookElements);
                                                                 $new_date = date("d-m-Y h:i:s", $timestamp);
                                                               
                                                            @endphp
                                                            <p class="text-nowrap">Created by : {{$appointment->created_by }} </p>
                                                            <p class="text-nowrap">Created Date: {{$new_date}} </p>
                                                            <p class="text-nowrap">{{ $appointment->notes }}</p>
                                                            @php 
                                                                $appointments_array[count($appointments_array)] = $appointment->appointment_no;       
                                                            @endphp
                                                        @endif     
                                                    </td>

                                                    @endif
                                                    @php
                                                        $isSet = true;
                                                    @endphp
                                                @endif    
                                            @endforeach
                                            @if($quarters == 0 && !$isSet)
                                                <td class="border columns pointer text-dark" onclick="showCreateForm('{{$doctor->expected_time}}','{{$startHour.':00'}}','{{$doctor->doctor}}')"></td>
                                            @else 
                                              @if(!$isSet) 
                                                <td class="border columns pointer text-dark" onclick="showCreateForm('{{$doctor->expected_time}}','{{$startHour.':'.$quarters}}','{{$doctor->doctor}}')"></td>
                                              @endif
                                            @endif
                                        @else 
                                            <td class="border columns disabled text-light"></td>
                                        @endif
                                    @endforeach
                                </tr>                          
                            @endfor  
                    @endfor 

                    
                    @for($startHour = 12;$startHour < 24;$startHour++)
                            @for($quarters = 00;$quarters <= 45;$quarters += 15)
                                <tr>
                                    @if($quarters == 0)
                                        @if($startHour != 12)
                                        <td class="border text-nowrap hoursTD">{{($startHour - 12 ).":00"}} PM</td>
                                        @else 
                                            <td class="border text-nowrap hoursTD">{{ "12:00"}} PM</td>
                                        @endif
                                    @else
                                        @if($startHour != 12)
                                            <td class="border text-nowrap hoursTD">{{($startHour - 12 ).":".$quarters}} PM</td>
                                        @else 
                                            <td class="border text-nowrap hoursTD">{{ "12:00"}} PM</td>
                                        @endif
                                    @endif
                                    @foreach($doctors as $doctor)
                                        @if(
                                                (
                                                    substr($doctor->shift1_entime,0,strpos($doctor->shift1_entime,':')) > 12 
                                                    &&
                                                    $startHour <= substr($doctor->shift1_entime,0,strpos($doctor->shift1_entime,':'))
                                                    &&
                                                    (
                                                    substr($doctor->shift1_entime,0,strpos($doctor->shift1_entime,':')) != $startHour
                                                    ||       
                                                    substr($doctor->shift1_entime,strpos($doctor->shift1_entime,':') + 1,strlen($doctor->shift1_entime)) >= $quarters
                                                    )
                                                
                                                )
                                                ||
                                                (
                                                    substr($doctor->shift2_sttime,0,strpos($doctor->shift2_sttime,':')) <= $startHour 
                                                    && substr($doctor->shift2_entime,0,strpos($doctor->shift2_entime,':')) > $startHour
                                                    && (substr($doctor->shift2_sttime,0,strpos($doctor->shift2_sttime,':')) != $startHour 
                                                    || substr($doctor->shift2_sttime,strpos($doctor->shift2_sttime,':') + 1,strlen($doctor->shift2_sttime)) <= $quarters)
                                                )
                                            )

                                            @php
                                                $isSet = false;
                                            @endphp
                                            @foreach($appointments as $appointment)
                                            @if(
                                                    $appointment->doctor_name == $doctor->doctor
                                            )
                                        @if(
                                                    substr($appointment->time_from,0,strpos($appointment->time_from,':')) <= $startHour
                                                    && 
                                                    (
                                                        substr($appointment->time_to,0,strpos($appointment->time_to,':')) > $startHour 
                                                        ||
                                                        (substr($appointment->time_to,0,strpos($appointment->time_to,':')) == $startHour
                                                        &&
                                                        (
                                                            substr($appointment->time_to,strpos($appointment->time_to,':') + 1,strlen($appointment->time_to)) >= $quarters
                                                        &&
                                                            substr($appointment->time_to,strpos($appointment->time_to,':') + 1,strlen($appointment->time_to)) != 00
                                                        )
                                                        )
                                                    )
                                                    &&
                                                    (
                                                        substr($appointment->time_from,0,strpos($appointment->time_from,':')) != $startHour 
                                                        ||
                                                        substr($appointment->time_from,strpos($appointment->time_from,':') + 1,strlen($appointment->time_from)) <= $quarters
                                                    )
                                            )

                                                    <td style="position:relative;" class="border columns pl-0 pr-0 pointer text-dark {{$appointment->status}}" onclick="showUpdateForm('{{$appointment->patient_first_name}}','{{$appointment->patient_last_name}}','{{$appointment->phone}}','{{$appointment->doctor_name}}','{{$appointment->status}}','{{$appointment->schedule_date}}','{{$appointment->time_from}}','{{$appointment->file_no}}','{{$appointment->appointment_no}}','{{$appointment->time_to}}','{{$doctor->expected_time}}','{{$appointment->notes}}','{{$appointment->created_date}}')">
                                                        @if(!in_array($appointment->appointment_no,$appointments_array))
                                                            <span class="text-nowrap bg-light" style="position:relative;top:-7px;left:0px;display:block!important;min-width:100%!important;">{{ $doctor->doctor .' ('. $appointment->time_from .'/'. $appointment->time_to .') '}}</span>
                                                            <span class="text-nowrap">Patient/ {{$appointment->patient_first_name .' '. $appointment->patient_last_name}}</span>
                                                            @php 
                                                                 $bookElements=$appointment->created_date;
                                                                 $timestamp = strtotime($bookElements);
                                                                 $new_date = date("d-m-Y h:i:s", $timestamp);
                                                                 
                                                            @endphp
                                                            <p class="text-nowrap">created by : {{$appointment->created_by }}</span>
                                                            <p class="text-nowrap">created Date :{{$new_date}} </p>
                                                            <p class="text-nowrap">{{ $appointment->notes }}</p>
                                                            @php 
                                                                $appointments_array[count($appointments_array)] = $appointment->appointment_no;       
                                                            @endphp
                                                        @endif           
                                                    </td>
                                                    @php
                                                        $isSet = true;
                                                    @endphp
                                                @endif    
                                                @endif    
                                            @endforeach
                                            @if($quarters == 0 && !$isSet)
                                                <td class="border columns pointer text-dark" onclick="showCreateForm('{{$doctor->expected_time}}','{{$startHour.':00'}}','{{$doctor->doctor}}')"></td>
                                            @else 
                                            @if(!$isSet)
                                                <td class="border columns pointer text-dark" onclick="showCreateForm('{{$doctor->expected_time}}','{{$startHour.':'.$quarters}}','{{$doctor->doctor}}')"></td>
                                            @endif
                                            @endif
                                        @else 
                                            <td class="border columns disabled text-light"></td>
                                        @endif
                                    @endforeach
                                </tr>                          
                            @endfor  
                    @endfor 

                    @for($startHour = 00;$startHour <= 5;$startHour++)
                            @for($quarters = 00;$quarters <= 45;$quarters += 15)
                                <tr>
                                    @if($quarters == 0)
                                        @if(($startHour-1) != 0)
                                            <td class="border hoursTD text-nowrap">{{$startHour.":00"}} AM</td>
                                        @else
                                            <td class="border hoursTD text-nowrap">12:00 AM</td>
                                        @endif
                                    @else
                                       @if(($startHour-1) != 0)
                                          <td class="border hoursTD text-nowrap">{{$startHour.":".$quarters}} AM</td>
                                       @else 
                                          <td class="border hoursTD text-nowrap">12{{":".$quarters}} AM</td>
                                       @endif
                                    @endif
                                    @foreach($doctors as $doctor)
                                        @if(
                                            (
                                            substr($doctor->shift3_sttime,0,strpos($doctor->shift3_sttime,':')) <= $startHour || 
                                            (substr($doctor->shift3_sttime,0,strpos($doctor->shift3_sttime,':')) <= 12)
                                            )
                                            && 
                                            (substr($doctor->shift3_entime,0,strpos($doctor->shift3_entime,':')) > $startHour 
                                            || 
                                            (substr($doctor->shift3_entime,0,strpos($doctor->shift3_entime,':')) > 12))
                                            && 
                                            (
                                            (substr($doctor->shift3_sttime,0,strpos($doctor->shift3_sttime,':')) != $startHour 
                                            || 
                                            ((substr($doctor->shift3_sttime,0,strpos($doctor->shift3_sttime,':')) != 12))
                                            || 
                                            substr($doctor->shift3_sttime,strpos($doctor->shift3_sttime,':') + 1,strlen($doctor->shift3_sttime)) <= $quarters)
                                        )
                                        )
                                            @php
                                                $isSet = false;
                                            @endphp
                                            @foreach($appointments as $appointment)
                                            @if(
                                                    $appointment->doctor_name == $doctor->doctor
                                                    && 
                                                    substr($appointment->time_from,0,strpos($appointment->time_from,':')) <= $startHour
                                                    && 
                                                    (
                                                        (
                                                        substr($appointment->time_to,0,strpos($appointment->time_to,':')) > $startHour 
                                                        ||
                                                        (substr($appointment->time_to,0,strpos($appointment->time_to,':')) == $startHour
                                                        &&
                                                        (
                                                            substr($appointment->time_to,strpos($appointment->time_to,':') + 1,strlen($appointment->time_to)) >= $quarters
                                                        &&
                                                            substr($appointment->time_to,strpos($appointment->time_to,':') + 1,strlen($appointment->time_to)) != 00
                                                        )
                                                        )
                                                    )
                                                    )
                                                    &&
                                                    (
                                                        substr($appointment->time_from,0,strpos($appointment->time_from,':')) != $startHour 
                                                        ||
                                                        substr($appointment->time_from,strpos($appointment->time_from,':') + 1,strlen($appointment->time_from)) <= $quarters
                                                    )
                                                )
                                                   
                                                   @php  
                                                       $dateElements = explode('-',$appointment->schedule_date);
                                                   @endphp 

                                                   @if(($dateElements[0] < $day && $dateElements[1] <= $month) || $dateElements[1] < $month || $dateElements[2] < $year)        

                                                   <td style="position:relative;" class="border columns pl-0 pr-0 pointer text-dark NOSHOW" onclick="showUpdateForm('{{$appointment->patient_first_name}}','{{$appointment->patient_last_name}}','{{$appointment->phone}}','{{$appointment->doctor_name}}','{{$appointment->status}}','{{$appointment->schedule_date}}','{{$appointment->time_from}}','{{$appointment->file_no}}','{{$appointment->appointment_no}}','{{$appointment->time_to}}','{{$doctor->expected_time}}','{{$appointment->notes}}','{{$appointment->created_date}}')">
                                                        @if(!in_array($appointment->appointment_no,$appointments_array))
                                                            <span class="text-nowrap bg-light" style="position:relative;top:-7px;left:0px;display:block!important;min-width:100%!important;">{{ $doctor->doctor .' ('. $appointment->time_from .'/'. $appointment->time_to .') '}}</span>
                                                            <span class="text-nowrap">Patient/ {{$appointment->patient_first_name .' '. $appointment->patient_last_name}}</span>
                                                            @php 
                                                                 $bookElements=$appointment->created_date;
                                                                 $timestamp = strtotime($bookElements);
                                                                 $new_date = date("d-m-Y h:i:s", $timestamp);
                                                                 $btime= explode(" ",$bookElements);
                                                            @endphp
                                                            <span class="text-nowrap">created by : {{$appointment->created_by }}-{{$new_date}} </span>
                                                            <p class="text-nowrap">{{ $appointment->notes }}</p>
                                                            @php 
                                                                $appointments_array[count($appointments_array)] = $appointment->appointment_no;       
                                                            @endphp
                                                        @endif           
                                                    </td>

                                                   @else

                                                    <td style="position:relative;" class="border columns pl-0 pr-0 pointer text-dark {{$appointment->status}}" onclick="showUpdateForm('{{$appointment->patient_first_name}}','{{$appointment->patient_last_name}}','{{$appointment->phone}}','{{$appointment->doctor_name}}','{{$appointment->status}}','{{$appointment->schedule_date}}','{{$appointment->time_from}}','{{$appointment->file_no}}','{{$appointment->appointment_no}}','{{$appointment->time_to}}','{{$doctor->expected_time}}','{{$appointment->notes}}','{{$appointment->created_date}}')">
                                                        @if(!in_array($appointment->appointment_no,$appointments_array))
                                                            <span class="text-nowrap bg-light" style="position:relative;top:-7px;left:0px;display:block!important;min-width:100%!important;">{{ $doctor->doctor .' ('. $appointment->time_from .'/'. $appointment->time_to .') '}}</span>
                                                            <span class="text-nowrap">Patient/ {{$appointment->patient_first_name .' '. $appointment->patient_last_name}}</span>
                                                            <p class="text-nowrap">{{ $appointment->notes }}</p>
                                                            @php 
                                                                 $bookElements=$appointment->created_date;
                                                                 $timestamp = strtotime($bookElements);
                                                                 $new_date = date("d-m-Yh:i:s", $timestamp);
                                                                 
                                                            @endphp
                                                            <span class="text-nowrap">created by : {{$appointment->created_by }}</span>
                                                            <p class="text-nowrap">{{$new_date}} </p>
                                                            @php 
                                                                $appointments_array[count($appointments_array)] = $appointment->appointment_no;       
                                                            @endphp
                                                        @endif     
                                                    </td>

                                                    @endif
                                                    @php
                                                        $isSet = true;
                                                    @endphp
                                                @endif    
                                            @endforeach
                                            @if($quarters == 0 && !$isSet)
                                              @if($startHour != 12)
                                                <td class="border columns pointer text-dark" onclick="showCreateForm('{{$doctor->expected_time}}','{{$startHour.':00'}}','{{$doctor->doctor}}')"></td>
                                              @else 
                                                <td class="border columns pointer text-dark" onclick="showCreateForm('{{$doctor->expected_time}}','12:00','{{$doctor->doctor}}')"></td>
                                              @endif 
                                            @else 
                                              @if(!$isSet) 
                                                @if($startHour != 12)
                                                    <td class="border columns pointer text-dark" onclick="showCreateForm('{{$doctor->expected_time}}','{{$startHour.':'.$quarters}}','{{$doctor->doctor}}')"></td>
                                                @else
                                                    <td class="border columns pointer text-dark" onclick="showCreateForm('{{$doctor->expected_time}}','12:{{$quarters}}','{{$doctor->doctor}}')"></td>
                                                @endif
                                              @endif
                                            @endif
                                        @else 
                                            <td class="border columns disabled text-light"></td>
                                        @endif
                                    @endforeach
                                </tr>                          
                            @endfor  
                    @endfor 
                    
                </tbody>
            </table>
        </div>
    </div>
    <script>

        var appointments = {!! json_encode($appointments) !!};
        var appointment ;
        var time, doctor;
        
        function checkAppointment(){

            let atimeFrom = $('#time').val();      
            let atimeTo   = $('#timeTo').val();  

            let timeELements = atimeFrom.split(':');
                
            let tfhours = parseInt(timeELements[0]);
            let tfminutes = parseInt(timeELements[1]);

            timeELements = atimeTo.split(':');
                
            let tthours = parseInt(timeELements[0]);
            let ttminutes = parseInt(timeELements[1]);

            let itsOK = true;

            for(x = 0;x < appointments.length;x++){
                if(appointments[x].doctor_name != doctor){
                    continue;
                }

                timeFrom = appointments[x].time_from;
                timeTo = appointments[x].time_to;

                let timeELements = timeFrom.split(':');
                
                let atfhours = parseInt(timeELements[0]);
                let atfminutes = parseInt(timeELements[1]);

                if(atfhours == tfhours || tfhours > atfhours){
                    if(tfminutes == atfminutes && atfhours == tfhours){
                        $('#time').addClass('invalid');
                        document.getElementById("createSbmtBtn").disabled = true;
                        itsOK = false;
                        break;
                    }      
                }    

                timeELements = timeTo.split(':');
                
                atthours = parseInt(timeELements[0]);
                attminutes = parseInt(timeELements[1]);

                if(tfhours < atfhours){
                    if(tthours > atfhours && tthours <= atthours){
                        $('#timeTo').addClass('invalid');
                        document.getElementById("createSbmtBtn").disabled = true;
                        itsOK = false;
                        break;                        
                    }
                }

                if(atthours == tthours || tthours < atthours){
                    if(tfhours < atfhours && tthours < atthours){
                        $('#timeTo').addClass('invalid');
                        document.getElementById("createSbmtBtn").disabled = true;
                        itsOK = false;
                        break;
                    }
                    if((ttminutes == attminutes || ttminutes < attminutes) && atthours == tthours){
                        $('#timeTo').addClass('invalid');
                        document.getElementById("createSbmtBtn").disabled = true;
                        itsOK = false;
                        break;
                    }      
                }    

            }

            if(itsOK){
                document.getElementById("createSbmtBtn").disabled = false;
                $('#timeTo').removeClass('invalid');
                $('#time').removeClass('invalid');
            }
        }

        function today(){
            var now = new Date();
            var month = (now.getMonth() + 1);               
            var day = now.getDate();
            if (month < 10) 
                month = "0" + month;
            if (day < 10) 
                day = "0" + day;
            var today = now.getFullYear() + '-' + month + '-' + day;
            $('#filterDate').val(today);
            filterDoctors();

        }     

        var dateNow;

        function nextDay(){

            if($('#filterDate').val() == ''){
                var now = new Date();
            }else{
                var now = new Date($('#filterDate').val());
            }


            var now2 = new Date(now.getFullYear(),now.getMonth(),now.getDate() + 1);

            var month = parseInt(now2.getMonth()) + 1;
            var day = now2.getDate();
            if (month < 10) 
                month = "0" + month;
            if (day < 10) 
                day = "0" + day;
            var today2 = now2.getFullYear() + '-' + month + '-' + day;

            $('#filterDate').val(today2);

            filterDoctors();
        }

        function previousDay(){

            if($('#filterDate').val() == ''){
                var now = new Date();
            }else{
                var now = new Date($('#filterDate').val());
            }


            var now2 = new Date(now.getFullYear(),now.getMonth(),now.getDate() - 1);

            var month = parseInt(now2.getMonth()) + 1;
            var day = now2.getDate();
            if (month < 10) 
                month = "0" + month;
            if (day < 10) 
                day = "0" + day;
            var today2 = now2.getFullYear() + '-' + month + '-' + day;

            $('#filterDate').val(today2);
            filterDoctors();

        }

        function nextWeek(){
            
            if($('#filterDate').val() == ''){
                var now = new Date();
            }else{
                var now = new Date($('#filterDate').val());
            }


            var now2 = new Date(now.getFullYear(),now.getMonth(),now.getDate() + 7);

            var month = parseInt(now2.getMonth()) + 1;
            var day = now2.getDate();
            if (month < 10) 
                month = "0" + month;
            if (day < 10) 
                day = "0" + day;
            var today2 = now2.getFullYear() + '-' + month + '-' + day;

            $('#filterDate').val(today2);
            filterDoctors();
            
        }

        function previousWeek(){
            
            if($('#filterDate').val() == ''){
                var now = new Date();
            }else{
                var now = new Date($('#filterDate').val());
            }


            var now2 = new Date(now.getFullYear(),now.getMonth(),now.getDate() - 7);

            var month = parseInt(now2.getMonth()) + 1;
            var day = now2.getDate();
            if (month < 10) 
                month = "0" + month;
            if (day < 10) 
                day = "0" + day;
            var today2 = now2.getFullYear() + '-' + month + '-' + day;

            $('#filterDate').val(today2);
            filterDoctors();

        }

        function nextMonth(){
            
            if($('#filterDate').val() == ''){
                var now = new Date();
            }else{
                var now = new Date($('#filterDate').val());
            }

            var now2 = new Date(now.getFullYear(),now.getMonth() + 1,now.getDate());

            var month = parseInt(now2.getMonth()) + 1;
            var day = now2.getDate();
            if (month < 10) 
                month = "0" + month;
            if (day < 10) 
                day = "0" + day;
            var today2 = now2.getFullYear() + '-' + month + '-' + day;

            $('#filterDate').val(today2);
            filterDoctors();

        }

        function previousMonth(){
            
            if($('#filterDate').val() == ''){
                var now = new Date();
            }else{
                var now = new Date($('#filterDate').val());
            }

            month = month == '01' ? 12 : parseInt(now.getMonth()) - 1;
            var now2 = new Date(now.getFullYear(),month,now.getDate());

            var month = parseInt(now2.getMonth()) + 1;
            var day = now2.getDate();
            if (month < 10) 
                month = "0" + month;
            if (day < 10) 
                day = "0" + day;
            var today2 = now2.getFullYear() + '-' + month + '-' + day;

            $('#filterDate').val(today2);
            filterDoctors();

        }

        function showCreateForm(expectedTime,stateTime, stateDoctor) {
            time = stateTime;
            doctor = stateDoctor;
            let timeELements = time.split(':');
            if(timeELements[0].length == 1){
                time = '0'+time;
            }
            var now = new Date();
            var month = (now.getMonth() + 1);               
            var day = now.getDate();
            if (month < 10) 
                month = "0" + month;
            if (day < 10) 
                day = "0" + day;
            var today = now.getFullYear() + '-' + month + '-' + day;
            let filterDate = $('#filterDate').val();
            if(filterDate == '' || filterDate == null)
            $('#date').val(today);
            else
            $('#date').val(filterDate);
            $('#time').val(time);
            $('#timeTo').val(getTimeTo(time,expectedTime));
            $('#doctor').val(stateDoctor);
            $('#expectedTime').val(expectedTime);
            $('#modalButton').click();
        }

        function getTimeTo(time,expected){
            let timeELements = time.split(':');

            let hours = parseInt(timeELements[0]);
            let minutes = parseInt(timeELements[1]) + parseInt(expected);

          if(minutes > 59){
                let hm = minutes / 60;
                hours += Math.round(hm);   
                minutes = minutes % 60;
          }

          if(minutes < 10){
                minutes = '0'.minutes;   
          }

          if(minutes == 0){
                minutes = '00';   
          }
          
          hours = ''+hours;

          if(''+hours.length == 1){
              hours = '0' + hours;
          }   

          return hours+':'+minutes;

        }

        function showUpdateForm(firstName,lastName,phone,doctor,status,date,time,fileNo,appointmentNo,timeTo,expectedTime,notes,bookedtime){
            $('#expectedTime2').val(expectedTime);
            appointment = appointmentNo;
            let forms = document.getElementsByTagName('form');
            forms[1].action = '/appointments/'+appointmentNo;
            let dateElements = date.split("-");
            let bookedlements = bookedtime.split("-");
            $('#notes2').val(notes);
            $('#fileNumber2').val(fileNo);
            $('#epectedTime2').val(expectedTime);
            $('#timeTo2').val(timeTo);
            $('#firstName2').val(firstName);
            $('#lastName2').val(lastName);
            $('#phone2').val(phone);
            $('#date2').val(dateElements[2]+'-'+dateElements[1]+'-'+dateElements[0]);
            $('#time2').val(time);
            $('#doctor2').val(doctor);
            $('#status2 option:contains('+status+')').prop('selected', true)
            let bookedlements1 = bookedlements[2].split(" ");
            const d = new Date(bookedtime);
            let text = d.toLocaleTimeString();
            $('#booked').val(bookedlements1[0]+'-'+bookedlements[1]+'-'+bookedlements[0]+' '+text);
            $('#modalButton2').click();
        }  

        function reset(){
              $('#firstName').val('');    
              $('#lastName').val('');    
              $('#phone').val('');    
              $('#date').val('');    
              $('#time').val('');    
        }

        function filterDoctors(){
            var data = {'name':$('#doctorName').val(),'department':$('#department').val(),'date':$('#filterDate').val()};
            let filters = '?name='+data.name+'&department='+data.department+"&date="+data.date;
            let origin = window.location.origin;
            let pathName = window.location.pathname;
            let path = origin + '' + pathName + '' + filters;
            window.location.href = path;
        }

        $( document ).ready(function() {
            var urlParams = new URLSearchParams(window.location.search);
            if(urlParams.has('department'))
                $('#department').val(urlParams.get('department'));
            if(urlParams.has('name'))
                $('#doctorName').val(urlParams.get('name'));
            if(urlParams.has('date'))
                $('#filterDate').val(urlParams.get('date'));    
        });

        function deleteAppointment(){
            var settings = {
                url: "/appointments/delete/"+appointment,
                method: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    window.location.href = window.location.href;
                }
            }
            $.ajax(settings);
        } 
        function getPatient(fileNo,state){
            var settings = {
                url: "/patients/"+fileNo,
                method: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                   if(response != 0){ 
                        let name = response[0].pat_name.split(' ');
                        console.log(response[0].notes);
                        if(state == 1){
                            $('#firstName').val(name[0]);
                            $('#lastName').val(name[name.length - 1]);
                            $('#phone').val(response[0].mobile);
                        }else{
                            $('#firstName2').val(name[0]);
                            $('#lastName2').val(name[name.length - 1]);
                            $('#phone2').val(response[0].mobile);
                        }
                   }
                }
            }
           // alert(JSON.stringify(settings, null, 4));
            $.ajax(settings);
        }
        function getPatient2(fileNo){
            var settings = {
                url: "/patients/"+fileNo,
                method: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                   if(response != 0){ 
                        let name = response[0].pat_name.split(' ');
                        $('#firstName2').val(name[0]);
                        $('#lastName2').val(name[name.length - 1]);
                        $('#phone2').val(response[0].mobile);
                   }
                }
            }
            $.ajax(settings);
        }
    </script>
</body>

</html>