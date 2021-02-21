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
                            <img class='rounded img-fluid product-img' src='".$product->getImg()."'/>
                            <p>{$product->getName()}</p>
                            <strong>{$product->getCost()} грн</strong><br/>
                            <button onclick='toBasket({$product->getId()})'>В корзину</button>
                        </div>";
                            } ?>
                    </div>
                    </div>

                    <div class="categories">
                        <div class="row">
                        <h3>Популярные категории</h3><hr/>
                            <?php
                            foreach ($this->content['data']['Categories'] as $category) {
                                echo "<div class='col-4 col-md-2 category'>
                            <a href='/products/index?category=".$category->getId()."'><img class='rounded img-fluid category-img' src='".$category->getImg()."'/>
                                <strong>{$category->getName()}</strong></a>
                            </div>";
                            } ?>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </main>