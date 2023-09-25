<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SMSGlobal\Credentials;
use SMSGlobal\Resource\Otp;
use Config;
use Session;
use Illuminate\Support\Facades\Http;

class otpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function sendOTP(Request $request){
     
        
        $countryCode = "968";
       $userPhone="99521113";
        $api_key=config('smsGlobal.api_key');
        $secter_key=config('smsGlobal.secret_key');
        Credentials::set($api_key,$secter_key);
        $otp=new Otp();
        $phone_number = $countryCode . $userPhone;

        try{
            $responce=$otp->send(
                $phone_number,
                'Dear Customer, Your  OTP / verification code is {*code*} ,Do not share it with anyone',
                'M5azn',
                600,
                4,
              
               
               
            );
           
            Session::put('id',$responce['destination']);
            return redirect('/');
          

        }
        catch (\Exception $e) {
            
            \Log::error($e->getMessage());
			return false;
         
            }
      
      

    }
    public function cancelOTP(){
        $requestId=Session::get('id');
        // dd($requestId);
        $api_key=config('smsGlobal.api_key');
        $secter_key=config('smsGlobal.secret_key');
     
        Credentials::set($api_key,$secter_key);
        $otp=new Otp();
        try{
        $response = $otp->cancelByRequestId($requestId);
           
            
            if($response['status']=='Cancelled'){
                Session::forget('id');
                
                return true;
            }
            else{
                return false;
            }
        }
        catch (\Exception $e){
            \Log::error($e->getMessage());
			return false;
        }
       
      

    }
    public function verifyOTP(Request $request){
        $userCode=$request['otp'];
      
        $requestId=Session::get('id');
        $api_key=config('smsGlobal.api_key');
        $secter_key=config('smsGlobal.secret_key');
     
        Credentials::set($api_key,$secter_key);
        $otp=new Otp();
        
        try{
          
            $response = $otp->verifyByRequestId($requestId, $userCode);
        if($response['status']=='Verified'){
            Session::forget('id');
            
            return true;
        }
        else{
                return false;
            }
            // 
            
        }
        catch (\Exception $e){
            \Log::error($e->getMessage());
			return false;
        }
       
       
       

    }
   }
