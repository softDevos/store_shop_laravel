<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Validator;


class EmployeeController extends Controller
{

    public function create(Request $request)
    {

        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|unique:customers',
            'phone' => 'required|unique:customers',
            'salary' => 'required',
            'photo' => 'required',
            'nid' => 'required',
            'joinging_date' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'message' => 'fails',
                'errors' => $validator->errors(),
            ]);
        } else {

            $file = $request->file('photo');
            $filename = date('ymdhis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('employee'), $filename);

            $employee = new Employee();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->salary = $request->salary;
            $employee->photo = $filename;
            $employee->nid = $request->nid;
            $employee->joinging_date = $request->joinging_date;

            if ($employee->save()) {
                return response()->json([
                    'code' => 1,
                    'message' => 'seccess',
                ]);
            } else {
                return response()->json([
                    'code' => 2,
                    'message' => 'fails',
                ]);
            }
        }
    }

    public function read()
    {
        $employee = Employee::all();

        return response()->json([
            'code' => 1,
            'message' => 'seccess',
            'data' => $employee,
        ]);
    }

    public function update(Request $request, $id)
    {

        $rules = [
            'name' => 'required|max:255',
            'email' => 'required',
            'phone' => 'required',
            'salary' => 'required',
            'nid' => 'required',
            'joinging_date' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'message' => 'fails',
                'errors' => $validator->errors(),
            ]);
        } else {

            $employee =   Employee::find($id);

            $image_path = public_path('employee/' . $employee->photo);

            File::delete($image_path);

            $file = $request->file('photo');

            $filename = date('ymdhis') . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('employee'), $filename);

            $employee->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'salary' => $request->salary,
                'photo' => $filename,
                'nid' => $request->nid,
                'joinging_date' => $request->joinging_date,
            ]);

            if ($employee) {
                return response()->json([
                    'code' => 1,
                    'message' => 'seccess',
                ]);
            } else {
                return response()->json([
                    'code' => 2,
                    'message' => 'fails',
                ]);
            }
        }
    }

    public function delete(Request $request)
    {

        $rules = [
            'id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'message' => 'fails',
                'errors' => $validator->errors(),
            ]);
        } else {

            $employee = Employee::find($request->id);

            $image_path = public_path('employee/' . $employee->photo);

            if ($employee) {

                File::delete($image_path);
                if ($employee->delete()) {
                    return response()->json([
                        'code' => 1,
                        'message' => 'seccess',
                    ]);
                } else {
                    return response()->json([
                        'code' => 2,
                        'message' => "Sorry fails to delete employee with ID: $request->id",
                    ]);
                }
            } else {
                return response()->json([
                    'code' => 0,
                    'message' => "Sorry we cant find employee with ID: $request->id",
                ]);
            }
        }
    }
}