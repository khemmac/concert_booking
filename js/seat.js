function Seat(){

	this.__initEl();
	this.__initSeatEvent();

	return this;
};

Seat.prototype = {
	cfg: {
		limit:6
	},
	el: {
		seatContainer: null,
		seat: null,
		checkbox: null
	},
	__initEl: function(){
		this.el.seatContainer = $('#seat-container');
		this.el.seat = this.el.seatContainer.find('a');
		this.checkbox = this.el.seatContainer.find('input');
	},
	__initSeatEvent: function(){
		this.el.seat.bind('click', function(e){
			e.preventDefault();
			var el = $(this),
				chk_box = $(el.attr('href')),
				is_disabled = chk_box.is(':disabled');
			if(is_disabled) return false;

			var is_checked = chk_box.is(':checked');
			if(is_checked){
				el.removeClass('active');
			}else{
				el.addClass('active');
			}

			chk_box.attr("checked", !chk_box.attr("checked"));
		});
	}
};

$(function(){
	var seat = new Seat();
});