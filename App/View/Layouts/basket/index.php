<main>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="basket">
                    <ul class="basket-list">
                            <?php
                            $total = 0;
                            foreach ($this->content['data']['Products'] as $item) {
                                echo "<li>
                                        <div class='product'>
                                <div class='grid'>
                                <img class='rounded img-fluid product-img' src='".$item['item']->getImg()."'/>
                                    <div class='info'>
                                        <h3>{$item['item']->getName()}</h3>
                                        <strong>".$item['item']->getCost() * $item['amount']."</strong>
                                        <div class='counter'>
                                            <button name='-'>-</button>
                                            <input type='text' value='".$item['amount']."' size='3' name='count'/>
                                            <button name='+'>+</button>
                                        </div>
                                    </div>
                                <button>Убрать</button>
                                </div>
                            </div>
                        </li>";
                                $total += $item['item']->getCost() * $item['amount'];
                            }
                            ?>

                        <li>
                            <div class="total">
                            <strong>Итог: <?= $total ?> грн</strong><br/>
                            <button>Перейти к оформлению</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>