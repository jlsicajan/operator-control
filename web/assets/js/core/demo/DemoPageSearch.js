<<<<<<< HEAD
(function(namespace, $) {
	"use strict";

	var DemoPageSearch = function() {
		// Create reference to this instance
		var o = this;
		// Initialize app when document is ready
		$(document).ready(function() {
			o.initialize();
		});

	};
	var p = DemoPageSearch.prototype;

	// =========================================================================
	// MEMBERS
	// =========================================================================

	p.map = null;

	// =========================================================================
	// INIT
	// =========================================================================

	p.initialize = function() {
		this._initDatePicker();
		this._initMultiselect();
	};

	// =========================================================================
	// MULTISELECT
	// =========================================================================

	p._initMultiselect = function() {
		if (!$.isFunction($.fn.multiselect)) {
			return;
		}

		$('select[name="category"]').multiselect({
			buttonClass: 'form-control',
			buttonContainer: '<div class="btn-group btn-group-justified" />'
		});
	};

	// =========================================================================
	// DATETIME
	// =========================================================================

	p._initDatePicker = function() {
		if (!$.isFunction($.fn.datepicker)) {
			return;
		}

		$('.input-daterange').datepicker({todayHighlight: true});
	};

	// =========================================================================
	namespace.DemoPageSearch = new DemoPageSearch;
}(this.materialadmin, jQuery)); // pass in (namespace, jQuery):
=======
(function(namespace, $) {
	"use strict";

	var DemoPageSearch = function() {
		// Create reference to this instance
		var o = this;
		// Initialize app when document is ready
		$(document).ready(function() {
			o.initialize();
		});

	};
	var p = DemoPageSearch.prototype;

	// =========================================================================
	// MEMBERS
	// =========================================================================

	p.map = null;

	// =========================================================================
	// INIT
	// =========================================================================

	p.initialize = function() {
		this._initDatePicker();
		this._initMultiselect();
	};

	// =========================================================================
	// MULTISELECT
	// =========================================================================

	p._initMultiselect = function() {
		if (!$.isFunction($.fn.multiselect)) {
			return;
		}

		$('select[name="category"]').multiselect({
			buttonClass: 'form-control',
			buttonContainer: '<div class="btn-group btn-group-justified" />'
		});
	};

	// =========================================================================
	// DATETIME
	// =========================================================================

	p._initDatePicker = function() {
		if (!$.isFunction($.fn.datepicker)) {
			return;
		}

		$('.input-daterange').datepicker({todayHighlight: true});
	};

	// =========================================================================
	namespace.DemoPageSearch = new DemoPageSearch;
}(this.materialadmin, jQuery)); // pass in (namespace, jQuery):
>>>>>>> 070f9b57d8747528afb295c6b752c7ddcfb9831a
