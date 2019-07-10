<?php

//add Dokan withdraw as mycred reference
add_filter( 'mycred_all_references', 'mycred_dokan_withdraw_reference' );
function mycred_dokan_withdraw_reference( $list ) {
    $list['dokan_withdraw'] = 'Dokan withdraw';
    return $list;
}

//Add custom hooks to MYCRED
add_filter( 'mycred_setup_hooks', 'register_my_custom_hook', 999 );
function register_my_custom_hook( $installed )
{
	$installed['hook_id'] = array(
		'title'       => __( 'Hook for AutoGOV', 'textdomain' ),
		'description' => __( 'Hook description', 'textdomain' ),
		'callback'    => array( 'Hook_MyCRED_Autogov' )
	);

	return $installed;
}

	// If the hook has been replaced or if plugin is not installed, exit now
  if ( !class_exists( 'myCRED_Hook' ) ) return;

	class Hook_MyCRED_Autogov extends myCRED_Hook {

		/**
		 * Construct
     */
		public function __construct( $hook_prefs, $type = 'applauds' ) {

			parent::__construct( array(
				'id'       => 'hook_autogov',
				'defaults' => array(
					'answer_mostvoted'         => array(
						'creds'         => 1,
						'log'           => '%plural% for answer most voted'
					),
					'product_purchased' => array(
						'creds'         => 1,
						'log'           => '%plural% for product purchased',
						'limit'         => '0/x'
					),
          'product_sold' => array(
						'creds'         => 1,
						'log'           => '%plural% for product sold',
						'limit'         => '0/x'
					),
					'add_favorite'   => array(
						'creds'         => 1,
						'log'           => '%plural% for adding an activity to favorites',
						'limit'         => '0/x'
					),
					'remove_favorite' => array(
						'creds'         => '-1',
						'log'           => '%singular% deduction for removing favorite activity'
					)
				)
			), $hook_prefs, $type );

		}

		/**
		 * Run
		 * @since 0.1
		 * @version 1.0
		 */
		public function run() {

			if ( $this->prefs['answer_mostvoted']['creds'] != 0 )
				add_action( 'creating_votography', array( $this, 'answer_most_voted' ), 10, 2 );

			if ( $this->prefs['product_purchased']['creds'] != 0 )
				add_action( 'woocommerce_order_status_completed', array( $this, 'product_purchased' ), 10, 2 );

      if ( $this->prefs['product_sold']['creds'] != 0 )
				add_action( 'woocommerce_order_status_completed', array( $this, 'product_sold' ), 10, 2 );

			if ( $this->prefs['add_favorite']['creds'] != 0 )
				add_action( 'bp_activity_add_user_favorite', array( $this, 'add_to_favorites' ), 10, 2 );

			if ( $this->prefs['remove_favorite']['creds'] != 0 )
				add_action( 'bp_activity_remove_user_favorite', array( $this, 'removed_from_favorites' ), 10, 2 );

		}


		public function answer_most_voted( $answer_id ) {

			// Check if user is excluded
			if ( $this->core->exclude_user( $user_id ) ) return;

      //Logica para encontrar el user_id = author de la answer
      $user_id = get_post_field('post_author',$answer_id);
			// Make sure this is unique event
			if ( $this->core->has_entry( 'answer_most_voted', $answer_id, $user_id ) ) return;

			// Execute
			$this->core->add_creds(
				'answer_most_voted',
				$user_id,
				$this->prefs['answer_mostvoted']['creds'],
				$this->prefs['answer_mostvoted']['log'],
				$answer_id,
				'answer_most_voted',
				$this->mycred_type
			);

		}


		public function product_purchased( $order_id ) {

      $order = wc_get_order($order_id);
      $items = $order->get_items();
      $customer_id = $order->get_customer_id();

      foreach($items as $item){
        $item_id = $item->get_product_id();
        $post_obj = get_post( $item_id ); // The WP_Post object
        $user_id = $post_obj->post_author; //

        if($customer_id == $user_id) continue;

        // Check if user is excluded
  			if ( $this->core->exclude_user( $user_id ) ) continue;

  			// Limit
  			if ( $this->over_hook_limit( 'product_purchased', $order_id, $item_id ) ) continue;

        // Make sure this is unique event
        if ( $this->core->has_entry( 'product_purchased', $order_id, $item_id ) ) continue;

  			// Execute
  			$this->core->add_creds(
  				'product_purchased',
  				$customer_id,
  				$this->prefs['product_purchased']['creds'],
  				$this->prefs['product_purchased']['log'],
  				$order_id,
  				$item_id,
  				$this->mycred_type
  			);

      }

		}

    public function product_sold( $order_id ) {

      $order = wc_get_order($order_id);
      $items = $order->get_items();
      $customer_id = $order->get_customer_id();

      foreach($items as $item){
        $item_id = $item->get_product_id();
        $post_obj = get_post( $item_id ); // The WP_Post object
        $user_id = $post_obj->post_author; //

        if($customer_id == $user_id) continue;

        // Check if user is excluded
  			if ( $this->core->exclude_user( $user_id ) ) continue;

  			// Limit
  			if ( $this->over_hook_limit( 'product_sold', $order_id, $item_id ) ) continue;

        // Make sure this is unique event
        if ( $this->core->has_entry( 'product_sold', $order_id, $item_id ) ) continue;

  			// Execute
  			$this->core->add_creds(
  				'product_sold',
  				$user_id,
  				$this->prefs['product_sold']['creds'],
  				$this->prefs['product_sold']['log'],
  				$order_id,
  				$item_id,
  				$this->mycred_type
  			);

      }

		}

		/**
		 * Add to Favorites
		 * @since 1.7
		 * @version 1.0
		 */
		public function add_to_favorites( $activity_id, $user_id ) {

      $activity = new BP_Activity_Activity($activity_id);
      $author_id = $activity->user_id;

      if($author_id == $user_id) return;

			// Check if user is excluded
			if ( $this->core->exclude_user( $author_id ) ) return;

			// Make sure this is unique event
			if ( $this->core->has_entry( 'fave_activity_author', $activity_id, $user_id ) ) return;

			// Execute
			$this->core->add_creds(
				'fave_activity_author',
				$author_id,
				$this->prefs['add_favorite']['creds'],
				$this->prefs['add_favorite']['log'],
				$activity_id,
				'fave_activity_author',
				$this->mycred_type
			);

		}

		/**
		 * Remove from Favorites
		 * @since 1.7
		 * @version 1.0
		 */
		public function removed_from_favorites( $activity_id, $user_id ) {

      $activity = new BP_Activity_Activity($activity_id);
      $author_id = $activity->user_id;

      if($author_id == $user_id) return;

			// Check if user is excluded
			if ( $this->core->exclude_user( $author_id ) ) return;

			// Make sure this is unique event
			if ( $this->core->has_entry( 'unfave_activity_author', $activity_id, $user_id ) ) return;

			// Execute
			$this->core->add_creds(
				'unfave_activity_author',
				$author_id,
				$this->prefs['remove_favorite']['creds'],
				$this->prefs['remove_favorite']['log'],
				$activity_id,
				$user_id,
				$this->mycred_type
			);

		}


		/**
		 * Preferences
		 * @since 0.1
		 * @version 1.2
		 */
		public function preferences() {

			$prefs = $this->prefs;
?>
<div class="hook-instance">
	<h3><?php _e( 'Answer most voted on closing votograpy', 'mycred' ); ?></h3>
	<div class="row">
		<div class="col-lg-2 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="<?php echo $this->field_id( array( 'answer_mostvoted', 'creds' ) ); ?>"><?php echo $this->core->plural(); ?></label>
				<input type="text" name="<?php echo $this->field_name( array( 'answer_mostvoted', 'creds' ) ); ?>" id="<?php echo $this->field_id( array( 'answer_mostvoted', 'creds' ) ); ?>" value="<?php echo $this->core->number( $prefs['answer_mostvoted']['creds'] ); ?>" class="form-control" />
			</div>
		</div>
		<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="<?php echo $this->field_id( array( 'answer_mostvoted', 'limit' ) ); ?>"><?php _e( 'Limit', 'mycred' ); ?></label>
				<?php echo $this->hook_limit_setting( $this->field_name( array( 'answer_mostvoted', 'limit' ) ), $this->field_id( array( 'answer_mostvoted', 'limit' ) ), $prefs['answer_mostvoted']['limit'] ); ?>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="<?php echo $this->field_id( array( 'answer_mostvoted', 'log' ) ); ?>"><?php _e( 'Log template', 'mycred' ); ?></label>
				<input type="text" name="<?php echo $this->field_name( array( 'answer_mostvoted', 'log' ) ); ?>" id="<?php echo $this->field_id( array( 'answer_mostvoted', 'log' ) ); ?>" placeholder="<?php _e( 'required', 'mycred' ); ?>" value="<?php echo esc_attr( $prefs['answer_mostvoted']['log'] ); ?>" class="form-control" />
				<span class="description"><?php echo $this->available_template_tags( array( 'general' ) ); ?></span>
			</div>
		</div>
	</div>
</div>
<div class="hook-instance">
	<h3><?php _e( 'Product purchased', 'mycred' ); ?></h3>
	<div class="row">
		<div class="col-lg-2 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="<?php echo $this->field_id( array( 'product_purchased', 'creds' ) ); ?>"><?php echo $this->core->plural(); ?></label>
				<input type="text" name="<?php echo $this->field_name( array( 'product_purchased', 'creds' ) ); ?>" id="<?php echo $this->field_id( array( 'product_purchased', 'creds' ) ); ?>" value="<?php echo $this->core->number( $prefs['product_purchased']['creds'] ); ?>" class="form-control" />
			</div>
		</div>
		<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="<?php echo $this->field_id( array( 'product_purchased', 'limit' ) ); ?>"><?php _e( 'Limit', 'mycred' ); ?></label>
				<?php echo $this->hook_limit_setting( $this->field_name( array( 'product_purchased', 'limit' ) ), $this->field_id( array( 'product_purchased', 'limit' ) ), $prefs['product_purchased']['limit'] ); ?>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="<?php echo $this->field_id( array( 'removed_update', 'log' ) ); ?>"><?php _e( 'Log template', 'mycred' ); ?></label>
				<input type="text" name="<?php echo $this->field_name( array( 'removed_update', 'log' ) ); ?>" id="<?php echo $this->field_id( array( 'removed_update', 'log' ) ); ?>" placeholder="<?php _e( 'required', 'mycred' ); ?>" value="<?php echo esc_attr( $prefs['removed_update']['log'] ); ?>" class="form-control" />
				<span class="description"><?php echo $this->available_template_tags( array( 'general' ) ); ?></span>
			</div>
		</div>
	</div>

  <h3><?php _e( 'Product sold', 'mycred' ); ?></h3>
  <div class="row">
		<div class="col-lg-2 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="<?php echo $this->field_id( array( 'product_sold', 'creds' ) ); ?>"><?php echo $this->core->plural(); ?></label>
				<input type="text" name="<?php echo $this->field_name( array( 'product_sold', 'creds' ) ); ?>" id="<?php echo $this->field_id( array( 'product_sold', 'creds' ) ); ?>" value="<?php echo $this->core->number( $prefs['product_sold']['creds'] ); ?>" class="form-control" />
			</div>
		</div>
		<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="<?php echo $this->field_id( array( 'product_sold', 'limit' ) ); ?>"><?php _e( 'Limit', 'mycred' ); ?></label>
				<?php echo $this->hook_limit_setting( $this->field_name( array( 'product_sold', 'limit' ) ), $this->field_id( array( 'product_sold', 'limit' ) ), $prefs['product_sold']['limit'] ); ?>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="<?php echo $this->field_id( array( 'removed_update', 'log' ) ); ?>"><?php _e( 'Log template', 'mycred' ); ?></label>
				<input type="text" name="<?php echo $this->field_name( array( 'removed_update', 'log' ) ); ?>" id="<?php echo $this->field_id( array( 'removed_update', 'log' ) ); ?>" placeholder="<?php _e( 'required', 'mycred' ); ?>" value="<?php echo esc_attr( $prefs['removed_update']['log'] ); ?>" class="form-control" />
				<span class="description"><?php echo $this->available_template_tags( array( 'general' ) ); ?></span>
			</div>
		</div>
	</div>

</div>

<div class="hook-instance">
	<h3><?php _e( 'Favorite Activity', 'mycred' ); ?></h3>
	<div class="row">
		<div class="col-lg-2 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="<?php echo $this->field_id( array( 'add_favorite', 'creds' ) ); ?>"><?php echo $this->core->plural(); ?></label>
				<input type="text" name="<?php echo $this->field_name( array( 'add_favorite', 'creds' ) ); ?>" id="<?php echo $this->field_id( array( 'add_favorite', 'creds' ) ); ?>" value="<?php echo $this->core->number( $prefs['add_favorite']['creds'] ); ?>" class="form-control" />
			</div>
		</div>
		<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="<?php echo $this->field_id( array( 'add_favorite', 'limit' ) ); ?>"><?php _e( 'Limit', 'mycred' ); ?></label>
				<?php echo $this->hook_limit_setting( $this->field_name( array( 'add_favorite', 'limit' ) ), $this->field_id( array( 'add_favorite', 'limit' ) ), $prefs['add_favorite']['limit'] ); ?>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="<?php echo $this->field_id( array( 'add_favorite', 'log' ) ); ?>"><?php _e( 'Log template', 'mycred' ); ?></label>
				<input type="text" name="<?php echo $this->field_name( array( 'add_favorite', 'log' ) ); ?>" id="<?php echo $this->field_id( array( 'add_favorite', 'log' ) ); ?>" placeholder="<?php _e( 'required', 'mycred' ); ?>" value="<?php echo esc_attr( $prefs['add_favorite']['log'] ); ?>" class="form-control" />
				<span class="description"><?php echo $this->available_template_tags( array( 'general' ) ); ?></span>
			</div>
		</div>
	</div>
</div>
<div class="hook-instance">
	<h3><?php _e( 'Removing Favorit Activity', 'mycred' ); ?></h3>
	<div class="row">
		<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="<?php echo $this->field_id( array( 'remove_favorite', 'creds' ) ); ?>"><?php echo $this->core->plural(); ?></label>
				<input type="text" name="<?php echo $this->field_name( array( 'remove_favorite', 'creds' ) ); ?>" id="<?php echo $this->field_id( array( 'remove_favorite', 'creds' ) ); ?>" value="<?php echo $this->core->number( $prefs['remove_favorite']['creds'] ); ?>" class="form-control" />
			</div>
		</div>
		<div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="<?php echo $this->field_id( array( 'remove_favorite', 'log' ) ); ?>"><?php _e( 'Log template', 'mycred' ); ?></label>
				<input type="text" name="<?php echo $this->field_name( array( 'remove_favorite', 'log' ) ); ?>" id="<?php echo $this->field_id( array( 'remove_favorite', 'log' ) ); ?>" placeholder="<?php _e( 'required', 'mycred' ); ?>" value="<?php echo esc_attr( $prefs['remove_favorite']['log'] ); ?>" class="form-control" />
				<span class="description"><?php echo $this->available_template_tags( array( 'general' ) ); ?></span>
			</div>
		</div>
	</div>
</div>
<?php

		}

		/**
		 * Sanitise Preferences
		 * @since 1.6
		 * @version 1.1
		 */
		public function sanitise_preferences( $data ) {

			if ( isset( $data['update']['limit'] ) && isset( $data['update']['limit_by'] ) ) {
				$limit = sanitize_text_field( $data['update']['limit'] );
				if ( $limit == '' ) $limit = 0;
				$data['update']['limit'] = $limit . '/' . $data['update']['limit_by'];
				unset( $data['update']['limit_by'] );
			}

			if ( isset( $data['removed_update']['limit'] ) && isset( $data['removed_update']['limit_by'] ) ) {
				$limit = sanitize_text_field( $data['removed_update']['limit'] );
				if ( $limit == '' ) $limit = 0;
				$data['removed_update']['limit'] = $limit . '/' . $data['removed_update']['limit_by'];
				unset( $data['removed_update']['limit_by'] );
			}

			if ( isset( $data['add_favorite']['limit'] ) && isset( $data['add_favorite']['limit_by'] ) ) {
				$limit = sanitize_text_field( $data['add_favorite']['limit'] );
				if ( $limit == '' ) $limit = 0;
				$data['add_favorite']['limit'] = $limit . '/' . $data['add_favorite']['limit_by'];
				unset( $data['add_favorite']['limit_by'] );
			}
      if ( isset( $data['remove_favorite']['limit'] ) && isset( $data['remove_favorite']['limit_by'] ) ) {
				$limit = sanitize_text_field( $data['remove_favorite']['limit'] );
				if ( $limit == '' ) $limit = 0;
				$data['remove_favorite']['limit'] = $limit . '/' . $data['remove_favorite']['limit_by'];
				unset( $data['remove_favorite']['limit_by'] );
			}

			return $data;

		}

	}
