<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Bus;
use Session;

class CsvImportController extends Controller
{
    //
    public function impostCsv()
    {
        //  return view('csvimposrt');
        return view('importcsv_3');
    }


    public function uploadFile(Request $request)
    {
        try{
        $file = $request->file('file');

        $file = $request->file('file');
        // try{
        //     DB::beginTransaction();


        //     DB::commit();
        // } catch(\Exception $e){
        //     DB::rollback();
        //     echo $e->getMessage();
        // }


        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();
        $valid_extension = array("csv");
        // 2MB in Bytes
        $maxFileSize = 2097152;
        if (in_array(strtolower($extension), $valid_extension)) {

            // Check file size
            if ($fileSize <= $maxFileSize) {

                // File upload location
                $location = 'uploads';

                // Upload file
                $file->move($location, $filename);

                // Import CSV to Database
                $filepath = public_path($location . "/" . $filename);
                $file = fopen($filepath, "r");
                $importData_arr = array();
                $i = 0;

                while (($filedata = fgetcsv($file, 3000, ",")) !== FALSE) {
                    $num = count($filedata);


                    for ($c = 0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata[$c];
                    }
                    $i++;
                }
                fclose($file);



                // Insert data in database

                foreach ($importData_arr as $importData) {

                    $insertData = array(

                        "name" => $importData[0],
                        "email" => $importData[1],
                        "password" => $importData[2],
                        "address" => $importData[3],
                        "city" => $importData[4]
                    );

                    $data = user::create($insertData);
                }


                Session::flash('message', 'Import Successful.');
            } else {
                Session::flash('message', 'File too large. File must be less than 2MB.');
            }
        } else {
            Session::flash('message', 'Invalid File Extension.');
        }
        return response()->json(['success' => 'Successfully']);
        // return back();
    }
    catch(\Exception $e)
    {
        echo $e->getMessage();
    }

    }
}
