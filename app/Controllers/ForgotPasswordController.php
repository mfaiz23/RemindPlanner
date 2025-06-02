<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ForgotPasswordController extends BaseController
{
    // GET: Form input email untuk lupa password
    public function index()
    {
        return view('auth/forgot_password');
    }

    // POST: Kirim OTP ke email
    public function sendOtp()
    {
        $email = $this->request->getPost('email');
        $otp = random_int(100000, 999999);

        // Simpan OTP dan waktu kadaluarsa di session
        session()->set([
            'otp_code' => $otp,
            'otp_email' => $email,
            'otp_expire' => Time::now()->addMinutes(5)->getTimestamp(),
        ]);

        // Kirim email
        $mail = new PHPMailer(true);

        try {
            // Konfigurasi SMTP Gmail
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = '';      // ganti dengan emailmu
            $mail->Password   = '';  // gunakan app password dari Google
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('', '');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Kode OTP Lupa Password';
            $mail->Body    = "Kode OTP Anda adalah: <b>$otp</b><br>OTP berlaku selama 5 menit.";

            $mail->send();
            return redirect()->to('/forgot_password/verify_otp')->with('success', 'OTP berhasil dikirim ke email.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengirim email. Error: ' . $mail->ErrorInfo);
        }
    }

    // GET: Tampilkan form verifikasi OTP
    public function showVerifyOtpForm()
    {
        return view('auth/verify_otp');
    }

    // POST: Proses verifikasi OTP
    public function submitVerifyOtp()
{
    $inputOtp = trim($this->request->getPost('otp'));
    $sessionOtp = (string) session()->get('otp_code');
    $sessionEmail = session()->get('otp_email');
    $otpExpire = session()->get('otp_expire');

    if (!$sessionOtp || !$otpExpire) {
        return redirect()->to('/forgot_password')->with('error', 'OTP tidak ditemukan atau sudah kadaluarsa.');
    }

    if (Time::now()->getTimestamp() > $otpExpire) {
        session()->remove(['otp_code', 'otp_email', 'otp_expire']);
        return redirect()->to('/forgot_password')->with('error', 'OTP sudah kadaluarsa.');
    }

    if ((string) $inputOtp === (string) $sessionOtp) {
        return redirect()->to('/reset_password')->with('success', 'OTP valid. Silakan ubah password Anda.');
    } else {
        return redirect()->back()->with('error', 'OTP salah.');
    }
}

public function resendOtp()
{
    $email = session()->get('otp_email');

    if (!$email) {
        return redirect()->to('/forgot_password')->with('error', 'Sesi tidak ditemukan. Silakan input ulang email Anda.');
    }

    $otp = random_int(100000, 999999);

    // Perbarui OTP dan waktu kadaluarsa di session
    session()->set([
        'otp_code' => $otp,
        'otp_expire' => Time::now()->addMinutes(5)->getTimestamp(),
    ]);

    // Kirim ulang email
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'cvremindplanner@gmail.com'; // email kamu
        $mail->Password   = 'shkz wgsp sseo gcht';        // app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('cvremindplanner@gmail.com', 'Remind Planner');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Resend OTP Lupa Password';
        $mail->Body    = "Kode OTP baru Anda adalah: <b>$otp</b><br>OTP berlaku selama 5 menit.";

        $mail->send();

        return redirect()->back()->with('success', 'OTP baru berhasil dikirim ke email Anda.');
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Gagal mengirim ulang OTP. Error: ' . $mail->ErrorInfo);
    }
}

public function update_password()
{
    $email = session()->get('otp_email');

    if (!$email) {
        return redirect()->to('/forgot_password')->with('error', 'Session telah habis. Silakan ulangi proses lupa password.');
    }

    $password = $this->request->getPost('password');

    // Validasi password minimal 6 karakter (bisa sesuaikan)
    if (strlen($password) < 6) {
        return redirect()->back()->with('error', 'Password minimal 6 karakter.');
    }

    // Hash password baru
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Update password di database (ganti 'users' & kolom sesuai model kamu)
    $userModel = new \App\Models\UserModel();
    $user = $userModel->where('email', $email)->first();

    if (!$user) {
        return redirect()->to('/forgot_password')->with('error', 'User tidak ditemukan.');
    }

    $userModel->update($user['id'], ['password' => $hashedPassword]);

    // Hapus session OTP dan email
    session()->remove(['otp_code', 'otp_email', 'otp_expire']);

    return redirect()->to('/login')->with('success', 'Password berhasil diubah. Silakan login dengan password baru.');
}
public function reset_password()
{
    // Pastikan email dalam session agar hanya user yang sudah verifikasi OTP bisa akses
    if (!session()->get('otp_email')) {
        return redirect()->to('/forgot_password')->with('error', 'Akses tidak valid. Silakan verifikasi email terlebih dahulu.');
    }

    return view('auth/reset_password'); // sesuaikan path view jika berbeda
}

}
