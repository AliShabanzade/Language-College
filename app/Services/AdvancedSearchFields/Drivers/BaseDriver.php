<?php

namespace App\Services\AdvancedSearchFields\Drivers;

use Illuminate\Database\Eloquent\Builder;

abstract class BaseDriver
{
    protected array  $fillable_columns = [];
    protected string $table            = "";

    abstract public function handle(Builder $query, array $values): Builder;

    public function filter(Builder $query, array $values): Builder
    {
        $this->table = $query->getModel()->getTable() . '.';
        $this->fillable_columns = array_merge($query->getModel()->getFillable(), ["id", "created_at"]);
        foreach ($values as $item) {
            if (!in_array($item['column'], $this->fillable_columns, true)) {
                continue;
            }
            $this->addQuery($query, $item, $this->table);
        }
        return $query;
    }


    /**
     * @param Builder                                                                 $query
     * @param array{contain:bool,column:string,operator:string,from:string,to:string} $item $item
     * @param                                                                         $table
     * @return void
     */
    public function addQuery(Builder $query, array $item, $table = null): void
    {
        if (!isset($item['contain']) || is_null($item['from']) || empty($item['operator'])==='' || empty($item['column'])) {
            return;
        }
        if ($item['contain']) {
            if ($item['operator'] === 'between') {
                $query->whereBetween($table . $item['column'], [$item['from'], $item['to']]);
            } elseif ($item['operator'] === 'like') {
                $query->where($table . $item['column'], $item['operator'], "%" . $item['from'] . "%");
            } elseif ($item['operator'] === 'in') {
                $query->whereIn($table . $item['column'], $item['from']);
            } elseif ($item['operator'] === 'from_date') {
                $query->whereDate($table . $item['column'], '>=',$item['from']);
            } elseif ($item['operator'] === 'to_date') {
                $query->whereDate($table . $item['column'], '<=',$item['from']);
            } elseif ($item['operator'] === 'exact_date') {
                $query->whereDate($table . $item['column'], '=', $item['from']);
            } else {
                $query->where($table . $item['column'], $item['operator'], $item['from']);
            }
        } else {
            if ($item['operator'] === 'between') {
                $query->whereNotBetween($table . $item['column'], [$item['from'], $item['to']]);
            } elseif ($item['operator'] === 'like') {
                $query->whereNot($table . $item['column'], $item['operator'], "%" . $item['from'] . "%");
            } elseif ($item['operator'] === 'from_date') {
                $query->whereDate($table . $item['column'], $item['from']);
            } elseif ($item['operator'] === 'to_date') {
                $query->whereDate($table . $item['column'], $item['from']);
            } elseif ($item['operator'] === 'exact_date') {
                $query->whereDate($table . $item['column'], $item['from']);
            } else {
                $query->whereNot($table . $item['column'], $item['operator'], $item['from']);
            }
        }
    }

    public function completeQueryWithOperation(array$filter = []): string|null
    {
        if (!isset($filter['contain']) || empty($filter['from']) || empty($filter['operator']) || empty($filter['column'])) {
            return null;
        }
        switch ($filter['operator']) {
            case 'between':
                if (isset($filter['from']) && isset($filter['to'])) {
                    if($filter['contain'] === '1'){
                        $query = " between '" . $filter['from'] . "' and '" . $filter['to'] . "'";
                    }
                    else{
                        $query = " not between '" . $filter['from'] . "' and '" . $filter['to'] . "'";
                    }

                } else {
                    $query = null;
                }
                break;
            case '>':
                $query = " > " . $filter['from'] ;
                break;
            case '<':
                $query = " < " . $filter['from'] ;
                break;
            case '=' :
                $query = " = " . $filter['from'];
                break;
            case '>=':
                $query = " >= " . $filter['from'] ;
                break;
            case '<=':
                $query = " <= " . $filter['from'] ;
                break;
            default:
                $query = null;
                break;
        }
        return $query;

    }
}
