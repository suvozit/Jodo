<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
  public function index()
  {
    $data = array();

    $this->load->library('tank_auth');
    $this->load->library('lib_user_profile');
    
    $user_id = 0;
    if ($data['is_logged_in'] = $this->tank_auth->is_logged_in())
    {
      $user_id = $this->tank_auth->get_user_id();
      $data['user_data'] = $this->lib_user_profile->get_user_profile_by_id($user_id);
    }

    $this->load->view('base', $data);
  }
}
