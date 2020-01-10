<?php

namespace App\Http\Controllers\Api\V1;

use App\Staff;
use App\Entries;
use App\EntriesFilter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;

class EntriesController extends Controller
{
    /**
     * Все записи с учётом фильтров
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //жадная загрузка
        $items = Entries::with('staff');
        //применяем фильтры
        $items = (new EntriesFilter($items, $request))->apply()->get();
        return $items;
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
        foreach ($staff as $item) {
            $time = new \DateTime();
            Entries::create([
                'staff_id' => $item->id,
                'timestamp' => $time->format('Y-m-d H:i:s'),
                'pass_direction' => rand(0, 1)
            ]);
        }

        return 'ok';
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
