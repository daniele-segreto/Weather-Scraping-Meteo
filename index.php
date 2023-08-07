<?php
    require 'php/getWeather.php';
    /* require al posto di include:
        include => mostra l'errore sul contenuto della pagina
        require => mostra l'errore, ma senza mostrare il contenuto della pagina
    */
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <title>WEATHER API</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <!-- CSS -->
    <link href="./css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-2">Che tempo fa?</h1>

        <!-- FORM -->
        <form action="index.php">
            <div class="form-group">
                <label for="city">Inserisci il nome della città</label>
                <input class="form-control mt-3" placeholder="Es. Roma" value="<?=$city?>" name="city" required>
            </div>
            <div class="form-group mt-3">
                <button class="btn btn-primary">CERCA</button>
            </div>

            <!-- ALERT -->
            <!-- * Controlla se la '$weather' è definita (sul tutorial non era presente): -->
            <?php if (isset($weather)): ?>

                <!-- Se la variabile '$weather' è true (cioè se ha qualcosa dentro), la classe è 'success', altrimenti  è'danger' -->
                <?php $class = $weather ? 'success' : 'danger'; ?>

                <div class="alert alert-<?=$class?> mt-3">
                    <!-- Se abbiamo '$header' andiamo a mostrare il suo contenuto, altrimenti mostriamo il contenuto di '$error' -->
                    <?= $weather ? $weather : $error ?>
                </div>

            <!-- * Chiudo la condizione di controllo (sul tutorial non era presente). -->
            <?php endif; ?>
        </form>

    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>