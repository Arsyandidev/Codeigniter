<?php namespace App\Database\Seeds;

class Kandidat extends \Codeigniter\Database\Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i=1; $i <= 10 ; $i++) { 
            $nama = $faker->name;
            $prodi = $faker->address; //address masih contoh
            $foto = $faker->word;

            $data = [
                'nama_kandidat' => $nama,
                'prodi_kandidat' => $prodi,
                'foto' => $foto
            ];

            $this->db->table('kandidat')->insert($data);
        }
    }
}