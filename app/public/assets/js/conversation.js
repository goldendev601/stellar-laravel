$(document).ready(function () {
    var firstID = $(".conversation:first").attr("id");
    if (firstID > 0) {
        $(".conversation:first")
            .addClass("conversationActive")
            .removeClass("conversationInActive");
        $.ajax({
            url: "/conversations/show/" + firstID,
            method: "GET",
            beforeSend: function () {
                $("#conversationsPageRight .loaderWrapper").show();
            },
            success: function (data) {
                $("#conversationsPageRight #selected").html(data);
            },
            complete: function () {
                $("#conversationsPageRight .loaderWrapper").hide();
                $("#conversationsPageRight #selected").show();
            },
        });
    }

    $(".conversation").click(function () {
        $("#conversationsPageRight #selected").hide();
        $("#selected .loaderWrapper").show();
        var id = $(this).attr("id");
        $(".conversation")
            .removeClass("conversationActive")
            .addClass("text-black conversationInActive");

        $(this).removeClass("text-black conversationInActive");
        $(this).addClass(" conversationActive");
        $.ajax({
            url: "/conversations/show/" + id,
            method: "GET",
            beforeSend: function () {
                $("#conversationsPageRight .loaderWrapper").show();
            },
            success: function (data) {
                $("#conversationsPageRight #selected").html(data);
            },
            complete: function () {
                $("#conversationsPageRight .loaderWrapper").hide();
                $("#conversationsPageRight #selected").show();
            },
        });
    });
});
