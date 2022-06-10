<?php

namespace App\Http\Controllers;

use App\Http\Requests\TableQueryRequest;
use Illuminate\Support\Facades\DB;

class TableQueriesController extends Controller
{
    public function __invoke(TableQueryRequest $request)
    {
        $table = $request->get("table");
        $fields = $request->get("fields");

        $query = DB::table($table);

        $query->select($fields);

        return response([
            "data" => $query->get()
        ]);
    }
}
