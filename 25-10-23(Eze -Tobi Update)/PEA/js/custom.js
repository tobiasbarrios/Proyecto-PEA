(function () {
	'use strict';
  
	var initTestimonialSlider = function () {
	  var testimonialSlider = document.querySelectorAll('.testimonial-slider');
  
	  if (testimonialSlider.length > 0) {
		var slider = tns({
		  container: '.testimonial-slider',
		  items: 1,
		  axis: 'horizontal',
		  controlsContainer: '#testimonial-nav',
		  swipeAngle: false,
		  speed: 700,
		  nav: true,
		  controls: true,
		  autoplay: true,
		  autoplayHoverPause: true,
		  autoplayTimeout: 3500,
		  autoplayButtonOutput: false,
		});
	  }
	};
  
	var initQuantityControls = function () {
	  var increaseValue = function (quantityAmount) {
		var value = parseInt(quantityAmount.value, 10) || 0;
		quantityAmount.value = value + 1;
	  };
  
	  var decreaseValue = function (quantityAmount) {
		var value = parseInt(quantityAmount.value, 10) || 0;
		if (value > 0) {
		  quantityAmount.value = value - 1;
		}
	  };
  
	  var createBindings = function (quantityContainer) {
		var quantityAmount = quantityContainer.querySelector('.quantity-amount');
		var increase = quantityContainer.querySelector('.increase');
		var decrease = quantityContainer.querySelector('.decrease');
  
		increase.addEventListener('click', function () {
		  increaseValue(quantityAmount);
		});
  
		decrease.addEventListener('click', function () {
		  decreaseValue(quantityAmount);
		});
	  };
  
	  var init = function () {
		var quantityContainers = document.querySelectorAll('.quantity-container');
		quantityContainers.forEach(function (container) {
		  createBindings(container);
		});
	  };
  
	  init();
	};
  
	// Initialize the testimonial slider
	initTestimonialSlider();
  
	// Initialize the quantity controls
	initQuantityControls();
  })();
  