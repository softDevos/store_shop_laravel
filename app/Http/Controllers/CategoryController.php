<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Models\Category;

use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{

    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|min:3|max:20',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'message' => 'fails',
                'errors' => $validator->errors(),
            ]);
        } else {
            $category = new Category();

            $category->name = $request->name;

            if ($category->save()) {
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
        $category = Category::with(['products'])->get();

        return response()->json([
            'code' => 1,
            'message' => 'success',
            'data' => $category,
        ]);
    }

    public function update(Request $request, $id)
    {

        $rules = [
            'name' => 'required|min:3|max:20',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'message' => 'fails',
                'errors' => $validator->errors(),
            ]);
        } else {
            $category = Category::where('id', $id)->update([
                'name' => $request->name,
            ]);

            if ($category) {
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

        $category = Category::find($id);
        if ($category) {
            if ($category->delete()) {
                return response()->json([
                    'code' => 1,
                    'message' => 'seccess',
                ]);
            } else {
                return response()->json([
                    'code' => 2,
                    'message' => "Sorry fails to delete Category with ID: $id",
                ]);
            }
        } else {
            return response()->json([
                'code' => 0,
                'message' => "Sorry we cant find category with ID: $id",
            ]);
        }
    }
}