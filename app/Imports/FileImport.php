<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FileImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $dataOfTwentyEleven = $collection->whereBetween('date', ['2011-01-01', '2011-12-01']);
        $dataOfLondonCity = $collection->where('area', '=', 'city of london');

        $totalPrice = 0;
        $totalHousesSold = 0;
        $totalNumberOfCrimes = 0;

        foreach ($dataOfTwentyEleven as $data) {
            $totalPrice += $data['average_price'];
            $totalHousesSold += $data['houses_sold'];
            $totalNumberOfCrimes += $data['no_of_crimes'];
        }

        $averagePricePerYear = [];
        foreach ($dataOfLondonCity as $key => $data) {
            $totalPricePerYear=0;

            for ($i = 0; $i < count($dataOfLondonCity); $i += 12) {
                if ($i ==$key)
                {
                    $currentYear = substr($data['date'], 0, 4);

                    $totalPricePerYear +=$data['average_price'];
                    $averagePricePerYear[$currentYear]=$totalPricePerYear;

                }
           }
        }
        $data = [
            'average_price' => $totalPrice,
            'total_houses_sold' => $totalHousesSold,
            'number_of_crimes' => $totalNumberOfCrimes,
            'average_price_per_year'=>$averagePricePerYear
        ];

        Session::put('fileData', $data);
    }
}
