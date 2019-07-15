<?php get_header();?>

	<main role="main">
	<!-- section -->
	<section>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
		<?php $current_vontest = new Vontest(get_the_ID()); ?>
		 <!-- article -->
		<article id="pastilla-politics" <?php post_class('container-fluid cardtab'); ?>>
			<?php if(!$current_vontest->is_active()){
				$current_vontest->create_resolution(); ?>
				<div class="row">
					<div class="col-12 text-center closed-vontest">
						<i class="fas fa-times-circle"></i><?php _e('Closed vontest'); ?>
					</div>
				</div>
			<?php } ?>
			<div class="row tab">
					<button class="tablinks col-4 active" data-id="question"><?php _e('Question','autogov'); ?></button>
					<button class="tablinks col-4" data-id="answers"><?php _e('Answers','autogov'); ?></button>
					<button class="tablinks col-4" data-id="decisions"><?php _e('Decisions','autogov'); ?></button>
			</div>
			<div id="tab-question" class="tabcontent active">
				<!-- post thumbnail -->
				<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
					<div class="row">
						<div class="col-12">
							<div class="image_featured_question" style="background-image:url(<?php echo get_the_post_thumbnail_url(); ?>);"></div>
						</div>
					</div>
				<?php else: ?>
					<div class="row">
						<div class="col-12">
							<div class="image_featured_question text-center" style="background-color:#e9eef1; overflow:hidden;">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/default_image.png" />
							</div>
						</div>
					</div>
				<?php endif; ?>
				<!-- /post thumbnail -->
					<div class="row pb-3 mb-3">
						<div class="col-6 col-md-6">
							<!-- post title -->
							<h1>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
							</h1>
							<div class="date"><?php the_time('F j, Y'); ?></div>
							<!-- /post title -->
							<div class="vontest_list_topics">
								<span><?php _e('Topics','autogov'); ?>:</span>
									<?php $term_list = wp_get_post_terms($post->ID, 'topics');
									foreach($term_list as $t){?>
										<a href="<?php echo get_term_link($t); ?>"><?php echo $t->name; ?></a>
									<?php } ?>
							</div>
							<div class="vontest_list_tags">
								<span><?php _e('Tags','autogov'); ?>:</span>
									<?php $term_list = wp_get_post_terms($post->ID, 'vontest_tag', array("fields" => "all"));
									foreach($term_list as $t){ ?>
										<a href="<?php echo get_term_link($t); ?>"><?php echo $t->name; ?></a>
									<?php } ?>
							</div>
						</div>
						<div class="col-2 col-md-2">
							<!-- post details -->
							<div class="vontest_author row align-middle">
								<div class="col-6">
									<div class="avatar"><?php echo get_avatar(get_the_author_meta('ID')); ?></div>
								</div>
								<div class="author col-6 align-self-end">
									<span><?php _e( 'Posted by', 'autogov' ); ?></span>
									<?php if(social_enabled()==1){ ?>
									<?php echo bp_core_get_userlink( get_the_author_meta('ID') ); ?>
									<?php }else{
									$author = get_the_author();
									echo $author;
									}?>
								</div>
							</div>
							<div class="vontest_metrics">
								<strong><?php _e('Vontest metrics','autogov') ?></strong>
								<div><?php echo $current_vontest->answers->post_count.' '.__( 'answers', 'autogov' ); ?></div>
								<div><?php //if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'autogov' ), __( '1 Comment', 'autogov' ), __( '% Comments', 'autogov' )); ?></div>
								<div><?php //_e( '%s votes', 'autogov' ); ?></div>
							</div>
							<!-- /post details -->
						</div>
						<div class="col-4 col-md-4 vontest_buttons">
							<a href="#" onclick="jQuery('button[data-id=\'answers\']').click(); return false;" class="button"><?php _e('VIEW ANSWERS','autogov') ?></a>
							<?php if(is_user_logged_in() && $current_vontest->is_active()) { ?>
								<a href="#new_answer" class="button grey" onclick="jQuery('button[data-id=\'answers\']').click();jQuery(document).scrollTop( jQuery('#form_answer_collapse').offset().top );return false;"><?php _e('PUBLISH NEW ANSWER','autogov') ?></a>
							<?php } ?>

						</div>
					</div>
					<div class="row">
						<div class="col-12 vontest_contents"><div></div></div>
						<div class="col-6 vontest-excerpt">
							<?php the_excerpt(); // Dynamic Content ?>
						</div>
						<div class="col-6">
							<div class="vontest_toc">
								<h2><?php _e('Table of content','autogov'); ?></h2>
								<?php if(get_post_meta(get_the_ID(),'_editor_what',true)){ ?>
									<a href="#section_what" class="anchor"><?php _e('What','autogov'); ?></a>
								<?php } ?>
								<?php if(get_post_meta(get_the_ID(),'_editor_how',true)){ ?>
									<a href="#section_how" class="anchor"><?php _e('How','autogov'); ?></a>
								<?php } ?>
								<?php if(get_post_meta(get_the_ID(),'_editor_when',true)){ ?>
									<a href="#section_when" class="anchor"><?php _e('When','autogov'); ?></a>
								<?php } ?>
								<?php if(get_post_meta(get_the_ID(),'_editor_where',true)){ ?>
									<a href="#section_where" class="anchor"><?php _e('Where','autogov'); ?></a>
								<?php } ?>
								<?php if(get_post_meta(get_the_ID(),'_editor_why',true)){ ?>
									<a href="#section_why" class="anchor"><?php _e('Why','autogov'); ?></a>
								<?php } ?>
								<?php if(get_post_meta(get_the_ID(),'_editor_howmuch',true)){ ?>
									<a href="#section_howmuch" class="anchor"><?php _e('How much','autogov'); ?></a>
								<?php } ?>
							</div>
						</div>
						<div class="col-12 vontest_contents">
							<?php if(get_post_meta(get_the_ID(),'_editor_what',true)){ ?>
							<div>
								<h3 id="section_what"><?php _e('What','autogov'); ?></h3>
									<?php echo get_post_meta(get_the_ID(),'_editor_what',true); ?>
							</div>
							<?php } ?>
							<?php if(get_post_meta(get_the_ID(),'_editor_how',true)){ ?>
							<div>
								<h3 id="section_how"><?php _e('How','autogov'); ?></h3>
								<?php echo get_post_meta(get_the_ID(),'_editor_how',true); ?>
							</div>
						<?php } ?>
							<?php if(get_post_meta(get_the_ID(),'_editor_when',true)){ ?>
							<div>
								<h3 id="section_when"><?php _e('When','autogov'); ?></h3>
								<?php echo get_post_meta(get_the_ID(),'_editor_when',true); ?>
							</div>
						<?php } ?>
							<?php if(get_post_meta(get_the_ID(),'_editor_where',true)){ ?>
							<div>
								<h3 id="section_where"><?php _e('Where','autogov'); ?></h3>
								<?php echo get_post_meta(get_the_ID(),'_editor_where',true); ?>
							</div>
						<?php } ?>
							<?php if(get_post_meta(get_the_ID(),'_editor_why',true)){ ?>
							<div>
								<h3 id="section_why"><?php _e('Why','autogov'); ?></h3>
								<?php echo get_post_meta(get_the_ID(),'_editor_why',true); ?>
							</div>
						<?php } ?>
							<?php if(get_post_meta(get_the_ID(),'_editor_howmuch',true)){ ?>
							<div>
								<h3 id="section_howmuch"><?php _e('How much','autogov'); ?></h3>
								<?php echo get_post_meta(get_the_ID(),'_editor_howmuch',true); ?>
							</div>
						<?php } ?>
						</div>
						<div class="col-12 vontest_buttons_bottom">
							<a class="button" href="#" onclick="jQuery('button[data-id=\'answers\']').click(); return false;"><?php _e('VIEW ANSWERS','autogov'); ?></a>
							<?php if(is_user_logged_in() && $current_vontest->is_active()) { ?>
								<a class="button grey" href="#" onclick="jQuery('button[data-id=\'answers\']').click();jQuery(document).scrollTop( jQuery('#form_answer_collapse').offset().top); return false;"><?php _e('PUBLISH NEW ANSWER','autogov'); ?></a>
							<?php } ?>
						</div>
						<div id="comments" class="col-12 vontest_comments_bottom">
							<?php comments_template(); ?>
						</div>
					</div>
			</div>
			<div id="tab-answers" class="tabcontent">
				<div class="row">
					<div class="col-12 mx-auto pt-3 pb-3">
						<div><?php _e('Answers for the vontest','autogov'); ?></div>
						<h3><?php the_title(); ?></h3>
					</div>
				</div>
				<?php
				if($current_vontest->answers){ ?>
			    <?php while($current_vontest->answers->have_posts()){
						$current_vontest->answers->the_post();
						?>
						<div class="row pt-5 pb-5 row-answer">
			      	<div class="col-3 photo-answer">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
			      	</div>
							<div class="col-9">
								<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
								<div><?php the_excerpt(); ?></div>
								<?php /*<div><strong><?php _e('Resolution case','autogov'); ?>:</strong> <?php echo get_post_meta(get_the_ID(),'_resolution_case',true); ?></div> */ ?>
								<div class="text-right">
									<a href="<?php the_permalink(); ?>">> <?php _e('read more','autogov'); ?></a>
								</div>
								<div class="row">
									<div class="col">
										<div class="vontest_author row align-items-center">
											<div class="avatar col"><?php echo get_avatar(get_the_author_meta('ID')); ?>
												<span><?php _e( 'Posted by', 'autogov' ); ?></span>
												<div><?php echo bp_core_get_userlink( get_the_author_meta('ID') ); ?></div>
											</div>
										</div>
									</div>
									<?php
								    if(is_user_logged_in() && $current_vontest->is_active()){ ?>
									<div class="col text-right answer_metrics">
										<?php
										$total_answer_points = get_total_answer_points(get_the_ID());
										echo __("Esta respuesta tiene",'autogov').' '.$total_answer_points.__('puntos en total',"autogov").'<br />';
										$current_answer_points=get_user_meta(get_current_user_id(), 'answer_'.get_the_ID(),true);
										if($current_answer_points)
											echo __("Tienes ",'autogov').$current_answer_points.__('punto(s) otorgado(s) a esta respuesta','autogov').'<br />';
										else
											echo __("No tienes puntos otorgados a esta respuesta<br>",'autogov');
										$puntos_disponibles_respuesta = get_disposable_points($current_vontest->id,get_the_ID());
										if($puntos_disponibles_respuesta || $current_answer_points)
										{ ?>
											<select id="<?php echo $post->ID; ?>" name="points">
												<?php
												for ($i=0; $i<=$puntos_disponibles_respuesta; $i++)
													echo "<option value='$i'>$i ".__('points','autogov')."</option>";
												?>
											</select>
											<button class="button color_politics voteAnswer" id="<?php echo $post->ID; ?>"><?php _e('VOTE THIS ANSWER','autogov'); ?></button>
										<?php }
										else
											echo __("No puedes votar esta respuesta, no te quedan más puntos en este vontest.",'autogov').'<br>';
										?>
									</div>
									<?php }	?>
								</div>
			      	</div>
						</div>

			    <?php }
					wp_reset_postdata();
				 } ?>
				 <div class="row buttons_create_vontest">
					 <div class="col-12">
							 <?php if(is_user_logged_in() && $current_vontest->is_active()) { ?>
							 	<a class="button grey" id="form_answer_collapse" data-toggle="collapse" data-target="#form_answer" href="#"><?php _e('PUBLISH NEW ANSWER','autogov'); ?></a>
							 <?php } ?>
							 <script>
				       jQuery(document).ready(function(){
				         jQuery('#form_answer').on('show.bs.collapse', function () {
				           jQuery('#form_answer_collapse').hide();
				         });
				       });
				       </script>
						 <div class="collapse" id="form_answer" vontest-id="<?php echo $post->ID; ?>">
							 <h2><?php _e('Create new answer','autogov'); ?></h2>
							 <div class="md-form">
		             <form id="form-create-answer">
		             <input type="text" id="vontest_title" class="form-control" required>
		             <label for="vontest_title"><?php _e('Answer title','autogov'); ?></label>
								 <i class="fa fa-question-circle tips" title="<?php _e( "Add your answer title", 'autogov' );?>" data-placement="left" aria-hidden="true"></i>
		           </div>
		           <div class="md-form">
		             <textarea type="text" id="vontest_excerpt" class="md-textarea form-control" rows="3" required></textarea>
		             <label for="vontest_excerpt"><?php _e('Description','autogov'); ?></label>
								 <i class="fa fa-question-circle tips textarea-tips" title="<?php _e( "Add your answer description", 'autogov' );?>" data-placement="left" aria-hidden="true"></i>
		           </div>
		           <?php /*<div class="md-form">
		             <textarea type="text" id="vontest_resolution_case" class="md-textarea form-control" rows="3" required></textarea>
		             <label for="vontest_resolution_case"><?php _e('Resolution case','autogov'); ?></label>
		           </div> */ ?>
		           <div class="form-row">
		             <div class="form-group col-md-12">
		               <div class="md-form">
		                 <div for="vontest_featuredimage"><?php _e('Featured image','autogov'); ?> <i class="fa fa-question-circle tips inline" title="<?php _e( "Add your answer featured image", 'autogov' );?>" data-placement="left" aria-hidden="true"></i></div>
		                 <input type="file" id="vontest_featuredimage" class="form-control">

		               </div>
		             </div>
		           </div>
				   <div class="form-row">
		             <div class="form-group col-md-12">
		               <div class="md-form text-center">
		                 <button id="saveAnswer" type="submit" class="button color_politics"><?php _e('Publicar respuesta','autogov'); ?>
		             </form>
		               </div>
		             </div>
		           </div>
						 </div>
					 </div>
				 </div>
			</div>
			<div id="tab-decisions" class="tabcontent">
				<div class="row">
					<div class="col-12 mx-auto pt-3 pb-3">
						<div><?php _e('Before take a decision of','autogov'); ?></div>
						<p><strong><?php the_title(); ?></strong></p>
					</div>
					<div class="col-12 pt-3 pb-3 border-top">
						<div><?php _e('Next votography','autogov'); ?></div>
						<span><strong><?php $field_date_votography = get_post_meta(get_the_ID(), '_date_votography', true);
						echo date_i18n( get_option( 'date_format' ), strtotime($field_date_votography)); ?></strong></span>
					</div>
					<div class="col-12 pt-3 pb-3 border-top">
						<p><?php _e('History of this Vontest','autogov'); ?></p>
						<div class="row"><?php $votographies = get_post_meta(get_the_ID(), '_votographies', true);
						if($votographies){
					  foreach($votographies as $v){ ?>
							<div class="col col-lg-6 mb-3">
		            <div class="card">
		            	<div class="card-body">
		            	<h4 class="card-title"><?php echo __('Votography','autogov')?> <strong><?php echo date_i18n( get_option( 'date_format' ), strtotime($v['_date_votography'])); ?></strong></h4>
		            	<p class="card-text">
										<?php echo __('Participantes','autogov')?> : <strong><?php echo ($v['_users_voted']-1); ?></strong>, <?php echo __('Quorum','autogov')?> : <strong><?php echo ($v['_quorum_votography']).'%'; ?></strong>
									</p>
			            <table class="table table-hover table-sm table-bordered my-3">
			              <thead class="thead-dark">
				              <tr>
				                <th scope="col"><?php _e('Answers','autogov'); ?></th>
				                <th scope="col text-center"><?php _e('Votes','autogov'); ?></th>
				              </tr>
				            </thead>
										<tbody>
		                  <?php
		                  if(!empty($v['_answers_on_votography'])){
		                    foreach($v['_answers_on_votography'] as $a) { ?>
		                      <tr>
		                        <td scope="row"><?php echo $a->post_title ?></td>
		                        <td class="text-center"><?php echo $v['_answers_voted'][$a->ID] ?></td>
													</tr>
		                    <?php }
		                  }else{ ?>
		                    <tr>
		                      <td><?php _e('There is no answers','autogov'); ?></td>
		                    </tr>
		                  <?php } ?>
			                </tbody>
										</table>
		              </div>
	              </div>
	            </div>
						    <?php
						  }
						}else{?>
							<p><?php _e('There are not votographies yet','autogov'); ?></p>
						<?php } ?>
						</div>
					</div>
					<div class="col-12 pt-3 pb-3 border-top">
						<p><strong><?php _e('Created resolutions','autogov'); ?></strong></p>
						<?php
						$current_vontest->get_resolutions();
						if($current_vontest->resolutions->have_posts()){
							foreach($current_vontest->resolutions->posts as $res){ ?>
								<div><a href="<?php echo get_the_permalink($res->ID); ?>"><strong><?php echo $res->post_title; ?></strong></a><br />
								<?php echo $res->post_content; ?></div>
							<?php }
						}else{
							_e('There are still no resolutions for this vontest','autogov');
						} ?>
					</div>
					<div class="col-12 pt-3 pb-3 border-top">
						<p><strong><?php _e('Conflicted resolutions','autogov'); ?></strong></p>
						<?php if(!empty($current_vontest->meta['_related_resolutions'][0])){
							foreach(unserialize($current_vontest->meta['_related_resolutions'][0]) as $rel){
								$rel_conc = get_post($rel);
								if($rel_conc->post_status == 'publish'){ ?>
									<div><a href="<?php echo get_the_permalink($rel); ?>"><?php echo $rel_conc->post_title; ?></a></div>
								<?php }
							}
						}else{
							_e('There is not conflicted resolutions for this vontest','autogov');
					 } ?>
					</div>
				</div>
			</div>

		</article>
		<!-- /article -->

	<?php endwhile; ?>

	<?php else: ?>

		<!-- article -->
		<article>

			<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>

	</section>
	<!-- /section -->
	</main>

<?php //get_sidebar(); ?>

<?php get_footer(); ?>
