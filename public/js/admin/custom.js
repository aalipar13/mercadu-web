/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/admin/custom.js":
/***/ (function(module, exports) {

/**
 * Delete confirmation
 * 
 */
$('button[name="delete-me"]').on('click', function (e) {
    e.preventDefault();
    var $form = $(this).closest('form');
    $('#confirm-delete').on('click', '#delete', function (e) {
        $form.trigger('submit'); // submit the form
    });
});

/**
 * Update confirmation
 * 
 */
$('button[name="update-me"]').on('click', function (e) {
    e.preventDefault();
    var $form = $(this).closest('form');
    $('#confirm-update').on('click', '#update', function (e) {
        $form.trigger('submit'); // submit the form
    });
});

/**
 * Fade Out Alert Message
 */
$('.alert-flash').delay(2000).fadeOut(400);

/**
 * Add More Fields
 */
$(document).ready(function () {
    var max_fields = 5; //maximum input boxes allowed
    var wrapper = $(".input_fields_wrap"); //Fields wrapper
    var add_button = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function (e) {
        //on add input button click
        e.preventDefault();
        if (x < max_fields) {
            //max input box allowed
            $(wrapper).append('<div class="store-photos"><input name="photo[' + x + ']" type="file" class="col-md-8 store-file"><a href="#" class="remove_field col-md-4">Remove</a><div>'); //add input box
            x++; //text box increment
        }
    });

    $(wrapper).on("click", ".remove_field", function (e) {
        //user click on remove text
        e.preventDefault();$(this).parent('div').remove();x--;
    });

    /**
     * Disable button if no file uploaded
     */
    $('input:file.photos-add').change(function () {
        if ($(this).val()) {
            $('.btn-add').attr('disabled', false);
        }
    });

    $('input:file.photos-update').change(function () {
        if ($(this).val()) {
            $('.btn-update').attr('disabled', false);
        }
    });
});

// Tag Mapping on change select option
$('.store-name').change(function () {
    $('.tag-list').empty();
    $('.product-list').empty();

    fetchTags();
    fetchProducts();
});

/**
 * Fetch Tags by Store Id
 * 
 * @param  $storeId
 * @return mixed
 */
function fetchTags() {
    // Get the store id from the store select
    var storeId = $('.store-name').find(":selected").val();

    $.ajax({
        type: 'GET',
        url: '/admin/tag-mapping/fetchTags/' + storeId,
        error: function error() {
            console.log('Error!');
        },
        success: function success(data) {
            console.log(data);
            $.each(data, function (i, item) {
                $('.tag-list').append($('<option>', {
                    value: i,
                    text: item
                }));
            });
        }
    });
}

/**
 * Fetch Products by Store Id
 * 
 * @param  $storeId
 * @return mixed
 */
function fetchProducts() {
    // Get the store id from the store select
    var storeId = $('.store-name').find(":selected").val();

    $.ajax({
        type: 'GET',
        url: '/admin/tag-mapping/fetchProducts/' + storeId,
        error: function error() {
            console.log('Error!');
        },
        success: function success(data) {
            console.log(data);
            $.each(data, function (i, item) {
                $('.product-list').append($('<option>', {
                    value: i,
                    text: item
                }));
            });
        }
    });
}

/***/ }),

/***/ "./resources/assets/sass/admin/custom.scss":
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/assets/js/admin/custom.js");
module.exports = __webpack_require__("./resources/assets/sass/admin/custom.scss");


/***/ })

/******/ });