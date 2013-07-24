function Common(){

};

Common.prototype = {
	initFormTip : function(){
		$('input[qtip-data]').qtip({
			content: { attr: 'qtip-data' },
			show: {
				when: false, // Don't specify a show event
				ready: true // Show the tooltip when ready
			},
			hide: 'keyup', // hide when key on input
			//hide: false, // Don't specify a hide event
			position: {
				my: 'center left',
				at: 'center right',
				adjust: { x: 5 }
			},
			style: {
				classes: 'qtip-red'
			}
		});
	},
	popup : {
		init : function(){
			var _this=this;
			//if close button is clicked
			$('.window .close').click(function (e) {
				//Cancel the link behavior
				e.preventDefault();
				_this.hide();
			});

			//if mask is clicked
			$('#mask').click(function () {
				_this.hide();
			});

			$(window).resize(function () {
				var box = $('#boxes .window');

				//Get the screen height and width
				var maskHeight = $(document).height();
				var maskWidth = $(window).width();

				//Set height and width to mask to fill up the whole screen
				$('#mask').css({'width':maskWidth,'height':maskHeight});

				//Get the window height and width
				var winH = $(window).height();
				var winW = $(window).width();

				//Set the popup window to center
				box.css('top',  winH/2 - box.height()/2);
				box.css('left', winW/2 - box.width()/2);
			});
		},
		show : function(){
			//Get the A tag
			var id = '#common-popup';//$(this).attr('href');

			//Get the screen height and width
			var maskHeight = $(document).height();
			var maskWidth = $(window).width();

			//Set height and width to mask to fill up the whole screen
			$('#mask').css({'width':maskWidth,'height':maskHeight});

			//transition effect
			//$('#mask').fadeIn(1000);
			//$('#mask').fadeTo("slow",0.8);
			$('#mask').fadeTo(200, 0.6);

			//Get the window height and width
			var winH = $(window).height();
			var winW = $(window).width();

			//Set the popup window to center
			$(id).css('top',  winH/2-$(id).height()/2);
			$(id).css('left', winW/2-$(id).width()/2);

			//transition effect
			$(id).fadeIn(200);
		},
		hide : function(){
			$('#mask, .window').hide();
		}
	},
	combo : {
		create : function(el, cls){
			el.sexyCombo({
				triggerSelected: true,
				skin: 'custom',
				initCallback: function() {
					var parent = el.parent('.combo');
					parent
						.addClass(cls)
						.find('input[type="text"]').on('blur', function(){
							$(this).val(parent.find('select>option:selected').text());
						});
				}
			});
		}
	}
};

$(function(){
	var common = window['common'] = new Common();

	common.initFormTip();

	common.popup.init();

	$('#menu-1 a.menu-1, #menu-2 a.menu-4').click(function(e) {
		//Cancel the link behavior
		e.preventDefault();

		common.popup.show();
	});
})
