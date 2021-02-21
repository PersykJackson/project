function increment(id)
{
    $.ajax({
        url: "/basket/increment",
        method: "POST",
        type: "text/html",
        data: {id: id},
        success: function () {
            $(".wrapper").load(`${uri} .wrapper`);
        }
    })
}