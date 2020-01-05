<?php

namespace App;

class Entriesfilter
{
    protected $biulder;
    protected $request;

    public function __construct($biulder, $request)
    {
        $this->biulder = $biulder;
        $this->request = $request;
    }

    /**
     * Применяет все фильтры из request
     *
     * @return void
     */
    public function apply ()
    {
        foreach ($this->filters() as $filter => $value) {
            /*
            если в данном классе есть указанный метод по имени $filter, 
            выполнить его с параметром $value
            */
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }
        return $this->biulder;
    }

    /**
     * Возвращает все параметры фильтров
     *
     * @return void
     */
    public function filters()
    {
        return $this->request->all();
    }

    /**
     * Фильтрация по имени рабочего
     *
     * @param string $value
     * @return void
     */
    public function name ($value)
    {
        $this->biulder->whereHas('staff', function ($query) use ($value) {
            $query->where('name', 'like', "%$value%");
        });
    }
}