<?php

$password = 'UIDJ@bar123';

echo $password.'<br/>';
// Hash a new password for storing in the database.
// The function automatically generates a cryptographically safe salt.
$hashToStoreInDb = password_hash($password, PASSWORD_BCRYPT);
echo $hashToStoreInDb.'<br/>';

$existingHashFromDb = $hashToStoreInDb;

// Check if the hash of the entered login password, matches the stored hash.
// The salt and the cost factor will be extracted from $existingHashFromDb.
$isPasswordCorrect = password_verify($password, $existingHashFromDb);
echo $isPasswordCorrect.'<br/>';

?>