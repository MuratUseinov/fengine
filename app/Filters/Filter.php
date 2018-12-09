<?php
/**
 * Created by PhpStorm.
 * User: murat
 * Date: 09.12.18
 * Time: 23:08
 */

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filter
{
    /**
     * @var Request $request
     */
    protected $request;

    protected $builder;

    protected $filters = [];

    /**
     * Filter constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $builder;
    }

    public function getFilters()
    {
        return $this->request->only($this->filters);
    }

}