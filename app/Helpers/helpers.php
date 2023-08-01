<?php
use Illuminate\Support\Str;

define("PAGELIST", "list");
define("PAGECREATEFORM", "create");
define("PAGEEDITFORM", "edit");

define("DEFAULTPASSWORD", "password");


//recupere nom et prenom 
function userFullName(){
    return auth()->user()->prenom . " " . auth()->user()->nom;
}

//Gestion de menu
function setMenuClass($route, $classe){
    $routeActuel = request()->route()->getName();

    if(contains($routeActuel, $route) ){
        return $classe;
    }
    return "";
}

function setMenuActive($route){
    $routeActuel = request()->route()->getName();

    if($routeActuel === $route ){
        return "active";
    }
    return "";
}

function contains($container, $contenu){
    return Str::contains($container, $contenu);
}

//Afficher les roles
function getRolesName(){
    $rolesName = "";
    $i = 0;
    foreach(auth()->user()->roles as $role){
        $rolesName .= $role->nom;

        //
        if($i < sizeof(auth()->user()->roles) - 1 ){
            $rolesName .= ",";
        }

        $i++;

    }

    return $rolesName;
}