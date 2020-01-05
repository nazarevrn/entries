<?php

namespace App\Http\Controllers\Api\V1;

use App\Staff;
use App\Entries;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EntriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items =  Entries::all();
        
        foreach ($items as $item) {
            //адскый костыль. пока не нашёл, как включить жадную загрузку
            $result[] = [$item, $item->staff->name];

        }

        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($data)
    {
        //
    }

    /**
     * Используется для генерации информации о посещениях
     *
     * @return void
     */
    public function store()
    {
        $staff = Staff::all();
        //$staffIds = [];
        foreach ($staff as $item) {
            //$item->id - id рабочего
            //запись о входе
            // $data['staff_id'] = $item->id;
            $time = new \DateTime();
            // $data['timestamp'] = $time->format('Y-m-d');
            // $data['pass_direction'] = 0;
            Entries::create([
                'staff_id' => $item->id,
                'timestamp' => $time->format('Y-m-d'),
                'pass_direction' => 0

            ]);
        }

        //foreach ($)
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return Entries::findOrFail($id);
        $a = Entries::findOrFail($id);
        return $a->staff->name;
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
    }

}
