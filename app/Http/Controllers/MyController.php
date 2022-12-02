<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;


class MyController extends Controller
{
    //
    public function importExportView()
    {
       return view('import');
    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function import() 
    {

         Excel::import(new UsersImport,request()->file('file'));
         
        return back();
    }

    public function import_with_batch()
     {
         Excel::import(
            new UsersImport,
            request()->file('file')
        );
        

        return redirect('/importExportView')->with('success', 'Users Imported Successfully!');
        
    }

    


}
