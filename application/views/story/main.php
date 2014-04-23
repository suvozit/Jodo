<?php //var_dump($story_data); ?>

<div class="col-xs-12">

  <div class="story-main row">
    <div class="col-xs-2">
      <?php
      if (!empty($story_data['parent_story']))
      {
        ?>
        <a href="<?php echo base_url('story/id/'.$story_data['parent_story']['story_id']); ?>">
          <div class="thumbnail">
            <img class="img-responsive" src="<?php echo base_url('timthumb/timthumb.php?src=uploads/'.$story_data['parent_story']['file_name']); ?>&w=250&h=250">
          </div>
        </a>
        <?php
      }
      ?>
    </div>
    <div class="col-xs-7">
      <?php
      if (!empty($story_data['parent_story']))
      {
        ?>
        <div class="connector"></div>
        <?php
      }
      ?>
      <div class="thumbnail">
        <a data-toggle="modal" data-target="#myModal" href="#">
          <img class="img-responsive" src="<?php echo base_url('timthumb/timthumb.php?src=uploads/'.$story_data['story']['file_name']); ?>&w=750">
        </a>
      </div>

      <!-- Modal -->
      <div class="image-zoom">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $story_data['story']['title']; ?></h4>
              </div>
              <div class="modal-body">
                <div class="photo-holder">
                  <img class="img-responsive" src="<?php echo base_url('timthumb/timthumb.php?src=uploads/'.$story_data['story']['file_name']); ?>&w=750">
                </div>
              </div>
              <div class="modal-footer">
                <p class="text-left"><?php echo $story_data['story']['caption']; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-4 col-xs-offset-8">
          <?php
          if (!empty($user_data))
          {
            if (empty($story_data['child_list']) AND $story_data['story']['user_id'] == $user_data['user_id'])
            {
              $redirect = '';
              if ($story_data['story']['parent_story_id'] != $story_data['story']['start_story_id']) $redirect = 'story/id/'.$story_data['story']['parent_story_id'];

              $key_id = 'modal-delete-story-'.$story_data['story']['story_id'];
              $url = base_url('do_story/delete/'.$story_data['story']['story_id'].'?redirect='.rawurlencode($redirect));
              ?>
              <a class="btn btn-danger btn-block" data-toggle="modal" data-target="#<?php echo $key_id; ?>" href="<?php echo $url; ?>"><span class="glyphicon glyphicon-remove-circle"></span> Delete Story</a>
              <div class="modal fade" id="<?php echo $key_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
              <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
    <div class="col-xs-3">
      <?php
      foreach ($story_data['child_list'] as $c)
      {
        ?>
        <div class="row">
          <div class="col-xs-8">
            <a href="<?php echo base_url('story/id/'.$c['story_id']); ?>">
              <div class="connector"></div>
              <div class="thumbnail">
                <img class="img-responsive" src="<?php echo base_url('timthumb/timthumb.php?src=uploads/'.$c['file_name']); ?>&w=250&h=250">
              </div>
            </a>
          </div>
          <div class="col-xs-4">
            <?php
            foreach ($c['child_list'] as $cc)
            {
              ?>
              <a href="<?php echo base_url('story/id/'.$cc['story_id']); ?>">
                <div class="connector"></div>
                <div class="thumbnail">
                  <img class="img-responsive" src="<?php echo base_url('timthumb/timthumb.php?src=uploads/'.$cc['file_name']); ?>&w=250&h=250">
                </div>
              </a>
              <?php
            }
            ?>
          </div>
        </div>
        <?php
      }
      ?>

      <?php
      if (!empty($next_page))
      {
        ?>
        <div class="row">
          <div class="col-xs-8">
            <a class="btn btn-link btn-block" href="<?php echo base_url('story/id/'.$story_data['story']['story_id'].'/'.$next_page); ?>"><span class="glyphicon glyphicon-chevron-down"></span></a>
          </div>
        </div>
        <?php
      }
      ?>

      <?php
      //if ($is_logged_in AND $story_data['story']['parent_story_id'] != NULL)
      {
        ?>
        <div class="row">
          <div class="col-xs-8">
            <div class="connector connector-new"></div>
            <div class="thumbnail">
              <a href="<?php echo base_url('story/add_next/'.$story_data['story']['story_id']); ?>">
                <img class="img-responsive" src="http://placehold.it/350&text=Add+String">
              </a>
            </div>
          </div>
        </div>
        <?php
      }
      ?>
    </div>
  </div>

  <div class="story-caption row">
    <div class="col-xs-7 col-xs-offset-2">
      <?php
      if (!empty($user_data))
      {
        if ($story_data['story']['user_id'] == $user_data['user_id'])
        {
          $key_id = 'modal-edit-caption-'.$story_data['story']['story_id'];
          $url = base_url('do_story/edit_caption/'.$story_data['story']['story_id']);
          ?>
          <a class="pull-right" data-toggle="modal" data-target="#<?php echo $key_id; ?>" href="<?php echo $url; ?>"><span class="glyphicon glyphicon-edit"></span></a>
          <div class="modal fade" id="<?php echo $key_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
          <?php
        }
      }
      ?>

      <?php
      if (!empty($story_data['story']['caption']))
      {
        ?>
        <blockquote>
          <p><?php echo $story_data['story']['caption']; ?></p>
        </blockquote>
        <?php
      }
      ?>

      <div class="media">
        <a class="pull-left" href="<?php echo base_url('user/id/'.$story_data['user']['user_id']); ?>">
          <img class="media-object img-responsive" src="<?php echo base_url((!empty($story_data['user']['profile_image_id'])) ? $story_data['user']['profile_image_id'] : 'assets/img/user-profile.png'); ?>" style="width:50px; height:50px;">
        </a>
        <div class="media-body">
          <h4 class="media-heading"><a href="<?php echo base_url('user/id/'.$story_data['user']['user_id']); ?>"><?php echo $story_data['user']['disp_name']; ?></a></h4>
          <?php echo $story_data['user']['bio']; ?>
        </div>
      </div>
    </div>
  </div>
  
</div>

<!-- resposive thumb !-->
<script type="text/javascript">
  $(function() { repos($('.rect-responsive')) });
</script>