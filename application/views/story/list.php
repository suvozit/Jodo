<?php //var_dump($story); ?>

<div class="col-xs-12">

  <div class="story-list row">
    <?php
    foreach ($story as $s)
    {
      ?>
      <div class="col-xs-6 col-md-4 col-md-3">
        <div class="thumbnail">
          <div class="bg-cover" style="background-image: url('<?php echo base_url('uploads/'.$s['file_name']); ?>')">
            <a href="<?php echo base_url('story/id/'.$s['story_id']); ?>" title="<?php echo $s['title']; ?>">
              <img class="img-responsive" src="<?php echo base_url('assets/img/story-cover.png'); ?>">
            </a>
          </div>
          <div class="caption">
            <?php echo anchor('story/id/'.$s['story_id'], $s['title']); ?>
          </div>
        </div>
      </div>
      <?php
    }
    ?>
  </div>

  <?php
  if (!empty($next_page))
  {
    ?>
    <div class="row">
      <div class="col-xs-12 col-md-4 col-md-offset-4">
        <a class="btn btn-primary btn-block" href="<?php echo base_url($next_page); ?>">More</a>
      </div>
    </div>
    <?php
  }
  ?>
  
</div>