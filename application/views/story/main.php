<?php //var_dump($story_data); ?>

<div class="col-xs-12">

  <div class="story-main row" id="story-nav">
    <div class="col-xs-4 col-sm-2">
      <?php
      if (!empty($story_data['parent_story']))
      {
        ?>
        <a href="<?php echo base_url('story/id/'.$story_data['parent_story']['story_id']); ?>">
          <div class="thumbnail story-thumbnail" id="story-thumbnail-left" data-story-id="<?php echo $story_data['parent_story']['story_id']; ?>">
            <div class="bg-cover" style="background-image: url(<?php echo base_url('uploads/'.$story_data['parent_story']['file_name']); ?>)">
              <img class="img-responsive" src="<?php echo base_url('assets/img/blank.png'); ?>" width="300">
            </div>
          </div>
        </a>
        <?php
      }
      ?>
    </div>
    <div class="col-xs-12 col-sm-7">
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
          <img class="img-responsive" src="<?php echo base_url('uploads/'.$story_data['story']['file_name']); ?>" style="width:1750px;">
        </a>

        <div class="media">
          <?php
          if (!empty($user_data))
          {
            if ($story_data['story']['user_id'] == $user_data['user_id'])
            {
              $key_id = 'modal-edit-caption-'.$story_data['story']['story_id'];
              $url = base_url('do_story/edit_caption/'.$story_data['story']['story_id']);
              ?>
              <a class="media-object pull-right" data-toggle="modal" data-target="#<?php echo $key_id; ?>" href="<?php echo $url; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
              <div class="modal fade" id="<?php echo $key_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
              <?php
            }
          }
          ?>
        </div>
        
        <div class="caption">
          <blockquote>
            <?php
            if (!empty($story_data['story']['caption']))
            {
              ?>
                <p><?php echo $story_data['story']['caption']; ?></p>
              <?php
            }
            ?>
            <footer>by <cite title="Source Title"><a href="<?php echo base_url('user/id/'.$story_data['user']['user_id']); ?>"><?php echo $story_data['user']['disp_name']; ?></a></cite></footer>
          </blockquote>

          <p>
            <?php
            if (!empty($user_data))
            {
              if (empty($story_data['child_list']) AND $story_data['story']['user_id'] == $user_data['user_id'])
              {
                $redirect = '';
                if (!empty($story_data['story']['parent_story_id'])) $redirect = 'story/id/'.$story_data['story']['parent_story_id'];

                $key_id = 'modal-delete-story-'.$story_data['story']['story_id'];
                $url = base_url('do_story/delete/'.$story_data['story']['story_id'].'?redirect='.rawurlencode($redirect));
                ?>
                <a class="btn btn-danger btn-block" data-toggle="modal" data-target="#<?php echo $key_id; ?>" href="<?php echo $url; ?>"><span class="glyphicon glyphicon-remove-circle"></span> Delete Story</a>
                <div class="modal fade" id="<?php echo $key_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
                <?php
              }
            }
            ?>
          </p>
        </div>

        <div class="image-zoom">
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel"><?php echo $story_data['story']['title']; ?></h4>
                </div>
                <div class="modal-body">
                  <div class="photo-holder">
                    <img class="img-responsive" src="<?php echo base_url('uploads/'.$story_data['story']['file_name']); ?>">
                  </div>
                </div>
                <div class="modal-footer">
                  <p class="text-left"><?php echo $story_data['story']['caption']; ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="col-xs-6 col-sm-3">
      <?php
      $right_story_thumbnail = FALSE;
      foreach ($story_data['child_list'] as $c)
      {
        ?>
        <div class="row">
          <div class="col-xs-8">
            <a href="<?php echo base_url('story/id/'.$c['story_id']); ?>">
              <div class="connector"></div>
              <div class="thumbnail story-thumbnail" id="<?php if (!$right_story_thumbnail) echo "story-thumbnail-right"; ?>" data-story-id="<?php echo $c['story_id']; ?>">
                <div class="bg-cover" style="background-image: url(<?php echo base_url('uploads/'.$c['file_name']); ?>)">
                  <img class="img-responsive" src="<?php echo base_url('assets/img/blank.png'); ?>" width="300">
                </div>
              </div>
            </a>
          </div>
          <div class="col-xs-4">
            <?php
            foreach ($c['child_list'] as $cc)
            {
              ?>
              <!-- <a href="<?php echo base_url('story/id/'.$cc['story_id']); ?>"> -->
                <div class="connector"></div>
                <div class="thumbnail">
                  <div class="bg-cover" style="background-image: url(<?php echo base_url('uploads/'.$cc['file_name']); ?>)">
                    <img class="img-responsive" src="<?php echo base_url('assets/img/blank.png'); ?>" width="300">
                  </div>
                </div>
              <!-- </a> -->
              <?php
            }
            ?>
          </div>
        </div>
        <?php
        $right_story_thumbnail = TRUE;
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
                <img class="img-responsive" src="<?php echo base_url('assets/img/add_next.png'); ?>">
              </a>
            </div>
          </div>
        </div>
        <?php
      }
      ?>
    </div>
  </div>
</div>

<script>
  $("#story-thumbnail-right img").addClass("selected");

  $(document).keydown(function(e) {
    if (e.keyCode == 13) { // enter
      
    }
    if (e.keyCode == 37) { // left
      if ($("#story-thumbnail-left img").hasClass("selected"))
      {
        selectOption($("#story-thumbnail-left").data("storyId"))
      }
      else
      {
        $(".story-thumbnail img").removeClass("selected");
        $("#story-thumbnail-left img").addClass("selected");
      }
    }
    if (e.keyCode == 38) { // up
    }
    if (e.keyCode == 39) { // right
      if ($("#story-thumbnail-right img").hasClass("selected"))
      {
        selectOption($("#story-thumbnail-right").data("storyId"))
      }
      else
      {
        $(".story-thumbnail img").removeClass("selected");
        $("#story-thumbnail-right img").addClass("selected");
      }
    }
    if (e.keyCode == 40) { // up
    }
  });

  $(".story-thumbnail img").mouseover(function() {
    $(".story-thumbnail img").removeClass("selected");
    $(this).addClass("selected");
  }).click(function() {
    // selectOption();
  });

  function selectOption(id) {
    // go to story
    if (id)
    {
      window.location = "<?php echo base_url('story/id') ?>"+"/"+id
    }
  }
</script>