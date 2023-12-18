<?php

namespace Modules\Tests\Tasks;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Modules\Tests\Models\Test;

class GetTestsTask
{
    public function run(array $params = []): LengthAwarePaginator
    {
        $columns = [
            'tests.*',
            'operators.name as operators.name',
            'standards.name as standards.name',
            'connection_types.name as connection_types.name',
            'servers.name as servers.name',
            'towers.cell_id as towers.cell_id'
        ];

        return Test::query()
            ->select($columns)
            ->leftJoin('operators', 'tests.operator_id', '=', 'operators.id')
            ->leftJoin('standards', 'tests.standard_id', '=', 'standards.id')
            ->leftJoin('connection_types', 'tests.connection_type_id', '=', 'connection_types.id')
            ->leftJoin('servers', 'tests.server_id', '=', 'servers.id')
            ->leftJoin('towers', 'tests.tower_id', '=', 'towers.id')
            ->when(!empty($params['sortBy']), function ($query) use ($params) {
                foreach ($params['sortBy'] as $sort) {
                    $query->orderBy($sort['key'], $sort['order']);
                }
            })
            ->when(!empty($params['filters']), function ($query) use ($params) {
                foreach ($params['filters'] as $key => $value) {
                    $query = match (gettype($value)) {
                        'integer' => $query->when(!empty($value),
                            fn($query) => $query->where($key, $value)
                        ),
                        'string' => $query->when(!empty($value),
                            fn($query) => $query->where($key, 'like', '%' . $value . '%')
                        ),
                        'array' => $query->when(!empty($value[0]),
                            fn($query) => $query->whereDate($key, '>=', Carbon::parse($value[0]))
                        )->when(!empty($value[1]),
                            fn($query) => $query->whereDate($key, '<=', Carbon::parse($value[1]))
                        ),
                        default => $query
                    };
                }
            })
            ->paginate($params['itemsPerPage'] ?? 15);
    }
}
