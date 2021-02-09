<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="products">
                    <h3>Товары</h3><hr/>
                    <div class="row">
                        <?php foreach ($this->content['data']['Product'] as $product) {
                            echo "
                            <div class='col-4 col-md-2 product'>
                            <img class='rounded img-fluid product-img' src='".$product->img."'/>
                            <p>{$product->name}</p>
                            <strong>{$product->cost} грн</strong><br/>
                            <button>В корзину</button>
                        </div>";
                        }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>