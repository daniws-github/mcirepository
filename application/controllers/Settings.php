<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Under Development';

        $this->load->view('error', $data);
    }

    public function profile()
    {
        $data['title'] = 'Under Development';

        $this->load->view('error', $data);
    }
}
