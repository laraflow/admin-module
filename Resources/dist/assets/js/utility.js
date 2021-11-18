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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./Resources/src/js/utility.js":
/*!*************************************!*\
  !*** ./Resources/src/js/utility.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * Trigger Delete Modal
 */
function initDeleteModal() {
  $(".delete-btn").click(function (event) {
    //stop href to trigger
    event.preventDefault(); //Model

    var deleteModalElement = $("#deleteModal"); //ahref has link

    var url = this.getAttribute('href');

    if (url.length > 0 && url !== "#") {
      //Ajax
      $.get(url, function (response) {
        $("#deleteConfirmationForm").empty().html(response);
      }, 'html').done(function () {}).fail(function (error) {
        $("#deleteConfirmationForm").empty().html(error.responseText);
      }).always(function () {
        deleteModalElement.modal({
          backdrop: 'static',
          show: true
        });
      });
    }
  });
}
/**
 * Modal Enabled Status Update
 */


function toggleEnabledStatus() {
  $(".toggle-class").change(function () {
    var toggle = $(this);
    var fieldData = toggle.prop("checked") === true ? toggle.data("on") : toggle.data("off");
    $.get(TOGGLE_URL, {
      m: toggle.data("model"),
      i: toggle.data("id"),
      f: toggle.data("field"),
      v: fieldData
    }, function (response) {
      if (response.status === 200) {
        //@TODO add notify popup
        console.log(response);
      } else {
        console.log(response);
      }
    }, "json");
  });
}
/**
 * Mark search keyword in table
 *
 * @param searchElement
 * @param targetTable
 */


function highLightQueryString(searchElement, targetTable) {
  var JqSearchElement = $("#" + searchElement);
  var JqTargetTable = $("#" + targetTable);
  var searchText = JqSearchElement.val();
  var searchTextLength = searchText.length; //only if search text in not empty

  if (searchTextLength > 0) {
    JqTargetTable.find("tr").each(function () {
      $(this).find("td").each(function () {
        var tableCell = $(this);

        if (!tableCell.hasClass("exclude-search")) {
          var innerHtml = tableCell.html();
          var patternPosition = innerHtml.search(new RegExp(searchText, "igmsu"));

          if (patternPosition !== -1) {
            var innerContent = innerHtml.substr(patternPosition, searchTextLength);
            tableCell.html(innerHtml.replace(innerContent, "<span class='text-dark bg-warning py-1 px-0'>" + innerContent + "</span>"));
          }
        }
      });
    });
  }
}
/**
 * Filter Table Row based on search Query
 *
 * @param filter
 * @param targetTable
 */


function searchFilter(filter, targetTable) {
  $("#" + targetTable).find("tbody tr").each(function () {
    var row = $(this);

    if (filter.length >= 1) {
      var cellText = row.find("td").eq(1).text();

      if (cellText.toLowerCase().indexOf(filter.toLowerCase()) < 0) {
        row.hide();
      } else {}
    } else {
      row.show();
    }
  });
}
/**
 * Validation Type
 * @param fileType
 * @returns {{error: string, status: boolean}}
 */


function fileTypeValidation(fileType) {
  if (fileType != 'image/png' && fileType != 'image/jpg' && fileType != 'image/gif' && fileType != 'image/jpeg') {
    return {
      "status": false,
      "error": "<b>Invalid File Type (" + fileType + ")</b>. Allowed (.jpg, .png, .gif)."
    };
  } else {
    return {
      "status": true,
      "error": "<b>Valid File Type (" + fileType + ")</b>."
    };
  }
}
/**
 * File Validation Size
 * @param fileSize
 * @param minSize
 * @param maxSize
 * @returns {{error: string, status: boolean}}
 */


function fileSizeValidation(fileSize, minSize, maxSize) {
  if (fileSize < minSize || fileSize > maxSize) {
    return {
      "status": false,
      "error": "<b>Invalid File Size( " + fileSize.toFixed(2) + " kb)</b>." + " Allowed between " + minSize + " kb to " + maxSize + " kb"
    };
  } else return {
    "status": true,
    "error": "<b>Valid File Size (" + fileSize + "kb)</b>."
  };
}
/**
 * Resolution Validation
 * @param imgWidth
 * @param imgHeight
 * @param minWidth
 * @param minHeight
 * @param maxWidth
 * @param maxHeight
 * @param stdRatio
 * @returns {{error: string, status: boolean}}
 */


function imageResolutionValidation(imgWidth, imgHeight, minWidth, minHeight, maxWidth, maxHeight, stdRatio) {
  var ratio = (imgWidth / imgHeight).toPrecision(3);
  /* Maximum Width */

  if (imgWidth > maxWidth || imgHeight > maxHeight) {
    return {
      "status": false,
      "error": "<b>Invalid Resolution( Width: " + imgWidth + " px , Height: " + imgHeight + "px )</b>." + " Allowed maximum width: " + maxWidth + "px , height: " + maxHeight + "px."
    };
  }
  /* Minimum Width */
  else if (imgWidth < minWidth || imgHeight < minHeight) {
    return {
      "status": false,
      "error": "<b>Invalid Resolution( Width: " + imgWidth + " px , Height: " + imgHeight + "px )</b>." + " Allowed minimum width: " + minWidth + "px , height:  " + minHeight + "px."
    };
  }
  /* Image Ratio */
  else if (ratio != stdRatio) {
    return {
      "status": false,
      "error": "<b>Invalid Image Scale ( Ratio: " + ratio + " )</b>." + " Allowed Ratio Scale of " + stdRatio + "."
    };
  } else {
    return {
      "status": true,
      "error": "<b>Image Validation Successful.</b>"
    };
  }
}
/***************************************** JQuery Validation **********************************/


if (typeof $.validator === 'function') {
  //default proof
  var proof = null;
  var fileSize = 0; //Set Template for Error Validation

  $.validator.setDefaults({
    errorElement: "span",
    errorClass: "invalid-feedback",
    errorPlacement: function errorPlacement(error, element) {
      // Add the `help-block` class to the error element
      if (element.prop("type") === "checkbox") {
        error.insertAfter(element.parent("label"));
      } else {
        if (element.next('span')) element.next('span').replaceWith(error);else error.insertAfter(element);
      }
    },
    highlight: function highlight(element, errorClass, validClass) {
      $(element).addClass('is-invalid').removeClass('is-valid');
    },
    unhighlight: function unhighlight(element, errorClass, validClass) {
      $(element).addClass('is-valid').removeClass('is-invalid');
    }
  }); //regex match method

  $.validator.addMethod("regex", function (value, element, regexp) {
    var re = new RegExp(regexp);
    return this.optional(element) || re.test(value);
  }, "Please check your input.(Invalid Format)"); //name match method

  $.validator.addMethod("nametitle", function (value, element) {
    return this.optional(element) || /[a-zA-Z\s]+$/.test(value);
  }, "Please enter only alphabets and spaces."); //mobile number match method

  $.validator.addMethod("mobilenumber", function (value, element) {
    return this.optional(element) || /^01[0-9]{9}$/.test(value);
  }, "Please enter value on this 01XXXXXXXXX format."); //applicant's id & password match method

  $.validator.addMethod("credential", function (value, element) {
    return this.optional(element) || /^[a-zA-Z0-9]{8,10}$/.test(value);
  }, "Please enter only alphabet and numbers.");
  $.validator.addMethod("filesize", function (value, element) {
    return !!(this.optional(element) || value < 50 || value > 1000);
  }, "Please enter file size between 50 kb to 1000 kb");
  $.validator.addMethod("noSpace", function (value, element) {
    return this.optional(element) || value.indexOf(" ") < 0 && value.length >= 1;
  }, "No space please and don't leave it empty");
  $.validator.addMethod("username", function (value, element) {
    return this.optional(element) || /^[a-zA-Z0-9\-\.]+$/i.test(value);
  }, "Letters, numbers, hyphen sign and dot only please");
  $.validator.addMethod("notEqualPassword", function (value, element, param) {
    return this.optional(element) || value !== param;
  }, "Old/Temporary password should not match with new password."); //@TODO current message set to 8 MB need some improvements

  $.validator.addMethod("videofilesize", function (value, element, param) {
    //console.log(element.files[0].size);
    return this.optional(element) || element.files[0].size <= param;
  }, "Upload Max File Size Limit 8MB. Try another file.");
  /*
      //AJAx Based Unique user name confirm
      /!**
       * @param value inout field value
       * @param element input field
       * @param id user id for edit except purpose
       *!/
      $.validator.addMethod('uniqueusername', function (value, element, id) {
          $.post(USERNAME_FIND_URL, {username: value, _token: CSRF_TOKEN, user_id: id}, function (response) {
              if (response.status == 200)
                  proof = response.data;
              else
                  proof = false;
          }, 'json');
          return this.optional(element) || proof;
       }, "Username already taken, Try another one");
       /!**
       * @param value inout field value
       * @param element input field
       * @param id user id for edit except purpose
       *!/
      $.validator.addMethod('uniqueemail', function (value, element, id) {
          $.post(EMAIL_FIND_URL, {email: value, user_id: id, _token: CSRF_TOKEN}, function (response) {
              if (response.status == 200)
                  proof = response.data;
              else
                  proof = false;
          }, 'json');
          return this.optional(element) || proof;
       }, "Email Address already taken, Try another one");
  */

  /**
   * @param value inout field value
   * @param element input field
   * @param paramDate max date limit
   */

  $.validator.addMethod("maxDate", function (value, element) {
    var paramDate = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
    var inputDate = new Date(value);
    var compareDate = new Date(paramDate);
    return this.optional(element) || new Date(value) <= new Date(paramDate);
  }, "Input date cannot be greater then current date.");
  /**
   * @param value inout field value
   * @param element input field
   * @param paramDate max date limit
   */

  $.validator.addMethod("minDate", function (value, element) {
    var paramDate = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
    var inputDate = new Date(value);
    var compareDate = new Date(paramDate);
    return this.optional(element) || inputDate >= compareDate;
  }, "Input date cannot be smaller then birth date.");
}

$(document).ready(function () {
  initDeleteModal();
});

/***/ }),

/***/ "./Resources/src/sass/custom-switch.scss":
/*!***********************************************!*\
  !*** ./Resources/src/sass/custom-switch.scss ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!***********************************************************************************!*\
  !*** multi ./Resources/src/js/utility.js ./Resources/src/sass/custom-switch.scss ***!
  \***********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! I:\XAMPP\htdocs\boilerplate\modules\Admin\Resources\src\js\utility.js */"./Resources/src/js/utility.js");
module.exports = __webpack_require__(/*! I:\XAMPP\htdocs\boilerplate\modules\Admin\Resources\src\sass\custom-switch.scss */"./Resources/src/sass/custom-switch.scss");


/***/ })

/******/ });