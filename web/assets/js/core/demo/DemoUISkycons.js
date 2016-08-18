<<<<<<< HEAD
(function(namespace, $) {
	"use strict";

	var DemoUISkycons = function() {
		// Create reference to this instance
		var o = this;
		// Initialize app when document is ready
		$(document).ready(function() {
			o.initialize();
		});

	};
	var p = DemoUISkycons.prototype;
	
	// =========================================================================
	// INIT
	// =========================================================================

	p.initialize = function() {
		this._initSkycons();
	};

	// =========================================================================
	// Skycons
	// =========================================================================

	p._initSkycons = function () {
		var skycons = new Skycons({"color": "black"});
		$('canvas').each(function(){
			skycons.add($(this).get(0), Skycons[$(this).data('type')]);
		});
		skycons.play();
	};

	// =========================================================================
	namespace.DemoUISkycons = new DemoUISkycons;
}(this.materialadmin, jQuery)); // pass in (namespace, jQuery):
=======
(function(namespace, $) {
	"use strict";

	var DemoUISkycons = function() {
		// Create reference to this instance
		var o = this;
		// Initialize app when document is ready
		$(document).ready(function() {
			o.initialize();
		});

	};
	var p = DemoUISkycons.prototype;
	
	// =========================================================================
	// INIT
	// =========================================================================

	p.initialize = function() {
		this._initSkycons();
	};

	// =========================================================================
	// Skycons
	// =========================================================================

	p._initSkycons = function () {
		var skycons = new Skycons({"color": "black"});
		$('canvas').each(function(){
			skycons.add($(this).get(0), Skycons[$(this).data('type')]);
		});
		skycons.play();
	};

	// =========================================================================
	namespace.DemoUISkycons = new DemoUISkycons;
}(this.materialadmin, jQuery)); // pass in (namespace, jQuery):
>>>>>>> 070f9b57d8747528afb295c6b752c7ddcfb9831a
