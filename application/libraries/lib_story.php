<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lib_story
{
  private $error = array();
  
  function __construct()
  {
    $this->ci =& get_instance();
    
    $this->ci->load->database();
    $this->ci->load->model('model_page');
  }
  
  /**
   * Get error message.
   * Can be invoked after any failed operation such as login or register.
   *
   * @return  string
   */
  function get_error_message()
  {
    return $this->error;
  }

  function create($user_id, $title, $image_data, $caption = '')
  {
    $this->ci->load->helper(array('text'));
    
    $title = htmlspecialchars($title);
    $title = ascii_to_entities($title);
    
    $caption = htmlspecialchars($caption);
    $caption = ascii_to_entities($caption);

    $this->ci->db->trans_start();
    $this->ci->load->model('model_page');
    $story_id = $this->ci->model_page->create($user_id, $caption);

    $this->ci->load->model('model_image');
    $this->ci->model_image->create($story_id, $image_data);

    $this->ci->load->model('model_story');
    $this->ci->model_story->create($story_id, $title);
    $this->ci->db->trans_complete();

    return $story_id;
  }

  function add_page($user_id, $parent_story_id, $start_story_id, $image_data, $caption = '')
  {
    $this->ci->load->helper(array('text'));
    
    $caption = htmlspecialchars($caption);
    $caption = ascii_to_entities($caption);

    $this->ci->db->trans_start();
    $this->ci->load->model('model_page');
    $story_id = $this->ci->model_page->create($user_id, $caption, $parent_story_id, $start_story_id);

    $this->ci->load->model('model_image');
    $image_id = $this->ci->model_image->create($story_id, $image_data);
    $this->ci->db->trans_complete();

    return $story_id;
  }
  
  public function get_data($story_id)
  {
    $story = $this->ci->model_page->get_story_data_by_id($story_id);
    if (empty($story))
    {
      $this->error = array('message' => 'story not found');
      return NULL;
    }

    $data['story'] = $story;
    $data['parent_page'] = NULL;
    if (!empty($story['parent_story_id']))
    {
      $data['parent_page'] = $this->ci->model_page->get_data_by_id($story['parent_story_id']);
    }

    $data['child_list'] = $this->ci->model_page->get_child_list($story_id);
    foreach ($data['child_list'] as $key => $value)
    {
      $data['child_list'][$key]['child_list'] = $this->ci->model_page->get_child_list($value['story_id'], 2);
    }

    $data['child_count'] = $this->ci->model_page->get_child_count($story_id);

    $this->ci->load->library('lib_user_profile');
    $data['user'] = $this->ci->lib_user_profile->get_user_profile_by_id($story['user_id']);

    return $data;
  }

  function get_recent($index = 0)
  {
    $this->ci->load->config('story', TRUE);

    $this->ci->load->model('model_story');
    $data['story'] = $this->ci->model_story->get_recent($this->ci->config->item('stories_per_page', 'story'), $index);
    $data['count'] = $this->ci->model_story->get_count();

    return $data;
  }

  function get_users_recent($user_id, $index = 0)
  {
    $this->ci->load->config('story', TRUE);

    $this->ci->load->model('model_page');
    $data['story'] = $this->ci->model_page->get_user_pages($user_id, $this->ci->config->item('stories_per_page', 'story'), $index);
    $data['count'] = $this->ci->model_page->get_user_pages_count($user_id);

    return $data;
  }
}