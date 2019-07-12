<div class="col content">
        <script type="text/javascript">
        jQuery(document).ready(function($) {
            // This is required for AJAX to work on our page
            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
            function load_all_log(page){
                $(".agovlog_pag_loading").fadeIn().css('background','#ccc');

                var data = {
                    page: page,
                    action: "agovlog-load"
                };

                $.post(ajaxurl, data, function(response) {
                    $(".agovlog_universal_container").html(response);
                    $(".agovlog_pag_loading").css({'background':'none', 'transition':'all 1s ease-out'});
                });
            }

            load_all_log(1);

            $('.agovlog_universal_container .agovlog-universal-pagination li.active').live('click',function(){
                var page = $(this).attr('p');
                load_all_log(page);

            });

        });
        </script>
        <div class="agovlog_pag_loading">
            <div class="agovlog_universal_container">
                <div class="agovlog-universal-content"></div>
            </div>
        </div>

</div>
