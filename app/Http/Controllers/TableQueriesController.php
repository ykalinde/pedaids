<?php

namespace App\Http\Controllers;

use App\Http\Requests\TableQueryRequest;
use Illuminate\Support\Facades\DB;

class TableQueriesController extends Controller
{
    public function __invoke(TableQueryRequest $request)
    {
        $table = $request->get("table");
        $fields = $request->get("fields") == null ? ["*"] : $request->get("fields");

        $conditions = $request->get("conditions");

        $query = DB::table($table);

        $aggregate = $request->get("aggregate");

        if (!$aggregate) {
            $query->select($fields);
        } else {
            if ($this->shouldGroup($aggregate["function"])) {
                $query->selectRaw(
                    sprintf("%s, %s(%s) as %s", $aggregate["field"], $aggregate["function"], $aggregate["field"], strtolower($aggregate["function"] . "_of_" . $aggregate["field"])))
                    ->groupBy($aggregate["field"]);
            } else {
                $query->selectRaw(sprintf("%s(%s) %s", $aggregate["function"], $aggregate["field"], strtolower($aggregate["function"] . "_of_" . $aggregate["field"])));
            }

        }

        for ($i = 0; $i < count($conditions); $i++) {
            $condition = $conditions[$i];
            $operator = strtolower($condition["condition"]);
            $value = $operator == "like" ? "%" . str_replace("%", "", $condition["value"]) . "%" : $condition["value"];
            $query->where($condition["field"], $condition["condition"], $value);
        }

        return response([
            "data" => $query->get()
        ]);
    }

    private function shouldGroup($function)
    {
        switch ($function) {
            case "COUNT":
                return true;
            default:
                return false;
        }
    }
}
