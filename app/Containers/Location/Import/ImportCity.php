<?php

namespace App\Containers\Location\Import;

use App\Containers\Location\Models\City;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportCity implements ToModel
{
    public function model(array $row)
    {
        return new City([
            'code' => $row[0],
            'name' => $row[1],
        ]);
    }
}
