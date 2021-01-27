
<!DOCTYPE html>
<html lang="ru">
    <meta charset="UTF-8">
    <title>MaxiMarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
          crossorigin="anonymous">

    <?="<link rel='stylesheet' href='style/".$this->path.".css'>"?>
    <!--<link rel="stylesheet" href="../../../public/style/layout.css">-->
    <link rel='stylesheet' href='style/layout.css'>
</head>
<body>
    <div class="wrapper">
    <?php require_once __DIR__.'/../Layouts/header.html' ?>
    <?php echo $this->content['main']?>
    <?php require_once __DIR__.'/../Layouts/footer.html' ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>