<?php 

namespace App\Controllers;

use App\Models\User;

class Login extends BaseController
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        $data = [
            'title' => 'Login | Pemira Micro IT'
        ];

        return view('pages/login/template', $data);
    }
    
    public function cek_login()
    {
        $user = $this->request->getVar('user');
        $pass = md5($this->request->getVar('pass'));
        $cek_baris = $this->user->where(['username' => $user, 'password' => $pass, 'status' => 1])->countAllResults();
        $cek_data = $this->user->where(['username' => $user, 'password' => $pass])->find();
        
        if ($cek_baris) {
            if ($cek_data[0]['level'] == 'admin') {
                $_SESSION['admin'] = $cek_data;
                session()->setFlashData('pesan', 'Anda berhasil Login');
                return redirect()->to('/admin/index');
            } else {
                $_SESSION['user'] = $cek_data;
                $id_user = $cek_data[0]['id'];
                // dd($id_user);
                $db = \Config\Database::connect();
                $db->query("UPDATE user SET status = 0 WHERE id = $id_user");
                // $this->user->save([
                //     'id' => $id_user,
                //     'status' => 0
                // ]);

                session()->setFlashData('pesan', 'Anda berhasil Login');
                return redirect()->to('/user/index');
            } 
        } else {
            session()->setFlashData('pesan', 'Anda Gagal Login');
            return redirect()->to('/login/index');
        }
    }

    public function logout()
    {
        session_destroy();
        return redirect()->to('/login');
    }

	//--------------------------------------------------------------------

}
