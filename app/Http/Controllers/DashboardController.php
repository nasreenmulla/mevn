<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\MEVN_DOCTOR;
use App\Models\MEVN_PATIENT;
use App\Models\MEVN_USERS;
use Illuminate\Support\Facades\DB;
use Session;
use Date;

class DashboardController extends Controller
{

    public function index(){
        $check = DB::table('SMART.CLNC_LOGIN_SESSION_MEVN')->where('HASH',Session::get('authenticated'))->select('*')->first();  
        $location = $check->loc_name_e;
        $name = $check->username;
          
        $user = MEVN_USERS::whereUsername($check->username)->orWhere('full_name',$check->username)
        ->first();

        $isDoctor = false;
 
        if($user->type == 'DOCTOR'){
            $isDoctor = true;
        }

        if(!$isDoctor){
            $doctors = DB::table('SMART.MEVN_DOCTORS')->where(function($query) use($location){
                $name = request()->get('name','');
                $department = request()->get('department','');
                if($department != '' && $department != 'ALL' && $department != "null" && $department != "null"){
                    $query->where('SPECIALTY',$department);       
                }            
                if($name != '' && $name != 'ALL' && $name != "null"){
                    $query->where('doctor',$name);       
                }       
                $query->where('ACTIVE','Y');  
                $query->where('loc_name_e',$location);  
            })->get();
        }else{
            $doctors = DB::table('SMART.MEVN_DOCTORS')->where(function($query) use($location,$check){
                $name = $check->username;
                $query->where('doctor',$name);       
                $query->where('ACTIVE','Y');  
                $query->where('loc_name_e',$location);  
            })->get();
        }

       $departments = DB::table('SMART.MEVN_DOCTORS')->where('loc_name_e',$location)->select('SPECIALTY')->distinct()->get();

       if(!$isDoctor){
            $appointments = DB::table('SMART.CLNC_APPOINTMENT_MEVN')->where(function($query) use($location){
                    $date = request()->get('date','');

                    if($date != ''){   
                        $dateElements = explode('-',$date);
                        $date = $dateElements[2].'-'.$dateElements[1].'-'.$dateElements[0];          
                        $query->where('schedule_date',$date);            
                    }else{
                        $query->where('schedule_date',date('d-m-Y'));            
                    }
                    
                    $query->where('location_name_e',$location);
            })->get();
       }else{
            $appointments = DB::table('SMART.CLNC_APPOINTMENT_MEVN')->where(function($query) use($location,$check){
                $date = request()->get('date','');

                if($date != ''){   
                    $dateElements = explode('-',$date);
                    $date = $dateElements[2].'-'.$dateElements[1].'-'.$dateElements[0];          
                    $query->where('schedule_date',$date);            
                }else{
                    $query->where('schedule_date',date('d-m-Y'));            
                }

                $query->where('location_name_e',$location);

                $query->where('DOCTOR_NAME',$check->username);

            })->get();
       }

       if(!$isDoctor){
            $names = DB::table('SMART.MEVN_DOCTORS')->where(
                function($query) use($location){
                   $department = request()->get('department','');
                    if($department != '' && $department != 'ALL' && $department != "null"){
                        $query->where('SPECIALTY',$department);       
                    }                 
                    $query->where('ACTIVE','Y'); 
                    $query->where('loc_name_e',$location);   
                }
            )->select('doctor')->distinct()->get();
        }else{
            $names = DB::table('SMART.MEVN_DOCTORS')->where(
                function($query) use($location,$check){

                    $query->where('doctorqq',$check->username);

                    $query->where('ACTIVE','Y'); 
                    
                    $query->where('loc_name_e',$location);   

                }
            )->select('doctor')->distinct()->get();
        }   

       $date = date('Y/m/d');
       $dateElements = explode('/',$date);
       $year = $dateElements[0];         
       $month = $dateElements[1];         
       $day = $dateElements[2];  
// dd($appointments);
       return view('index',compact('doctors','departments','names','appointments','name','year','month','day','isDoctor')); 
    }

    public function store(Request $request){
        $check = DB::table('SMART.CLNC_LOGIN_SESSION_MEVN')->where('HASH',Session::get('authenticated'))->select('*')->first();  
        $name = $check->username;

        $user = MEVN_USERS::whereUsername($name)->orWhere('full_name',$name)
        ->first();

        $isDoctor = false;
 
        if($user->type == 'DOCTOR'){
            $isDoctor = true;
        }

        $request->session()->forget('appointmentAdded');
        $request->session()->forget('appointmentNotAdded');

        $data = request()->all();

        $check = DB::table('SMART.CLNC_LOGIN_SESSION_MEVN')->where('HASH',Session::get('authenticated'))->select('*')->first();  
        $location = $check->loc_name_e;

        if($data['timeTo'] == ''){
            $timeTo = $this->timeTo($data['time'],$data['expectedTime']);
        }else{
            $timeTo = $data['timeTo'];
        }
        
        $max = DB::table('SMART.CLNC_APPOINTMENT_MEVN')->max('APPOINTMENT_NO');
        $appointmentNo = $max + 1;
        $date = date_create($data['date']);
        $date = date_format($date,'d-m-Y');
        $docName = $data['doctor'];      
        if($isDoctor){
           $docName = $check->username;      
        }
        $appointment = DB::table('SMART.CLNC_APPOINTMENT_MEVN')->insert([
            'APPOINTMENT_NO' => $appointmentNo,
            'FILE_NO' => $data['fileNumber'],
            'PATIENT_FIRST_NAME' => $data['firstName'], 
            'PATIENT_LAST_NAME' => $data['lastName'], 
            'phone' => $data['phone'],
            'SCHEDULE_DATE' =>  $date,
            'location_name_e' =>  $location,
            'DOCTOR_NAME' =>  $docName,
            'notes' =>  $data['notes'],
            'STATUS' =>  $data['status'],
            'created_by' =>  $name,
            'TIME_FROM' =>  $data['time'],
            'TIME_TO' =>  $timeTo,
        ]);

        if($appointment != null){ echo $appointment;
            session(['appointmentAdded' => $appointment]);
            return redirect()->back();
        }

        session(['appointmentNotAdded' => false]);

    }

    public function timeTo($timeFrom,$doctorTime){
          if($doctorTime == ''){
             return $timeFrom; 
          }
          $timeFrom = explode(":",$timeFrom);
          $hours = $timeFrom[0];
          $minutes = $timeFrom[1] + $doctorTime;

          if($minutes > 59){
                $hm = $minutes / 60;
                $hours += round($hm);   
                $minutes = $minutes % 60;
          }

          if($minutes < 10){
                $minutes = '0'.$minutes;   
          }

          if($minutes == 0){
                $minutes = '00';   
          }
 
          return $hours.':'.$minutes;
    }

    function destroy($appointment){
        $appointment = DB::table('SMART.CLNC_APPOINTMENT_MEVN')->where('appointment_no',$appointment)->delete();
        return redirect()->back();
    }

    function update($appointment){
        $check = DB::table('SMART.CLNC_LOGIN_SESSION_MEVN')->where('HASH',Session::get('authenticated'))->select('*')->first();  
        $name = $check->username;

        $user = MEVN_USERS::whereUsername($name)->orWhere('full_name',$name)
        ->first();

        $isDoctor = false;
 
        if($user->type == 'DOCTOR'){
            $isDoctor = true;
        }

        $data = request()->all();
 
        if($data['timeTo2'] == ''){
           $timeTo = $this->timeTo($data['time2'],$data['expectedTime2']);
        }else{
            $timeTo = $data['timeTo2'];
        }

        $date = date_create($data['date2']);
        $date = date_format($date,'d-m-Y');
        $docName = $data['doctor2'];      
        if($isDoctor){
           $docName = $check->username;      
        }
        $appointment = DB::table('SMART.CLNC_APPOINTMENT_MEVN')->where('appointment_no',$appointment)->update(
            [
                'FILE_NO' => $data['fileNumber2'],
                'PATIENT_FIRST_NAME' => $data['firstName2'], 
                'PATIENT_LAST_NAME' => $data['lastName2'], 
                'phone' => $data['phone2'],
                'SCHEDULE_DATE' =>  $date,
                'DOCTOR_NAME' =>  $docName,
                'notes' =>  $data['notes2'],
                'STATUS' =>  $data['status2'],
                'TIME_FROM' =>  $data['time2'],
                'TIME_TO' =>  $timeTo,
            ]
        );

        return redirect()->back();
    }

    function getPatient($file){
       $patient = DB::table('SMART.MEVN_PATIENTS')->where('FILE_NO',$file)->select('*')->get();
       
       if($patient != null){
          return $patient;           
       }

       return 0;
    }

    function getLocations($username){
        $locations = MEVN_USERS::whereUsername($username)->select('loc_name_e')->get();
        return $locations;
    }

}