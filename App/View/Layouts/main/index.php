 <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 new-year-img">
                    <img class="img-fluid rounded mx-auto d-block" src="/images/new-year-image.jpg" alt="oops"/>
                </div>
                <div class="col-12 popular">
                    <div class="products">
                        <h3>Популярные товары</h3><hr/>
                        <div class="row">
                            <?php
                            foreach ($this->content['data']['Product'] as $product) {
                                echo "
                                <div class='col-4 col-md-2 product'>
                            <img class='rounded img-fluid product-img' src='".$product->img."'/>
                            <p>{$product->name}</p>
                            <strong>{$product->cost} грн</strong><br/>
                            <button>В корзину</button>
                        </div>"; } ?>
                    </div>
                    </div>

                    <div class="categories">
                        <div class="row">
                        <h3>Популярные категории</h3><hr/>
                        <div class="col-4 col-md-2 category">
                            <a href="#"><img class="rounded img-fluid category-img" src="/images/categories/accessories.jpg"/>
                                <strong>Аксессуары</strong></a>
                        </div>
                        <div class="col-4 col-md-2 category">
                            <a href="#"><img class="rounded img-fluid category-img" src="/images/categories/for-kids.jpg"/>
                                <strong>Для детей</strong></a>
                        </div>
                        <div class="col-4 col-md-2 category">
                            <a href="#"><img class="rounded img-fluid category-img" src="/images/categories/sport.jpeg"/>
                                <strong>Для спорта</strong></a>
                        </div>
                        <div class="col-4 col-md-2 category">
                            <a href="#"><img class="rounded img-fluid category-img" src="/images/categories/clothes.jpg"/>
                                <strong>Одежда</strong></a>
                        </div>
                        <div class="col-4 col-md-2 category">
                            <a href="#"><img class="rounded img-fluid category-img" src="/images/categories/computer.jpg"/>
                                <strong>Компьютеры</strong></a>
                        </div>
                        <div class="col-4 col-md-2 category">
                            <a href="#"><img class="rounded img-fluid category-img" src="/images/categories/other.png"/>
                                <strong>Другое</strong></a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </main>