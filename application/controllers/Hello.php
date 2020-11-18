<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hello extends CI_Controller {

    public function index() {
        echo 'I am in hello controller index function!';
    }

    public function test() {
        echo 'I am in  hello controller test function!';
    }

}