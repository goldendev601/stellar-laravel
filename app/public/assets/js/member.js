$(document).ready(function () {
    $("#memberPageRight #selected").hide();
    var firstID = $(".memberList li:first").attr("id");

    $(".memberList li:first a").addClass("active");
    $.ajax({
        url: "/member/show/" + firstID,
        method: "GET",
        beforeSend: function () {
            $("#memberPageRight .loaderWrapper").show();
        },
        success: function (data) {
            $("#memberPageRight #selected").html(data);
        },
        complete: function () {
            $("#memberPageRight .loaderWrapper").hide();
            $("#memberPageRight #selected").show();
        },
    });

    $(".memberList li").click(function () {
        $("#memberPageRight #selected").hide();
        $("#selected .loaderWrapper").show();
        var id = $(this).attr("id");
        // If this isn't already active
        if (!$(this).hasClass("active")) {
            // Remove the class from anything that is active
            $(".memberList li a").removeClass("active");
            // And make this active
            $(`li#${id} a`).addClass("active");
        }

        $.ajax({
            url: "/member/show/" + id,
            method: "GET",
            beforeSend: function () {
                $("#memberPageRight .loaderWrapper").show();
            },
            success: function (data) {
                $("#memberPageRight #selected").html(data);
            },
            complete: function () {
                $("#memberPageRight .loaderWrapper").hide();
                $("#memberPageRight #selected").show();
            },
        });
    });
});
