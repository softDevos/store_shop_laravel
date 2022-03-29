<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Models\Brand;

class BrandController extends Controller
{

    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|min:3|max:100'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'message' => 'fails',
                'errors' => $validator->errors(),
            ]);
        } else {
            $brand = new Brand();
            $brand->name = $request->name;

            if ($brand->save()) {
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
        $brand = Brand::with(['products'])->get();

        return response()->json([
            'code' => 1,
            'message' => 'success',
            'data' => $brand,
        ]);
    }


    public function update(Request $request)
    {
        $rules = [
            'id' => 'required',
            'name' => 'required|min:3|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'message' => 'fails',
                'errors' => $validator->errors(),
            ]);
        } else {

            $brand =  Brand::where('id', $request->id)->update([
                'name' => $request->name,
            ]);

            if ($brand) {
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

    public function delete($id)
    {
        $brand = Brand::find($id);
        if ($brand) {
            if ($brand->delete()) {
                return response()->json([
                    'code' => 1,
                    'message' => 'seccess',
                ]);
            } else {
                return response()->json([
                    'code' => 2,
                    'message' => "Sorry fails to delete brand with ID: $id",
                ]);
            }
        } else {
            return response()->json([
                'code' => 0,
                'message' => "Sorry we cant find brand with ID: $id",
            ]);
        }
    }
}