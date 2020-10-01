<?php namespace App\Controllers;

use App\Models\Kandidat;

class Admin extends BaseController
{
    protected $kandidat; //nama tabel

    public function __construct()
    {
        $this->kandidat = new Kandidat();
    }

	public function index()
	{
        $data = [
            'data_kandidat' => $this->kandidat->load(),
            'jumlah_kandidat' => $this->kandidat->jumlah()
        ];

		return view('pages/admin/home', $data);
	}

    public function tambah()
    {
        return view('pages/admin/tambah');
    }

    public function save_tambah()
    {
        
        $nama = $this->request->getVar('nama');
        $prodi = $this->request->getVar('prodi');
        $foto = $this->request->getFile('foto');
        // $nama_foto = $foto->getName();
        // 
        if ($foto->getError() == 4) {
            $nama_foto = "";
        } else {
            $nama_foto = $foto->getName();
            $foto->move('dist/img/', $nama_foto);
        }

        $this->kandidat->save([
            'nama_kandidat' => $nama,
            'prodi_kandidat' => $prodi,
            'foto' => $nama_foto
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin');
    }

    // public function edit()
    // {
    //     $data = [
    //         'data_kandidat' => $this->kandidat->load(),
    //         'jumlah_kandidat' => $this->kandidat->jumlah()
    //     ];
        
    //     return view('pages/admin/edit', $data);
    // }

    public function edit($id = '')
    {
        $kandidat = $this->kandidat->where(['id' => $id])->first();
        $data = [
            'kandidat' => $kandidat
        ];

        return view('pages/admin/edit', $data);
    }

    public function edit_data($id = '')
    {
        $data_lama = $this->kandidat->where(['id' => $id])->first();
        $nama = $this->request->getVar('nama');
        $prodi = $this->request->getVar('prodi');
        $foto = $this->request->getFile('foto');
        $nama_foto_baru = $foto->getName();
        $nama_foto_lama = $data_lama['foto'];
        if($foto->getError() == 4) {
            $nama_foto = $nama_foto_lama;
        } else {
            $nama_foto = $nama_foto_baru;
            $foto->move('dist/img/',$nama_foto);
            unlink('dist/img/'.$nama_foto_lama);
        }
        $this->kandidat->save([
            'id' => $id,
            'nama_kandidat' => $nama,
            'prodi_kandidat' => $prodi,
            'foto' => $nama_foto
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin');
    }


    
    public function hapus($id)
    {
        $data_kandidat = $this->kandidat->where(['id' => $id])->first();
        $nama_foto = $data_kandidat['foto'];
        $this->kandidat->delete($id);
        unlink('dist/img/'.$nama_foto);
        session()->setFlashdata('pesan', 'Hapus data.');

        return redirect()->to('/admin');
    }
	//--------------------------------------------------------------------

}