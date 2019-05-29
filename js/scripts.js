var flickityoptions = {	freeScroll: true,
	contain: true,
	imagesLoaded: true,
	prevNextButtons: false,
	pageDots: false};

(function ($, root, undefined) {

	$(function () {

		'use strict';

		$('.tips').tooltip();

		$("button.hamburger").click(function(){
			$(this).toggleClass('is-active');
			$(this).siblings('.menu').toggleClass('active');
		});

		//Add target blank to img links or out
		$('.woocommerce-product-gallery__image a').each(function(){
			$(this).attr('target','_blank');
		})

		//On TAB Click Event
		$(".tablinks").click(function() {
			var currenttab = $(this).parents('.cardtab');
			var activeTab = $(this).attr("data-id");
			$(".tablinks.active",currenttab[0]).removeClass("active");
			$(this).addClass("active");
			$(".tabcontent.active",currenttab[0]).removeClass('active');
			$("#tab-"+activeTab,currenttab[0]).addClass('active');
			window.location.hash = activeTab;
			var thisflick = $("#tab-"+activeTab+" ul.slider",currenttab[0]).flickity(flickityoptions);
			thisflick.flickity('resize');
			return false;
		});

		//Inicialize sliders
		$('.tabcontent.active ul.slider').flickity(flickityoptions);

		//Funcionamiento de puntos de ancla
		var $root = $('html, body');
		$('a.anchor[href^="#"]:not(".tablink"):not(".collapsed")').click(function () {
		    $root.animate({
		        scrollTop: $( $.attr(this, 'href') ).offset().top
		    }, 500);
		    return false;
		});

		//Comportamiento de hash
		var hash = window.location.hash;
		if(hash){
			jQuery('[data-id='+hash.slice(1)+']').click();
		}

		//guardado de vontest desde front
		$("#form-create-vontest").on('submit',function(e){
			if($('#createVontest').hasClass('loading')){
				return false;
			}
			$('#createVontest').addClass('loading').prop('disabled', true);
    		e.preventDefault();
    		var error = false;
			var error_field='';
			var formData = new FormData();
			formData.append('action', 'create_vontest');

			$('input[id^=vontest_],textarea[id^=vontest_],select[id^=vontest_]').each(function(){
				if(this.id == 'vontest_featuredimage')
					formData.append(this.id,$(this).prop('files')[0]);
				else
					formData.append(this.id,$(this).val());
			});
			var i = 0;
 			for (i=0; i < tinyMCE.editors.length; i++){
			    formData.append(tinyMCE.editors[i].id,tinyMCE.editors[i].getContent());
			}

	        $.ajax({
	           type : "post",
	           url : frontend_ajax_object.ajaxurl,
	           data : formData,
	           processData: false,
	           contentType: false,
	           error: function(response){
	            	console.log(response);
	            	alert("Error al guardar");
								$('#createVontest').removeClass('loading');
	           },
	           success: function(response) {
	               window.location.replace(response);
	           }
	        })
		});

		//guardado de answers desde front
		$("#form-create-answer").on('submit',function(e){
			$('#saveAnswer').addClass('loading').prop('disabled', true);
			e.preventDefault();
			var error = false;
			var error_field='';
			var formData = new FormData();
			formData.append('action', 'create_answer');
			formData.append('vontest_id', $('#form_answer').attr("vontest-id") );

			$('input[id^=vontest_],textarea[id^=vontest_]').each(function(){

				if(this.id == 'vontest_featuredimage')
					formData.append(this.id,$(this).prop('files')[0]);
				else
					formData.append(this.id,$(this).val());
			});
			$.ajax({
	           type : "post",
	           url : frontend_ajax_object.ajaxurl,
	           data : formData,
	           processData: false,
	           contentType: false,
	           error: function(response){
	            	console.log(response);
	            	alert("Error al guardar");
	           },
	           success: function(response) {
	               location.reload();
	           }
	        })
	    });

		$('.voteAnswer').click(function(){
			var button = $(this);
			if(button.hasClass('loading')){
				return false;
			}
			button.addClass('loading');
			var answer_id = $(this).attr('id');
			var formData = new FormData();
			formData.append('action', 'vote_answer');
			formData.append('vote_value',$('select[id='+answer_id+']').val());
			formData.append('answer_id',answer_id);
			formData.append('vontest_id', $('#form_answer').attr("vontest-id") );

			$.ajax({
	           type : "post",
	           url : frontend_ajax_object.ajaxurl,
	           data : formData,
	           processData: false,
	           contentType: false,
	           error: function(response){
							 button.removeClass('loading');
	            	console.log(response);
	            	alert("Error al guardar");
	           },
	           success: function(response) {
	               location.reload();
	           }
	        })
		});

		$('ul.orderby a').click(function(){
			var criteria=$(this).attr('id');
			var ul = $(this).closest('div.tabcontent').find('ul.slider');
			var li = ul.find('li');
			var div = $(this).closest('div.tabcontent').find('div.flickity-slider');
			//de menor a mayor
			if(criteria=='byname' || criteria=='bycheap'){
				li.detach().sort(function(a, b) {
			    return $(a).data(criteria).toString().localeCompare($(b).data(criteria).toString());
				}).appendTo(div);
			}
			//de mayor a menor
			else{
				li.detach().sort(function(b, a) {
			    return $(a).data(criteria).toString().localeCompare($(b).data(criteria).toString());
				}).appendTo(div);
			}
			ul.flickity('reloadCells');
			return false;
		});

		$('#unfollow_topic, #follow_topic').click(function(){
			var formData = {
				'action' : 'toogle_follow_topic',
				'term_id' : $(this).attr('data-term_id')
			};
			$.ajax({
	           type : "post",
	           url : frontend_ajax_object.ajaxurl,
	           data : formData,
						 beforeSend: function() {
							 $('#unfollow_topic, #follow_topic').addClass('loading');
						 },
	           error: function(response){
	            	console.log(response);
	            	alert("Error al guardar");
	           },
						 complete: function(){
							 $('#unfollow_topic, #follow_topic').removeClass('loading');
						 },
	           success: function(response) {
	               $('#unfollow_topic, #follow_topic').toggle();
	           }
	        })
			return false;
		});
	});
})(jQuery, this);
