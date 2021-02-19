<main>
    <div class="container">
        <form action="/order/new" method="post">
            <label for="phone">Enter your phone number:</label><br/>
            <input type="tel" id="phone" name="phone" size="10" maxlength="10"/><br/>
            <label for="address">Enter your address:</label><br/>
            <input type="text" id="address" name="address"/><br/>
            <label for="date">Enter delivery date:</label><br/>
            <input type="date" id="date" name="date"/><br/>
            <label for="comment">Enter comment for order:</label><br/>
            <textarea id="comment" name="comment"></textarea><br/>
            <input type="submit" value="Order"/>
        </form>
    </div>
</main>
