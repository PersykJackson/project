<main>
    <div class="container">
        <div class="row">
            <div class="col">
                <div id="errors"></div>
                <form action="/authentication/login" method="post">
                    <label for="login">Логин</label><br/>
                    <input type="text" id="login" name="login" placeholder="Введите логин"/><br/>
                    <label for="pass">Пароль</label><br/>
                    <input type="password" id="pass" name="password" placeholder="Введите пароль"/><br/>
                    <button>Вход</button>
                    <a href="/registration/index">Регистрация</a>
                </form>
            </div>
        </div>
    </div>
</main>