;jQuery(function($) {
	/**
	 * Set a horizontal gradient background image on an element.
	 * Uses the now-deprecated $.browser
	 * @param $ element
	 * @param $.colorpicker.Color startColor
	 * @param $.colorpicker.Color endColor
	 * @returns {undefined}
	 */
	function setGradient(element, startColor, endColor) {
		var start	= startColor.toCSS(),
			end		= endColor.toCSS(),
			styles = window.getComputedStyle(document.documentElement, ''),	
			prefix = (Array.prototype.slice.call(styles).join('').match(/-(moz|webkit|ms)-/) || (styles.OLink === '' && ['', 'o']))[1];
		  
		element.css('background-image', '-'+prefix+'-linear-gradient(left, '+start+' 0%, '+end+' 100%)');
	}

	$.colorpicker.parts.rgbslider = function (inst) {
		var that	= this,
			sliders	= {	r: $('<div class="ui-colorpicker-slider"/>'),
						g: $('<div class="ui-colorpicker-slider"/>'),
						b: $('<div class="ui-colorpicker-slider"/>')
					};

		this.init = function () {
			$('<div class="ui-colorpicker-rgbslider"/>').append(sliders.r, sliders.g, sliders.b)
			.appendTo($('.ui-colorpicker-rgbslider-container', inst.dialog));

			function refresh() {
				var min,
					max,
					r = sliders.r.slider('value') / 255,
					g = sliders.g.slider('value') / 255,
					b = sliders.b.slider('value') / 255;

				inst.color.setRGB(r, g, b);

				setGradient(sliders.r, new $.colorpicker.Color(0, g, b), new $.colorpicker.Color(1, g, b));
				setGradient(sliders.g, new $.colorpicker.Color(r, 0, b), new $.colorpicker.Color(r, 1, b));
				setGradient(sliders.b, new $.colorpicker.Color(r, g, 0), new $.colorpicker.Color(r, g, 1));

				inst._change();
			}

			$(sliders.r).add(sliders.g).add(sliders.b).slider({
				min: 0,
				max: 255,
				step: 1,
				slide:	refresh,
				change:	refresh
			});
		};

		this.repaint = function () {
			$.each(inst.color.getRGB(), function (index, value) {
				var input = sliders[index];
				value = Math.round(value * 255);
				if (input.slider('value') !== value) {
					input.slider('value', value);
				}
			});
		};

		this.update = function () {
			this.repaint();
		};
		
		this.disable = function (disabled) {
			sliders.r.slider(disabled ? 'disable' : 'enable');
			sliders.g.slider(disabled ? 'disable' : 'enable');
			sliders.b.slider(disabled ? 'disable' : 'enable');
		};
	};
});