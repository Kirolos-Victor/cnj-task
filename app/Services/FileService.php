<?php

namespace App\Services;

use App\Imports\FileImport;
use App\Models\DataFile;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class FileService
{
    public function execute($request)
    {
        $path = $request->file('file')->getRealPath();

        Excel::import(new FileImport, $path);
        $data = Session::get('fileData');

        if ($request->save_to_database == 'true') {
            DataFile::create([
                'average_price' => $data['average_price'],
                'total_houses_sold' => $data['total_houses_sold'],
                'number_of_crimes_in_2011' => $data['number_of_crimes'],
                'average_price_per_year_in_london' => serialize($data['average_price_per_year'])
            ]);
        }

        return $data;
    }

}
