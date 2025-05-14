<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use Config\Google;
use Google\Client as Google_Client;
use Google\Service\Oauth2 as Google_Service_Oauth2;

class AuthController extends Controller
{
    protected $googleClient;
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();

        // Konfigurasi Google Client
        $googleConfig = new Google();

        $this->googleClient = new Google_Client();
        $this->googleClient->setClientId($googleConfig->clientID);
        $this->googleClient->setClientSecret($googleConfig->clientSecret);
        $this->googleClient->setRedirectUri($googleConfig->redirectUri); // harus berupa string, jangan pakai base_url()
        $this->googleClient->addScope('email');
        $this->googleClient->addScope('profile');
    }

    // Menampilkan halaman login
    public function login()
    {
        $data = [
            'googleButton' => $this->googleClient->createAuthUrl()
        ];
        return view('auth/login', $data);
    }

    // Proses login manual
    public function prosesLogin()
    {
        $session = session();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'user_id' => $user['id'],
                'name'    => $user['name'],
                'email'   => $user['email'],
                'role'    => $user['role'],
                'logged_in' => true
            ]);
            return redirect()->to('/user/dashboard');   
        }

        return redirect()->to('/login')->with('error', 'Email atau password salah.');
    }

    // Callback login dari Google
    public function googleCallback()
    {
        $code = $this->request->getVar('code');

        if (!$code) {
            return redirect()->to('/login')->with('error', 'Kode otorisasi tidak ditemukan.');
        }

        $token = $this->googleClient->fetchAccessTokenWithAuthCode($code);

        if (isset($token['error'])) {
            return redirect()->to('/login')->with('error', 'Gagal login dengan Google.');
        }

        $this->googleClient->setAccessToken($token['access_token']);
        $googleService = new Google_Service_Oauth2($this->googleClient);
        $googleUser = $googleService->userinfo->get();

        // Cek apakah email user sudah ada di database
        $user = $this->userModel->where('email', $googleUser->email)->first();

        // Jika belum ada → insert user baru
        if (!$user) {
            $this->userModel->insert([
                'name'      => $googleUser->name,
                'email'     => $googleUser->email,
                'google_id' => $googleUser->id,
                'password'  => password_hash(random_bytes(16), PASSWORD_DEFAULT), // password acak
                'role'      => 'user'
            ]);

            // Ambil kembali data user baru
            $user = $this->userModel->where('email', $googleUser->email)->first();
        }

        // Set session
        session()->set([
            'user_id'   => $user['id'],
            'name'      => $user['name'],
            'email'     => $user['email'],
            'role'      => $user['role'],
            'logged_in' => true
        ]);

        return redirect()->to('/user/dashboard');
    }

    // Logout
    public function logout()
    {
        $session = session();
        
        // Hancurkan semua data session
        $session->destroy();
        
        // Pastikan session benar-benar kosong
        $session->remove('logged_in');
        $session->remove('role');
        $session->remove('username');
        
        return redirect()->to('')->with('message', 'Anda telah logout');
}
}