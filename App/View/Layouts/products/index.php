<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="products">
                    <h3>Товары</h3><hr/>
                    <div class="row">
                        <?php var_dump($_SESSION); foreach ($this->content['data']['Product'] as $product) {
                            echo "
                            <div class='col-4 col-md-2 product'>
                            <img class='rounded img-fluid product-img' src='".$product->getImg()."'/>
                            <p>{$product->getName()}</p>
                            <strong>{$product->getCost()} грн</strong><br/>
                            <button onclick='toBasket(".$product->getId().", ".$product->getCost().")'>В корзину</button>
                        </div>";
                        }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    function toBasket(id, cost)
    {
        $.ajax({
            url: "/basket/add",
            method: "POST",
            type: "text/html",
            data: {id: id, cost: cost},
            success: function () {
                $("html").load('/products/index');
            }
        })
    }
</script>