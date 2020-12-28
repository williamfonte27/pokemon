<?php
$url = "https://www.canalti.com.br/api/pokemons.json";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$pokemons = json_decode(curl_exec($ch));
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pokemóns</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
    <section class="container">
        <div id="card">

            <?php
            if (count($pokemons->pokemon)) {
                $i = 0;
                foreach ($pokemons->pokemon as $Pokemon) {
                    $i++;
            ?>
                    <figure class="card card--<?= strtolower($Pokemon->type[0]) ?>">
                        <div class="card__image-container">
                            <img src="<?= $Pokemon->img ?>" alt="<?= $Pokemon->name ?>" class="card__image">
                        </div>

                        <figcaption class="card__caption">
                            <h1 class="card__name"><?= $Pokemon->num . ' - ' . $Pokemon->name ?></h1>
                            <h5 class="card__type">
                                <?= $Pokemon->type[0] ?>
                            </h5>
                            <table class="card__stats">
                                <tbody>
                                    <tr>
                                        <th>Altura</th>
                                        <td><?= $Pokemon->height ?></td>
                                    </tr>
                                    <tr>
                                        <th>Peso</th>
                                        <td><?= $Pokemon->weight ?></td>
                                    </tr>

                                    <tr>
                                        <th>Evolutions</th>
                                        <td>
                                            <?php
                                            if (@count($Pokemon->next_evolution)) {
                                                foreach ($Pokemon->next_evolution as $NextEvolution) {
                                                    echo $NextEvolution->name . "  ";
                                                }
                                            } else {
                                                echo "None";
                                            }
                                            ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Weaknesses</th>
                                        <td>
                                            <?php
                                            if (@count($Pokemon->weaknesses)) {
                                                foreach ($Pokemon->weaknesses as $weakness) {
                                                    echo $weakness . ", ";
                                                }
                                            } else {
                                                echo "None";
                                            }
                                            ?>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </figcaption>
                    </figure>
                <?php
                }
            } else { ?>
                <strong>No pokemon returned by API.</strong>
            <?php } ?>

        </div><!-- Div Cards -->
    </section>

</body>

</html>