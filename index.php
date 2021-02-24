<?php
require_once './controllers/pagination.php';
$pagination = new Pagination(3);
$pagination->calculatedTotalPages();
$pagination->calculatedSelectPage();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Listar Peliculas</title>
    <link rel="stylesheet" href="./styles//main.css">
</head>

<body>
    <main>
        <section>
            <div>
                <?php
$pagination->showMenu();
?>
            </div>
            <div class="container-movies">
                <?php
$pagination->showImages();
?>
            </div>
        </section>
    </main>
</body>

</html>