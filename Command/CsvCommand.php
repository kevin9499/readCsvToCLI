<?php 

namespace App\Command;

use ReadCsv;
use WriteJson;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CsvCommand extends Command
{
    // Nom de la commande à écrire ("php bin/console app:csvCommand") 
    protected static $defaultName = 'app:csvCommand';
 
    protected function configure()
    {
        $this
            ->setDescription('Permet de lire un fichier CSV et de le convertir en tableau dans la CLI ou JSON')
            ->setHelp('Cette commande peremet d\'afficher un fichier Csv en CLI ou en JSON')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Json');
    }
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {   
        //Instantiation des classes ReadCsv et WriteJson
       $resultatCsv = new ReadCsv();
       $resultatCsv = $resultatCsv->readCsv();
       $resultatJson = new WriteJson();
       //Si un argument est utilisé alors créer un json
       $argument = $input->getArgument('argument');
        if ($argument){
            $resultatJson = $resultatJson->CreateJson($resultatCsv);
        }
        //Sinon retourn un tableau dans la CLI du fichier CSV
        else{
            $table = new Table($output);
            $table
                ->setHeaders($resultatCsv[0])
                ->setRows(
                    $this->formatOutput($resultatCsv)
                );
            $table->render();
        }
        $this->execTask();  
    }

    private function formatOutput($resultatCsv){
        //Cette fonction permet de créer l'affichage de la CLI
        $tab = [];
        for($i=0;$i<count($resultatCsv);$i++){

            if($i == 0){
                continue;
            }
            array_push($tab,$resultatCsv[$i]);
            if($i != count($resultatCsv)-1){
                array_push($tab,new TableSeparator());
            }
        }
        return $tab;
    }
    
    private function execTask(){
        //Execution d'une tache pour windows, cela créer une tache dans le planificaeur de tache windows qui executera un .bat qui lui même executera la commande php bin/console app:csv-command
        exec('schtasks /create /tn LaunchCsv /tr C:/Users/serveur/exec/task.bat /sc daily /st 07:00 /ed 31/12/2030');
        exec('schtasks /create /tn LaunchCsv /tr C:/Users/serveur/exec/task.bat /sc daily /st 19:00 /ed 31/12/2030');
    }
}
    

