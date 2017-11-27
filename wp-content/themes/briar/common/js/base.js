window.requestAnimFrame = (function(callback) {
	return window.requestAnimationFrame ||
		window.webkitRequestAnimationFrame ||
		window.mozRequestAnimationFrame ||
		window.oRequestAnimationFrame ||
		window.msRequestAnimationFrame ||
		function(callback) {
			return window.setTimeout(callback, 1000 / 60);
		};
})();

window.cancelAnimFrame = (function(_id) {
	return window.cancelAnimationFrame ||
		window.cancelRequestAnimationFrame ||
		window.webkitCancelAnimationFrame ||
		window.webkitCancelRequestAnimationFrame ||
		window.mozCancelAnimationFrame ||
		window.mozCancelRequestAnimationFrame ||
		window.msCancelAnimationFrame ||
		window.msCancelRequestAnimationFrame ||
		window.oCancelAnimationFrame ||
		window.oCancelRequestAnimationFrame ||
		function(_id) { window.clearTimeout(id); };
})();

var FirstView = function() {
	this._header = document.getElementsByTagName('header')[0];
	this._mainContent = document.querySelector('.main_content');
	this.init();
}
FirstView.prototype = {
	init: function() {
		var _self = this;
		if (this._mainContent) {
			this._mainContent.classList.add('active')
			this._header.classList.add('top');
			setTimeout(function() { _self._header.classList.add('active') }, 50);
		}
		window.addEventListener('scroll', function() { _self.scrollLeft() }, false);
	},
	scrollLeft: function() {
		var _left = (document.documentElement && document.documentElement.scrollLeft) || document.body.scrollLeft;
		this._header.style.left = -_left + 'px';
	}
}

var Landing = function() {
	this._section = document.getElementsByClassName('section');
	this._elementList;
	this._element;
	this._offsetSection;
	this._windownH;
	this._windownW;
	this._flag;
	this._iStart;
	this._durationIn;
	this._durationOut;
	this._transX;
	this._disEffSp = true;
	this._animateSection = false;
	if (!this._section.length) return;
	this.init();
}

Landing.prototype = {
	init: function() {
		var _self = this;
		this.reset();
		window.addEventListener('load', function() { _self.onScroll() }, false);
		window.addEventListener('scroll', function() {_self.onScroll()}, 50, false);
		window.addEventListener('resize', function() {_self.onScroll()}, 50, false);
	},
	onScroll: function() {
		for (var i = 0; i < this._section.length; i++) {
			this.activeScreen(this._section[i]);
		}
	},
	activeScreen: function(_sec) {
		this._windownH = window.innerHeight;
		this._windownW = window.innerWidth;
		this._offsetSection = _sec.getBoundingClientRect().top;
		this._element = _sec.getElementsByClassName('element');
		this._elementList = _sec.querySelectorAll('.pro_gallery figure');
		this._elementStaff = _sec.querySelectorAll('.list_staff_item li');
		//set point animate pc or sp;
		this.setPoint();
		// customer start point for section
		_sec.classList.contains('slider') ? this._iStart = 0 : '';
		_sec.classList.contains('contact') ? this._iStart = 150 : '';

		if (this._offsetSection - (this._windownH - this._iStart) < 0) {
			if (!_sec.classList.contains('active')) {
				_sec.classList.add('active');
				// animate for section
				this._animateSection ? this.animate(_sec, _sec.classList.contains('active'), this.returnPc()) : '';
				// handling element
				for (var j = 0; j < this._element.length; j++) {
					this._flag = true;
					this.animate(this._element[j], this._flag, this.returnPc());
				}
				// handling element List
				for (var z = 0; z < this._elementList.length; z++) {
					!this._disEffSp || this.returnPc() ? Velocity(this._elementList[z], { opacity: 1, translateY: [0, this._transX] }, { duration: 500, delay: z * 150, queue: false, easing: 'linear' }) : this._elementList[z].style.opacity = '1';
				}
				// handling _elementStaff
				for (var z = 0; z < this._elementStaff.length; z++) {
					!this._disEffSp || this.returnPc() ? Velocity(this._elementStaff[z], { opacity: 1, translateY: [0, -this._transX] }, { duration: 500, delay: z * 150, queue: false, easing: 'linear' }) : this._elementStaff[z].style.opacity = '1';
				}
			}
		} else {
			// this for animate Out
		}
	},
	setPoint: function() {
		this.point = function(_iStart, _durationIn, _durationOut, _transX) {
			this._iStart = _iStart;
			this._durationIn = _durationIn;
			this._durationOut = _durationOut;
			this._transX = _transX;
		}
		this.returnPc() ? this.point(500, 400, 300, 60) : this.point(50, 400, 400, 50);
	},
	returnPc: function() {
		var _pc;
		this._windownW = window.innerWidth;
		this._windownW > 768 ? _pc = true : _pc = false;
		return _pc;
	},
	animate: function(_ele, _status, _pc) {
		if (/translateleft/.test(_ele.className)) {
			this.translateleft(_ele, _status, this._disEffSp, _pc);
		} else if (/translateright/.test(_ele.className)) {
			this.translateright(_ele, _status, this._disEffSp, _pc);
		} else if (/translateup/.test(_ele.className)) {
			this.translateUp(_ele, _status, this._disEffSp, _pc);
		} else if (/translatedown/.test(_ele.className)) {
			this.translateDown(_ele, _status, this._disEffSp, _pc);
		}else if (/scale/.test(_ele.className)) {
			this.scale(_ele, _status, this._disEffSp, _pc);
		} else {
			this.fade(_ele, _status, this._disEffSp, _pc);
		}
	},
	fade: function(_item, _status, _effSp, _pc) {
		if (!_effSp || _pc) {
			_status ?
				Velocity(_item, { opacity: 1 }, { duration: this._durationIn, delay: 0, queue: false, easing: 'linear' }) :
				Velocity(_item, { opacity: 0 }, { duration: this._durationOut, delay: 0, queue: false, easing: 'linear' });
		} else { _item.style.opacity = '1' }
	},
	translateright: function(_item, _status, _effSp, _pc) {
		if (!_effSp || _pc) {
			_status ?
				Velocity(_item, { opacity: 1, translateX: [0, this._transX] }, { duration: this._durationIn, delay: 0, queue: false, easing: 'linear' }) :
				Velocity(_item, { opacity: 0, translateX: [this._transX, 0] }, { duration: this._durationOut, delay: 0, queue: false, easing: 'linear' });
		} else { _item.style.opacity = '1' }
	},
	translateleft: function(_item, _status, _effSp, _pc) {
		if (!_effSp || _pc) {
			_status ?
				Velocity(_item, { opacity: 1, translateX: [0, -this._transX] }, { duration: this._durationIn, delay: 0, queue: false, easing: 'linear' }) :
				Velocity(_item, { opacity: 0, translateX: [-this._transX, 0] }, { duration: this._durationOut, delay: 0, queue: false, easing: 'linear' });
		} else { _item.style.opacity = '1' }
	},
	translateUp: function(_item, _status, _effSp, _pc) {
		if (!_effSp || _pc) {
			_status ?
				Velocity(_item, { opacity: 1, translateY: [0, this._transX] }, { duration: this._durationIn, delay: 0, queue: false, easing: 'linear' }) :
				Velocity(_item, { opacity: 0, translateY: [this._transX, 0] }, { duration: this._durationOut, delay: 0, queue: false, easing: 'linear' });
		} else { _item.style.opacity = '1' }
	},
	translateDown: function(_item, _status, _effSp, _pc) {
		if (!_effSp || _pc) {
			_status ?
				Velocity(_item, { opacity: 1, translateY: [0, -this._transX] }, { duration: this._durationIn, delay: 0, queue: false, easing: 'linear' }) :
				Velocity(_item, { opacity: 0, translateY: [-this._transX, 0] }, { duration: this._durationOut, delay: 0, queue: false, easing: 'linear' });
		} else { _item.style.opacity = '1' }
	},
	scale: function(_item, _status, _effSp, _pc) {
		if (!_effSp || _pc) {
			_status ?
				Velocity(_item, { opacity: 1, scale: [1, 0.2] }, { duration: this._durationIn, delay: 0, queue: false, easing: 'linear' }) :
				Velocity(_item, { opacity: 0, scale: [0, 1] }, { duration: this._durationOut, delay: 0, queue: false, easing: 'linear' });
		} else { _item.style.opacity = '1' }
	},
	reset: function() {
		var _ele = document.getElementsByClassName('element'),
				_eleList = document.querySelectorAll('.pro_gallery figure');
				_eleStaff = document.querySelectorAll('.list_staff_item li');
		for (var i = 0; i < this._section.length; i++) {
			this._disEffSp && !this._animateSection ? this._section[i].style.opacity = '1' :  this._section[i].style.opacity = '0';
		}
		for (var j = 0; j < _ele.length; j++) {
			this._disEffSp && !this.returnPc() ? _ele[j].style.opacity = '1' : _ele[j].style.opacity = '0';
		}
		for (var n = 0; n < _eleList.length; n++) {
			this._disEffSp && !this.returnPc() ? _eleList[n].style.opacity = '1' : _eleList[n].style.opacity = '0';
		}
		 for (var n = 0; n < _eleStaff.length; n++) {
			this._disEffSp && !this.returnPc() ? _eleStaff[n].style.opacity = '1' : _eleStaff[n].style.opacity = '0';
		}
	}
}


var AutoHover = function(_type) {
	this._type = _type;
	this._targets = document.getElementsByClassName(this._type);
	if (!this._targets.length) return;
	this.init();
};
AutoHover.prototype = {
	init: function() {
		var _self = this;
		var i = 0 | 0;
		for (i = 0; i < this._targets.length; i = (i + 1) | 0) {
			this._targets[i].addEventListener('mouseenter', function(e) { _self.onMouseOver({ currentTarget: e.currentTarget, self: _self }) }, false);
			this._targets[i].addEventListener('mouseleave', function(e) { _self.onMouseOut({ currentTarget: e.currentTarget, self: _self }) }, false);
		};
	},
	onMouseOver: function(e) {
		if (e.self._type === 'img_ovr') {
			e.currentTarget.setAttribute('src', e.currentTarget.getAttribute('src').replace(/_off/ig, '_on'));
			return;
		}
		Velocity(e.currentTarget, 'stop');
		Velocity(e.currentTarget, { opacity: 0.7 }, { duration: 300, delay: 0, easing: 'easeOutSine' });
	},
	onMouseOut: function(e) {
		if (e.self._type === 'img_ovr') {
			e.currentTarget.setAttribute('src', e.currentTarget.getAttribute('src').replace(/_on/ig, '_off'));
			return;
		}
		Velocity(e.currentTarget, 'stop');
		Velocity(e.currentTarget, { opacity: 1 }, { duration: 300, delay: 0, easing: 'easeInSine' });
	}
}

var PageTop = function() {
	this._targets = document.getElementsByClassName('pagetop');
	if (!this._targets.length) return;
	this.init();
}
PageTop.prototype = {
	_isShow: false,
	init: function() {
		var _self = this;
		window.addEventListener('scroll', _.debounce(function() { _self.onScroll(); }, 50), false);
	},
	onScroll: function() {
		var _top = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;
		_top > 0 ? this.show() : this.hide();
	},
	show: function() {
		if (this._isShow) return;
		this._isShow = true;
		this.setVisible(1);
	},
	hide: function() {
		if (!this._isShow) return;
		this._isShow = false;
		this.setVisible(0);
	},
	setVisible: function(_opacity) {
		var i = 0 | 0;
		for (i = 0; i < this._targets.length; i = (i + 1) | 0) {
			Velocity(this._targets[i], 'stop');
			Velocity(this._targets[i], { opacity: _opacity }, { duration: 100, delay: 0, easing: 'easeOutSine' });
		};
	}
}

var AnchorLink = function() {
	this._targets = document.querySelectorAll('a[href^="#"]');
	 this._header = document.getElementsByTagName('header')[0];
	if (!this._targets.length) return;
	this.init();
}
AnchorLink.prototype = {
	init: function() {
		var _self = this;
		var i = 0 | 0;
		for (i = 0; i < this._targets.length; i = (i + 1) | 0) {
			this._targets[i].addEventListener('click', function(e) { _self.onClickHD(e) }, false);
		};
	},
	onClickHD: function(_e) {
		var _hash = _e.currentTarget.getAttribute('href').replace('#', ''),
			_headerH = this._header.clientHeight;
		Velocity(document.getElementById(_hash), 'scroll', { duration: 1000, offset: -_headerH, delay: 0, easing: 'easeInOutSine' });
		//_e.preventDefault();
	}
}

window.addEventListener('DOMContentLoaded', function() {
	if (window.jQuery) window.Velocity = window.jQuery.fn.velocity;
	new AutoHover('img_ovr');
	new AutoHover('alpha_ovr');
	new PageTop();
	new AnchorLink();
	new FirstView();
	new Landing();
});
jQuery.colorbox.settings.maxWidth  = '95%';
jQuery.colorbox.settings.maxHeight = '95%';
var resizeTimer;
function resizeColorBox(){
	if (resizeTimer) clearTimeout(resizeTimer);
	resizeTimer = setTimeout(function() {
			if (jQuery('#cboxOverlay').is(':visible')) {
					jQuery.colorbox.load(true);
			}
	}, 300);
}
jQuery(window).resize(resizeColorBox);
window.addEventListener("orientationchange", resizeColorBox, false);

$(document).ready(function() {
	$('.banner_list').slick({
		autoplay: true,
		autoplaySpeed: 6500,
		slidesToScroll: 1,
		infinite: true,
		dots: false,
		arrows: true,
		responsive: [{
			breakpoint: 769,
			settings: {
				arrows: false,
				dots: true
			},
			breakpoint: 481,
			settings: {
				arrows: false,
				dots: false
			}
		}]
	});
	$('.list_staff_item').slick({
		autoplay: true,
		autoplaySpeed: 5000,
		centerPadding: '50%',
		slidesToShow: 3,
		slidesToScroll: 1,
		infinite: true,
		dots: false,
		arrows: true,
		responsive: [{
			breakpoint: 769,
			settings: {
				centerPadding: '10px',
				slidesToShow: 3,
				slidesToScroll: 1,
				arrows: false,
			},
			breakpoint: 481,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
				centerPadding: false,
				arrows: false,
			}
		}]
	});
	$('.wel_lst').slick({
		autoplay: true,
		autoplaySpeed: 7000,
		slidesToScroll: 1,
		infinite: true,
		dots: true,
		arrows: true,
		prevArrow: false,
		nextArrow: false,
		responsive: [{
			breakpoint: 769,
			settings: {
				arrows: false,
				dots: true
			}
		}]
	});
	$('.pro_gallery .img-path').colorbox({
		rel: 'img-path',
		transition: "fade",
	});
	$('.slick-prev').addClass('element translateleft');
	$('.slick-next').addClass('element translateright');

	onChangeMedia();
});
// scroll
$(window).on('scroll', function () {
  var header = $('.head_gallery').height();
  var scrollTop = $(window).scrollTop();
  if (scrollTop > header) {
    $('.head_gallery').addClass('fixed fadeInDown');
  }
  else {
    $('.head_gallery').removeClass('fixed fadeInDown');
  }
});
// work with media screen
function onChangeMedia() {
	if ($(window).width() <= 768) {
		$('.hamburger').addClass('active');

		$(".drop_down_lst").slideUp('slow');
		$(".drop_down").click(function() {
			$('.drop_down_lst li').removeClass('animated fadeInLeft');
			$(this).find('.drop_down_lst').slideToggle('500').addClass('active');
			$(this).siblings().find('.active').each(function() {
				$(this).slideUp('500').removeClass('active');
			});
		});

		$('.pro_gallery .img-path').colorbox({
			width:'100%',
			maxHeight:'100%'
		});

	}else {
		$('.hamburger').removeClass('active');
		$('.nav_menu ul li').css('display', 'block');
		$(".drop_down_lst").slideUp('slow');
		$(".drop_down").hover(function() {
			$(this).find('.drop_down_lst').slideToggle('500').addClass('active');
			$(this).siblings().find('.active').each(function() {
				$(this).slideUp('500').removeClass('active');
			});
		});

		$('.search_ar').click(function() {
			$('.search_btn').not('.search_btn').removeClass('active');
			$('.search_btn').toggleClass('active');
		});
	}
}
$(window).resize(function() {
	onChangeMedia();
});

// hamburger-box
$('.hamburger').click(function(){
	if($(this).hasClass('is-active') != true){
		$(this).addClass('is-active');
		$('.nav_menu').addClass('active animated fadeIn');
		$('.nav_menu ul li').each(function(i) {
			var el=$(this);
			setTimeout(function() {
				el.css('display', 'block');
				el.addClass('animated fadeInLeft');
			}, i * 50);
		});
		$('a').click(function(){
			$('.hamburger').removeClass('is-active');
			$('.nav_menu').removeClass('active');
		});
		$('body').css('overflow', 'hidden');
		$('.search_form').delay(500).addClass('active');
		$('.search_form .search_btn').delay(300).addClass('active animated fadeIn');
		$('.search_form .search_ar').delay(325).addClass('active animated fadeIn');
	}
	else{
		$(this).removeClass('is-active');
		$('.nav_menu').removeClass('active animated fadeIn');
		$('.nav_menu ul li').css('display', 'none');
		$('.nav_menu ul li').removeClass('animated fadeInLeft');
		$('body').css('overflow', 'auto');
	}
});