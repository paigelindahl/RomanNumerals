<?php

namespace App\Http\Controllers;

use App\Rules\RomanDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DateConversionController extends Controller
{
    private $romanMap = [
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

    public function convertDateToRoman(Request $request)
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

    /**
     * Converts roman numeral string to a valid date
     */
    public function convertRomanToDate(Request $request)
    {
        $rules = [
            'roman_date' => ['required', new RomanDate]
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        $romanDate = $request->input('roman_date');
        $parts = explode('-', $romanDate);
        list($day, $month, $year) = array_map([$this, 'romanToInt'], $parts);

        if ($day < 1 || $day > 31 || $month < 1 || $month > 12) {
            return response()->json(['error' => 'Invalid date range.'], 400);
        }

        return response()->json(['date' => sprintf('%02d-%02d-%04d', $day, $month, $year)]);
    }

    /**
     * Logic to determine integer conversion from roman numeral input
     */
    private function romanToInt($roman)
    {
        $result = 0;
        $length = strlen($roman);

        for ($i = 0; $i < $length; $i++) {
            $current = $this->romanMap[$roman[$i]];
            $next = ($i + 1 < $length) ? $this->romanMap[$roman[$i + 1]] : 0;

            if ($next > $current) {
                $result -= $current;
            } else {
                $result += $current;
            }
        }

        return $result;
    }

    /**
     * Logic to convert number to roman numeral
     */
    private function toRoman($num)
    {
        $result = '';
        while ($num > 0) {
            foreach ($this->romanMap as $roman => $value) {
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
