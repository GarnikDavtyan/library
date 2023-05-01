/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/requests.js":
/*!**********************************!*\
  !*** ./resources/js/requests.js ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "request": () => (/* binding */ request)
/* harmony export */ });
function request(route, method) {
  var form = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
  var isCreateOrUpdate = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : false;
  var withImage = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : false;
  $('.success-response').addClass('d-none');
  $('.error-response').addClass('d-none');
  $('.field-error').addClass('d-none');
  var ajaxOptions = {
    url: route,
    type: method,
    dataType: 'json',
    error: function error(xhr) {
      var errors = xhr.responseJSON.errors;
      if (errors) {
        $.each(errors, function (key, value) {
          var errorElement = $('#' + key + '-error');
          errorElement.text(value[0]);
          errorElement.removeClass('d-none');
        });
      } else {
        $('.error-response').text(xhr.responseJSON.message);
        $('.error-response').removeClass('d-none');
      }
    }
  };
  if (Object.keys(form).length !== 0) {
    if (withImage) {
      ajaxOptions.data = new FormData(form[0]);
      ajaxOptions.contentType = false;
      ajaxOptions.processData = false;
    } else {
      ajaxOptions.data = form.serialize();
    }
  }
  if (isCreateOrUpdate) {
    ajaxOptions.success = function (response) {
      $('.success-response').text(response.message);
      $('.success-response').removeClass('d-none');
    };
  } else {
    ajaxOptions.success = function (response) {
      window.location.reload();
    };
  }
  $.ajax(ajaxOptions);
}

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!*******************************!*\
  !*** ./resources/js/staff.js ***!
  \*******************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _requests_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./requests.js */ "./resources/js/requests.js");

$('#staff-create').on('submit', function (e) {
  e.preventDefault();
  (0,_requests_js__WEBPACK_IMPORTED_MODULE_0__.request)('/api/staff', 'POST', $(this), true);
});
$('#staff-edit').on('submit', function (e) {
  e.preventDefault();
  var id = $('#staff-id').val();
  (0,_requests_js__WEBPACK_IMPORTED_MODULE_0__.request)('/api/staff/' + id, 'PUT', $(this), true);
});
$('body').on('click', '#staff-delete', function (e) {
  e.preventDefault();
  var id = $(this).attr('attr-id');
  (0,_requests_js__WEBPACK_IMPORTED_MODULE_0__.request)('/api/staff/' + id, 'DELETE');
});
})();

/******/ })()
;