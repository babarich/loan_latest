<?php

namespace App\Imports;

use App\Models\Borrow\Borrower;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomerImport implements ToModel, WithHeadingRow,SkipsEmptyRows
{

    use Importable;

    protected  $user;


    protected  array $skippedDuplicates = [];
    public  function __construct($user)
    {
       $this->user = $user;
    }
    public function model(array $row)
    {
        // Generate a new reference
        $reference = 'BRW' . rand(1000, 9999);

        // Check if a borrower with the same reference already exists
        $existingBorrower = Borrower::where('reference', $reference)->first();

        // If a duplicate is found, generate a new reference
        while ($existingBorrower) {
            $reference = 'BRW' . rand(5000, 6999);
            $existingBorrower = Borrower::where('reference', $reference)->first();
        }

        // Check if a borrower with the same mobile number already exists (if mobile should be unique)
        // $existingBorrowerByMobile = Borrower::where('mobile', $row['mobile'])->first();

    
        
        $data = [
            'reference' => isset($row['name']) ? $reference : null,
            'first_name' => $row['name'] ?? null,
            'gender' => $row['gender'] ?? null,
            'mobile' => $row['mobile'] ?? null,
            'address' => $row['address'] ?? null,
            'uploaded_by' => isset($row['name']) ? $this->user->id : null,
            'status' => isset($row['name'])  ? 'pending' : null,
            'com_id' => isset($row['name'])  ? $this->user->com_id : null
            ];

        $data = array_filter($data, fn($value) => !is_null($value));
        return new Borrower($data);
    }

}
