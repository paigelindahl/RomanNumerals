<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DateConversionController extends Controller
{
    public function convertDate(Request $request)
    {
        $rules = [
            'date' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        $date = $request->input('date');

        if (!$date) {
            return response()->json(['error' => 'Date is required'], 400);
        }

        $parts = explode('-', $date);
        if (count($parts) !== 3) {
            return response()->json(['error' => 'Invalid date format'], 400);
        }

        list($day, $month, $year) = array_map('intval', $parts);

        $romanDate = [
            'day' => $this->toRoman($day),
            'month' => $this->toRoman($month),
            'year' => $this->toRoman($year)
        ];

        return response()->json(['roman_date' => "{$romanDate['day']}-{$romanDate['month']}-{$romanDate['year']}"]);
    }

    private function toRoman($num)
    {
        $map = [
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1
        ];

        $result = '';
        while ($num > 0) {
            foreach ($map as $roman => $value) {
                if ($num >= $value) {
                    $num -= $value;
                    $result .= $roman;
                    break;
                }
            }
        }

        return $result;
    }
}
