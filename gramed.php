<?php
error_reporting(0);
function putreq($url, $data, $headers)
{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
    curl_setopt($curl, CURLOPT_ENCODING, '');
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    return curl_exec($curl);
}

function save($filename, $email)
{
    $save = fopen($filename, "a");
    fputs($save, "$email");
    fclose($save);
}

function get($url, $headers, $put = null)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    if ($put) :
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    endif;
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if ($headers) :
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    endif;
    curl_setopt($ch, CURLOPT_ENCODING, "GZIP");
    return curl_exec($ch);
}


function request1($url, $headers, $put = null)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    if ($put) :
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    endif;
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if ($headers) :
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    endif;
    curl_setopt($ch, CURLOPT_ENCODING, "GZIP");
    return curl_exec($ch);
}

function request($url, $data, $headers, $put = null)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    if ($put) :
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    endif;
    if ($data) :
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
    endif;
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if ($headers) :
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    endif;
    curl_setopt($ch, CURLOPT_ENCODING, "GZIP");
    return curl_exec($ch);
}

function regis($email, $nope, $fname, $lname)
{
    $url = "https://auth.myvalue.id/v1/user/";
    $data = '{"email":"' . $email . '","password":"viola331","mobilePhoneNumber":"' . $nope . '","mobilePhonePrefix":"+62","firstName":"' . $fname . '","lastName":"' . $lname . '","clientID":"MyValueWeb","redirect_uri":"https://www.myvalue.id/redirect","outletID":"10111"}';
    $headers = array();
    $headers[] = "Host: auth.myvalue.id";
    $headers[] = "Cookie: client=%7B%22client_id%22%3A%22MyValueWeb%22%2C%22redirect_uri%22%3A%22https%3A%2F%2Fwww.myvalue.id%2Fredirect%22%2C%22state%22%3A%22eNjUv67yihvE0%22%2C%22isThirdParty%22%3Afalse%7D; G_ENABLED_IDPS=google; auth_token=%7B%22access_token%22%3A%22tRumn_EEUWJM61aivf4LROP3K5C6HMzNWfT4CNlZc9s.SNtkkqGmF38hHxwfO6N9VJboVCn-P-L2rW67vEan_QA%22%2C%22refresh_token%22%3A%22uLm1FDw7t68-DKpVBgkbaAMNw4xh41KcgIAQQhVQwr0.5lffLG_CRgVcrkXeXA5rSDvBzTCu0ji3OOp4IC3gNIQ%22%2C%22token_type%22%3A%22bearer%22%2C%22expires_in%22%3A86400%2C%22refresh_expires_in%22%3A31622400%2C%22id_token%22%3A%22%22%2C%22not_before_policy%22%3A0%2C%22session_state%22%3A%22%22%2C%22expired%22%3A1657452756298%7D";
    $headers[] = 'Sec-Ch-Ua: ".Not/A)Brand";v="99", "Google Chrome";v="103", "Chromium";v="103"';
    $headers[] = "Accept: application/json, text/plain, */*";
    $headers[] = "Content-Type: application/json";
    $headers[] = "Sec-Ch-Ua-Mobile: ?0";
    $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36";
    $headers[] = 'Sec-Ch-Ua-Platform: "Windows"';
    $headers[] = "Origin: https://auth.myvalue.id";
    $headers[] = "Accept-Encoding: gzip, deflate";
    $headers[] = "Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7";
    $getotp = request($url, $data, $headers);
    $json = json_decode($getotp, true);
    $a = $json['enabled'];
    if ($a == true) {
        $kgid = $json['kgValueID'];
        return $kgid;
    } else {
        echo "gagal";
    }

    //var_dump($json);
}

function gettoken($email)
{
    $url = "https://auth.myvalue.id/v1/auth/token/";
    $data = '{"client_secret":"1750806f-06d4-4653-a58f-02981f855e98","client_id":"ValueID","grant_type":"password","username":"' . $email . '","password":"viola331"}';
    $headers = array();
    $headers[] = "Host: auth.myvalue.id";
    $headers[] = "Cookie: _ga=GA1.2.1323164393.1657452904; _gid=GA1.2.1235521816.1657452904; _fbp=fb.1.1657452904449.1464358466; client=%7B%22client_id%22%3A%22MyValueWeb%22%2C%22redirect_uri%22%3A%22https%3A%2F%2Fwww.myvalue.id%2Fredirect%22%2C%22state%22%3A%22eNjUv67yihvE0%22%2C%22isThirdParty%22%3Afalse%7D; G_ENABLED_IDPS=google";
    $headers[] = 'Sec-Ch-Ua: ".Not/A)Brand";v="99", "Google Chrome";v="103", "Chromium";v="103"';
    $headers[] = "Accept: application/json, text/plain, */*";
    $headers[] = "Content-Type: application/json";
    $headers[] = "Sec-Ch-Ua-Mobile: ?0";
    $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36";
    $headers[] = 'Sec-Ch-Ua-Platform: "Windows"';
    $headers[] = "Origin: https://auth.myvalue.id";
    $headers[] = "Accept-Encoding: gzip, deflate";
    $headers[] = "Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7";
    $getotp = request($url, $data, $headers);
    $json = json_decode($getotp, true);
    $a = $json['access_token'];
    if ($a == null) {
        return array(false);
    } else {
        return array(true, $a);
    }
}

function sendotp($email, $token)
{
    $url = "https://auth.myvalue.id/v1/user/email/otp/";
    $data = '{"email":"' . $email . '","template":"myvalue"}';
    $headers = array();
    $headers[] = "Host: auth.myvalue.id";
    $headers[] = "Accept: application/json, text/plain, */*";
    $headers[] = "Content-Type: application/json";
    $headers[] = "Authorization: Bearer $token";
    $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36";
    $headers[] = 'Sec-Ch-Ua-Platform: "Windows"';
    $headers[] = "Origin: https://auth.myvalue.id";
    $headers[] = "Referer: https://auth.myvalue.id/authorize/set_email";
    $headers[] = "Accept-Encoding: gzip, deflate";
    $headers[] = "Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7";
    $getotp = request($url, $data, $headers);
    $json = json_decode($getotp, true);
    $a = $json['errorCode'];
    if ($a == "401") {
        return false;
    } else {
        return true;
    }
}

function verifotp($email, $otp, $token)
{
    $url = "https://auth.myvalue.id/v1/user/email/";
    $data = '{"email":"' . $email . '","code":"' . $otp . '"}';
    $headers = array();
    $headers[] = "Host: auth.myvalue.id";
    $headers[] = "Accept: application/json, text/plain, */*";
    $headers[] = "Content-Type: application/json";
    $headers[] = "Authorization: Bearer $token";
    $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36";
    $headers[] = 'Sec-Ch-Ua-Platform: "Windows"';
    $headers[] = "Origin: https://auth.myvalue.id";
    $headers[] = "Referer: https://auth.myvalue.id/authorize/set_email";
    $headers[] = "Accept-Encoding: gzip, deflate";
    $headers[] = "Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7";
    $getotp = putreq($url, $data, $headers);
    $json = json_decode($getotp, true);
    $a = $json['emailVerified'];
    if ($a == true) {
        return true;
    } else {
        return false;
    }
}

function createmail($email)
{
    $url = "https://api.internal.temp-mail.io/api/v3/email/new";
    $data = '{"name":"' . $email . '","domain":"coooooool.com"}';
    $headers = array();
    $headers[] = "Host: api.internal.temp-mail.io";
    $headers[] = "Connection: close";
    $headers[] = "Accept: application/json, text/plain, */*";
    $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.97 Safari/537.36";
    $headers[] = "Content-Type: application/json;charset=UTF-8";
    $headers[] = "Origin: https://temp-mail.io";
    $headers[] = "Sec-Fetch-Site: same-site";
    $headers[] = "Sec-Fetch-Mode: cors";
    $headers[] = "Sec-Fetch-Dest: empty";
    $headers[] = "Referer: https://temp-mail.io/en";
    $headers[] = "Accept-Encoding: gzip, deflate";
    $headers[] = "Accept-Language: en-US,en;q=0.9";
    $headers[] = "Referer: https://m.tokopedia.com/register?ld=";
    $headers[] = "Accept-Encoding: gzip, deflate";
    $headers[] = "Accept-Language: en-US,en;q=0.9";
    $headers[] = "Cookie: __cfduid=d38828fa7a1bd1b084014560fbb0369131591295947; _ga=GA1.2.1284780574.1591295957; _gid=GA1.2.73843276.1591295957; __gads=ID=60fa90a69e6b97d4:T=1591295968:S=ALNI_MaH-5WX-f0vB2fECQbdiATHHok4Sw";


    $getotp = request($url, $data, $headers);
    $json = json_decode($getotp, true);

    //var_dump($json);

    if (strpos($getotp, "$email")) {
        return array(true, "$email@coooooool.com");
    } else {
        echo "gagal bikin email\n";
    }
}



function verivemail($email)
{
    $url = "https://api.internal.temp-mail.io/api/v3/email/$email/messages";
    $headers = array();
    $headers[] = "Host: api.internal.temp-mail.io";
    $headers[] = "Connection: close";
    //$headers [] = "Content-Length: 399";
    $headers[] = "Accept: application/json, text/plain, */*";
    $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36";
    $headers[] = "Origin: https://temp-mail.io";
    $headers[] = "Sec-Fetch-Site: same-site";
    $headers[] = "Sec-Fetch-Mode: cors";
    $headers[] = "Sec-Fetch-Dest: empty";
    $headers[] = "Referer: https://temp-mail.io/en";
    $headers[] = "Accept-Encoding: gzip, deflate";
    $headers[] = "Accept-Language: en-US,en;q=0.9";


    $getotp = get($url, $headers);
    $json = json_decode($getotp);
    $cari = strpos($getotp, "no-reply@spotify.com");
    $sub_kal = substr($getotp, $cari);
    $cari2 = strpos($sub_kal, 'https://wl.spotify.com/ls/click?upn=');
    //$bner = $cari2 - 213 - 35;
    $output = substr($sub_kal, $cari2, 1000);
    $cari3 = strpos($output, ' )\n\n#');
    $output2 = substr($sub_kal, $cari2, $cari3);

    //echo "$output2\n";
    $a = get_between($getotp, "Berikut ini token update email Anda:", "Copyright © 2018 MyValue");
    $str = str_replace("n", "", $a);
    $str1 = str_replace('\\', "", $str);
    //var_dump($a);
    if ($a == "") {
        return array(false, $str1);
    } else {
        return array(true, $str1);
    }
}

function nope()
{
    $nope1 = rand(0, 9);
    $nope2 = rand(0, 9);
    $nope3 = rand(0, 9);
    $nope4 = rand(0, 9);
    $nope5 = rand(0, 9);
    $nope6 = rand(0, 9);
    $nope7 = rand(0, 9);
    $nope8 = rand(0, 9);
    $nope9 = rand(0, 9);
    $nope10 = rand(0, 9);
    $nope = "+6289$nope1$nope2$nope3$nope4$nope5$nope6$nope7$nope8$nope9$nope10";
    return $nope;
}

function get_between($string, $start, $end)
{
    $string = " " . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

/*
echo "MAU BRP: ";
$brp = trim(fgets(STDIN));

for ($i = 0; $i < $brp; $i++) {
    $fgcnama = file_get_contents("bahannama.txt");
    $hslnama = explode("\n", str_replace("\r", "", $fgcnama));
    $count = count($hslnama);

    $b = rand(0, 9999999);
    $anama = $hslnama[rand(0, $count)];
    $bnama = $hslnama[rand(0, $count)];
    $fullnama = "$anama $bnama";
    $hsl2 = str_replace(" ", "", $fullnama);
    $sub = substr($hsl2, 0, 15);
    $kcl  = strtolower($sub);
    $kcl2 = "$kcl";
    $mail2 = "$kcl2$b@gmail.com";
    $nope = nope();
    regis($mail2, $nope, $anama, $bnama, $i);
}

*/

//createmail("mabokhela");
//verivemail("mabokhela@coooooool.com");
//gettoken("ikbalnurhakim6@gmail.com");
//verifotp();

echo "MAU BRP: ";
$brp = trim(fgets(STDIN));
$total = 1;

ulang:
if ($total <= $brp) {
    $fgcnama = file_get_contents("bahannama.txt");
    $hslnama = explode("\n", str_replace("\r", "", $fgcnama));
    $count = count($hslnama);

    $b = rand(0, 9999999);
    $anama = $hslnama[rand(0, $count)];
    $bnama = $hslnama[rand(0, $count)];
    $fullnama = "$anama $bnama";
    $hsl2 = str_replace(" ", "", $fullnama);
    $sub = substr($hsl2, 0, 15);
    $kcl  = strtolower($sub);
    $kcl2 = "$kcl";
    $mail2 = "$kcl2$b@gmail.com";
    $nope = nope();
    $kgid = regis($mail2, $nope, $anama, $bnama, $i);
    $createmail = createmail("$kcl2$b");
    if ($createmail[0] == true) {
        // echo "Berhasil membuat email temp => $createmail[1]\n";
        $gettoken = gettoken($mail2);
        if ($gettoken[0] == true) {
            $token = $gettoken[1];
            // echo "Berhasil Mengambil token => $token\n";
            $sendotp = sendotp($createmail[1], $token);
            if ($sendotp == true) {
                //echo "Berhasil kirim otp ke email \n";
                ulangotp:
                if ($ulangotp <= 10) {
                    $verivemail = verivemail($createmail[1]);
                    if ($verivemail[0] == true) {
                        $otp = $verivemail[1];
                        $verifotp = verifotp($createmail[1], $otp, $token);
                        if ($verifotp == true) {
                            echo "$total. Berhasil => $anama $bnama | $nope | $kgid\n";
                            echo "\n";
                            $result = "$anama $bnama | $nope | $createmail[1] | $kgid \n";
                            save("hasil.txt", $result);
                            $total = $total + 1;
                            goto ulang;
                        }
                    } else {
                        sleep(2);
                        //echo "Tidak berhasil dapet otp \n";
                        $ulangotp = $ulangotp + 1;
                        goto ulangotp;
                    }
                } else {
                    echo "Ulang dari awal";
                    goto ulang;
                }
            } else {
                echo "Gagal kirim otp ke email \n";
            }
        } else {
            echo "Gagal mengambil token \n";
        }
    } else {
        echo "Gagagl bikin email temp \n";
    }
} else {
    echo "selesai";
}
