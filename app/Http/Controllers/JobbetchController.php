<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Bus;
use App\Jobs\CsvProcess;

class JobbetchController extends Controller
{
    //
    public function index()
    {
        return view('jobbetch.index');
    }

    public function upload_csv_records(Request $request)
    {
        ini_set('max_execution_time',-1);

        if( $request->has('csv') ) {

            $csv    = file($request->csv);
            $chunks = array_chunk($csv,100);
            $header = [];
            //$batch  = Bus::batch([])->dispatch();
            $batch = [];
            
            foreach ($chunks as $key => $chunk) {
                $data = array_map('str_getcsv', $chunk);
                if($key == 0){
                    $header = $data[0];
                    unset($data[0]);
                }
                $chunk = array_map(function($val) use ($header){
                    $ararya = explode(',',$val);
                    $return = array_combine($header,$ararya);   
                    return  $return;
                },$chunk);

                $batch[] = CsvProcess::dispatch($chunk, $header);
                //$batch->add(new CsvProcess($data, $header));
            }
            return 'sucessfully done';
        }
        return "please upload csv file";
    }
}
