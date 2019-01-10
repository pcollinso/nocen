<?php

namespace App\Utils;

class Passcode
{
  public static function hashPassword($pass){
    return md5(md5(sha1(sha1(md5($pass)))));
  }

  public static function checkPassword($plain, $hash) {
    return $hash === static::hashPassword($plain);
  }
}
