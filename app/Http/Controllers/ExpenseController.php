<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Validator;

class ExpenseController extends Controller
{

    public function create(Request $request)
    {
        $rules = [
            'name' => 'required',
            'details' => 'required',
            'amount' => 'required',
            'date' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'message' => 'fails',
                'errors' => $validator->errors(),
            ]);
        } else {
            $expense = new Expense();

            $expense->name = $request->name;
            $expense->details = $request->details;
            $expense->amount = $request->amount;
            $expense->date = $request->date;

            if ($expense->save()) {
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
        $expense = Expense::all();

        return response()->json([
            'code' => 1,
            'message' => 'success',
            'data' => $expense,
        ]);
    }

    public function update(Request $request, $id)
    {

        $rules = [
            'name' => 'required',
            'details' => 'required',
            'amount' => 'required',
            'date' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'message' => 'fails',
                'errors' => $validator->errors(),
            ]);
        } else {
            $expense = Expense::where('id', $id)->update([
                'name' => $request->name,
            ]);

            if ($expense) {
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

        $expense = Expense::find($id);
        if ($expense) {
            if ($expense->delete()) {
                return response()->json([
                    'code' => 1,
                    'message' => 'seccess',
                ]);
            } else {
                return response()->json([
                    'code' => 2,
                    'message' => "Sorry fails to delete Expense with ID: $id",
                ]);
            }
        } else {
            return response()->json([
                'code' => 0,
                'message' => "Sorry we cant find Expense with ID: $id",
            ]);
        }
    }
}