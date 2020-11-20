<?php
namespace view;
use model\Model;
include_once ('model/Model.php');
use model\Patient;
include_once('model/Patient.php');
use model\User;
include_once ('model/User.php');
class View
{

    private $model;
    public function __construct($model){
        $this->model = $model;
    }
    public function showPatienten($result = null){
        $patienten = $this->model->getPatienten();
        $users = $this->model->getUser();

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
                               </form></div>
                                <div><h2>profile</h2>
                                <a>name : </a>$users->name<br />
                                <a>apotheek : </a>$users->apotheek </div><br />
                               <form action='index.php' method='post'>
                                <input type='hidden' name='logout' value='0'>
                                <input type='submit' value='logout'/>
                               </form><br />
                               <div><h2>Drugs</h2>
                               <form action='index.php' method='post'>
                               <input type='hidden' name='showDrugs'>
                               <input type='submit' value='Drugs'>
                               </form>
                               </div><br />
                                </body></html>";
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
    public function showFormPatienten($id=null){
        if($id !=null && $id !=0){
            $patient = $this->model->selectPatient($id);
        }
        /*de html template */
        echo "<!DOCTYPE html>
        <html lang=\"en\">
        <head>
            <meta charset=\"UTF-8\">
            <title>Beheer patientengegevens</title>
        </head><body>
        <h2>Formulier patientgegevens</h2>";
        if(isset($patient)){
            echo "<form method='post' >
        <table>
            <tr><td></td><td>
                <input type=\"hidden\" name=\"id\" value='$id'/></td></tr>
             <tr><td>   <label for=\"naam\">Patient naam</label></td><td>
                <input type=\"text\" name=\"naam\" value= '".$patient->naam."'/></td></tr>
            <tr><td>
                <label for=\"adres\">adres</label></td><td>
                <input type=\"text\" name=\"adres\" value = '".$patient->adres."'/></td></tr>
            <tr><td>
                <label for=\"woonplaats\">woonplaats</label></td><td>
                <input type=\"text\" name=\"woonplaats\" value= '".$patient->woonplaats."'/></td></tr>
            <tr><td>
                <label for=\"geboortedatum\">geboortedatum</label></td><td>
                <input type=\"text\" name=\"geboortedatum\" value= '".$patient->geboortedatum."'/></td></tr>
            <tr><td>
                <label for=\"zknummer\">zknummer</label></td><td>
                <input type=\"text\" name=\"zknummer\" value= '".$patient->zknummer."'/></td></tr>
                 <tr><td>
                <label for=\"soortverzekering\">soortverzekering</label></td><td>
                <input type=\"text\" name=\"soortverzekering\" value= '".$patient->soortverzekering."'/></td></tr>
            <tr><td>
                <input type='submit' name='update' value='opslaan'></td><td>
            </td></tr></table>
            </form>
        </body>
        </html>";
        }
        else{
            /*de html template */
            echo "<form method='post' action='index.php'>
        <table>
            <tr><td></td><td>
                <input type=\"hidden\" name=\"id\" value=''/></td></tr>
             <tr><td>   <label for=\"naam\">Patient naam</label></td><td>
                <input type=\"text\" name=\"naam\" value= ''/></td></tr>
            <tr><td>
                <label for=\"adres\">adres</label></td><td>
                <input type=\"text\" name=\"adres\" value = ''/></td></tr>
            <tr><td>
                <label for=\"woonplaats\">woonplaats</label></td><td>
                <input type=\"text\" name=\"woonplaats\" value= ''/></td></tr>
            <tr><td>
                <label for=\"geboortedatum\">geboortedatum</label></td><td>
                <input type=\"text\" name=\"geboortedatum\" value= ''/></td></tr>
            <tr><td>
                <label for=\"zknummer\">zknummer</label></td><td>
                <input type=\"text\" name=\"zknummer\" value= ''/></td></tr>
                 <tr><td>
                <label for=\"soortverzekering\">soortverzekering</label></td><td>
                <input type=\"text\" name=\"soortverzekering\" value= ''/></td></tr>
            <tr><td>
                <input type='submit' name='create' value='opslaan'></td><td>
            </td></tr></table>
            </form>
        </body>
        </html>";
        }
    }
    public function showLogin(){
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
                <body>
                <h2>Login</h2>
                <form method='post' action='index.php'>
                <table class='login'>
                    <tr><td></td><td>
                        <input type=\"hidden\" name=\"id\" value=''/></td></tr>
                    <tr><td>   
                        <label for=\"naam\">user naam</label></td><td>
                        <input type=\"text\" name=\"naam\" value= ''/></td></tr>                               
                    <tr><td>
                        <label for=\"wachtwoord\">wachtwoord</label></td><td>
                        <input type=\"text\" name=\"wachtwoord\" value = ''/></td></tr>
                    <tr><td>
                        <input type='submit' name='login' value='login'></td><td>
                    </td></tr>
                </table>
                </form>            
                </body>
                </html>";
    }
    public function showDrugs(){
        $drugs = $this->model->getDrugs();
        echo "<!DOCTYPE html>
                <html lang=\"en\">
                <head>
                    <meta charset=\"UTF-8\">
                    <title>Overzicht patienten</title>
                    <style>
                        #drugs{
                            display:grid;
                            grid-template-columns:repeat(4,1fr);                
                            grid-column-gap:10px;
                            grid-row-gap:10px;
                            justify-content: center;
                        }
                        .drug{
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
        echo "<div><h2>Terug</h2>
                <form action='index.php' method='post'>
                               <input type='hidden' name='showPatienten' value='0'>
                               <input type='submit' value='terug'/>
                               </form>
                </div>
                <div><h2>Drugs</h2>
                <form action='index.php' method='post'>
                               <input type='hidden' name='showDrugForm' value='0'>
                               <input type='submit' value='toevoegen'/>
                               </form>
              </div><br />";
        if($drugs !== null) { echo "
                        <div id=\"drugs\">";
            foreach ($drugs as $drug) {
                echo "<div class=\"drug\">
                                       
                                      $drug->naam<br />
                                      $drug->maker<br />
                                      $drug->compensated<br />
                                      $drug->side_efect<br />
                                      $drug->benefits<br />

                                      <form action='index.php' method='post'>
                                       <input type='hidden' name='showDrugForm' value='$drug->id'><input type='submit' value='wijzigen'/></form>
                                        <form action='index.php' method='post'>
                                       <input type='hidden' name='deleteDrug' value='$drug->id'><input type='submit' value='verwijderen'/></form>
                                    </div>";
            }
        }
    }
    public function showDrugForm($id=null){
        if($id !=null && $id !=0){
            $drug = $this->model->selectDrug($id);
        }
        /*de html template */
        echo "<!DOCTYPE html>
        <html lang=\"en\">
        <head>
            <meta charset=\"UTF-8\">
            <title>Beheer druggegevens</title>
        </head><body>
        <h2>Formulier DrugGegevens</h2>";
        if(isset($drug)){
            echo "<form method='post' >
        <table>
            <tr><td></td><td>
                <input type=\"hidden\" name=\"id\" value='$id'/></td></tr>
             <tr><td>   <label for=\"naam\">Patient naam</label></td><td>
                <input type=\"text\" name=\"naam\" value= '".$drug->naam."'/></td></tr>
            <tr><td>
                <label for=\"maker\">maker</label></td><td>
                <input type=\"text\" name=\"maker\" value = '".$drug->maker."'/></td></tr>
            <tr><td>
                <label for=\"compensated\">compensated</label></td><td>
                <input type=\"text\" name=\"compensated\" value= '".$drug->compensated."'/></td></tr>
            <tr><td>
                <label for=\"side_efect\">side_efect</label></td><td>
                <input type=\"text\" name=\"side_efect\" value= '".$drug->side_efect."'/></td></tr>
            <tr><td>
                <label for=\"benefits\">benefits</label></td><td>
                <input type=\"text\" name=\"benefits\" value= '".$drug->benefits."'/></td></tr>
            <tr><td>
                <input type='submit' name='updateDrug' value='opslaan'></td><td>
            </td></tr></table>
            </form>
        </body>
        </html>";
        }
        else{
            /*de html template */
            echo "<form method='post' action='index.php'>
        <table>
            <tr><td></td><td>
                <input type=\"hidden\" name=\"id\" value=''/></td></tr>
             <tr><td>   <label for=\"naam\">Patient naam</label></td><td>
                <input type=\"text\" name=\"naam\" value= ''/></td></tr>
            <tr><td>
                <label for=\"maker\">maker</label></td><td>
                <input type=\"text\" name=\"maker\" value = ''/></td></tr>
            <tr><td>
                <label for=\"compensated\">compensated</label></td><td>
                <input type=\"text\" name=\"compensated\" value= ''/></td></tr>
            <tr><td>
                <label for=\"side_efect\">side_efect</label></td><td>
                <input type=\"text\" name=\"side_efect\" value= ''/></td></tr>
            <tr><td>
                <label for=\"benefits\">benefits</label></td><td>
                <input type=\"text\" name=\"benefits\" value= ''/></td></tr>
            <tr><td>
                <input type='submit' name='addDrug' value='opslaan'></td><td>
            </td></tr></table>
            </form>
        </body>
        </html>";
        }
    }
}