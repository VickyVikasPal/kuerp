<?php

use App\Common\Datetime\TimeDate;
use Illuminate\Support\Facades\DB;
function applySearchFilters($query, $baseTable)
{

    $datetime = new TimeDate();

    $request = request();

    $searchs = $request->input('search');

    if (!empty($searchs))
    {
        $searchs = json_decode($searchs);

        if (!empty($searchs))
        {
            foreach ($searchs as $key => $search)
            {
                $searchAls = $baseTable;

                $field_info = $search->field_info ?? '';

                if ($search->value !== '' && $search->value !== null && ($search->value !== [] || !empty($search->value)))
                {

                    if (!empty($field_info->relRef))
                    {
                        if (!empty($field_info->relRef))
                        {
                            $relationship_name = $field_info->relRef;
                            $relationships = DB::table('relationships')
                            ->where('name', $relationship_name)
                            ->where('deleted', '0')
                            ->first();
                        }
                        if (!empty($relationships->name))
                        {
                            $relationship = [
                                'table1' => $relationships->lhs_table,
                                'table2' => $relationships->rhs_table,
                                'column1' => $relationships->lhs_key,
                                'column2' => $relationships->rhs_key,
                            ];

                            $searchAls = $relationship['table2'];

                            $existingJoin = collect($query->getQuery()->joins)->first(function ($join) use ($relationship) {
                                return $join->table === $relationship['table2'] && $join->type === 'left';
                            });

                            if (!$existingJoin)
                            {
                                $query->leftJoin($relationship['table2'], $relationship['table1'] . '.' . $relationship['column1'], '=', $relationship['table2'] . '.' . $relationship['column2']);
                            }
                        }
                    }

                    if (!empty($field_info->type) && ($field_info->type == 'date' || $field_info->type == 'daterange'))
                    {
                        $date_array = explode('__', $key);

                        $key = $date_array[0] ?? $key;

                        $dateIndent = $date_array[count($date_array) - 1] ?? 'start';

                        $search->value = explode('T', $search->value)[0] ?? $search->value;

                        $search->value = $datetime->to_db_datetime($search->value);

                        if (!empty($field_info->type) && $field_info->type == 'date')
                        {
                            $query->whereDate($searchAls . '.' . $key, '=', $search->value);
                        }
                        else
                        {
                            if ($dateIndent == 'end')
                            {
                                $query->whereDate($searchAls . '.' . $key, '<=', $search->value);
                            }
                            else
                            {
                                $query->whereDate($searchAls . '.' . $key, '>=', $search->value);
                            }
                        }
                    }
                    else
                    {

                        $key_array = explode('__', $key);

                        $key = $key_array[0] ?? $key;

                        if (is_array($search->value))
                        {
                            $query->whereIn($searchAls . '.' . $key, $search->value);
                        }
                        else
                        {
                            $query->where($searchAls . '.' . $key, 'LIKE', '%' . $search->value . '%');
                        }
                    }
                }
            }
        }
    }
}
function applySorting($query, $baseTable)
{

    $request = request();

    $sort = $request->input('sort');

    if (!empty($sort))
    {
        $sort = json_decode($sort);

        
        if (!empty($sort))
        {
            $sortAls = $baseTable;
            
            if (!empty($sort->order) && !empty($sort->column))
            {

                if (!empty($sort->relRef))
                {
                    $relationship_name = $sort->relRef;
                    $relationships = DB::table('relationships')
                    ->where('name', $relationship_name)
                    ->where('deleted', '0')
                    ->first();

                    if (!empty($relationships->name))
                    {
                        $relationship = [
                            'table1' => $relationships->lhs_table,
                            'table2' => $relationships->rhs_table,
                            'column1' => $relationships->lhs_key,
                            'column2' => $relationships->rhs_key,
                        ];

                        $sortAls = $relationship['table2'];

                        $existingJoin = collect($query->getQuery()->joins)->first(function ($join) use ($relationship) {
                            return $join->table === $relationship['table2'] && $join->type === 'left';
                        });

                        if (!$existingJoin)
                        {
                            $query->leftJoin($relationship['table2'], $relationship['table1'] . '.' . $relationship['column1'], '=', $relationship['table2'] . '.' . $relationship['column2']);
                        }
                    }
                }
                $key_array = explode('__', $sort->column);

                $sort->column = $key_array[0] ?? $sort->column;

                $query->orderBy($sortAls . '.' . $sort->column, $sort->order ?? 'DESC');
            }
        }
    }
}
?>