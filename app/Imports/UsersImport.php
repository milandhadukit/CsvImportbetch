<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithChunkReading;


class UsersImport implements ToModel, WithHeadingRow,WithChunkReading
// ,WithBatchInserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    // public function model(array $row)
    // {
    //     Excel::filter('chunk')->selectSheetsByIndex(0)->load(request()->file('file'))->chunk(5000, function ($results) {

    //         foreach ($results as $row) {
    //             return new User([
    //                 'name'     => $row['name'],
    //                 'email'    => $row['email'],
    //                 'password' => Hash::make($row['password']),
    //             ]);
    //         }
    //     });
    // }




    public function model(array $row)
    {
        ini_set('max_execution_time', '-1');



               return  new User([

                    'name'     => $row['name'],
                    'email'    => $row['email'],
                    'password' => Hash::make($row['password']),
                ]);
    }


    public function chunkSize(): int
    {
        return 5000;
    }
}
