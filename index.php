<?php

$encrypted = [39, 11, 11, 0, 2, 7, 3, 8, 5, 11, 20, 73, 32, 0, 3, 27, 4, 29, 71, 46, 8, 28, 8, 7, 77, 78, 15, 8, 18, 78, 11, 6, 6, 28, 6, 13, 14, 78, 3, 12, 18, 13, 14, 15, 19, 15, 21, 73, 4, 2, 71, 4, 4, 0, 20, 8, 11, 11, 73, 73, 65, 47, 15, 6, 19, 15, 75, 73, 17, 15, 21, 8, 65, 31, 18, 12, 65, 39, 9, 26, 8, 24, 2, 73, 19, 11, 4, 6, 15, 1, 29, 10, 0, 78, 19, 28, 65, 2, 8, 14, 19, 1, 75, 73, 18, 27, 5, 12, 65, 11, 11, 73, 2, 1, 3, 12, 65, 13, 8, 7, 65, 11, 11, 73, 16, 27, 2, 73, 19, 11, 20, 6, 13, 24, 14, 26, 21, 11, 71, 12, 18, 26, 2, 73, 4, 4, 2, 27, 2, 7, 4, 0, 14, 78, 2, 7, 65, 41, 14, 29, 41, 27, 5, 70, 38, 7, 19, 37, 0, 12, 71, 16, 65, 13, 8, 4, 17, 15, 21, 29, 4, 78, 2, 5, 65, 11, 9, 5, 0, 13, 2, 73, 0, 78, 20, 6, 17, 1, 21, 29, 4, 46, 14, 7, 18, 7, 17, 12, 79,
13, 11, 71];

function isValidText($text): bool {
    //verifica si el texto cumple con la expresión regular proporcionada 
    return preg_match('/^[a-zA-Z0-9\s.,@\-_\/]+$/', $text) === 1;
}

function applyXOR(array $encrypted, string $key): string {
    // texto completo desencriptado
    $decrypted = '';
    //tamaño de la llave
    $keyLength = strlen($key);
    //recorre los numero encriptados
    for ($i = 0, $count = count($encrypted); $i < $count; $i++) {
        //desencripto el numero con la llave recibida y convierto el numero a una letra  y lo concateto a la variable para armar el texto
        $decrypted .= chr($encrypted[$i] ^ ord($key[$i % $keyLength]));
    }
    return $decrypted;
}

$alphabet = range('a', 'z');
// genero un ciclos en la cual va cambiando las letras del abecedario
foreach ($alphabet as $char1) {
    foreach ($alphabet as $char2) {
        foreach ($alphabet as $char3) {
            foreach ($alphabet as $char4) {
                $key = $char1 . $char2 . $char3 . $char4;
                $decrypted = applyXOR($encrypted, $key);
                if (isValidText($decrypted)) {

                   echo "key: $key\n";
                   echo "text: $decrypted\n";
                   exit();
                }
            }
        }
    }
}