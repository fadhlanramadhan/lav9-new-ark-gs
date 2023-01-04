<?php

namespace App\Imports;

use App\Models\Migi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MigiImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Migi([
            'posting_date'  => $this->convert_date($row['posting_date']),
            'doc_type'      => $row['doc_type'],
            'doc_no'        => $row['doc_no'],
            'project_code'  => $row['project_code'],
            'dept_code'     => $row['dept_code'],
            'item_code'     => $row['item_code'],
            'qty'           => $row['qty'],
            'uom'           => $row['uom'],
        ]);
    }

    public function convert_date($date)
    {
        if ($date) {
            $year = substr($date, 6, 4);
            $month = substr($date, 3, 2);
            $day = substr($date, 0, 2);
            $new_date = $year . '-' . $month . '-' . $day;
            return $new_date;
        } else {
            return null;
        }
    }
}
