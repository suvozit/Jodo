<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_image extends CI_Model
{
  private $images_table = 'images';
  
  function create($story_id, $file_data)
  {
    $this->db->set('story_id',      $story_id);
    $this->db->set('file_name',     $file_data['file_name']);
    $this->db->set('raw_name',      $file_data['raw_name']);
    $this->db->set('orig_name',     $file_data['orig_name']);
    $this->db->set('file_size',     $file_data['file_size']);
    $this->db->set('image_width',   $file_data['image_width']);
    $this->db->set('image_height',  $file_data['image_height']);
    $this->db->set('image_type',    $file_data['image_type']);

    $this->db->insert($this->images_table);
    return $this->db->insert_id();
  }
}