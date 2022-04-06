<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Imports\FileImport;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;


class UploadController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function uploadData(FileRequest $request,FileService $fileService)
    {
        $data=$fileService->execute($request);


        return response()->json($data);
    }
}
