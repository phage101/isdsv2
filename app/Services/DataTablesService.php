<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class DataTablesService
{
    /**
     * Current query
     */
    protected $query;

    /**
     * Columns to add/edit
     */
    protected $columns = [];

    /**
     * Raw columns (HTML safe)
     */
    protected $rawColumns = [];

    /**
     * Create a new DataTable
     */
    public static function of($query)
    {
        $instance = new static();
        $instance->query = $query;
        return $instance;
    }

    /**
     * Add a column to the DataTable
     */
    public function addColumn($name, $callback)
    {
        $this->columns[$name] = [
            'type' => 'add',
            'callback' => $callback
        ];
        return $this;
    }

    /**
     * Edit an existing column 
     */
    public function editColumn($name, $callback)
    {
        $this->columns[$name] = [
            'type' => 'edit',
            'callback' => $callback
        ];
        return $this;
    }

    /**
     * Mark columns as raw HTML (don't escape)
     */
    public function rawColumns($columns = [])
    {
        $this->rawColumns = array_merge($this->rawColumns, (array) $columns);
        return $this;
    }

    /**
     * Make the response
     */
    public function make($keepOrder = false)
    {
        return $this->render();
    }

    /**
     * Render the data as JSON response
     */
    public function render()
    {
        $results = $this->query->get();
        $data = [];

        foreach ($results as $row) {
            $item = $row->toArray();
            
            // Process edited columns (replace existing)
            foreach ($this->columns as $column => $spec) {
                if ($spec['type'] === 'edit' && isset($item[$column])) {
                    $item[$column] = $spec['callback']($row);
                }
            }
            
            // Process added columns (new columns)
            foreach ($this->columns as $column => $spec) {
                if ($spec['type'] === 'add' && !isset($item[$column])) {
                    $item[$column] = $spec['callback']($row);
                }
            }
            
            $data[] = $item;
        }

        return response()->json([
            'draw' => intval(request()->get('draw', 0)),
            'recordsTotal' => $this->getTotalRecords(),
            'recordsFiltered' => $this->getFilteredRecords(),
            'data' => $data,
        ]);
    }

    /**
     * Get total records (without filters)
     */
    protected function getTotalRecords()
    {
        return $this->query->count();
    }

    /**
     * Get filtered records count
     */
    protected function getFilteredRecords()
    {
        return $this->query->count();
    }
}
