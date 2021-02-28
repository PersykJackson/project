<header>
    <nav>
        <ul>
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-lg-8">
                        <div class="row justify-content-start left-nav">
                            <div class="col-1 col-md-4 col-lg-1">
                                <li class="nav-item"><a href="/main/index">MaxiMarket</a></li>
                            </div>
                            <div class="col-1 col-md-4 col-lg-1">
                                <li class="nav-item"><a href="/products/index">Товары</a></li>
                            </div>
                            <div class="col-1 col-md-4 col-lg-1 drop-trigger">
                                <li class="nav-item"><a class="" href="#">Категории</a></li>
                                <div class="drop-down">
                                    <ul>
                                        <?php
                                        foreach ($this->content['data']['Categories'] as $category) {
                                            echo "<li><a href='/products/index?category=".$category->getId()."'>{$category->getName()}</a></li>";
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-4">
                        <div class="row justify-content-center">
                            <?php
                            if (isset($_SESSION['auth'])) {
                                    echo "
                            <div class='col-1 col-md-auto'>
                                <li class='nav-item'><a href='/basket/index'>Корзина</a></li>
                            </div>
                            <div class='col-1 col-md-auto'>
                                <li class='nav-item'><a href='/account/history'>Аккаунт</a></li>
                            </div>
                            <div class='col-1 col-md-auto'>
                                <li class='nav-item'><a href='/authentication/logout'>Выход</a></li>
                            </div>";
                            } else {
                                echo "<div class='col-1 col-md-auto'>
                                <li class='nav-item'><a href='/authentication/index'>Авторизация</a></li>
                            </div>";
                            }?>
                        </div>
                    </div>
                </div>
            </div>
        </ul>
    </nav>
</header>
