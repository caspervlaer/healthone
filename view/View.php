<?php
namespace view;
use model\Model;

class View
{
    private $model;
    private $content;
    //constructor
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->content = "Tractors";
        //echo "<hr>create account : ".$this->model->getContent();

    }
    public function showPatienten($result = null){
        if($result == 1){
            echo "<h4>Action proceeded</h4>";
        }
        $patienten = $this->model->getPatienten();

        /*de html template */
        echo "<!DOCTYPE html>
                <html lang=\"en\">
                <head>
                    <meta charset=\"UTF-8\">
                    <title>Overzicht patienten</title>
                    <style>
                        #patienten{
                            display:grid;
                            grid-template-columns:repeat(4,1fr);                
                            grid-column-gap:10px;
                            grid-row-gap:10px;
                            justify-content: center;
                        }
                        .patient{
                            width:80%;
                            background-color:#ccccff;
                            color:darkslategray;
                            font-size:24px;
                            padding:10px;
                            border-radius:10px;
                        }
                    </style>
                </head>
                <body>";
        echo "<h2>Patienten overzicht</h2> <form action='index.php' method='post'>
            <input type='hidden' name='showForm' value='0'>
            <input type='submit' value='toevoegen'/>
            </form></div></body></html>";
        if($patienten !== null) { echo "
            <div id=\"patienten\">";
                foreach ($patienten as $patient) {
                    echo "<div class=\"patient\">
                                       
                         $patient->naam<br />
                         $patient->adres<br />
                         $patient->woonplaats<br />
                         $patient->zknummer<br />
                         $patient->geboortedatum<br />
                         $patient->soortverzekering<br />
                         <form action='index.php' method='post'>
                         <input type='hidden' name='showForm' value='$patient->id'><input type='submit' value='wijzigen'/></form>
                         <form action='index.php' method='post'>
                         <input type='hidden' name='delete' value='$patient->id'><input type='submit' value='verwijderen'/></form>
                         </div>";
            }
        }
        else{
            echo "Geen patienten gevonden";
        }

    }

}