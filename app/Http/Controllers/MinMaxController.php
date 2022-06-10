<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MinMaxController extends Controller
{

    public function __invoke(Request $request)
    {
        $number = $request->query("number");

        if($number == null||$number ==""){
            return response("Please provide a number");
        }

        return response([
            "maximum" => $this->getMax($number),
            "minimum" => $this->getMin($number),
        ]);
    }

    private function getMin($value)
    {
        $array = str_split($value);

        $minValue = $array[0];
        $minIndex = 0;
        $minFirstPos = $array[0];

        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i] < $minValue && $array[$i] != 0) {
                $minValue = $array[$i];
                $minIndex = $i;
            }
        }

        if ($minValue == $array[0]) {

            $minValue = $array[1];
            $minFirstPos = $array[1];
            $minIndex = 1;

            for ($i = 1; $i < count($array); $i++) {
                if ($array[$i] < $minValue) {
                    $minValue = $array[$i];
                    $minIndex = $i;
                }
            }
            $array[1] = $minValue;
            $array[$minIndex] = $minFirstPos;
        } else {
            $array[0] = $minValue;
            $array[$minIndex] = $minFirstPos;
        }

        return implode("", $array);
    }

    private function getMax($value)
    {
        $array = str_split($value);

        $maxValue = -1;
        $maxIndex = -1;
        $maxFirstPos = $array[0];

        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i] >= $maxValue) {
                $maxValue = $array[$i];
                $maxIndex = $i;
            }
        }

        $array[0] = $maxValue;
        $array[$maxIndex] = $maxFirstPos;

        return implode("", $array);
    }
}
