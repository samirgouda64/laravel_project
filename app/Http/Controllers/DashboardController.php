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
		$dep_type = array();
		$result = DB::table('admin.dept_type_master')
			->select('dept_code', 'dept_type')
			->where('company_code','COMP001')
			->get();
		if(COUNT($result) > 0){
			foreach($result AS $row){
				$dep_type[] = $row;
			}
		}
        return view('dashboard/dashboard', compact('dep_type'));
    }

    public function GetDepartmentList(){
        $output = array('aaData' => array(), 'dbStatus' => '');
        $result = DB::table('admin.department_master')
        -> select ('dept_name', 'dept_type','dept_code','id')
        -> where ('status',1)
		->orderBy('dept_name', 'asc')
        -> get();
        $sl_no = 1;
        if(count($result) > 0){
            foreach($result as $row){
                $row->sl_no = $sl_no;
            	$output['aaData'][] = $row;
				$sl_no++;
            }
			$output['dbStatus'] = 'SUCCESS';
        } else {
	        $output['dbStatus'] = 'FAILURE';
	    }
	    return response()->json($output);
    }

    public function InsertDepartment(Request $request)
	{
		$output = ['dbStatus' => '', 'dbMessage' => ''];
		$dept_code = $request->cmbdeptType;
		// Check if department exists
		$exists = DB::table('admin.department_master')
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
				$result = DB::table('admin.department_master')->insert([
					'dept_code'   => $dept_code,
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

	public function UpdateDepartment(Request $request){
		$output = array('dbStatus' => '', 'dbMessage' => '');
		$dept_code = $request->input('hidcodedept');
		$txtdescriptiondept = $request->input('txtdescriptiondept');
		$cmbdeptType = $request->input('cmbdeptType');

		$exists = DB::table('admin.department_master')
		->whereRaw('upper(dept_name) = ?', [strtoupper($request->txtdescriptiondept)])
		->where('status', 1)
		->where('dept_code','!=',$dept_code)
		->select('id');

		$rules = [
			'txtdescriptiondept' => 'required|regex:/^[a-zA-Z0-9\-_ ]*$/|max:50',
			// 'cmbdeptType'        => 'required|regex:/^[a-zA-Z0-9\-_ ]*$/|max:20',
		];

		$messages = [
			'required' => 'The :attribute field is required.',
		];

		$attributes = [
			'txtdescriptiondept' => 'Department Name',
			// 'cmbdeptType'        => 'Department Type',
		];

		$validator = Validator::make($request->all(), $rules, $messages);
		$validator->setAttributeNames($attributes);

		if ($validator->fails()) {
			return response()->json([
				'dbStatus'  => 'NOT_VALID',
				'dbMessage' => $validator->errors(),
			]);
		}else{

			if (($exists->count())>0) {
				return response()->json([
					'dbStatus'  => 'EXIST',
					'dbMessage' => 'Sorry! Department name already exists.',
				]);
			} else {
				// Insert department
				$result = DB::table('admin.department_master')
				->where('dept_code',$dept_code)
				->update([
					'dept_code'   => $dept_code,
					'dept_name'   => $txtdescriptiondept,
					// 'dept_type'   => $cmbdeptType,
					'created_by'  => 'ADMIN',
					'created_on'  => now(),
					'updated_by'  => 'ADMIN',
					'updated_on'  => now(),
					'status'      => 1
				]);
				
				if ($result) {
					$output['dbStatus'] = 'SUCCESS';
					$output['dbMessage'] = 'Data Updated Successfully.';
				} else {
					$output['dbStatus'] = 'FAILURE';
					$output['dbMessage'] = 'Something went wrong while inserting.';
				}
			}
		}
		return response()->json($output);
	}

	public function DeleteDept(Request $request){
		$output = array('dbStatus' => '', 'dbMessage' => '');
		$id = $request -> input('id');
		$result = DB::table('admin.department_master')
		->where('id',$id)
		->delete();
		if($result){
			$output['dbStatus'] = 'SUCCESS';
			$output['dbMessage'] = 'Department Deleted Successfully';
		} else {
			$output['dbStatus'] = 'FAILURE';
			$output['dbMessage'] = 'Something Went Wrong in Delete';
		}
		return response()->json($output);
	}

}
