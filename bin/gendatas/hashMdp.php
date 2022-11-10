<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

$pdo = new PDO('mysql:host=localhost;dbname=gsb_frais2', 'userGsb', 'secret');
$pdo->query('SET CHARACTER SET utf8');

function hashMdpVisiteur($pdo)
{
    $req = 'select * from visiteur';
    $res = $pdo->query($req);
    $lesLignes = $res->fetchAll();
    foreach ($lesLignes as $unVisiteur) {
        $mdp = password_hash($unVisiteur['mdp'], PASSWORD_DEFAULT);
        $id = $unVisiteur['id'];
        $req = "update visiteur set mdp ='$mdp' where visiteur.id ='$id' ";
        $pdo->exec($req);
    }
}

hashMdpVisiteur($pdo);