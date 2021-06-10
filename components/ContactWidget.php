<?php

namespace app\components;


use app\models\Contact;
use yii\base\Widget;

class ContactWidget extends Widget {

    public $tpl;

    public function init(){
        parent::init();
        if( $this->tpl === null ){
            $this->tpl = 'top';
        }
        $this->tpl .= '.php';
    }

    public function run(){
        $contact = Contact::findOne(1);

        $phones = json_decode($contact->phone);
        $emails = json_decode($contact->email);

        ob_start();
        include __DIR__ . '/contact_tpl/' . $this->tpl;
        return ob_get_clean();
    }

}