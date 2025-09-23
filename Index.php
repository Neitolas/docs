<?php

require_once 'src/User.php';
require_once 'src/UserManager.php';

$users = [
    ['id' => 1, 'name' => 'João Silva', 'email' => 'joao@email.com', 'password' => password_hash('strongpassword1', PASSWORD_DEFAULT)],
    ['id' => 2, 'name' => 'Ana Martins', 'email' => 'ana@email.com', 'password' => password_hash('otherpassword2', PASSWORD_DEFAULT)],
];

$userManager = new UserManager($users);

echo "<h1>User and Authentication System</h1>";
echo "<h3>Demonstrating Use Cases</h3>";


echo "<h4>Valid Sign-Up</h4>";
$newUser = $userManager->registerUser('Maria Oliveira', 'maria@email.com', 'Senha123');
if ($newUser) {
    echo "<p>User successfully registered.</p>";
    echo "<pre>" . print_r($newUser->toArray(), true) . "</pre>";
}
echo "<hr>";


echo "<h4>Sign-up with Invalid Email</h4>";
$result = $userManager->registerUser('Pedro', 'pedro@email', 'Senha123');
if (!$result) {
    echo "<p>Invalid email.</p>";
}
echo "<hr>";


echo "<h4>Login Attempt with Wrong Password</h4>";
$login = $userManager->login('joao@email.com', 'Errada123');
if ($login) {
    echo "<p>Login successful.</p>";
} else {
    echo "<p>Invalid credentials.</p>";
}
echo "<hr>";

echo "<h4>Valid Password Reset</h4>";
$reset = $userManager->resetPassword(1, 'NovaSenha1');
if ($reset) {
    echo "<p>Password for user with ID 1 changed successfully.</p>";
} else {
    echo "<p>Failed to change password.</p>";
}
echo "<hr>";


echo "<h4>Sign-up with Duplicate Email</h4>";
$duplicateResult = $userManager->registerUser('José da Silva', 'joao@email.com', 'SenhaForte123');
if (!$duplicateResult) {
    echo "<p>Email is already in use.</p>";
}
echo "<hr>";

?>