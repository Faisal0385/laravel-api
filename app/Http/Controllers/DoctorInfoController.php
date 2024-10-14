<?php

namespace App\Http\Controllers;

use App\Models\DoctorInfo;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DoctorInfoController extends Controller
{
    function register(Request $request)
    {
        $isEmailExist = DoctorInfo::where("email", $request->email)->count();
        if ($isEmailExist) {
            return response()->json([
                'status' => 'warning',
                'message' => 'Email Already Exist',
            ], 200);
        }
        ## getting data from form
        $full_name = $request->full_name;
        $mobile = $request->mobile;
        $email = $request->email;
        $gender = $request->gender;
        $degree = $request->degree;
        $designation = $request->designation;
        $address = $request->address;
        $bod = $request->bod;
        $blood_grp = $request->blood_grp;
        $weight = $request->weight;
        $password = $request->password;

        try {
            DB::table('doctor_infos')->insert([
                'full_name' => $full_name,
                'mobile' => $mobile,
                'email' => $email,
                'gender' => $gender,
                'weight' => $weight,
                'blood_grp' => $blood_grp,
                'degree' => $degree,
                'designation' => $designation,
                'address' => $address,
                'bod' => $bod,
                'password' => $password,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Doctor Info Added Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something Went Wrong'
            ], 200);
        }
    }

    function login(Request $request)
    {
        ## getting data from form
        $email = $request->email;
        $password = $request->password;

        $isCheck = DoctorInfo::where('email', '=', $email)->get();
        if ($isCheck->count() > 0) {
            $data = DoctorInfo::where('email', '=', $email)->get();
            return response()->json([
                'status' => 'success',
                'message' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No user found'
            ], 200);
        }
    }

    function forgotPassword()
    {
        return "doctor forgot pasword";
    }

    function resetPassword()
    {
        return "doctor reset password";
    }

    function verifyCode()
    {
        return "doctor verify code";
    }
}
