<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use File;
use Validator;
use Illuminate\Http\Request;


class SupplierController extends Controller
{

    public function create(Request $request)
    {

        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|unique:suppliers',
            'phone' => 'required|unique:suppliers',
            'address' => 'required',
            'photo' => 'required',
            'shop_name' => 'required',
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
            $file->move(public_path('supplier'), $filename);

            $supplier = new Supplier();
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->photo = $filename;
            $supplier->shop_name = $request->shop_name;

            if ($supplier->save()) {
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
        $supplier = Supplier::all();

        return response()->json([
            'code' => 1,
            'message' => 'seccess',
            'data' => $supplier,
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

            $supplier =   Supp::find($id);

            $image_path = public_path('supplier/' . $supplier->photo);

            File::delete($image_path);

            $file = $request->file('photo');

            $filename = date('ymdhis') . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('supplier'), $filename);

            $supplier->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'photo' => $filename,
                'shop_name' => $request->shop_name,
            ]);

            if ($supplier) {
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

            $supplier = Supp::find($request->id);

            $image_path = public_path('supplier/' . $supplier->photo);

            if ($supplier) {

                File::delete($image_path);
                if ($supplier->delete()) {
                    return response()->json([
                        'code' => 1,
                        'message' => 'seccess',
                    ]);
                } else {
                    return response()->json([
                        'code' => 2,
                        'message' => "Sorry fails to delete supplier with ID: $request->id",
                    ]);
                }
            } else {
                return response()->json([
                    'code' => 0,
                    'message' => "Sorry we cant find supplier with ID: $request->id",
                ]);
            }
        }
    }
}