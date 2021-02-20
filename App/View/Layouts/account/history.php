<main>
    <div class="container">

        <table>
            <caption>Ваши заказы</caption>
            <tr>
                <td>Товары</td>
                <td>Телефон</td>
                <td>Дата</td>
                <td>Коммантарий</td>
                <td>Адрес</td>
            </tr>
            <?php foreach ($this->content['orders'] as $order) {
                echo "
               <tr>
                <td>{$order['info']}</td>
                <td>{$order['phone']}</td>
                <td>{$order['date']}</td>
                <td>{$order['comment']}</td>
                <td>{$order['address']}</td>
            </tr>";
            }?>
        </table>
    </div>
</main>
