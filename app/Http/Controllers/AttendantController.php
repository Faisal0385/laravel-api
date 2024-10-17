<?php

namespace App\Http\Controllers;

use App\Models\AttendantInfo;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendantController extends Controller
{
    public function register(Request $request)
    {
        $isEmailExist = AttendantInfo::where("email", $request->email)->count();
        if ($isEmailExist) {
            return response()->json([
                'status' => 'warning',
                'message' => 'Email Already Exist',
            ], 200);
        }

        ## getting data from form
        $doctor_id = $request->doctor_id;
        $venue_id = $request->venue_id;
        $full_name = $request->full_name;
        $hotline = $request->hotline;
        $address = $request->address;
        $gender = $request->gender;
        $bod = $request->bod;
        $blood_grp = $request->blood_grp;
        $joining_date = $request->joining_date;
        $email = $request->email;
        $password = $request->password;

        // try {
            DB::table('attendant_infos')->insert([
                'doctor_id' => $doctor_id,
                'venue_id' => $venue_id,
                'full_name' => $full_name,
                'hotline' => $hotline,
                'address' => $address,
                'gender' => $gender,
                'bod' => $bod,
                'blood_grp' => $blood_grp,
                'joining_date' => $joining_date,
                'email' => $email,
                'password' => $password,
                'created_at' => Carbon::now(),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Doctor Info Added Successfully',
            ], 200);
        // } catch (Exception $e) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Something Went Wrong',
        //         // 'error' => $e->getMessage(),
        //     ], 200);
        // }
    }

    public function login(Request $request)
    {
        ## getting data from form
        $email = $request->email;
        $password = $request->password;

        $isCheck = AttendantInfo::where('email', '=', $email)->get();

        if (count($isCheck) > 0) {
            if ($isCheck[0]->password === $password) {
                $data = $isCheck;
                return response()->json([
                    'status' => 'success',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized'
                ], 200);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No user found'
            ], 200);
        }
    }
}
