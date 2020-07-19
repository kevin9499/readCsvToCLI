<?php 

class WriteJson
{
    /*
        Cette class permet l'écriture dans un fichier JSON, Il est envoyé
        en argument le tableau qui contient les données du fichier CSV pour 
        ensuite l'écrire dans le fichier de destination
    */
    public function CreateJson($tab){
        $fJson = json_encode($tab); 
        $fp = fopen('src\Command\Ressource\products.json', 'w');
        fwrite($fp,$fJson);   // here it will print the array pretty
        fclose($fp);
        return $fJson;
    }
}