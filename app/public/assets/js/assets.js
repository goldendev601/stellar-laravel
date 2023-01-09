$(document).ready(function () {
    $(function () {
        $("#accomodationTagInput").tagsinput({});
        $("#dinningTagInput").tagsinput({});
        $("#eventTagInput").tagsinput({});
        $("#miscTagInput").tagsinput({});
    });

    $(function () {
        var accomodationDataTransfer = new DataTransfer();
        $("#accomodationFiles").on("change", function (e) {
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                var f = files[i];
                accomodationDataTransfer.items.add(f);
                e.target.files = accomodationDataTransfer.files;

                var fileReader = new FileReader();
                fileReader.onload = function (e) {
                    $("#uploadedFilePreviewAccomodation").append(`
                    <span class="pip">
                    <img class="imageThumbList" src="${e.target.result}" />
                     <i class="fa fa-times remove" aria-hidden="true"></i>
                    </span>
                    `);
                    $("#uploadedFilePreviewAccomodation").show();


                };
                fileReader.readAsDataURL(f);
            }

            console.log("fileList:", accomodationDataTransfer.files);
            console.log("files:", files);
        });
    });

    $(document).on('click', '.remove', function () {
        $(this).parent(".pip").remove();
    });

    $(function () {
        var diningDataTransfer = new DataTransfer();
        $("#diningFiles").on("change", function (e) {
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                var f = files[i];
                diningDataTransfer.items.add(f);
                e.target.files = diningDataTransfer.files;

                var fileReader = new FileReader();
                fileReader.onload = function (e) {
                    $("#uploadedFilePreviewDining").append(`
                    <span class="pip">
                    <img class="imageThumbList" src="${e.target.result}" />
                     <i class="fa fa-times remove" aria-hidden="true"></i>
                    </span>
                    `);
                    $("#uploadedFilePreviewDining").show();

                    $(".remove").click(function () {
                        $(this).parent(".pip").remove();
                        if (files.lenght == 0) {
                            $("#uploadedFilePreviewDining").hide();
                        }
                    });
                };
                fileReader.readAsDataURL(f);
            }
            console.log("fileList:", diningDataTransfer.files);
            console.log("files:", files);
        });
    });

    $(function () {
        var eventDataTransfer = new DataTransfer();
        $("#eventFiles").on("change", function (e) {
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                var f = files[i];
                eventDataTransfer.items.add(f);
                e.target.files = eventDataTransfer.files;

                var fileReader = new FileReader();
                fileReader.onload = function (e) {
                    $("#uploadedFilePreviewEvent").append(`
                    <span class="pip">
                    <img class="imageThumbList" src="${e.target.result}" />

                     <i class="fa fa-times remove" aria-hidden="true"></i>
                    </span>
                    `);
                    $("#uploadedFilePreviewEvent").show();

                    $(".remove").click(function () {
                        $(this).parent(".pip").remove();
                        if (files.lenght == 0) {
                            $("#uploadedFilePreviewEvent").hide();
                        }
                    });
                };
                fileReader.readAsDataURL(f);
            }
            console.log("fileList:", eventDataTransfer.files);
            console.log("files:", files);
        });
    });

    $(function () {
        var miscDataTransfer = new DataTransfer();
        $("#miscFiles").on("change", function (e) {
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                var f = files[i];
                var fileReader = new FileReader();
                miscDataTransfer.items.add(f);
                e.target.files = miscDataTransfer.files;

                fileReader.onload = function (e) {
                    $("#uploadedFilePreviewMisc").append(`
                    <span class="pip">
                    <img class="imageThumbList" src="${e.target.result}" />
                     <i class="fa fa-times remove" aria-hidden="true"></i>
                    </span>
                    `);
                    $("#uploadedFilePreviewMisc").show();

                    $(".remove").click(function () {
                        $(this).parent(".pip").remove();
                        if (files.lenght == 0) {
                            $("#uploadedFilePreviewMisc").hide();
                        }
                    });
                };
                fileReader.readAsDataURL(f);
            }
            console.log("fileList:", miscDataTransfer.files);
            console.log("files:", files);
        });
    });
});

function doOpenAccomodationFiles(event) {
    event = event || window.event;
    if (event.target.id != "accomodationFiles") {
        accomodationFiles.click();
    }
}

function doOpenDiningFiles(event) {
    event = event || window.event;
    if (event.target.id != "diningFiles") {
        diningFiles.click();
    }
}

function doOpenEventFiles(event) {
    event = event || window.event;
    if (event.target.id != "eventFiles") {
        eventFiles.click();
    }
}

function doOpenMiscFiles(event) {
    event = event || window.event;
    if (event.target.id != "miscFiles") {
        miscFiles.click();
    }
}

$(document).ready(function () {
    $(".sellerSelect").select2({
        placeholder: "Select seller",
    });

    $(".sellerSelect").on("select2:open", function () {
        if (!$(".addnewseller-btn").length) {
            $(".select2-results")
                .prepend(`<a class="addnewseller-btn" href="javascript:void(0)"
            class="btn"
            onClick="open_add_new_seller_popup()">+ Add New Seller</a>
            </li>`);
        }
    });
});

function open_add_new_seller_popup() {
    $.fancybox.open({
        src: "#add-new-seller-pop-up",
        type: "inline",
        modal: true,
        width: 800,
        height: 350,
    });
}

// The no matching result  disappear once  loose focus

$("input[name='venue']").focusout(function () {
    var dropdown = $(this).closest(".dropdown");
    var listContainer = dropdown.find(".list-autocomplete");
    var listItems = listContainer.find(".dropdown-item");
    var hasNoResults = dropdown.find(".hasNoResults");
    var count = listItems.filter(":visible").length;
    count == 0 ? hasNoResults.hide() : '';

});


// address search autocomplete

function createAuto(i, elem) {
    var input = $(elem);
    var dropdown = input.closest(".dropdown");
    var dropdownmenu = $(".venueNameDropdownAccommodation");
    var listContainer = dropdown.find(".list-autocomplete");
    var listItems = listContainer.find(".dropdown-item");
    var hasNoResults = dropdown.find(".hasNoResults");
    listItems.hide();
    listItems.each(function () {
        $(this).data("value", $(this).text());
        //!important, keep this copy of the text outside of keyup/input function
    });

    input.on("input", function (e) {
        if ((e.keyCode ? e.keyCode : e.which) == 13) {
            dropdownmenu.removeClass("show");
            return; //if enter key, close dropdown and stop
        }
        if ((e.keyCode ? e.keyCode : e.which) == 9) {
            return; //if tab key, stop
        }

        var query = input.val().toLowerCase();
        if (query.length > 1) {
            dropdownmenu.addClass("show");
            listItems.each(function () {
                var text = $(this).data("value");
                var alias = $(this).attr("alias");
                if (alias.toLowerCase().indexOf(query) > -1) {
                    var textStart = text.toLowerCase().indexOf(query);
                    var textEnd = textStart + query.length;
                    var htmlR =
                        text.substring(0, textStart) +
                        "<span>" +
                        text.substring(textStart, textEnd) +
                        "</span>" +
                        text.substring(textEnd + length);
                    $(this).html(htmlR);
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            var count = listItems.filter(":visible").length;
            count > 0 ? hasNoResults.hide() : hasNoResults.show();

        } else {

            listItems.hide();
            dropdownmenu.removeClass("show");
            hasNoResults.show();

        }
    });

    listItems.on("click", function (e) {

        var txt = $(this)
            .text()
            .replace(/^\s+|\s+$/g, ""); //remove leading and trailing whitespace
        input.val(txt);
        var address = $(this).attr("address-value");
        var timezone = $(this).attr("timezone");
        var images = $(this).data("images");
        var previewImages = '';
        $.each(images, function (index, value) {
            previewImages += `<span class="pip">
                    <img class="imageThumbList" src="${value.preview_image_aws}">
                     <input type="hidden" name="vendor_images[]" value="${value.image_relative_url}">
                     <i class="fa fa-times remove" aria-hidden="true"></i>
                    </span>`;
        });
        $('#uploadedFilePreviewAccomodation').append(previewImages);
        $('#event_timezone').val(timezone).trigger('change');
        $('#uploadedFilePreviewAccomodation').css('display', 'flex');
        $(".venueAddAutosuggestAccommodation").val(address);
        $(".venueAddAutosuggestAccommodation").focus();
        dropdownmenu.removeClass("show");
    });
}

$(".venue_name_accommodation").each(createAuto);
$(".venue_name_accommodation").keydown(function () {
    $(".venueAddAutosuggestAccommodation").val("");
    createAuto();
});

// ######################################################
function createAutoDining(i, elem) {
    var input = $(elem);
    var dropdown = input.closest(".dropdown");
    var dropdownmenu = $(".venueNameDropdownDining");
    var listContainer = dropdown.find(".list-autocomplete");
    var listItems = listContainer.find(".dropdown-item");
    var hasNoResults = dropdown.find(".hasNoResults");

    listItems.hide();
    listItems.each(function () {
        $(this).data("value", $(this).text());
        //!important, keep this copy of the text outside of keyup/input function
    });

    input.on("input", function (e) {
        if ((e.keyCode ? e.keyCode : e.which) == 13) {
            dropdownmenu.removeClass("show");
            return; //if enter key, close dropdown and stop
        }
        if ((e.keyCode ? e.keyCode : e.which) == 9) {
            return; //if tab key, stop
        }

        var query = input.val().toLowerCase();
        if (query.length > 1) {
            dropdownmenu.addClass("show");
            listItems.each(function () {
                var text = $(this).data("value");
                if (text.toLowerCase().indexOf(query) > -1) {
                    var textStart = text.toLowerCase().indexOf(query);
                    var textEnd = textStart + query.length;
                    var htmlR =
                        text.substring(0, textStart) +
                        "<span>" +
                        text.substring(textStart, textEnd) +
                        "</span>" +
                        text.substring(textEnd + length);
                    $(this).html(htmlR);
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            var count = listItems.filter(":visible").length;
            count > 0 ? hasNoResults.hide() : hasNoResults.show();
        } else {
            listItems.hide();
            dropdownmenu.removeClass("show");
            hasNoResults.show();
        }
    });

    listItems.on("click", function (e) {
        var txt = $(this)
            .text()
            .replace(/^\s+|\s+$/g, ""); //remove leading and trailing whitespace
        input.val(txt);

        var address = $(this).attr("address-value");
        $(".venueAddAutosuggestDining").val(address);
        $(".venueAddAutosuggestDining").focus();
        dropdownmenu.removeClass("show");
    });
}

$(".venue_name_dining").each(createAutoDining);
$(".venue_name_dining").keydown(function () {
    $(".venueAddAutosuggestDining").val("");
    createAutoDining();
});

// ######################################################
function createAutoEvent(i, elem) {
    var input = $(elem);
    var dropdown = input.closest(".dropdown");
    var dropdownmenu = $(".venueNameDropdownEvent");
    var listContainer = dropdown.find(".list-autocomplete");
    var listItems = listContainer.find(".dropdown-item");
    var hasNoResults = dropdown.find(".hasNoResults");

    listItems.hide();
    listItems.each(function () {
        $(this).data("value", $(this).text());
        //!important, keep this copy of the text outside of keyup/input function
    });

    input.on("input", function (e) {
        if ((e.keyCode ? e.keyCode : e.which) == 13) {
            dropdownmenu.removeClass("show");
            return; //if enter key, close dropdown and stop
        }
        if ((e.keyCode ? e.keyCode : e.which) == 9) {
            return; //if tab key, stop
        }

        var query = input.val().toLowerCase();
        if (query.length > 1) {
            dropdownmenu.addClass("show");
            listItems.each(function () {
                var text = $(this).data("value");
                if (text.toLowerCase().indexOf(query) > -1) {
                    var textStart = text.toLowerCase().indexOf(query);
                    var textEnd = textStart + query.length;
                    var htmlR =
                        text.substring(0, textStart) +
                        "<span>" +
                        text.substring(textStart, textEnd) +
                        "</span>" +
                        text.substring(textEnd + length);
                    $(this).html(htmlR);
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            var count = listItems.filter(":visible").length;
            count > 0 ? hasNoResults.hide() : hasNoResults.show();
        } else {
            listItems.hide();
            dropdownmenu.removeClass("show");
            hasNoResults.show();
        }
    });

    listItems.on("click", function (e) {
        var txt = $(this)
            .text()
            .replace(/^\s+|\s+$/g, ""); //remove leading and trailing whitespace
        input.val(txt);

        var address = $(this).attr("address-value");
        $(".venueAddAutosuggestEvent").val(address);
        $(".venueAddAutosuggestEvent").focus();
        dropdownmenu.removeClass("show");
    });
}

$(".venue_name_event").each(createAutoEvent);
$(".venue_name_event").keydown(function () {
    $(".venueAddAutosuggestEvent").val("");
    createAutoEvent();
});

// ######################################################
function createAutoMisc(i, elem) {
    var input = $(elem);
    var dropdown = input.closest(".dropdown");
    var dropdownmenu = $(".venueNameDropdownMisc");
    var listContainer = dropdown.find(".list-autocomplete");
    var listItems = listContainer.find(".dropdown-item");
    var hasNoResults = dropdown.find(".hasNoResults");

    listItems.hide();
    listItems.each(function () {
        $(this).data("value", $(this).text());
        //!important, keep this copy of the text outside of keyup/input function
    });

    input.on("input", function (e) {
        if ((e.keyCode ? e.keyCode : e.which) == 13) {
            dropdownmenu.removeClass("show");
            return; //if enter key, close dropdown and stop
        }
        if ((e.keyCode ? e.keyCode : e.which) == 9) {
            return; //if tab key, stop
        }

        var query = input.val().toLowerCase();
        if (query.length > 1) {
            dropdownmenu.addClass("show");
            listItems.each(function () {
                var text = $(this).data("value");
                if (text.toLowerCase().indexOf(query) > -1) {
                    var textStart = text.toLowerCase().indexOf(query);
                    var textEnd = textStart + query.length;
                    var htmlR =
                        text.substring(0, textStart) +
                        "<span>" +
                        text.substring(textStart, textEnd) +
                        "</span>" +
                        text.substring(textEnd + length);
                    $(this).html(htmlR);
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            var count = listItems.filter(":visible").length;
            count > 0 ? hasNoResults.hide() : hasNoResults.show();
        } else {
            listItems.hide();
            dropdownmenu.removeClass("show");
            hasNoResults.show();
        }
    });

    listItems.on("click", function (e) {
        var txt = $(this)
            .text()
            .replace(/^\s+|\s+$/g, ""); //remove leading and trailing whitespace
        input.val(txt);

        var address = $(this).attr("address-value");
        $(".venueAddAutosuggestMisc").val(address);
        $(".venueAddAutosuggestMisc").focus();
        dropdownmenu.removeClass("show");
    });
}

$(".venue_name_misc").each(createAutoMisc);
$(".venue_name_misc").keydown(function () {
    $(".venueAddAutosuggestMisc").val("");
    createAutoMisc();
});

function removeUploadedFiles(imageID, tab, imgDiv) {
    console.log("click");
    var field = $(tab);
    field.val(field.val() + imageID + ",");
    $(`#${imgDiv}-${imageID}`).remove();
}


// blade file script start

var CKEditor_accommodation = null;
ClassicEditor
    .create(document.querySelector('#description-accommodation'))
    .then((editor) => {
        CKEditor_accommodation = editor;
    })
    .catch(error => {
        console.error(error);
    });

var CKEditor_dining = null;
ClassicEditor
    .create(document.querySelector('#description-dining'))
    .then((editor) => {
        CKEditor_dining = editor;
    })
    .catch(error => {
        console.error(error);
    });

var CKEditor_event = null;
ClassicEditor
    .create(document.querySelector('#description-event'))
    .then((editor) => {
        CKEditor_event = editor;
    })
    .catch(error => {
        console.error(error);
    });

var CKEditor_misc = null;
ClassicEditor
    .create(document.querySelector('#description-misc'))
    .then((editor) => {
        CKEditor_misc = editor;
    })
    .catch(error => {
        console.error(error);
    });


$(document).ready(function () {
    $(".addnew-seller-btn").on('click', function () {
        $("#add-new-seller-form").validate({
            rules: {
                first_name: {
                    required: true,
                    maxlength: 250
                },
                last_name: {
                    required: true,
                    maxlength: 250
                },
            },
            submitHandler: function (form) {
                return false; // blocks regular submit since you have ajax
            }
        })
        var form = $("#add-new-seller-form");
        var formData = new FormData(form[0]);
        if ($("#add-new-seller-form").valid()) {
            $(".addnew-seller-btn").addClass('disabled').attr('disabled', true)
            setTimeout(function () {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "/seller/insert",
                    data: formData,
                    async: false,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $("#add-new-seller-form")[0].reset();
                        $(".addnew-seller-btn").removeClass('disabled')
                            .removeAttr('disabled')
                        if (data.response == 'success') {

                            // Create the DOM option that is pre-selected by default
                            var newState = new Option(data.member.name, data.member
                                    .id, true,
                                true);

                            // Append it to the select
                            if ($("#active-category").attr('data-id') == 2) {
                                $("#asset-dining-form #sellerSelect").append(
                                    newState).trigger(
                                    'change');
                            } else if ($("#active-category").attr('data-id') == 3) {
                                $("#asset-event-form #sellerSelect").append(
                                    newState).trigger(
                                    'change');
                            } else if ($("#active-category").attr('data-id') == 4) {
                                $("#asset-misc-form #sellerSelect").append(newState)
                                    .trigger(
                                        'change');
                            } else {
                                $("#asset-form #sellerSelect").append(newState)
                                    .trigger(
                                        'change');
                            }
                            $(".cancel-btn").click()
                            return true;
                        }
                    },
                    error: function (response, status, error) {
                        console.log('response == ', response);
                        $("#add-new-seller-form")[0].reset();
                        $(".addnew-seller-btn").removeClass('disabled')
                            .removeAttr('disabled')
                    }
                });
            }, 300);
        }
    });


    $(".category").on('click', function () {
        var _this = $(this);
        $(".category").removeClass("active");
        $(".category").removeClass("btn-primary");
        $(".category").removeClass("active-category");
        $(".category").attr("id", "");
        _this.addClass("active");
        _this.addClass("btn-primary");
        _this.addClass("active-category");
        _this.attr("id", "active-category");
        $("a.preview-assets-btn").attr("href",
            `/assets/preview/${_this.attr('aria-controls')}`); // Set herf value

        $("a.add-asset").attr("data-form",
            _this.attr('aria-controls')); // Set herf value
    });

    // Suppose that your method is well define

    jQuery.validator.addMethod("validatePhone",
        function (value, element) {
            var valid;
            if ($.trim(value).length > 0) {
                var regx = /[+][0-9]{10,15}/;
                valid = regx.test(value);
            } else {
                valid = true;
            }
            return this.optional(element) || valid;
        }, "Please enter valid phone number"
    );
    $("#asset-form").validate({
        rules: {
            name: {
                required: true,
                maxlength: 250
            },
            address: {
                required: true,
                maxlength: 250
            },
            venue: {
                required: true,
                maxlength: 250
            },
            seller: {
                required: true,
            },
            status: {
                required: true,
            },
            currency_type_id: {
                required: true,
            },
            amount: {
                required: true,
            },
            timezone: {
                required: true
            },
            cost_details: {
                required: true,
                maxlength: 250
            },
            description: {
                required: true
            },
            check_in_datetime: {
                required: true
            },
            check_out_date: {
                required: true
            },
            deadline_date: {
                required: true
            },
            deadline_time: {
                required: true
            }
        },
        errorElement: 'span',
        errorClass: 'd-none',
        highlight: function (element) {
            $(element).parent().addClass('has-error');
            $(element).closest(".validationNeed").addClass('has-error');
            if ($(element).attr("name") == "description") {
                $("#description-error").remove()
            }
        },
        unhighlight: function (element) {
            $(element).parent().removeClass('has-error');
            $(element).closest(".validationNeed").removeClass('has-error');
            if ($(element).attr("name") == "description") {
                $("#description-error").remove()
            }
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "description") {
                setTimeout(function () {
                    $("#description-error").removeClass('d-none').addClass(
                        'validation-error').show();
                }, 200);
            }
            error.insertAfter(element);
        },
    })

    $("#asset-form-more-info").validate({
        rules: {
            confirmation_number: {
                required: false,
                digits: true
            },
            number_of_guest: {
                required: false,
                digits: true
            },
            venue_phone: {
                required: false,
                validatePhone: true,
                minlength: 10
            },
            cancellation_policy: {
                required: false,
                url:true,
                maxlength: 250
            },
            website: {
                required: false,
                url: true
            },
        },
        messages: {
            venue_phone: {
                validatePhone: "Enter phone number with ( + ). minimum of 10 digits.",
            },
        },
        errorElement: 'span',
        errorClass: 'validation-error font-loto',
        highlight: function (element) {
            // console.log($(element))
            $(element).parent().addClass('has-error');
            $(element).closest(".validationNeed").addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).parent().removeClass('has-error');
            $(element).closest(".validationNeed").removeClass('has-error');
        }
    })

    $("#asset-dining-form").validate({
        rules: {
            name: {
                required: true,
                maxlength: 250
            },
            address: {
                required: true,
                maxlength: 250
            },
            venue: {
                required: true,
                maxlength: 250
            },
            seller: {
                required: true,
            },
            status: {
                required: true,
            },
            currency_type_id: {
                required: true,
            },
            amount: {
                required: true,
            },
            timezone: {
                required: true
            },
            cost_details: {
                required: true,
                maxlength: 250
            },
            description: {
                required: true
            },
            reservation_time: {
                required: true
            },
            deadline_time: {
                required: true
            }
        },
        errorElement: 'span',
        errorClass: 'd-none',
        highlight: function (element) {
            $(element).parent().addClass('has-error');
            $(element).closest(".validationNeed").addClass('has-error');
            if ($(element).attr("name") == "description") {
                $("#description-error").remove()
            }
        },
        unhighlight: function (element) {
            $(element).parent().removeClass('has-error');
            $(element).closest(".validationNeed").removeClass('has-error');
            if ($(element).attr("name") == "description") {
                $("#description-error").remove()
            }
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "description") {
                setTimeout(function () {
                    $("#description-error").removeClass('d-none').addClass(
                        'validation-error').show();
                }, 200);
            }
            error.insertAfter(element);
        },
    })
    $("#asset-dining-form-more-info").validate({
        rules: {
            guest_name: {
                required: false,
                maxlength: 250
            },
            number_of_guest: {
                required: false,
                digits: true
            },
            guest_email: {
                required: false,
                email: true
            },
            guest_phone: {
                required: false,
                validatePhone: true,
                minlength: 10
            },
            venue_phone: {
                required: false,
                validatePhone: true,
                minlength: 10
            },
            cancellation_policy: {
                required: false,
                url:true,
                maxlength: 250
            },
            menu_highlights: {
                required: false
            },
        },
        messages: {
            guest_phone: {
                validatePhone: "Enter phone number with ( + ). minimum of 10 digits.",
            },
            venue_phone: {
                validatePhone: "Enter phone number with ( + ). minimum of 10 digits.",
            },
        },
        errorElement: 'span',
        errorClass: 'validation-error font-loto',
        highlight: function (element) {
            // console.log($(element))
            $(element).parent().addClass('has-error');
            $(element).closest(".validationNeed").addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).parent().removeClass('has-error');
            $(element).closest(".validationNeed").removeClass('has-error');
        }
    })
    $("#asset-event-form").validate({
        rules: {
            name: {
                required: true,
                maxlength: 250
            },
            address: {
                required: true,
                maxlength: 250
            },
            venue: {
                required: true,
                maxlength: 250
            },
            seller: {
                required: true,
            },
            status: {
                required: true,
            },
            currency_type_id: {
                required: true,
            },
            amount: {
                required: true,
            },
            timezone: {
                required: true
            },
            cost_details: {
                required: true,
                maxlength: 250
            },
            description: {
                required: true
            },
            event_time: {
                required: true
            },
            deadline_time: {
                required: true
            }
        },
        errorElement: 'span',
        errorClass: 'd-none',
        highlight: function (element) {
            $(element).parent().addClass('has-error');
            $(element).closest(".validationNeed").addClass('has-error');
            if ($(element).attr("name") == "description") {
                $("#description-error").remove()
            }
        },
        unhighlight: function (element) {
            $(element).parent().removeClass('has-error');
            $(element).closest(".validationNeed").removeClass('has-error');
            if ($(element).attr("name") == "description") {
                $("#description-error").remove()
            }
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "description") {
                setTimeout(function () {
                    $("#description-error").removeClass('d-none').addClass(
                        'validation-error').show();
                }, 200);
            }
            error.insertAfter(element);
        },
    })


    $("#asset-event-form-more-info").validate({
        rules: {
            event_name: {
                required: false,
                maxlength: 250
            },
            event_type: {
                required: false,
                maxlength: 250
            },
            ticket_holder: {
                required: false,
                maxlength: 250
            },
            number_of_seats: {
                required: false,
                digits: true
            },
            venue_layout: {
                required: false,
                url:true,
                maxlength: 250
            },
            cancellation_policy: {
                required: false,
                url:true,
                maxlength: 250
            },
            total_paid: {
                required: false,
                digits: true
            },
            venue_amenities: {
                required: false,
            },
        },
        errorElement: 'span',
        errorClass: 'validation-error font-loto',
        highlight: function (element) {
            // console.log($(element))
            $(element).parent().addClass('has-error');
            $(element).closest(".validationNeed").addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).parent().removeClass('has-error');
            $(element).closest(".validationNeed").removeClass('has-error');
        }
    })

    $("#asset-misc-form").validate({
        rules: {
            name: {
                required: true,
                maxlength: 250
            },
            address: {
                required: false,
                maxlength: 250
            },
            venue: {
                required: false,
                maxlength: 250
            },
            seller: {
                required: true,
            },
            status: {
                required: true,
            },
            currency_type_id: {
                required: true,
            },
            amount: {
                required: true,
            },
            timezone: {
                required: false
            },
            cost_details: {
                required: true,
                maxlength: 250
            },
            description: {
                required: true,
            },
            display_date: {
                required: false
            },
            deadline_time: {
                required: false
            },
            venue_layout: {
                required: false,
                url:true,
                maxlength: 250
            },
            cancellation_policy: {
                required: false,
                url:true,
                maxlength: 250
            },
        },
        errorElement: 'span',
        errorClass: 'd-none',
        highlight: function (element) {
            $(element).parent().addClass('has-error');
            $(element).closest(".validationNeed").addClass('has-error');
            if ($(element).attr("name") == "description") {
                $("#description-error").remove()
            }
        },
        unhighlight: function (element) {
            $(element).parent().removeClass('has-error');
            $(element).closest(".validationNeed").removeClass('has-error');
            if ($(element).attr("name") == "description") {
                $("#description-error").remove()
            }
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "description") {
                setTimeout(function () {
                    $("#description-error").removeClass('d-none').addClass(
                        'validation-error').show();
                }, 200);
            }
            error.insertAfter(element);
        },
    })

    $("#asset-misc-form-more-info").validate({
        rules: {
            event_name: {
                required: false,
                maxlength: 250
            },
            event_type: {
                required: false,
                maxlength: 250
            },
            ticket_holder: {
                required: false,
                maxlength: 250
            },
            number_of_seats: {
                required: false,
                digits: true
            },
            multiple_locations: {
                required: false,
                maxlength: 250
            },
            total_paid: {
                required: false,
                digits: true
            },
        },
        errorElement: 'span',
        errorClass: 'validation-error font-loto',
        highlight: function (element) {
            // console.log($(element))
            $(element).parent().addClass('has-error');
            $(element).closest(".validationNeed").addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).parent().removeClass('has-error');
            $(element).closest(".validationNeed").removeClass('has-error');
        }
    })


    $(".add-asset").on("click", function () {

        var isValidate = false;
        var form = null;

        if ($("#active-category").attr('data-id') == 2) {
            if ($("#asset-dining-form").valid() && $("#asset-dining-form-more-info").valid()) {
                isValidate = true;
            }

            form = $("#asset-dining-form");
            $('#asset-dining-form-more-info :input').not(':submit').clone().hide().appendTo(form);
        } else if ($("#active-category").attr('data-id') == 3) {
            if ($("#asset-event-form").valid() && $("#asset-event-form-more-info").valid()) {
                isValidate = true;
            }

            form = $("#asset-event-form");
            $('#asset-event-form-more-info :input').not(':submit').clone().hide().appendTo(form);
        } else if ($("#active-category").attr('data-id') == 4) {
            if ($("#asset-misc-form").valid() && $("#asset-misc-form-more-info").valid()) {
                isValidate = true;
            }
            form = $("#asset-misc-form");
            $('#asset-misc-form-more-info :input').not(':submit').clone().hide().appendTo(form);
        } else {
            if ($("#asset-form").valid() && $("#asset-form-more-info").valid()) {
                isValidate = true;
            }
            form = $('#asset-form');
            $('#asset-form-more-info :input').not(':submit').clone().hide().appendTo(form);
        }

        if (CKEditor_accommodation) {
            $('#description-accommodation').val(CKEditor_accommodation.getData());
        }

        if ($("#active-category").attr('data-id') == 1) {
            if ($('#description-accommodation').val() == '') {
                isValidate = false;
                $('.error_description').addClass('has-error');
            }
        }
        if (CKEditor_dining) {
            $('#description-dining').val(CKEditor_dining.getData());
        }
        if ($("#active-category").attr('data-id') == 2) {
            if ($('#description-dining').val() == '') {
                isValidate = false;
                $('.error_description_dining').addClass('has-error');
            }
        }
        if (CKEditor_event) {
            $('#description-event').val(CKEditor_event.getData());
        }
        if ($("#active-category").attr('data-id') == 3) {
            if ($('#description-event').val() == '') {
                isValidate = false;
                $('.error_description_event').addClass('has-error');
            }
        }
        if (CKEditor_misc) {
            $('#description-misc').val(CKEditor_misc.getData());
        }
        if ($("#active-category").attr('data-id') == 4) {
            if ($('#description-misc').val() == '') {
                isValidate = false;
                $('.error_description_misc').addClass('has-error');
            }
        }

        var formData = new FormData(form[0]);
        var values = [];
        var vendor_images = $("input[name='vendor_images[]']");
        $("input[name='vendor_images[]']").each(function (index) {
            values[index] = $(this).val();
        })
        if (isValidate) {
            formData.append('vendor_images', values);

            $("a.add-asset").addClass('disabled').attr('disabled', true)
            setTimeout(function () {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "/assets/insert",
                    data: formData,
                    async: false,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $("a.add-asset").removeClass('disabled')
                            .removeAttr('disabled')
                        if (data.response == "success") {
                            $.notify({
                                title: 'Success: Submit Successfully',
                                message: ''
                            }, {
                                type: 'primary',
                                allow_dismiss: false,
                                newest_on_top: false,
                                mouse_over: false,
                                showProgressbar: false,
                                spacing: 10,
                                timer: 2000,
                                placement: {
                                    from: 'top',
                                    align: 'right'
                                },
                                offset: {
                                    x: 30,
                                    y: 30
                                },
                                delay: 1000,
                                z_index: 10000,
                            });
                            setTimeout(function () {
                                window.location.href = `/assets/index/${data.id}`;
                            }, 1000);
                        }
                        if (data.response == "error") {
                            $('.error_check_in_datetime').html('');
                            $('.error_event_date').html('');
                            $('.error_check_out_date').html('');
                            $('.error_reservation_date').html('');
                            $("a.add-asset").removeClass('disabled')
                                .removeAttr('disabled')
                            // if (Object.keys(data.validation_error).length > 0) {
                            //     for (const property in data.validation_error) {
                            //         message = data.validation_error[property];
                            //         console.log(`${property}: ${data.validation_error[property]}`);
                            //     }
                            // }
                            $.notify({
                                title: 'Error: Missing Data',
                                message: 'Please enter required fields'
                            }, {
                                type: 'danger',
                                allow_dismiss: false,
                                newest_on_top: false,
                                mouse_over: false,
                                showProgressbar: false,
                                spacing: 10,
                                timer: 2000,
                                placement: {
                                    from: 'top',
                                    align: 'right'
                                },
                                offset: {
                                    x: 30,
                                    y: 30
                                },
                                delay: 1000,
                                z_index: 10000,
                            });
                        }
                    },
                    error: function (response, status, error) {
                        $("a.add-asset").removeClass('disabled')
                            .removeAttr('disabled')
                        var errors = response.responseJSON;
                        $('.error_check_in_datetime').html('');
                        $('.error_event_date').html('');
                        $('.error_check_out_date').html('');
                        $('.error_reservation_date').html('');
                        $.each( errors.errors, function( key, value ) {
                           $('.error_'+key).html(value);
                            $.notify({
                                title: 'Error: Missing Data',
                                message: value
                            }, {
                                type: 'danger',
                                allow_dismiss: false,
                                newest_on_top: false,
                                mouse_over: false,
                                showProgressbar: false,
                                spacing: 10,
                                timer: 2000,
                                placement: {
                                    from: 'top',
                                    align: 'right'
                                },
                                offset: {
                                    x: 30,
                                    y: 30
                                },
                                delay: 1000,
                                z_index: 10000,
                            });
                        });
                    },
                });
            }, 300);
        }
    });


});

$(() => {
    $('[data-bs-toggle="tab"]').on('show.bs.tab', function () {
        $('.tab-pane.active.show').removeClass(['active', 'show'])
        $($(this).attr('data-bs-target')).each(function () {
            $(this).tab('show')
        })
    })
})


