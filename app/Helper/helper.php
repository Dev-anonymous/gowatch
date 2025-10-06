<?php

use App\Models\HttpToken;

function encode($str, $encrypt = true)
{
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = '781227';
    $secret_iv = '2002';
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($encrypt == true) {
        $output = openssl_encrypt($str, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else {
        $output = openssl_decrypt(base64_decode($str), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

function nnow()
{
    return now('Africa/Lubumbashi');
}


function makeRand($max = 5)
{
    $max = (int) $max;
    if (!$max or $max <= 0) {
        return 0;
    }

    $num = '';
    while ($max > 0) {
        $max--;
        $num .= rand(1, 9);
    }
    while (1) {
        $el = HttpToken::where('token', $num)->first();
        if ($el) {
            return makeRand($max);
        } else {
            break;
        }
    }
    return $num;
}


//////////////////////////

function fcmtoken()
{
    $credentialsFilePath =  [
        "type" => "service_account",
        "project_id" => "docta-2907c",
        "private_key_id" => "a5c0aeb7de7c7a9b47749b9fdc0eccf4334fa521",
        "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCz4gWSLTbQIhcj\nSzMZUHucYNJ6pKNjU8YnjLkei3sZ6FaNhaR76AiMHE5Hl1VLXHWYciYFOUkvizSE\nzjRNT8UO4c0vHPqa1szKBYU0wFaL8HaYbPe2HK6vbERVlP/4LXCOd4mv6TiS/++p\nSlWEdJXdDZxtukTyDeHJ/XsK31ePhNN7MLMdCvPWxwBE0D/72rIBKo8fXdAbBQbC\nrqVaPUaxghNoiiJXkJ6JcIw0Xzx8xGKf/o/Q4eIAymuCZ+OxJjck2TjPQ+TCGsPq\nzKcRgR/gEQu2mWwKhiTOFIerJ2j4RbvsxazJLq7cX3r6z+RTUz1GhW9FDr1MCJjq\nkv/k2Ky/AgMBAAECggEANNE5x4kFHinUV2WeNGGgWfNH+gDbhK+1cClutZxI4fuJ\nZnaGLGeeEt3A0l6KCd21HbTumvwOFCqwmgod61Fv0AXXBG1i3BIUAYGLckjDYMWT\nXQAp38weMp38lpBwdEOLWBmbUQ6OsQL7MN8FqyW8VzLG6qUV12jiEjgeZ7vabuYX\n0bIU0TdRbivJh/4SDtns0eZ4QaRIPWcA2l2+sU6MrHEfg4QvKEAdkqQDmqMEND3O\nPd8Pg31uH7c4EuFFN5ouWFwYSBFBxBcsYrydcVKUl03VafE9RVTQu3g3mdCmxpVE\nKWj/warIlXDiM06W7516189Ccwyw3OLXVT98F1OOcQKBgQDrNYCKGQyE9R67Baa1\ndHW+xFOtd1A9jVUvgf4OQD8Twi2iATUYVTwwgF0bQ6E52RrIOgz8yImmUcs8SKdf\n1rwyg/q7+bGYr9VxbSlZnIfpSeE2Sfd7+/PCYbhUycK0+uk7eFiHJ66m16zJK0Bx\nV2co4SIAaK4nTpPmB7uauZkAeQKBgQDDyI5tzeL3TYGWd79daulkKREEDtQ49VTe\nKmX/G6BGt6TZpEQzfz8UerGTu9o3RymyS7EWQ8JOsUD8kHyLxT4vAZtIbfFrb74E\n1taPB+koMZtADiD70q2aR/L0GcHR62an4KKcmHW3vedXaSOiULoJ+bwcaiofU//T\nA1FYHuT49wKBgQDam0RXlcZkAKpKKotyFMamwjP/gmgqfSRSXmAxAJdfltbwvmyJ\nrBagAX4HrAi6CkVxGTse6oe89EKPSft+AMezr6SndwAQKESaAlovNmO/eHIAEikZ\nq+c3n7lB3K/Bo36ITmcBXuldmhC2fCON9C0l+nCurpxGXirp3gAIYz2ICQKBgQCj\n16oCEEO5i/4/qrTV+8uXi5p21+YYSI8eYUL8S+VEaRknHgYJRprGi6siJBoJGp+1\nWwy2wjvQ2Ru2gUAJRCa29dQ6t+9KZrgRmqzyA7/GaEUxROGrfHLV4xJZ31hJUYOW\nSDItdJVHEECS8STmCEK4aGtZKCtaDlTQBT3Ezg32nwKBgGbs4R3mRbfDP1y9PkMX\neAi+4OzLHg0ttSCO2iZ4LrtOeHoNGbGAmvUJTTQafZJJFdS8DkvhJvhcYr//SKJ1\n2gZHgupBs+sDnyYwunwYwlB7LD926lIyBLm3tPWhJAjWvUb5b0vw3LNor0M1kv2B\n3CXq0MCLZsKKiEqXlKNbnAwr\n-----END PRIVATE KEY-----\n",
        "client_email" => "firebase-adminsdk-evcpg@docta-2907c.iam.gserviceaccount.com",
        "client_id" => "114909768922999544957",
        "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
        "token_uri" => "https://oauth2.googleapis.com/token",
        "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
        "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-evcpg%40docta-2907c.iam.gserviceaccount.com",
        "universe_domain" => "googleapis.com"
    ];

    $client = new Google_Client();
    $client->setAuthConfig($credentialsFilePath);
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    $client->refreshTokenWithAssertion();
    $token = $client->getAccessToken();
    return $token['access_token'];
}
function sendMessage($token, $payload = "")
{
    if (!$token) {
        return false;
    }
    $apiurl = 'https://fcm.googleapis.com/v1/projects/docta-2907c/messages:send';
    $headers = [
        'Authorization: Bearer ' . fcmtoken(),
        'Content-Type: application/json'
    ];

    $message = [
        'message' => [
            'token' => $token,
            'data' => [
                'data' => $payload
            ],
            "android" => [
                "priority" => "HIGH"
            ]
        ],
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiurl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
    $result = curl_exec($ch);

    $ok = false;
    if ($result === FALSE) {
        // die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
    try {
        $result = json_decode($result);
        $mess = @$result?->error?->message;
        if ('Android message is too big' == $mess) {
            return 0;
        }
        // dd($result, $token, $title, $body, $payload);
        $ok = (bool) @$result->name;
        // dd($result);
    } catch (\Throwable $th) {
        // throw $th;
    }
    return $ok;
}

function secIntime(int $seconds): string
{
    if (!$seconds) return '-';
    $minutes = floor($seconds / 60);
    $remainingSeconds = $seconds % 60;
    return sprintf("%d:%02d sec", $minutes, $remainingSeconds);
}

function callIcon($type)
{
    if ($type == 'Manqué') {
        return "<span  title='Appel $type'><i class='fas fa-phone-slash text-danger'></i> $type<span/>";
    }
    if ($type == 'Sortant') {
        return "<span  title='Appel $type'><i class='fas fa-arrow-up text-info'></i> $type<span/>";
    }
    if ($type == 'Entrant') {
        return "<span  title='Appel $type'><i class='fas fa-arrow-down text-success'></i> $type<span/>";
    }
    if ($type == 'Rejeté') {
        return "<span  title='Appel $type'><i class='fas fa-ban text-danger'></i> $type<span/>";
    }

    return $type;
}
