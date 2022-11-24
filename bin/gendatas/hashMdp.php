<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

$pdo = new PDO('mysql:host=localhost;dbname=gsb_frais2', 'userGsb', 'secret');
$pdo->query('SET CHARACTER SET utf8');

function augmentationNbCaractereMdp($pdo){
    $pdo->exec("ALTER TABLE utilisateur MODIFY mdp VARCHAR(255)");
    echo("le nombre de caractère de la colonne mdp est passé à 255\n");
}


function hashMdpVisiteur($pdo)
{
    $req = 'select * from visiteur';
    $res = $pdo->query($req);
    $lesLignes = $res->fetchAll();
    foreach ($lesLignes as $unVisiteur) {
        if (strlen($unVisiteur['mdp'])<60){
            $mdp = password_hash($unVisiteur['mdp'], PASSWORD_DEFAULT);
            $id = $unVisiteur['id'];
            $req = "update visiteur set mdp ='$mdp' where visiteur.id ='$id' ";
            echo("le mdp de [".$unVisiteur['prenom']." ".$unVisiteur['nom']."] a été modifié en base\n");
            $pdo->exec($req);
        }
        else{ echo ("le mdp de [".$unVisiteur['prenom']." ".$unVisiteur['nom']."] n'a été modifié car il est déjà hashé\n");}
    }
}

augmentationNbCaractereMdp($pdo);
hashMdpVisiteur($pdo);