<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class DashboardController extends Controller
{
    public function dashboard(){
        return view('dashboard/dashboard');
    }

    public function GetDepartmentList(){
        $output = array('aaData' => array(), 'dbStatus' => '');
        $result = DB::table('admin.department')
        -> select ('dept_name', 'dept_type')
        -> where ('status',1)
        -> get();
        $sl_no = 1;
        if(count($result) > 0){
            foreach($result as $row){
                $row->sl_no = $sl_no;
	            $output['aaData'][] = $row;
	            $output['dbStatus'] = 'SUCCESS';
	            $sl_no ++;
            }
        } else {
	        $output['dbStatus'] = 'FAILURE';
	    }
	    return response()->json($output);
    }

    public function InsertDepartment(Request $request)
	{
		$output = ['dbStatus' => '', 'dbMessage' => ''];
		// Check if department exists
		$exists = DB::table('admin.department')
		->whereRaw('upper(dept_name) = ?', [strtoupper($request->txtdescriptiondept)])
		->where('status', 1)
		->count();

		// Validation rules
		$rules = [
			'txtdescriptiondept' => 'required|regex:/^[a-zA-Z0-9\-_ ]*$/|max:50',
			'cmbdeptType'        => 'required|regex:/^[a-zA-Z0-9\-_ ]*$/|max:20',
		];

		$messages = [
			'required' => 'The :attribute field is required.',
		];

		$attributes = [
			'txtdescriptiondept' => 'Department Name',
			'cmbdeptType'        => 'Department Type',
		];

		$validator = Validator::make($request->all(), $rules, $messages);
		$validator->setAttributeNames($attributes);

		if ($validator->fails()) {
			return response()->json([
				'dbStatus'  => 'NOT_VALID',
				'dbMessage' => $validator->errors(),
			]);
		}else{

			if ($exists > 0) {
				return response()->json([
					'dbStatus'  => 'EXIST',
					'dbMessage' => 'Sorry! Department name already exists.',
				]);
			} else {
				// Insert department
				$result = DB::table('admin.department')->insert([
					'dept_name'   => $request->txtdescriptiondept,
					'dept_type'   => $request->cmbdeptType,
					'created_by'  => 'ADMIN',
					'created_on'  => now(),
					'updated_by'  => 'ADMIN',
					'updated_on'  => now(),
					'status'      => 1
				]);
				
				if ($result) {
					$output['dbStatus'] = 'SUCCESS';
					$output['dbMessage'] = 'Data Inserted Successfully.';
				} else {
					$output['dbStatus'] = 'FAILURE';
					$output['dbMessage'] = 'Something went wrong while inserting.';
				}
			}
		}

		return response()->json($output);
	}

}
