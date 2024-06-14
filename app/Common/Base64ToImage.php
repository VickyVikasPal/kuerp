<?php
namespace App\Common;
use Illuminate\Support\Facades\Validator;

class Base64ToImage
{

    public static function base64ToImage($base64_string, $output_file, $upload_path = '')
    {
        if ($upload_path!='') {
            if (!is_dir(public_path($upload_path))) {
                mkdir(public_path($upload_path), 0775, true);
            }
            $mk_file = public_path($upload_path . '/' . $output_file);
        }
        else {
            $file_year = date("Y");
            $file_month = date("m");
            $mk_file = 'error.jpeg';
            if (is_dir(public_path('uploads/' . $file_year))) {

                if (is_dir(public_path('uploads/' . $file_year . '/' . $file_month))) {
                    $mk_file = public_path('uploads/' . $file_year . '/' . $file_month . '/' . $output_file);
                }
                else {
                    public_path(mkdir('uploads/' . $file_year . '/' . $file_month));
                    $mk_file = public_path('uploads/' . $file_year . '/' . $file_month . '/' . $output_file);
                }

            }
            else {
                public_path(mkdir('uploads/' . $file_year));
                if (is_dir(public_path('uploads/' . $file_year . '/' . $file_month))) {
                    $mk_file = public_path('uploads/' . $file_year . '/' . $file_month . '/' . $output_file);
                }
                else {
                    public_path(mkdir('uploads/' . $file_year . '/' . $file_month));
                    $mk_file = public_path('uploads/' . $file_year . '/' . $file_month . '/' . $output_file);
                }
            }
        }

        $imgData = str_replace(' ', '+', $base64_string);
        $imgData = substr($imgData, strpos($imgData, ",") + 1);
        $imgData = base64_decode($imgData);
        $file = fopen($mk_file, "w");
        fwrite($file, $imgData);
        fclose($file);
        return $output_file;
    }
    public static function isBase64($code)
    {      
        // Check if the string starts with 'data:image' indicating it is a data URL
        if (strpos($code, 'data:code') !== 0) {
            return false;
        }

        // Remove the data URL prefix to extract the base64-encoded code content
        $base64Content = substr($code, strpos($code, ',') + 1);

        // Decode the base64-encoded content and check if it is a valid image
        $decodedImage = base64_decode($base64Content, true);

        if ($decodedImage === false) {
            return false;
        }

        $imageInfo = getimagesizefromstring($decodedImage);

        return $imageInfo !== false;
    }

}