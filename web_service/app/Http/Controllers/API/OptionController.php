<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Options = Option::all();
        return $this->output(200, 'retrieved successfully', $Options);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make(
            $request->all(),
            [
                'name'     => 'required',
                'description' => 'required',
            ],
            [
                'name.required' => 'name field is required',
                'description.required' => 'description field is required',
            ]
        );

        if ($validator->fails()) {
            return $this->output(422, 'please insert the empty column');
        } else {
            $Options = Option::create([
                'name'     => $request->input('name'),
                'description' => $request->input('description'),
            ]);
            if ($Options) {
                return $this->output(201, 'created successfully', $Options);
            } else {
                return $this->output(401, 'not created');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $Options = Option::whereId($id)->first();
        if ($Options) {
            return $this->output(200, 'retrieved successfully', $Options);
        } else {
            return $this->output(404, 'not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make(
            $request->all(),
            [
                'name'     => 'required',
                'description' => 'required',
            ],
            [
                'name.required' => 'name field is required',
                'description.required' => 'description field is required',
            ]
        );

        if ($validator->fails()) {
            return $this->output(422, 'please insert the empty column');
        } else {
            $Options = Option::find($id);
            $Options->name = $request->input('name');
            $Options->description = $request->input('description');
            $Options->update();
            
            if ($Options) {
                return $this->output(200, 'updated successfully', $Options);
            } else {
                return $this->output(401, 'not updated');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $Options = Option::findOrFail($id);
        $Options->delete();

        if ($Options) {
            return $this->output(200, 'deleted successfully', $Options);
        } else {
            return $this->output(404, 'not deleted');
        }
    }

    public function output($code, $message, $data = null)
    {
        $name = 'Option';
        if ($code == 200 || $code == 201) {
            $result = [
                'code' => $code,
                'status' => 'success',
                'message' => $name . " " . $message,
                'data' => $data,
            ];
        } else if ($code == 401 || $code == 404) {
            $result = [
                'code' => $code,
                'status' => 'fail',
                'message' => $name . " " . $message,
            ];
        } else if ($code == 422) {
            $result = [
                'code' => $code,
                'status' => 'error',
                'message' => $message,
            ];
        }

        return response($result);
    }
}
