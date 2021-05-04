<?php

namespace App\Imports;

use App\Helpers\MyHelper;
use App\User;
use App\Waybill;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class WaybillsImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        $insertCount  = $rowCount = $notAddCount = 0;
        foreach ($rows as $key => $row) {
            $rowCount++;
            if ($key > 2) {
                $name = strtolower($row[3]);
                $user_exists    = User::whereRaw("LOWER(name) = '$name'")->get();
                if (sizeof($user_exists) != 0) {
                    Waybill::create([
                        'user_id' => $user_exists->id,
                        'no_waybill'    => $row[1]
                    ]);
                    $insertCount++;
                }
            }
        }
        $notAddCount = $rowCount - $insertCount;
        // MyHelper::setMessage('Berhasil', 'success', "Import data resi sukses, Total Rows($rowCount) | Inserted ($insertCount)  | Not Inserted ($notAddCount)");
        // return redirect('utility/import_resi');
    }
}
