/**
 * Trigger Delete Modal
 */
function initDeleteModal() {
    $(".delete-btn").click(function (event) {
        //stop href to trigger
        event.preventDefault();

        //Model
        var deleteModalElement = $("#deleteModal");
        //ahref has link
        var url = this.getAttribute('href');
        if (url.length > 0 && url !== "#") {
            //Ajax
            $.get(url, function (response) {
                $("#deleteConfirmationForm").empty().html(response);
            }, 'html').done(function () {
            }).fail(function (error) {
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

        var fieldData = (toggle.prop("checked") === true)
            ? toggle.data("onvalue")
            : toggle.data("offvalue");

        $.get(TOGGLE_URL, {m: toggle.data("model"), i: toggle.data("id"), v: fieldData},
            function (response) {
                if (response.status === true) {
                    notify(response.message, response.level, response.title);
                    setTimeout(function () {
                        window.location.reload();
                    }, 3000);
                } else {
                    notify(response.message, response.level, response.title);
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
    var searchTextLength = searchText.length;
    //only if search text in not empty
    if (searchTextLength > 0) {
        JqTargetTable.find("tr").each(function () {

            $(this).find("td").each(function () {

                var tableCell = $(this);

                if (!tableCell.hasClass("exclude-search")) {

                    var innerHtml = tableCell.html();

                    var patternPosition = innerHtml.search(new RegExp(searchText, "igmsu"));

                    if (patternPosition !== -1) {
                        var innerContent = innerHtml.substr(patternPosition, searchTextLength);

                        tableCell.html(
                            innerHtml.replace(innerContent,
                                "<span class='text-dark bg-warning py-1 px-0'>" + innerContent + "</span>"
                            )
                        );
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
            } else {

            }
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
    if (fileType != 'image/png' && fileType != 'image/jpg' &&
        fileType != 'image/gif' && fileType != 'image/jpeg') {

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
            "error": "<b>Invalid File Size( " + fileSize.toFixed(2) + " kb)</b>." +
                " Allowed between " + minSize + " kb to " + maxSize + " kb"
        };
    } else
        return {
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
            "error": "<b>Invalid Resolution( Width: " + imgWidth + " px , Height: " + imgHeight + "px )</b>." +
                " Allowed maximum width: " + maxWidth + "px , height: " + maxHeight + "px."
        }

    }
    /* Minimum Width */
    else if (imgWidth < minWidth || imgHeight < minHeight) {
        return {
            "status": false,
            "error": "<b>Invalid Resolution( Width: " + imgWidth + " px , Height: " + imgHeight + "px )</b>." +
                " Allowed minimum width: " + minWidth + "px , height:  " + minHeight + "px."
        }
    }
    /* Image Ratio */
    else if (ratio != stdRatio) {
        return {
            "status": false,
            "error": "<b>Invalid Image Scale ( Ratio: " + ratio + " )</b>." +
                " Allowed Ratio Scale of " + stdRatio + "."
        };

    } else {
        return {
            "status": true,
            "error": "<b>Image Validation Successful.</b>"
        };
    }
}


function notify(message, level = 'success', title = '') {
    if (window.toastr != undefined) {
        switch (level) {
            case 'success' :
                toastr.success(message, title, []);
                break;

            case 'danger':
            case 'error' :
                toastr.error(message, title, []);
                break;

            case 'warning' :
                toastr.warning(message, title, []);
                break;

            case 'info' :
                toastr.warning(message, title, []);
                break;

            default :
                toastr.success(message, title, []);
                break;
        }
    }
}

/***************************************** JQuery Validation **********************************/
if (typeof $.validator === 'function') {

    //default proof
    var proof = null;
    var fileSize = 0;


//Set Template for Error Validation
    $.validator.setDefaults({
        errorElement: "span",
        errorClass: "invalid-feedback",
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.parent("label"));
            } else {
                if (element.next('span'))
                    element.next('span').replaceWith(error);
                else
                    error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        }
    });
    //regex match method
    $.validator.addMethod("regex", function (value, element, regexp) {
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        },
        "Please check your input.(Invalid Format)"
    );

    //name match method
    $.validator.addMethod("nametitle", function (value, element) {
            return this.optional(element) || /[a-zA-Z\s]+$/.test(value);
        },
        "Please enter only alphabets and spaces."
    );

    //mobile number match method
    $.validator.addMethod("mobilenumber", function (value, element) {
            return this.optional(element) || /^01[0-9]{9}$/.test(value);
        },
        "Please enter value on this 01XXXXXXXXX format."
    );

    //applicant's id & password match method
    $.validator.addMethod("credential", function (value, element) {
            return this.optional(element) || /^[a-zA-Z0-9]{8,10}$/.test(value);
        },
        "Please enter only alphabet and numbers."
    );

    $.validator.addMethod("filesize", function (value, element) {
            return !!(this.optional(element) || (value < 50 || value > 1000));
        },
        "Please enter file size between 50 kb to 1000 kb"
    );

    $.validator.addMethod("noSpace", function (value, element) {
            return this.optional(element) || value.indexOf(" ") < 0 && value.length >= 1;
        },
        "No space please and don't leave it empty"
    );

    $.validator.addMethod("username", function (value, element) {
            return this.optional(element) || /^[a-zA-Z0-9\-\.]+$/i.test(value);
        },
        "Letters, numbers, hyphen sign and dot only please"
    );

    $.validator.addMethod("notEqualPassword", function (value, element, param) {
        return this.optional(element) || value !== param;
    }, "Old/Temporary password should not match with new password.");

    //@TODO current message set to 8 MB need some improvements
    $.validator.addMethod("videofilesize", function (value, element, param) {
            //console.log(element.files[0].size);
            return this.optional(element) || (element.files[0].size <= param);
        },
        "Upload Max File Size Limit 8MB. Try another file."
    );

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
    $.validator.addMethod("maxDate", function (value, element, paramDate = null) {

        var inputDate = new Date(value);
        var compareDate = new Date(paramDate);

        return this.optional(element) || (new Date(value) <= new Date(paramDate));
    }, "Input date cannot be greater then current date.");

    /**
     * @param value inout field value
     * @param element input field
     * @param paramDate max date limit
     */
    $.validator.addMethod("minDate", function (value, element, paramDate = null) {

        var inputDate = new Date(value);
        var compareDate = new Date(paramDate);
        return this.optional(element) || (inputDate >= compareDate);
    }, "Input date cannot be smaller then birth date.");
}

$(document).ready(function () {
    initDeleteModal();
    toggleEnabledStatus();
});
