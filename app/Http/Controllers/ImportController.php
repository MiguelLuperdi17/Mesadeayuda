<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\HtmlImport;

class ImportController extends Controller
{
    public function import(Request $request)
    {
        $file = $request->file('html_file');

        Excel::import(new HtmlImport, $file);

        return redirect()->back()->with('success', 'HTML importado correctamente');
    }
}