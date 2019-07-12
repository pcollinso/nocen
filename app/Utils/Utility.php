<?php

namespace App\Utils;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Log;

class Utility
{

    public static function hashString($pass){
        return md5(md5(sha1(sha1(md5($pass)))));
    }

    public static function getConvertImage($params) {
        return Image::make(urldecode($params['file_path']))->resize($params['width'], $params['height'])->encode($params['format'], $params['quality'])->save($params['save_path']) ? true : false;
    }

    public static function getStoredImage($name, $env_path){
        $obj_url = asset(env($env_path).$name);
        $obj_path = public_path((env($env_path).$name));
        $img = File::exists($obj_path.'.jpg') ? $obj_url.'.jpg' : (File::exists($obj_path.'.png') ? $obj_url.'.png' : asset(env($env_path).'null.png'));
        return $img;
    }

    public static function make_get_request($url, $headers = [])
    {
        return self::make_request(['url' => $url, 'headers' => $headers, 'method' => 'GET']);
    }

    public static function make_post_request($params, $url, $headers)
    {
        return self::make_request(['body' => $params, 'url' => $url, 'headers' => $headers, 'method' => 'POST']);
    }

    public static function make_request(array $params)
    {
        $args = [
            CURLOPT_URL => $params['url'],
            CURLOPT_RETURNTRANSFER => true
        ];
        if ($params['method'] != 'GET') $args[CURLOPT_CUSTOMREQUEST] = $params['method'];
        if (! empty($params['body'])) $args[CURLOPT_POSTFIELDS] = json_encode($params['body']);
        if (count($params['headers'])) $args[CURLOPT_HTTPHEADER] = $params['headers'];
        try
        {
            $ch = curl_init();
            curl_setopt_array($ch, $args);
            $response = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            Log::info("{$params['method']} {$params['url']} returned HTTP code: $httpcode");
            curl_close($ch);
            return $response;
        } catch(Exception $e) {
            Log::info("{$params['method']} {$params['url']} request error: {$e->getTraceAsString()}");
            return 'ERROR';
        }
    }

    public static function parseValidatorErrors($errors) {
        $d = "<ul class=\"alert alert-warning\">";
        foreach ($errors as $err){
            $d .= "<li>".$err[0]."</li>";
        }
        $d .= "</ul>";
        return $d;
    }

    public static function parseErrorArray($errors) {
        $d = "<ul class=\"alert alert-warning\" style=\"list-style-type: none\">";
        foreach ($errors as $err){
            $d .= "<li>".$err."</li>";
        }
        $d .= "</ul>";
        return $d;
    }

    public static function hashedStringMatch($plain, $hash) {
        return $hash === static::hashString($plain);
    }


    public static function getTP($p) {
        return self::pauline($p);
    }

    public static function generatePassword(array $data)
    {
        if(!isset($data['password']))
        {
            $defaultPassword = Str::random(10);
            $userStr = "(email: {$data['email']}, phone: {$data['phone']})";
            Log::warning("Assigned '$defaultPassword' as default password to $userStr");
            return self::makePassword($defaultPassword);
        }
        return false;
    }

    public static function makePassword($password = 'Password')
    {
        return array('password' => $password, 'temp_password' => self::paul($password), 'plain_password' => $password, 'laravel_encrypted' => Hash::make($password));
    }

    public static function paul($data)
    {
        $first_key = base64_decode(env("FIRSTKEY", ""));
        $second_key = base64_decode(env("SECONDKEY", ""));
        $method = "aes-256-cbc";
        $iv_length = openssl_cipher_iv_length($method);
        $iv = openssl_random_pseudo_bytes($iv_length);
        $first_encrypted = openssl_encrypt($data,$method,$first_key, OPENSSL_RAW_DATA ,$iv);
        $second_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);
        $output = base64_encode($iv.$second_encrypted.$first_encrypted);
        return $output;
    }
    public static function pauline($input)
    {
        $first_key = base64_decode(env("FIRSTKEY", ""));
        $second_key = base64_decode(env("SECONDKEY", ""));
        $mix = base64_decode($input);
        $method = "aes-256-cbc";
        $iv_length = openssl_cipher_iv_length($method);
        $iv = substr($mix,0,$iv_length);
        $second_encrypted = substr($mix,$iv_length,64);
        $first_encrypted = substr($mix,$iv_length+64);
        $data = openssl_decrypt($first_encrypted,$method,$first_key,OPENSSL_RAW_DATA,$iv);
        $second_encrypted_new = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);
        if (hash_equals($second_encrypted,$second_encrypted_new))
            return $data;
        return false;
    }

    public static function time_tomysql($a){
        $b=strftime('%Y-%m-%d %H:%M:%S',$a);
        //$b=strftime('%Y-%m-%d %I:%M:%S',$a);
        return $b;
    }

    public static function remove_from_array($haystack,$needle,$criteria){
        $d=array_intersect($haystack,!is_array($needle) ? array($needle) : $needle);
        $e=array_diff($haystack,$d);
        return array('new_array'=>$e,'removed_item'=>$d);
    }

    public static function remove_special_chars($names){
        $names=str_replace("'","",$names);
        $names=str_replace("("," ",$names);
        $names=str_replace(")"," ",$names);
        $names=str_replace(",","",$names);
        $names=str_replace("/","",$names);
        $names=str_replace("$","",$names);
        $names=str_replace("%","",$names);
        $names=str_replace(".","",$names);
        $names=str_replace("!","",$names);
        $names=str_replace("`","",$names);
        $names=str_replace("&","AND",$names);
        $names=str_replace('"',"",$names);
        $names=str_replace("?","",$names);
        $names=str_replace(">","",$names);
        $names=str_replace("<","",$names);
        $names=str_replace("=","",$names);
        $names=str_replace("|","",$names);
        $names=str_replace("#","",$names);
        return $names;
    }

    public static function is_time_tomysql($date){
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
            return true;
        } else {
            return false;
        }
    }

    public static function contains($needle, $haystack)
    {
        return strpos($haystack, $needle) !== false;
    }

    public static function resemble($in, $text){
        if(strnatcasecmp($in,$text)==0){
            return true;
        }else{
            return false;
        }
    }

    public static function hours_to_date($hours){
        $secs=$hours*60*60;
        $tim=time()+$secs;
        $date = strftime('%Y-%m-%d %I:%M:%S', $tim);
        return $date;
    }

    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters2 = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function generateRandomCharUpper($length = 10) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function generateRandomCharUpperLower($length = 10) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function generateRandomNumber($length = 12) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function ping($host, $port, $timeout) {
        $tB = microtime(true);
        $fP = @fSockOpen($host, $port, $timeout);
        if (!$fP) {
            return false;
        }
        $tA = microtime(true);
        return round((($tA - $tB) * 1000), 0)." ms";
    }

    public static function url_is_reachable($host, $port=80, $timeout=20)
    {
        $tB = microtime(true);
        $fP = @fSockOpen($host, $port, $timeout);
        if (!$fP || is_null($host) || empty($host)) {
            $opts = array(
                'http'=>array(
                    'method'=>"GET",
                    'header'=>"Accept-language: en\r\n"
                )
            );
            $context = stream_context_create($opts);
            $file = @file_get_contents($host, false, $context);
            if(!$file){
                return false;
            }
        }
        $tA = microtime(true);
        return round((($tA - $tB) * 1000), 0)." ms";
    }

    public static function respondOK($a)
    {

        if (is_callable('fastcgi_finish_request')) {
            session_write_close();
            if(!empty($a)){
                echo $a;
            }
            fastcgi_finish_request();
        }
        ignore_user_abort(true);
        ob_start();
        if(!empty($a)){
            echo $a;
        }
        $serverProtocole = filter_input(INPUT_SERVER, 'SERVER_PROTOCOL', FILTER_SANITIZE_STRING);
        header($serverProtocole.' 200 OK');
        header('Content-Encoding: none');
        header('Content-Length: '.ob_get_length());
        header('Connection: close');
        ob_end_flush();
        ob_flush();
        flush();
    }












}
