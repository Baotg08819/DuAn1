<?php

namespace App\Helpers;

class NotificationHelper{
    public static function success($key, $message){
        $_SESSION['success'][$key] = $message;
    }

    public static function error($key, $message){
        $_SESSION['error'][$key] = $message;
    }
    

    public static function unset(){
        unset($_SESSION['success']);
        unset($_SESSION['error']);
    }
    public static function get()
    {
        if (isset($_SESSION['notification'])) {
            $notification = $_SESSION['notification'];
            unset($_SESSION['notification']);
            return $notification;
        }
        return null;
    }
    public static function set($type, $message)
    {
        $_SESSION['notification'] = [
            'type' => $type,
            'message' => $message
        ];
    }
    public static function render()
    {
        $notification = self::get();
        if ($notification) {
            $type = $notification['type'];
            $message = $notification['message'];
            $class = 'alert alert-' . $type;
            echo "<div class='$class'>$message</div>";
        }
    }
    public static function renderJS()
    {
        $notification = self::get();
        if ($notification) {
            $type = $notification['type'];
            $message = $notification['message'];
            echo "<script>alert('$message')</script>";
        }
    }
}