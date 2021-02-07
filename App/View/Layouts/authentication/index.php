<main>
    <div class="container">
        <div class="row">
            <div class="col">
                <?php
                if (isset($_COOKIE['errors'])) {
                    echo "<div class='error'>{$_COOKIE['errors']}</div>" . '<br/>';
                }
                ?>
                <form action="/authentication/login" method="post">
                    <label for="login">Логин</label><br/>
                    <input type="text" id="login" name="login" placeholder="Введите логин"><br/>
                    <label for="pass">Пароль</label><br/>
                    <input type="password" id="pass" name="password" placeholder="Введите пароль"><br/>
                    <button>Вход</button>
                    <a href="/authentication/registration">Регистрация</a>
                </form>
            </div>
        </div>
    </div>
</main>