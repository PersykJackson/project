<main>
    <div class="container">
        <div id="search" class="search">
            <input id="search_data"/>
            <select class="tst" id="search_type" name="search_type">
                <option value="phone">По номеру</option>
                <option value="address">По адресу</option>
                <option value="date">По дате</option>
            </select>
            <select id="sort" name="sort">
                <option value="id">default</option>
                <option value="date">Дата</option>
            </select>
            <button id="search_btn">Поиск</button>
        </div>
        <table id="table">
            <tr>
                <td>Downloading...</td>
            </tr>
        </table>

        <div id='pagination' class='pagination'>
        </div>
    </div>
</main>

