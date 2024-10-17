<?php

namespace App\Http\Controllers;

use App\Models\AttendantInfo;
use App\Models\BookingAppointment;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingAppointmentController extends Controller
{
    public function bookingAppointment(Request $request)
    {
        date_default_timezone_set("Asia/Dhaka");
        $contact_date = date("d-m-Y");

        ## getting data from form
        $date = $contact_date;
        $asst_id = $request->asst_id;
        $full_name = $request->full_name;
        $serial_no = $request->serial_no;
        $gender = $request->gender;
        $blood_grp = $request->blood_grp;
        $mobile = $request->mobile;
        $weight = $request->weight;
        $age_day = $request->age_day;
        $age_month = $request->age_month;
        $age_year = $request->age_year;

        try {
            $lastID = BookingAppointment::latest()->first();
            $id_no = ((int) $lastID?->id) + 1;

            DB::table('booking_appointments')->insert([
                'doctor_id' => "1",
                'venue_id' => "2",
                'asst_id' => $asst_id,
                'patient_id' => "PID" . date("dm") . "-" . $id_no,
                'visit_id' => "VID" . date("dm") . "-" . $id_no,
                'serial_no' => $serial_no,
                'full_name' => $full_name,
                'mobile' => $mobile,
                'gender' => $gender,
                'weight' => $weight,
                'blood_grp' => $blood_grp,
                'age_day' => $age_day,
                'age_month' => $age_month,
                'age_year' => $age_year,
                'date' => $date,
                'time' => date("h:i:sa"),
                'date_day' => date("d"),
                'date_month' => date("m"),
                'date_year' => date("Y"),
                'created_at' => Carbon::now(),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Patient Info Added Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something Went Wrong'
                // 'message' => $e->getMessage()
            ], 200);
        }
    }

    public function bookingPayment(Request $request)
    {
        $dataCheck = BookingAppointment::find($request->booking_id);
        if (empty($dataCheck)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No Data Found',
            ], 200);
        }

        if ($dataCheck->payment_status == 'paid') {
            return response()->json([
                'status' => 'error',
                'message' => 'Already Paid!!'
            ]);
        }

        try {
            $dataCheck->update([
                'payment_amount' => $request->payment_amount,
                'payment_status' => 'paid',
                'payment_time' => date("h:i:sa"),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Payment Successful',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something Went Wrong'
                // 'message' => $e->getMessage()
            ], 200);
        }
    }

    public function duePatientList($asst_id): JsonResponse
    {
        $isEmailExist = AttendantInfo::find(id: $asst_id);

        if (!$isEmailExist) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized'
            ], 200);
        }

        date_default_timezone_set("Asia/Dhaka");
        $today_date = date("d-m-Y");

        try {
            $dataList = BookingAppointment::where('asst_id', '=', $asst_id)->where('date', '=', $today_date)->where('payment_status', '=', 'due')->get();
            return response()->json([
                'status' => 'success',
                'data' => $dataList,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something Went Wrong'
                // 'message' => $e->getMessage()
            ], 200);
        }
    }

    public function paidPatientList($asst_id): JsonResponse
    {
        $isEmailExist = AttendantInfo::find(id: $asst_id);

        if (!$isEmailExist) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized'
            ], 200);
        }

        date_default_timezone_set("Asia/Dhaka");
        $today_date = date("d-m-Y");

        try {
            $dataList = BookingAppointment::where('asst_id', '=', $asst_id)->where('date', '=', $today_date)->where('payment_status', '=', 'paid')->get();
            $total = $dataList->where('payment_status', 'paid')->sum('payment_amount');
            return response()->json([
                'status' => 'success',
                "total" => $total,
                'data' => $dataList,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something Went Wrong'
                // 'message' => $e->getMessage()
            ], 200);
        }
    }
}
