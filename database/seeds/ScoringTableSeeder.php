<?php

use Illuminate\Database\Seeder;

class ScoringTableSeeder extends Seeder
{
	public function __construct()
    {
        $this->scoringModel = new \App\Models\Scoring;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->scoringModel->create(['penghasilan' => 1, 'pengeluaran' => 1, 'pekerjaan' => 1, 'status_kawin' => 1, 'score' => false]);
        $this->scoringModel->create(['penghasilan' => 2, 'pengeluaran' => 2, 'pekerjaan' => 2, 'status_kawin' => 2, 'score' => false]);
        $this->scoringModel->create(['penghasilan' => 3, 'pengeluaran' => 1, 'pekerjaan' => 2, 'status_kawin' => 1, 'score' => true]);
        $this->scoringModel->create(['penghasilan' => 2, 'pengeluaran' => 1, 'pekerjaan' => 1, 'status_kawin' => 2, 'score' => true]);
        $this->scoringModel->create(['penghasilan' => 1, 'pengeluaran' => 3, 'pekerjaan' => 1, 'status_kawin' => 1, 'score' => false]);
        $this->scoringModel->create(['penghasilan' => 2, 'pengeluaran' => 2, 'pekerjaan' => 1, 'status_kawin' => 2, 'score' => true]);
        $this->scoringModel->create(['penghasilan' => 2, 'pengeluaran' => 2, 'pekerjaan' => 2, 'status_kawin' => 1, 'score' => false]);
        $this->scoringModel->create(['penghasilan' => 3, 'pengeluaran' => 2, 'pekerjaan' => 1, 'status_kawin' => 2, 'score' => true]);
        $this->scoringModel->create(['penghasilan' => 1, 'pengeluaran' => 1, 'pekerjaan' => 2, 'status_kawin' => 1, 'score' => false]);
        $this->scoringModel->create(['penghasilan' => 2, 'pengeluaran' => 3, 'pekerjaan' => 1, 'status_kawin' => 2, 'score' => false]);
    }
}
