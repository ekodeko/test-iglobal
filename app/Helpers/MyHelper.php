<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;
use Image;

class MyHelper
{
    public static function setMessage($title = null, $type = null, $message = null)
    {
        if ($title && $type && $message) {
            return Session::flash('GLOBAL_MESSAGE', [
                'title' => $title,
                'type' => $type,
                'message' => $message,
            ]);
        }
    }
    public static function generateOriginalProductCode($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }
    public static function formatDateToDb($date)
    {
        $date_array = explode('-', $date);
        $year = trim($date_array[2]);
        $month = trim($date_array[1]);
        $day = trim($date_array[0]);
        $hours = $date_array[3];
        $date_to_db = date_create("$year-$month-$day $hours");
        return date_format($date_to_db, 'Y-m-d H:i:s');
    }
    public static function getUploadImageErrorMessage()
    {
        $message = [
            'max'   => 'Ukuran gambar tidak boleh lebih dari 512kb',
            'image' => 'File harus berupa Gambar',
            'mime'  => 'Format gambar harus JPG, JPEG Atau PNG'
        ];
        return $message;
    }
    public static function createThumbnail($path, $name, $width, $height)
    {
        $img = Image::make($path . '/' . $name)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path . '/thumb/' . $name);
    }
}
