$(document).ready(function(){
    var firstID = $(".vendor:first").attr('id');

    $(".vendor:first").addClass('bg-theme-primary text-white');
    $("li.vendor").slice(1).addClass('bg-theme-secondary text-black');
    $.ajax({
        url:"/library/show/" + firstID,
        method:"GET",
        success:function(data){
            $('#selected').html(data);
        }
    });

    $('.vendor').click(function(){
        var id = $(this).attr('id');
        $("li.vendor").removeClass('bg-theme-primary text-white').addClass('bg-theme-secondary text-black');
        $(this).removeClass('bg-theme-secondary text-black');
        $(this).addClass('bg-theme-primary text-white');
        $.ajax({
            url:"/library/show/" + id,
            method:"GET",
            beforeSend: function () {
                $("#assetsPageRight .loaderWrapper").show();
            },
            success:function(data){
                $('#selected').html(data);
            }
        });
    });
});
