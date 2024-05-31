<?php

namespace App\Imports;

use App\Models\Borrow\Borrower;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomerImport implements ToModel, WithHeadingRow
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
        $existingBorrowerByMobile = Borrower::where('mobile', $row['mobile'])->first();

        if ($existingBorrowerByMobile) {
            // Handle the duplicate case, for example, by skipping this record or updating the existing record
            // Here, we choose to skip the record
            return null;
        }

        return new Borrower([
            'reference' => $reference,
            'first_name' => $row['name'],
            'gender' => $row['gender'],
            'mobile' => $row['mobile'],
            'address' => $row['address'],
            'uploaded_by' => $this->user->id,
            'status' => 'pending',
            'com_id' => $this->user->com_id
        ]);
    }

}
