<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
class GererErreur extends Model
{
    public static function verifier($code){
        if($code==1044) 
        return 'Vous n\'êtes pas autorisé pour effectuer cette opération.';
        else if($code== 1048) 
        return'vérifiez que tous les champs sont remplis.';
        else if($code== 1086) 
        return'votre Email existe déja.';
        else if($code== 1132) 
        return'Vous n\'avez pas les privilèges pour faire ces modifications.';
        else if($code== 1216) 
        return 'Vous ne pouvez pas ajouté ou modifié (table fille).';
        else if($code== 1217) 
        return 'Vous ne pouvez pas supprimé ou modifié (table père).';
        
}
}