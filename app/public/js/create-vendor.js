Dropzone.autoDiscover = false;
var selectedPhotos = [];
var photoDropzone = null;
var logoDropzone = null;

function srcToFile(src, fileName, mimeType) {
    return fetch(src)
        .then(function (res) {
            return res.arrayBuffer();
        })
        .then(function (buf) {
            return new File([buf], fileName, { type: mimeType });
        });
}

function dataURLtoFile(dataURL, filename) {
    var arr = dataURL.split(","),
        mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[1]),
        n = bstr.length,
        u8arr = new Uint8Array(n);

    while (n--) {
        u8arr[n] = bstr.charCodeAt(n);
    }

    return new File([u8arr], filename, { type: mime });
}

$(document).ready(function () {
    new Tagify(document.querySelector("input[name=tags]"));

    $(".category").on("click", function () {
        var _this = $(this);
        $(".category").removeClass("active");
        $(".category").removeClass("btn-primary");
        $(".category").removeClass("active-category");
        _this.addClass("active");
        _this.addClass("btn-primary");
        _this.addClass("active-category");
        $("#asset_category_id").val(_this.data("id"));
    });


    $("#vendorForm").on("submit", async function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        var tags = [],
            vendorTags = [];
        if ($("#tags").val() != "") {
            tags = JSON.parse($("#tags").val());
        }

        vendorTags = tags.map(function (tag) {
            return tag.value;
        });

        formData.append("asset_category_id", $("#asset_category_id").val());
        formData.append("vendor_id", $("#vendor_id").val());
        formData.append("name", $("#name").val());
        formData.append("alias", $("#alias").val());
        formData.append("address", $("#address").val());
        formData.append("phone", $("#phone").val());
        formData.append("email", $("#email").val());
        formData.append("timezone", $("#timezone").val());
        formData.append("tags", vendorTags.join(","));
        formData.append("description", $("#description").val());


        $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            contentType: "multipart/form-data",
            data: formData,
            beforeSend: function () {
                $("#btnSubmit").html(
                    '<i class="fa fa-spin fa-spinner"></i> Saving'
                );
                $("#btnSubmit").prop("disabled", true);
            },
            success: function (data) {
                $.notify(
                    {
                        message: "Vendor has been added.",
                    },
                    {
                        type: "success",
                    }
                );
                $(".btn-group-vategory .category:first-child").trigger("click");
                setInterval(
                    window.location.href = '/library/index'
                    , 5000);

            },
            error: function (e) {
                $(".form-control").each(function () {
                    if ($(this).hasClass("is-invalid")) {
                        $(this).removeClass("is-invalid");
                    }
                });
                for (let [key, value] of Object.entries(e.responseJSON)) {
                    $("#" + key).addClass("is-invalid");
                    $("." + key + ".invalid-feedback").html(value);
                }
            },
            complete: function () {
                $("#btnSubmit").html("Save");
                $("#btnSubmit").prop("disabled", false);
            },
            cache: false,
            contentType: false,
            processData: false,
        });
    });

    $('.supplier_name').keyup(function (){
       $('#alias').val($(this).val());
    });

});
