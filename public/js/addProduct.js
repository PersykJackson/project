function toBasket(id)
{
    const uri = window.location.href;
    $.ajax({
        url: "/basket/add",
        method: "POST",
        type: "text/html",
        data: {id: id},
        success: function () {
            $(".wrapper").load(`${uri} .wrapper`);
        }
    })
}