<?php 

namespace App\Lib;

class CommonHelpers
{
    public static function newFeedback($title = 'عملیات موفقیت آمیز', $body = 'عملیات با موفقیت انجام شد', $type = 'success'){
        $session = session()->has('feedbacks') ? session()->get('feedbacks') : [];
        $session[] = ['title' => $title, "body"=>  $body, "type" => $type];
        session()->now('feedbacks', $session);
    }
}