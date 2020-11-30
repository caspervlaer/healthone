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
    // this will show u the patienten page
    public function showPatienten($result = null){
        $patienten = $this->model->getPatienten();
        $users = $this->model->getUser($_SESSION['user']);
        $receipts = $this->model->getReceipts();

        /*de html template */
        echo "<!DOCTYPE html>
                <html lang=\"en\">
                <head>
                    <meta charset=\"UTF-8\">
                    <title>Overzicht patienten</title>
                    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
                    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
                    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>
                    <style>
                    </style>
                </head>
                <body>";
        echo "
                            <div class='d-flex justify-content-center'>
                                <div><h2>profile</h2>
                                <a>name : </a>$users->name<br />
                                <a>apotheek : </a>$users->apotheek<br />
                               <form action='index.php' method='post'>
                                <input type='hidden' name='logout' value='0'>
                                <input class='btn btn-outline-secondary' type='submit' value='logout'/>
                               </form></div><br />
                            </div>
                            <div class='d-flex justify-content-center'>
                               <div><h2>Drugs</h2>
                               <form action='index.php' method='post'>
                               <input type='hidden' name='showDrugs'>
                               <input class='btn btn-outline-secondary' type='submit' value='Drugs'>
                               </form>
                               </div><br />
                            </div>
                            <div class='d-flex justify-content-center'>
                               <h2>Patienten overzicht</h2> <form action='index.php' method='post'>
                            </div>
                            <div class='d-flex justify-content-center'>
                               <input type='hidden' name='showForm' value='0'>
                               <input class='btn btn-outline-secondary' type='submit' value='toevoegen'/>
                               </form></div><br />
                            </div>
                                </body></html>";
        if($patienten !== null) { echo "
                        <div class='row d-flex justify-content-center'>";
            foreach ($patienten as $patient) {
                echo "<div class='col-sm-12 col-md-6 col-lg-4 jumbotron'>
                        <div class='d-flex justify-content-center'>
                            <table class='table-striped '>
                            <tr><th>naam :</th><th> $patient->naam</th></tr>
                            <tr><th>adres :</th><th> $patient->adres</th></tr>
                            <tr><th>woonplaats :</th><th> $patient->woonplaats</th></tr>
                            <tr><th>zknummer :</th><th> $patient->zknummer</th></tr>
                            <tr><th>geboortedatum :</th><th> $patient->geboortedatum</th></tr>
                            <tr><th>soortverzekering :</th><th> $patient->soortverzekering</th></tr> 
                            </table>
                        </div>
                        <div class='d-flex justify-content-center'>
                                      <form action='index.php' method='post'>
                                       <input type='hidden' name='showForm' value='$patient->id'><input class='btn btn-outline-secondary' type='submit' value='wijzigen'/></form>
                                        <form action='index.php' method='post'>
                                       <input type='hidden' name='delete' value='$patient->id'><input class='btn btn-outline-secondary' type='submit' value='verwijderen'/></form>
                        </div>
                        <div class='d-flex justify-content-center'>
                             <form action='index.php' method='post'>
                             <input type='hidden' name='showCreateReceipt' value='$patient->id'><input class='btn btn-outline-secondary' type='submit' value='add receipt'></form>
                             <form action='index.php' method='post'>
                             <input type='hidden' name='showReceipt' value='$patient->id'><input class='btn btn-outline-secondary' type='submit' value='show receipt'></form>
                        </div></div>";
            }
        }
        else{
            echo "Geen patienten gevonden";
        }
    }
    //this will show u the patieten form
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
            <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
                    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
                    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>
        </head><body>";
        if(isset($patient)){
            echo "<div class='jumbotron'><div class='d-flex justify-content-center'><h2>Formulier patientgegevens</h2></div>
        <div class='d-flex justify-content-center'>
        <form method='post' >
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
                <input class='btn btn-outline-secondary' type='submit' name='update' value='opslaan'></td><td>
            </td></tr></table>
            </form></div></div><div class='d-flex justify-content-center'>
            <form action='index.php' method='post'>
            <input type='hidden' name='showPatienten' value='0'>
            <input class='btn btn-outline-secondary' type='submit' value='terug'/>
            </form>
            </div>" .
                "
        </body>
        </html>";
        }
        else{
            /*de html template */
            echo "<div class='jumbotron'><div class='d-flex justify-content-center'><h2>Formulier patientgegevens</h2></div>
        <div class='d-flex justify-content-center'>
        <form method='post' action='index.php'>
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
                <input class='btn btn-outline-secondary' type='submit' name='create' value='opslaan'></td><td>
            </td></tr></table>
            </form></div></div>
            <div class='d-flex justify-content-center'>
            <form action='index.php' method='post'>
            <input type='hidden' name='showPatienten' value='0'>
            <input class='btn btn-outline-secondary' type='submit' value='terug'/>
            </form>
            </div>
        </body>
        </html>";
        }
    }
    //this will show u the login
    public function showLogin(){
        echo "<!DOCTYPE html>
                <html lang=\"en\">
                <head>
                    <meta charset=\"UTF-8\">
                    <title>Overzicht patienten</title>
                    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
                    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
                    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>
                </head>
                <body>      
                <div class='col-sm-4 container-fluid pt-5 bg-light '>
                <h2 class='d-flex justify-content-center'>Login</h2>
                <form method='post' action='index.php'>
                <table class='login .table-dark' >
                    <div>
                        <input type=\"hidden\" name=\"id\" value=''/>
                    </div><div class='d-flex justify-content-center'>   
                        <label class='form-group' for=\"naam\">user naam</label>
                        </div><div class='d-flex justify-content-center'>
                        <input class='form-group d-flex justify-content-center' type=\"text\" name=\"naam\" value= ''/>                              
                    </div><div class='d-flex justify-content-center'>
                        <label class='form-group' for=\"wachtwoord\">wachtwoord</label>
                        </div><div class='d-flex justify-content-center'>
                        <input class='form-group d-flex justify-content-center' type=\"text\" name=\"wachtwoord\" value = ''/>
                    </div><div class='d-flex justify-content-center'>
                        <input class='form-group d-flex justify-content-center btn btn-outline-secondary' type='submit' name='login' value='login'>
                    </div>
                </table>
                </form>
                </div>                     
                </body>
                </html>";
    }
    //this will show u the drug page
    public function showDrugs(){
        $drugs = $this->model->getDrugs();
        echo "<!DOCTYPE html>
                <html lang=\"en\">
                <head>
                    <meta charset=\"UTF-8\">
                    <title>Overzicht patienten</title>
                    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
                    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
                    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>
                    <style>
                    </style>
                </head>
                <body>";
        echo "<div class='d-flex justify-content-center'><h2>Terug</h2></div>
            <div class='d-flex justify-content-center'>
                <form action='index.php' method='post'>
                               <input type='hidden' name='showPatienten' value='0'>
                               <input class='btn btn-outline-secondary' type='submit' value='terug'/>
                               </form>
            </div>
                <div class='d-flex justify-content-center'><h2>Drugs</h2></div>
            <div class='d-flex justify-content-center'>
                <form action='index.php' method='post'>
                               <input type='hidden' name='showDrugForm' value='0'>
                               <input class='btn btn-outline-secondary' type='submit' value='toevoegen'/>
                               </form>
            </div>
              <br />";
        if($drugs !== null) { echo "
                        <div class='row d-flex justify-content-center'>";
            foreach ($drugs as $drug) {
                echo "<div class='col-sm-12 col-md-6 col-lg-4 jumbotron'>
                            <div class='d-flex justify-content-center'>
                            <table class='table-striped '>
                            <tr><th>naam :</th><th> $drug->naam</th></tr>
                            <tr><th>maker :</th><th> $drug->maker</th></tr>
                            <tr><th>compensated :</th><th> $drug->compensated</th></tr>
                            <tr><th>side_efect :</th><th> $drug->side_efect</th></tr>
                            <tr><th>benefits :</th><th> $drug->benefits</th></tr> 
                            </table>
                        </div><div class='d-flex justify-content-center'>
                                      <form action='index.php' method='post'>
                                       <input type='hidden' name='showDrugForm' value='$drug->id'><input class='btn btn-outline-secondary' type='submit' value='wijzigen'/></form>
                                        <form action='index.php' method='post'>
                                       <input type='hidden' name='deleteDrug' value='$drug->id'><input class='btn btn-outline-secondary' type='submit' value='verwijderen'/></form>
                                    </div></div>";
            }
        }
    }
    //this will show u the drug form
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
            <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
                    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
                    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>
        </head><body>";
        if(isset($drug)){
            echo "<div class='jumbotron'><div class='d-flex justify-content-center'><h2>Formulier DrugGegevens</h2></div>
        <div class='d-flex justify-content-center'><form method='post' >
        <table>
            <tr><td></td><td>
                <input type=\"hidden\" name=\"id\" value='$id'/></td></tr>
             <tr><td>   <label for=\"naam\">Drug naam</label></td><td>
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
                <input class='btn btn-outline-secondary' type='submit' name='updateDrug' value='opslaan'></td><td>
            </td></tr></table>
            </form></div></div>
            <div class='d-flex justify-content-center'><h2>Terug</h2></div>
            <div class='d-flex justify-content-center'>
            <form action='index.php' method='post'>
            <input type='hidden' name='showDrugs' value='0'>
            <input class='btn btn-outline-secondary' type='submit' value='terug'/>
            </form>
            </div>
        </body>
        </html>";
        }
        else{
            /*de html template */
            echo "<div class='jumbotron'><div class='d-flex justify-content-center'><h2>Formulier DrugGegevens</h2></div>
        <div class='d-flex justify-content-center'>
        <form method='post' action='index.php'>
        <table>
            <tr><td></td><td>
                <input type=\"hidden\" name=\"id\" value=''/></td></tr>
             <tr><td>   <label for=\"naam\">Drug naam</label></td><td>
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
                <input class='btn btn-outline-secondary' type='submit' name='addDrug' value='opslaan'></td><td>
            </td></tr></table>
            </form></div></div>
            <div class='d-flex justify-content-center'><h2>Terug</h2></div>
            <div class='d-flex justify-content-center'>
            <form action='index.php' method='post'>
            <input type='hidden' name='showDrugs' value='0'>
            <input class='btn btn-outline-secondary' type='submit' value='terug'/>
            </form>
            </div>
        </body>
        </html>";
        }
    }
    //this will show u the receipt form
    public function showReceiptForm($id){
        $drugs = $this->model->getDrugs();
        echo "<!DOCTYPE html>
        <html lang=\"en\">
        <head>
            <meta charset=\"UTF-8\">
            <title>Beheer druggegevens</title>
            <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
                    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
                    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>
        </head><body>";
        echo "<div class='jumbotron'><div class='d-flex justify-content-center'><h2>Formulier ReceiptGegevens</h2></div>
        <div class='d-flex justify-content-center'>
        <form method='post' action='index.php'>
        <table>
         <div>
             <input type=\"hidden\" name=\"patientid\" value='$id'/>
         </div><div>
            <input type='hidden' name='id' value=''>
         </div><div>
            <label>notitie</label>
         </div><div>
            <input type=\"text\" name='notitie' value= ''/>
         </div><div>
            <label>herhaling</label>
         </div><div>
            <input type='text' name='herhaling' value= ''/>
         </div><div>
            <label>duration</label>
         </div><div>
            <input type=\"text\" name='duration' value= ''/>
         </div><div>
            <input type='hidden' name='date' value=''>
         </div><div>
            <label>drug id</label>
         </div><div>
            <input type=\"text\" name='drugid' value= ''/>
         </div><div>
            <input type='submit' name='addReceipt' value='add Receipt'>      
         </div>
            </table>
            </form></div></div>
            <div class='d-flex justify-content-center'>
            <h2>terug</h2>
            </div>
         <div class='d-flex justify-content-center'>
            <form action='index.php' method='post'>
            <input type='hidden' name='showPatienten' value='0'>
            <input class='btn btn-outline-secondary' type='submit' value='terug'/>
            </form>
            </div>
         <h2 class='d-flex justify-content-center'>all drugs</h2>
        </body>
        </html>";
        if($drugs !== null) { echo "
                        <div class='row d-flex justify-content-center'>";
            foreach ($drugs as $drug) {
                echo "<div class='col-sm-12 col-md-6 col-lg-4 jumbotron'>
                            <div class='d-flex justify-content-center'>
                            <table class='table-striped '>
                            <tr><th>id :</th><th> $drug->id</th></tr>
                            <tr><th>naam :</th><th> $drug->naam</th></tr>
                            <tr><th>maker :</th><th> $drug->maker</th></tr>
                            <tr><th>compensated :</th><th> $drug->compensated</th></tr>
                            <tr><th>side_efect :</th><th> $drug->side_efect</th></tr>
                            <tr><th>benefits :</th><th> $drug->benefits</th></tr> 
                            </table>
                        </div></div>";
            }
        }
    }
    //this will show u the receipt page
    public function showReceipt($id){
        $recept = $this->model->selectReceipt($id);
        if ($recept){
        $drug = $this->model->selectDrug($recept->drugid);

        echo "<!DOCTYPE html>
        <html lang=\"en\">
        <head>
            <meta charset=\"UTF-8\">
            <title>Beheer druggegevens</title>
            <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
                    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
                    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>
        </head><body>";
        echo "
                            <div class='d-flex justify-content-center jumbotron'>
                            <h2>ReceiptGegevens</h2>
                            </div>
                            
                            <div class='d-flex justify-content-center jumbotron'>
                            <table class='table-striped '>
                            <tr><th>dosis :</th><th> $recept->notitie</th></tr>
                            <tr><th>duur :</th><th> $recept->duration</th></tr>
                            <tr><th>herhaling :</th><th> $recept->herhaling</th></tr>
                            <tr><th>datum :</th><th> $recept->date</th></tr>
                            </table>
                            </div>
                            
                            <div class='d-flex justify-content-center jumbotron'>
                            <h2>drug gegevens</h2>
                            </div>
                            
                            <div class='d-flex justify-content-center jumbotron'>
                            <table class='table-striped '><tr>
                            <th>naam :</th><th> $drug->naam</th></tr>
                            <tr><th>maker :</th><th> $drug->maker</th></tr>
                            <tr><th>compensated :</th><th> $drug->compensated</th></tr>
                            <tr><th>side_efect :</th><th> $drug->side_efect</th></tr>
                            <tr><th>benefits :</th><th> $drug->benefits</th></tr> 
                            </table>
                            </div>
                            
                            <div class='d-flex justify-content-center'><h2>Terug</h2></div>
                            <div class='d-flex justify-content-center'>
                            <form action='index.php' method='post'>
                            <input type='hidden' name='showPatienten' value='0'>
                            <input class='btn btn-outline-secondary' type='submit' value='terug'/>
                            </form>
                            </div>";
        }else{
            echo "<!DOCTYPE html>
        <html lang=\"en\">
        <head>
            <meta charset=\"UTF-8\">
            <title>Beheer druggegevens</title>
            <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
                    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
                    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>
        </head><body>";
            echo "<div class='d-flex justify-content-center jumbotron'>
                  <h2>ReceiptGegevens</h2>
                  </div>
                  
                  <div class='d-flex justify-content-center jumbotron'>
                  <h2>er is geen recept</h2>
                  </div>
                  
                  <div class='d-flex justify-content-center'><h2>Terug</h2></div>
                  <div class='d-flex justify-content-center'>
                  <form action='index.php' method='post'>
                  <input type='hidden' name='showPatienten' value='0'>
                  <input class='btn btn-outline-secondary' type='submit' value='terug'/>
                  </form>
                  </div>";
        }
    }
}