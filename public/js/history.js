async function searchOrders()
{
    window.onload = function () {
        const button = document.getElementById('search_btn')
        button.onclick = async function () {
            let searchData = search_data.value
            let sortType = sort.value
            let searchType = search_type.value

            let data = {
                'search' : searchData,
                'sort' : sortType,
                'type' : searchType
            }
            const answer = await sendPost('/account/search', data)
            localStorage.setItem('orders', await JSON.stringify(answer))
            paintOrders()
        }
    }
}
function paintOrders(number = 1)
{
    const first = (number - 1) * 5
    const last = first + 4
    const answer = JSON.parse(localStorage.getItem('orders'));
    let html = '<caption>Ваши заказы</caption>\n' +
        '            <tr>\n' +
        '                <td>Телефон</td>\n' +
        '                <td>Дата</td>\n' +
        '                <td>Коммантарий</td>\n' +
        '                <td>Адрес</td>\n' +
        '                <td>Товары</td>\n' +
        '            </tr>'
    answer.forEach((val, key) => {
        if (key >= first && key <= last) {
            html += `<tr>
                            <td>${val.phone}</td>
                            <td>${val.date}</td>
                            <td>${val.comment}</td>
                            <td>${val.address}</td>
                            <td>
                            <ol>`
            val.products.forEach((value) => {
                html += `<li>${value.name} - ${value.amount}</li>`
            })
            html += `</ol></td></tr>`
        }
    })
    let pagination = ''
    const count = Math.ceil(answer.length / 5);
    for (let n = 0; n < count; n++) {
        if (n+1 === number) {
            pagination += `<button disabled onclick='paintOrders(${n+1})'>${n+1}</button>`
        } else {
            pagination += `<button onclick='paintOrders(${n+1})'>${n+1}</button>`
        }
    }

    document.getElementById('pagination').innerHTML = pagination
    document.getElementById('table').innerHTML = html
}
async function startPaint()
{
    const answer = await sendPost('/account/startSearch', '')
    localStorage.setItem('orders', await JSON.stringify(answer))
    paintOrders()
}

startPaint()
searchOrders()