<?php

namespace App\Http\Controllers\Api\V1;

use App\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Staff::all();
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

        $v = Validator::make(
            $request->all(),
            [
                'name'  => 'required|max:255',
                'code'  => 'required|unique:staff,code',
                'phone' => 'required|unique:staff,phone'
            ]
        );

        if ($v->fails()) {
            return ($v->errors());
        }

        Staff::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Staff::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $id;
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
        $staffItem = $this->show($id);

        $v = Validator::make(
            $request->all(),
            [
                'name'  => 'required|max:255',
                'code'  => 'required|unique:staff,code',
                'phone' => 'required|unique:staff,phone'
            ]
        );

        if ($v->fails()) {
            return ($v->errors());
        }
        
        $staffItem->name = $request->input('name');
        $staffItem->code = $request->input('code');
        $staffItem->phone = $request->input('phone');
        $staffItem->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Staff::destroy($id);
    }
}
