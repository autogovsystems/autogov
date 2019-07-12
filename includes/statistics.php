<?php
add_shortcode('AGOV_stadistics','AGOV_stadistics');

function AGOV_stadistics(){
  get_template_part('template-parts/statistics');
}

function print_card_statistics($attr){
  ?>
  <div class="card">
    <div class="card-body">
      <h4 class="card-title"><?php echo $attr['number']; ?></h4>
      <p><?php echo $attr['title']; ?></p>
    </div>
  </div>

<?php
}
