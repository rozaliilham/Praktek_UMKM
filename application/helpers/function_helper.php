<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function tanggal_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $split = explode('-', $tanggal);
    return $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
}

function filter($data)
{

    $filter = stripslashes(strip_tags(htmlspecialchars(htmlentities($data, ENT_QUOTES))));

    return $filter;
}

function acak($length)
{
    $str = "";
    $karakter = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
    $max_karakter = count($karakter) - 1;
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max_karakter);
        $str .= $karakter[$rand];
    }
    return $str;
}

function acak_nomor($length)
{
    $str = "";
    $karakter = array_merge(range('0', '9'));
    $max_karakter = count($karakter) - 1;
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max_karakter);
        $str .= $karakter[$rand];
    }
    return $str;
}

function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'Tahun',
        'm' => 'Bulan',
        'w' => 'Minggu',
        'd' => 'Hari',
        'h' => 'Jam',
        'i' => 'Menit',
        's' => 'Detik',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' Yang Lalu' : 'Baru Saja';
}

function get_client_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP')) {
        $ipaddress = getenv('HTTP_CLIENT_IP');
    } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    } elseif (getenv('HTTP_X_FORWARDED')) {
        $ipaddress = getenv('HTTP_X_FORWARDED');
    } elseif (getenv('HTTP_FORWARDED_FOR')) {
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    } elseif (getenv('HTTP_FORWARDED')) {
        $ipaddress = getenv('HTTP_FORWARDED');
    } elseif (getenv('REMOTE_ADDR')) {
        $ipaddress = getenv('REMOTE_ADDR');
    } else {
        $ipaddress = 'UNKNOWN';
    }
    return $ipaddress;
}

function validate_date($date)
{
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') == $date;
}

function infojson($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

function Show($tabel, $limit)
{
    global $conn;
    $CallData = mysqli_query($conn, "SELECT * FROM " . $tabel . " WHERE " . $limit);
    $ThisData = mysqli_fetch_assoc($CallData);
    return $ThisData;
}

function followers_count($data)
{
    $id = file_get_contents("https://instagram.com/web/search/topsearch/?query=" . $data);
    $id = json_decode($id, true);
    $count = $id['users'][0]['user']['follower_count'];
    return $count;
}

function likes_count($data)
{
    $id = file_get_contents("" . $data . "?&__a=1");
    $id = json_decode($id, true);
    $count = $id['graphql']['shortcode_media']['edge_media_preview_like']['count'];
    return $count;
}

function views_count($data)
{
    $id = file_get_contents("" . $data . "?&__a=1");
    $id = json_decode($id, true);
    $count = $id['graphql']['shortcode_media']['video_view_count'];
    return $count;
}

function enC($str)
{
    $kunci = '979a218e0632df2935317f98d47956c7';
    $hasil = '';
    for ($i = 0; $i < strlen($str); $i++) {
        $karakter = substr($str, $i, 1);
        $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
        $karakter = chr(ord($karakter) + ord($kuncikarakter));
        $hasil .= $karakter;
    }
    return urlencode(base64_encode($hasil));
}
function deC($str)
{
    $str = base64_decode(urldecode($str));
    $hasil = '';
    $kunci = '979a218e0632df2935317f98d47956c7';
    for ($i = 0; $i < strlen($str); $i++) {
        $karakter = substr($str, $i, 1);
        $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
        $karakter = chr(ord($karakter) - ord($kuncikarakter));
        $hasil .= $karakter;
    }
    return $hasil;
}
class JsonGetLayanan
{
    public $path;
    public function getSearchNumber($number, $kode = 0)
    {
        if ($kode == 0) {
            $kodeRequst = 'Operator';
        } elseif ($kode != 0) {
            $kodeRequst = $kode;
        }
        $number = $this->getOperator($number);
        $data = $this->getJson();
        $values = '';
        foreach ($data[$kodeRequst] as $key => $value) {
            $items = (string)array_search($number, $data[$kodeRequst][$key]);
            if ($items != null) {
                $values = $key;
                break;
            }
        }

        return $values;
    }
    public function getJson()
    {
        $sumber = $this->path;
        $konten = file_get_contents("assets/Jsn/jsn.json");
        $data = json_decode($konten, true);
        return $data;
    }
    public function setPathJson($path)
    {
        $this->path = $path;
    }
    public function getOperator($number)
    {
        $pecah = str_split($number);
        if ($pecah[0] == '6' && $pecah[1] == '2') {
            $number = '08' . $pecah[3] . $pecah[4];
        } else if ($pecah[0] == '+' && $pecah[1] == '6' && $pecah[2] == '2') {
            $number = '08' . $pecah[4] . $pecah[5];
        } else if ($pecah[0] == '0' && $pecah[1] == '8') {
            $number = substr($number, 0, 4);
        } else {
            return false;
        }
        return $number;
    }
    public function getImgLogo($ket)
    {
        $number = $this->getOperator($number);
        $data   = $this->getJson();
        return $data[$ket];
    }

    public function test()
    {
        return $konten = file_get_contents("assets/Jsn/jsn.json");
    }
}
