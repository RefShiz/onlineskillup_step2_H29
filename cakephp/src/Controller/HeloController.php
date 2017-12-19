<?php
namespace App\Controller;
 
use App\Controller\AppController;
 
class HeloController extends AppController
{
    #public function index()
    #{
    #    $id = $this->request->query('id');
    #    $name = $this->request->query('name');
    #    if ($id != null && $name != null) {
    #        $this->set('message', 'your id:' . $id . ', name:' . $name);
    #    }
    #    else{
    #        $this->set('message', 'please type...');
    #    }
    #}
    public function index() {
        $str = $this->request->data('text1');
        $msg = 'typed: ' . $str;
        if ($str == null) {
            $msg = "please type...";
        }
        $this->set('message', $msg);
    }
}
