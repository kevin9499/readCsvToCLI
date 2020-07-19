<?php 

class ReadCsv
{
    /*
        Cette classe permet la lecture d'un fichier CSV, le convertie en tableau et formate
        selon les critères demandé, puis retourn le tableau pour pouvoir être affiché dans la CLI
    */
    
    public function readCsv(){

        $row = 1;

        if(!file_exists("src\Command\Ressource\products.csv") || !is_readable("src\Command\Ressource\products.csv"))
        return FALSE;
        $header = NULL;
        $data = array();
        if (($handle = fopen("src\Command\Ressource\products.csv", 'r')) !== FALSE)
        {                  
            while (($row = fgetcsv($handle, 1000, ';')) !== FALSE)
            {
                if(!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
                    $tab[] = $row;                   
            }

            $tab[0][1] = "Slug";
            $rowLength = count($tab); 
           
            for ($i=0; $i < $rowLength; $i++){
                
                $devise = $tab[$i][3].$tab[$i][4];
                $tab[$i][3] = $devise;
                $tab[0][1] = "Status";
                $slug = $tab[$i][1];
                $tab[$i][7] = $slug;
                //Définition des valeurs en fonction de 0 et 1
                if($tab[$i][2] == 1){
                    $tab[$i][2] = "Enable";
                }
                else{
                    $tab[$i][2] = "Disable";
                }
                $tab[$i][3]= str_replace('.', ',', $tab[$i][3]);
                //Supression et réoganisation des cases du tableau non utilisé
                array_splice($tab[$i],1,1);
                array_splice($tab[$i],3,1); 

                $colLength = count($tab[$i]);   
                for ($j=0; $j < $colLength; $j++){
                    //Filtrage des balises HTML
                    $tab[$i][$j] = trim($tab[$i][$j]);
                    $tab[$i][$j] = strip_tags($tab[$i][$j]);  
                }
                if($i != 0){
                //Formatage de la date
                $dateFormat = strftime('%A, %d-%b-%Y %T CET',strtotime($tab[$i][4]));
                //Formatage des diverses demandes
                $tab[$i][4] = $dateFormat;
                $tab[$i][5]= str_replace(',','', $tab[$i][5]);
                $tab[$i][2]= str_replace('.', ',', $tab[$i][2]);
                $tab[$i][3] = str_replace('\r', ' ', $tab[$i][3]);
                $tab[$i][5]= str_replace(' ', '-', $tab[$i][5]);
                }
                else{
                    //Majuscule du header
                    $tab[$i][2] = "Price";
                    $tab[$i][0] = ucwords($tab[$i][0]);    
                    $tab[$i][3] = ucwords($tab[0][3]); 
                    $tab[$i][4] = str_replace('_', ' ', $tab[0][4]);   
                    $tab[$i][4] = ucwords($tab[0][4]);                                     
                }        
            }
        }
    return $tab;
    }   
}