<?php

$city = ''; // inizializzo la variabile city a 'vuoto', se non abbiamo inviato il form, rimane vuota

// Se nonè vuota, andiamo a leggerci tutti questo dati
if (!empty($_GET['city'])) {
    
    $city = $_GET['city']; // la città viene modificata, da vuota diventa quella inserita dall'utente
    
    $url = 'https://www.weather-forecast.com/locations/'.$city.'/forecasts/latest';
    
    $content = @file_get_contents($url); // prendo il contenuto della pagina del meteo
    // uso la @ per evitare che l'errore durante un invio di una città inesistente di visualizzi sulla pagina
    // Warning: file_get_contents()...
    // sarebbe meglio un try/cathc
    
    $weather = ''; // inizializzo weather (il contenuto del meteo) a vuoto
    $error = ''; // inizializzo il messaggio di errore a vuoto
    
    // echo $content; // lo mando a schermo
    
    // Se il contenuto non è vuoto:
    if ($content) {
        $ini = strpos($content, '3 days)'); // cerchiamo la posizione in cui si trovano le parole 3 days (riferito al codice sorgente del sito del meteo, che si trova nella stringa $content), in modo da sapere da dove comincia il codice che ci interessa includere sulla nostra pagina...
        
        $end = strpos($content, '</span>', $ini); // e da dove finisce il codice che ci interessa includere sulla nostra pagina (in questo cerchiamo alla chiusura di span, ma non dappertutto, cerchiamo solo la prima che si trovi dopo la posizione $ini.
        
        /* N.B. 'strpos()' serve a cercare la posizione di una stringa all'interno di un'altra stringa (da dove comincia e da dove finisce il messaggio).
        
        Accetta 3 parametri:
        - la stringa in cui cercare la nostra posizione ($content in entrambi i casi);
        - che cosa vogliamo cercare ('3 days' nel primo caso / '</span>' nel secondo caso);
        - a partire da dove (nel primo caso dall'inizio, perché non abbiamo un punto di riferimento, quindi lo lasciamo vuoto / nel secondo caso a partire dalla prima chiusura span che si trova dopo la posizione $ini).
        
        A questo punto il nostro testo si troverà tra il punto $ini e il punto $end.
        */
        
        /* Per leggere il pezzo di stringa possiamo usare la funzione 'substr()', dove noi diciamo:
        - qual'è la stringa da dove vogliamo cominciare a leggere ($content);
        - a partire da dove, togliendo il pezzo che non ci interessa, in questo caso bisogna togliere '3 days)', cioè 7 caratteri ($ini +7);
        - la lunghezza, quanti caratteri vogliamo (in questo caso i caratteri che ci interessano sono compresi tra il contenuto che abbiamo in $end e quello che abbiamo in $ini, quindi $end - $ini)
        
        La funzione 'strip-tags()' mi permette di rimuovere tutti i tag che abbiamo sulla stringa in cui abbiamo lavorato
        */
        $weather = strip_tags(substr($content, $ini +7, $end - $ini));
        
        // Fermo il codice e vedo l'output di questa stringa
        // die($weather); // lo tolgo in modo che la pagina continui ad eseguirsi
    }
    // Altrimenti mostra l'errore
    else {
        $error = 'no data found';
    }
}

?>

<!-- Stringa in cui abbiamo lavorato -->
<!-- <span class="phrase">Light rain (total 5mm), mostly falling on Sat morning. Warm (max 29&deg;C on Mon afternoon, min 20&deg;C on Sat night). Wind will be generally light.</span> -->