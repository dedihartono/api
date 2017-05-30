<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class User extends REST_Controller
{

  function __construct() {

    parent::__construct();

    $this->load->database();
}

//Menampilkan data user
  public function index_get() {

      $id = $this->get('id');
      if ($id == '') {
          $user = $this->db->get('user')->result();
      } else {
          $this->db->where('id', $id);
          $user = $this->db->get('user')->result();
      }
      $this->response($user, 200);
  }

  function index_post() {
      $data = array(
                  'id'        => $this->post('id'),
                  'username'  => $this->post('username'),
                  'password'  => $this->post('password'));
      $insert = $this->db->insert('user', $data);
      if ($insert) {
          $this->response($data, 200);
      } else {
          $this->response(array('status' => 'fail', 502));
      }
  }
  //Memperbarui data kontak yang telah ada
  function index_put() {
        $id = $this->put('id');
        $data = array(
                    'id'        => $this->put('id'),
                    'username'  => $this->put('username'),
                    'password'  => $this->put('password'));
        $this->db->where('id', $id);
        $update = $this->db->update('user', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

  //Menghapus salah satu data kontak
  function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('telepon');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
