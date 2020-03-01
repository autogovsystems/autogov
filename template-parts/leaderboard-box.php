<?php echo do_shortcode('[mycred_leaderboard type="applauds" current="1"]
    <div>
      <div class="position_leaderboard">
        #%position%
      </div>
      <div class="image">
        <a href="%user_profile_url%"><img src="%user_profile_image%" /></a>
      </div>
      <div class="name_leaderboard">
        %user_profile_link% <span>(%cred_f%)</span>
  		</div>
    </div>
[/mycred_leaderboard]');
?>
