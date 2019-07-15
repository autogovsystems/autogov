<?php
add_shortcode('AGOV_stadistics','AGOV_stadistics');

function AGOV_stadistics(){
  get_template_part('template-parts/statistics');
}

function print_card_statistics($attr){
  ?>
  <div class="card text-center">
      <div class="card-header">
        <?php if(isset($attr['icon'])){ ?>
          <i style="color: #999;" class="fas fa-<?php echo $attr['icon']; ?>"></i> 
        <?php } ?>
        <span style="color: #999;font-style: italic;"><?php echo $attr['title']; ?></span>
      </div>
      <div class="card-body">
        <h1 class="card-title"><?php echo $attr['number']; ?></h4>
      </div>
  </div>

<?php
}
