<?php

namespace App\Http\Controllers;

use App\Models\test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return view('test.index');
    }

    public function getdata()
    {
        if (\request()->ajax()) {
            $test = test::all();
            $myTable =  view('test.table', compact('test'))->render();
            $response = [
                "success" => true,
                "myTable" => $myTable
            ];
            return json_encode($response);

        } else {
            return view('test.index');
        }
    }

    public function create()
    {
        return view('test.index');
    }

    public function store(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $rules = [
                'name' => 'required',
                'email' => 'required',
                'last_name' => 'required',
                'dob' => 'required',
                'address' => 'required',
                'roll_no' => 'required'
            ];
            $validators = \Validator::make($request->all(), $rules);
            if ($validators->passes()) {
                $test = test::find($id);
                $test->name = $request->name;
                $test->email = $request->email;
                $test->dob = $request->dob;
                $test->last_name = $request->last_name;
                $test->address = $request->address;
                $test->roll_no = $request->roll_no;
                $query = $test->save();
                if (!$query) {
                    return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
                } else {
                    return response()->json(['code' => 1, 'msg' => 'New Student has been successfully saved']);
                }
            } else {
                return $validators->errors();
            }
        } else {
            $rules = [
                'name' => 'required',
                'email' => 'required',
                'last_name' => 'required',
                'dob' => 'required',
                'address' => 'required',
                'roll_no' => 'required'
            ];
            $validators = \Validator::make($request->all(), $rules);
            if ($validators->passes()) {
                $test = new test();
                $test->name = $request->name;
                $test->email = $request->email;
                $test->dob = $request->dob;
                $test->last_name = $request->last_name;
                $test->address = $request->address;
                $test->roll_no = $request->roll_no;
                $query = $test->save();
                if (!$query) {
                    return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
                } else {
                    return response()->json(['code' => 1, 'msg' => 'New Student has been successfully saved']);
                }
            } else {
                return $validators->errors();
            }
        }
    }

    public function destroy(Request $request)
    {
        $test = test::where('id', $request->id)->delete();

        return response()->json(['success' => true]);
    }

    public function show(Request $request)
    {
        $where = array('id' => $request->id);
        $test = test::where($where)->first();

        return response()->json($test);
    }
}
