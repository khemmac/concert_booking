function Seat(cfg){
	var _this=this;
	if(cfg){
		for(var k in cfg){
			_this.cfg[k] = cfg[k];
		}
	}

	this.__initEl();
	this.__initSeatEvent();

	return this;
};

Seat.prototype = {
	cfg: {
		current:0,
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
		this.el.checkbox = this.el.seatContainer.find('input[name="seat\[\]"]');
	},
	__initSeatEvent: function(){
		var _this=this;

		this.el.seat.bind('click', function(e){
			e.preventDefault();
			var el = $(this),
				chk_box = $(el.attr('href')),
				is_disabled = chk_box.is(':disabled');
			if(is_disabled) return false;

			var is_checked = chk_box.is(':checked');
			if(is_checked){
				_this.cfg.current--;
				console.log(_this.cfg.current);
				el.removeClass('active');
			}else{
				// ถ้าเป็นการจองที่นั่งเพิ่มให้บอกค่าเข้าไป
				_this.cfg.current++;
				console.log(_this.cfg.current);
				if(_this.cfg.current > _this.cfg.limit){
					_this.cfg.current = _this.cfg.limit;
					common.popup.show(null, '#seat-limit-popup');
					return false;
				}else{
					el.addClass('active');
				}
			}

			chk_box.attr("checked", !chk_box.attr("checked"));
		});

		$('#submit').bind('click', function(e){
			if(_this.el.seatContainer.find('input[name="seat\[\]"]:checked').length<=0){
				e.preventDefault();
				common.popup.show(null, '#seat-no-select-popup');
			}
		});

		$('#seat-no-select-popup .ok').bind('click', function(e){
			e.preventDefault();
			self.location.href=__site_url+'/zone';
		});

	}
};