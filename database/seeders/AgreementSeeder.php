<?php

namespace Database\Seeders;

use App\Models\Agreement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgreementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agreements = DB::connection('mysql2')
            ->select('SELECT * FROM agreements ORDER BY id ASC');

        $agreement_organization_records = DB::connection('mysql2')
            ->select('SELECT * FROM agreement_organization ORDER BY id ASC');

        $agreement_partners = DB::connection('mysql2')
            ->select('SELECT * FROM agreement_partners ORDER BY agreement_id');

        foreach ($agreements as $agreement) {
            Agreement::query()->create([
                'id' => $agreement->id,
                'type' => $agreement->type,
                'investment_type' => $agreement->investment_type,
                'status' => $agreement->status,
                'stock' => $agreement->stock,
                'amount' => $agreement->amount,
                'currency_id' => $agreement->currency_id,
                'description' => $agreement->description,
                'references' => $agreement->references,
                'year' => $agreement->year,
                'month' => $agreement->month,
                'comment' => $agreement->comment,
                'deleted_at' => $agreement->deleted_at,
                'created_at' => $agreement->created_at,
                'updated_at' => $agreement->updated_at,
            ]);
        }

        foreach ($agreement_organization_records as $record) {
            DB::table('agreement_organization')->insert([
               'id' => $record->id,
               'agreement_id' => $record->agreement_id,
               'organization_id' => $record->organization_id,
               'party' => $record->party,
            ]);
        }

        foreach($agreement_partners as $record) {
            DB::table('agreement_partners')->insert([
               'agreement_id' => $record->agreement_id,
               'organization_id' => $record->organization_id,
            ]);
        }
    }
}
