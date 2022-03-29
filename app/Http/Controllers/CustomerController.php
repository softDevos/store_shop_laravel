<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use File;
use Validator;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function create(Request $request)
    {

        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|unique:customers',
            'phone' => 'required|unique:customers',
            'address' => 'required',
            'photo' => 'required',
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
            $file->move(public_path('customer'), $filename);

            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->photo = $filename;

            if ($customer->save()) {
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
        $customer = Customer::all();

        return response()->json([
            'code' => 1,
            'message' => 'seccess',
            'data' => $customer,
        ]);
    }

    public function update(Request $request, $id)
    {

        $rules = [
            'name' => 'required|max:255',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'message' => 'fails',
                'errors' => $validator->errors(),
            ]);
        } else {

            $customer =   Customer::find($id);

            $image_path = public_path('customer/' . $customer->photo);

            File::delete($image_path);

            $file = $request->file('photo');

            $filename = date('ymdhis') . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('customer'), $filename);

            $customer->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'photo' => $filename,
            ]);

            if ($customer) {
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

            $customer = Customer::find($request->id);

            $image_path = public_path('customer/' . $customer->photo);

            if ($customer) {

                File::delete($image_path);
                if ($customer->delete()) {
                    return response()->json([
                        'code' => 1,
                        'message' => 'seccess',
                    ]);
                } else {
                    return response()->json([
                        'code' => 2,
                        'message' => "Sorry fails to delete customer with ID: $request->id",
                    ]);
                }
            } else {
                return response()->json([
                    'code' => 0,
                    'message' => "Sorry we cant find customer with ID: $request->id",
                ]);
            }
        }
    }
}