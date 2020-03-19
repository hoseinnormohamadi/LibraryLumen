<?php


namespace App\Utils;


use function Composer\Autoload\includeFile;

class CurlHelper
{
    public static function Curl(string $Url, string $Api_Token = null, array $Data = null, string $Method = 'GET')
    {
        //POST && PUT Header For Curl
        $POSTHeader = array(
            "Accept: application/json",
            "Content-Type: application/json",
        );
        $PUTHeader = array(
            "Accept: application/json",
        );
        if ($Method == 'POST' && !empty($Data) && trim($Url) != null && trim($Url) != "") {
            $Data_String = json_encode($Data);
            return self::MakeCurl($Url, $Method, $Api_Token, $POSTHeader, $Data_String);
        } elseif ($Method == 'GET' && trim($Url) != null && trim($Url) != "") {
            return self::MakeCurl($Url, $Method, $Api_Token);
        } elseif ($Method == 'PUT' && !empty($Data) && trim($Url) != null && trim($Url) != "") {
            $Data_String = http_build_query($Data);
            return self::MakeCurl($Url, $Method, $Api_Token, $PUTHeader, $Data_String);
        }elseif ($Method == 'FILE' && !empty($Data) && trim($Url) != null && trim($Url) != "") {
            return self::MakeCurl($Url, $Method, $Api_Token, $PUTHeader, $Data);
        }
    }

    public static function MakeCurl($Url, $Mode, $Api_Token = null, $Header = null, $Data = null)
    {

        $Setting = array(
            CURLOPT_URL => $Url . $Api_Token,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_CUSTOMREQUEST => $Mode,
        );
        if ($Mode == 'POST' || $Mode == 'PUT')
        {
            $Setting[CURLOPT_POSTFIELDS] = $Data;
            $Setting[CURLOPT_HTTPHEADER] = $Header;
        }elseif ($Mode == 'FILE'){
            $Setting[CURLOPT_CUSTOMREQUEST] = 'POST';
            $Setting[CURLOPT_POSTFIELDS] = $Data;
        }
        $curl = curl_init();
        curl_setopt_array($curl, $Setting);
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }
}