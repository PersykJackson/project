<main>
    <div class="container">
        <div class="row">
            <div class="col">
                <?php if (isset($_COOKIE['errors'])) {
                    echo $_COOKIE['errors'];
                }?>
                <form class="form" action="/registration/register" method="post">
                    <label for="name">Имя</label><br/>
                    <input type="text" id="name" name="firstName" placeholder="Введите имя"/><br/>
                    <label for="lastName">Фамилия</label><br/>
                    <input type="text" id="lastName" name="lastName" placeholder="Введите фамилию"/><br/>
                    <label for="login">Логин</label><br/>
                    <input type="text" id="login" name="login" placeholder="Введите логин"/><br/>
                    <label for="email">Почта</label><br/>
                    <input type="email" id="email" name="email" placeholder="Введите почту"/><br/>
                    <label for="password">Пароль</label><br/>
                    <input type="password" id="password" name="password" placeholder="Введите пароль"/><br/>
                    <label for="confirm">Подтвердие пароль</label><br/>
                    <input type="password" id="confirm" name="confirm" placeholder="Проверка пароля"/><br/>
                    <button class="btn">Зарегистрироваться</button>
                </form>
            </div>
        </div>
    </div>
</main>