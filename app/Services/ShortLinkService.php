<?php


namespace App\Services;


class ShortLinkService
{
    private static $chars = "abcdfghjkmnpqrstvwxyzABCDFGHJKLMNPQRSTVWXYZ|0123456789";


    /**
     * @return string
     */
    public static function generateToken(): string
    {
        $arrChars = explode('|', self::$chars);
        $step = 4;
        $token = '';

        foreach ($arrChars as $set) {
            for ($i = 0; $i < $step; $i++) {
                $index = rand(0, strlen($set) - 1);
                $token .= $set[$index];
            }
        }
        $token = str_shuffle($token);

        return $token;
    }
}
