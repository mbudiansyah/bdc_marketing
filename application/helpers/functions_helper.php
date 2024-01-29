<?php


if (!function_exists('fungsi')) {
    function login_cb($username = null, $password = null)
    {
        // Data yang akan dikirim dalam permintaan POST
        $postData = [
            'username' => $username,
            'password' => $password,
        ];

        // Inisialisasi cURL
        $ch = curl_init();

        // Set opsi cURL
        curl_setopt($ch, CURLOPT_URL, 'https://cb.web.id/ggklikv2/api/getUser');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Matikan verifikasi SSL (seperti opsi 'verify' => false pada library Guzzle)

        // Eksekusi permintaan cURL
        $response = curl_exec($ch);

        // Cek apakah ada kesalahan cURL
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }

        // Tutup sumber daya cURL
        curl_close($ch);

        // Lakukan pengolahan respons
        $data = json_decode($response);
        if (!empty($data)) {
            return (array) $data;
        }
    }
    function get_post($name, $required = false)
    {
        /* CEK APAKAH ADA POST DENGAN NAMA $NAME */
        if (isset($_POST[$name])) {
            /* CEK APAKAH REQUIRED ATAU WAJIB DI ISI */
            if ($required) {
                return !empty(htmlspecialchars(trim($_POST[$name]))) ? htmlspecialchars(trim($_POST[$name])) : http_response_code(400);
                result_json('error', 400, ucwords($name) . ' Tidak Boleh Kosong');
            } else {
                return htmlspecialchars($_POST[$name]);
            }
        }
        return result_json('error', 400, 'Data Kurang Lengkap');
    }
    function validasi_method($method)
    {
        if (in_array(strtoupper($method), ['POST', 'GET'])) {
            if ($_SERVER["REQUEST_METHOD"] !== strtoupper($method)) {
                result_json('error', 400, 'Metode tidak diterima atau tidak valid');
            }
        }
    }
    function result_json($status = '', $kode = '', $pesan = '', $listdata = array())
    {
        /*
        $status contohnya "berhasil" "gagal"
        $kode diisi 200 atau 400
            200 = berhasil
            400 = gagal
        $pesan isinya bebas, contoh "berhasil tambah data"
        $listdata = optsional bebas
        
        */
        $response = [
            'status' => $status,
            'kode' => $kode,
            'message' => $pesan,
            'listdata' => $listdata

        ];
        $kode == 200 ? http_response_code(200) : http_response_code(400);
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
    function debug($v)
    {
        echo "<pre>";
        print_r($v);
        exit;
    }
    function validate_phone_number($phone)
    {
        // Jika input bukan angka, langsung return false
        if (!is_numeric($phone)) {
            result_json('error', '400', 'Nomor Hp tidak valid');
        }

        // Bersihkan nomor HP dari karakter non-angka
        $phone = preg_replace('/\D/', '', $phone);
        // Pastikan nomor HP mengandung 10-13 angka
        if (strlen($phone) < 10 || strlen($phone) > 15) {
            result_json('error', '400', 'Nomor Hp tidak valid');
        }

        // Pastikan nomor diawali dengan 08, 628 atau +628
        if (substr($phone, 0, 2) != '08' && substr($phone, 0, 3) != '628') {
            return false;
        }

        // Nomor HP valid
        return $phone;
    }
    function validate_email($email)
    {
        // Gunakan fungsi filter_var untuk validasi email dengan FILTER_VALIDATE_EMAIL
        $valid_email = filter_var($email, FILTER_VALIDATE_EMAIL);

        // Jika filter_var mengembalikan nilai yang bukan false, email valid
        if ($valid_email !== false) {
            return $email;
        } else {
            result_json('error', '400', 'Email tidak valid');
        }
    }
}
