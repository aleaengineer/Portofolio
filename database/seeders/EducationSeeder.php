<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Data pendidikan contoh — idempoten (institusi + gelar dipakai acuan).
     */
    public function run(): void
    {
        $educations = [
            [
                'institution' => 'Universitas Terbuka',
                'degree' => 'Bachelor of Accounting',
                'start_date' => '2023-01-01',
                'end_date' => null,
                'sort_order' => 0,
            ],
            [
                'institution' => 'MAN 1 Pangandaran',
                'degree' => 'Ilmu Pengetahuan Sosial',
                'start_date' => '2015-01-01',
                'end_date' => '2018-12-31',
                'sort_order' => 1,
            ],
        ];

        foreach ($educations as $data) {
            Education::firstOrCreate(
                ['institution' => $data['institution'], 'degree' => $data['degree']],
                $data,
            );
        }
    }
}
