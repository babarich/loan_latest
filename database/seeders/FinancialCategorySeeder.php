<?php

namespace Database\Seeders;

use App\Models\Account\FinancialCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinancialCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FinancialCategory::truncate();
        $financial_category=[
            [
                'id'=> 1,
                'name'=>'Revenue',
                'financial_statement_id'=>1,
                'note'=>'Revenue Collection',
            ],
            [
                'id'=> 2,
                'name'=>'Operational Expenses',
                'financial_statement_id'=>1,
                'note'=>'Operating Expenses',
            ],
            [
                'id'=> 3,
                'name'=>'Other Expenses',
                'financial_statement_id'=>2,
                'note'=>'Non-current assets',
            ],
            [
                'id'=> 4,
                'name'=>'Fixed Assets',
                'financial_statement_id'=>2,
                'note'=>'Fixed Assets',
            ],
            [
                'id'=> 5,
                'name'=>'Current Assets',
                'financial_statement_id'=>2,
                'note'=>'Current Assets',
            ],
            [
                'id'=> 6,
                'name'=>'Liabilities',
                'financial_statement_id'=>2,
                'note'=>'Liabilities',
            ],
            [
                'id'=> 7,
                'name'=>'Equity',
                'financial_statement_id'=>1,
                'note'=>'Equity',
            ],


        ];
        FinancialCategory::insert($financial_category);
    }
}
