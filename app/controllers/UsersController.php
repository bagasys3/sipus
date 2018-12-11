<?php
use Phalcon\Mvc\Controller;
class UsersController extends BaseController
{
    public function manageAction()
    {
        if($this->session->get('auth')['status'] != '1'){
            $this->response->redirect();
        }

        $nama = $this->request->getPost('title');
        $nama = '%'.$nama.'%';
        $results = Users::find(
            [
                'conditions' => "nama LIKE :nama:" ,
                'bind'       => [
                    'nama' => $nama,
                ]
            ]
        );
        
        
        $this->view->results = $results;
        
    }
    public function createAction()
    {
        if($this->session->get('auth')['status'] != '1'){
            $this->response->redirect();
        }
    }
    public function editAction()
    {
        if($this->session->get('auth')['status'] != '1'){
            $this->response->redirect();
        }
        $id = $this->dispatcher->getParam("id");
        $results = Users::findFirst("id = '$id' ");
        $this->view->results = $results;
    }

    public function storeAction()
    {
        $user = new Users();

        $nama = $this->request->getPost('nama');
        $alamat = $this->request->getPost('alamat');
        $telp = $this->request->getPost('telp');
        $no_id = $this->request->getPost('no_id');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $cpassword = $this->request->getPost('cpassword');
        $admin = 0;

        if($password === $cpassword && $password != ''){
            $checkUser = Users::findFirst("email = '$email'");
            if($checkUser){
                $this->response->redirect('tambah-anggota');
            }
            else{
                $password = password_hash($password, PASSWORD_DEFAULT); 
                $user->nama = $nama;
                $user->email = $email;
                $user->password = $password;
                $user->alamat = $alamat;
                $user->no_telepon = $telp;
                $user->no_id = $no_id;
                $user->admin = $admin;

                if($user->save() === false){
                    foreach ($user->getMessages() as $message) {
                        echo $message, "\n";
                    }                
                }
                else{
                    $this->response->redirect('daftar-anggota');
                }
            }
        }
        else{
            $this->response->redirect('tambah-anggota');
        }
        
    }
    public function updateAction()
    {
        $flag = 0;
        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        $alamat = $this->request->getPost('alamat');
        $telp = $this->request->getPost('telp');
        $no_id = $this->request->getPost('no_id');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $cpassword = $this->request->getPost('cpassword');
        $admin = $this->request->getPost('admin');

        $user = Users::findFirst("id = '$id'");

        if($password === $cpassword && password_verify($password, $user->password)){
            
            $checkUser = Users::findFirst("email = '$email'");
            if($user->email === $email){
                $flag = 1;
            }
            else if (!$checkUser){
                $flag = 1;
            }
            if($flag === 1){
                
                $password = password_hash($password, PASSWORD_DEFAULT); 
                $user->nama = $nama;
                $user->email = $email;
                $user->password = $password;
                $user->alamat = $alamat;
                $user->no_telepon = $telp;
                $user->no_id = $no_id;
                $user->admin = $admin;

                if($user->save() === false){
                    foreach ($user->getMessages() as $message) {
                        echo $message, "\n";
                    }         
                }
                else{
                    $this->response->redirect('daftar-anggota');
                }
            }
            else{
                $this->response->redirect("ubah-anggota/$id");
            }
           
        }
        else{
            $this->response->redirect("ubah-anggota/$id");
        }
    }
    public function destroyAction()
    {
        $id = $this->request->getPost('id');
        
        $user = Users::findFirst("id = '$id'");

        if ($user !== false) {
            if ($user->delete() === false) {
                echo "Sorry, we can't delete the user right now: \n";
        
                $messages = $user->getMessages();
        
                foreach ($messages as $message) {
                    echo $message, "\n";
                }
            } else {
                $this->response->redirect('daftar-anggota');
            }
        }
    }
}
