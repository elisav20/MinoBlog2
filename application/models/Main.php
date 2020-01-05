<?php

namespace application\models;

use application\core\Model;

class Main extends Model {

    public $error;

    public function contactValidate($_post) {
        $nameLen = iconv_strlen($_POST['contact-name']);
        $subjectLen = iconv_strlen($_POST['contact-subject']);
        $textLen = iconv_strlen($_POST['contact-message']);
        if ($nameLen < 3 or $nameLen > 20) {
            $this->error = 'The name must contain from 3 to 20 characters.';
            return false;
        } elseif (!filter_var($_POST['contact-email'], FILTER_VALIDATE_EMAIL)) {
            $this->error = 'Incorect Email adress';
            return false;
        } elseif ($subjectLen < 3 or $subjectLen > 50) {
            $this->error = 'The subject must contain from 3 to 50 characters.';
            return false;
        } elseif ($textLen < 10 or $textLen > 500) {
            $this->error = 'The message must contain from 10 to 500 characters.';
            return false;
        }
        return true;
    }
}

?>