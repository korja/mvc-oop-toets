<?php
class RichestPeople extends Controller {

  public function __construct() {
    $this->RichModel = $this->model('RichestPeople');
  }

  public function index() {
    /**
     * Haal via de method getFruits() uit de model Fruit de records op
     * uit de database
     */
    $RichestPeople = $this->RichModel->getRich();

    /**
     * Maak de inhoud voor de tbody in de view
     */
    $rows = '';
    foreach ($RichestPeople as $value){
      $rows .= "<tr>
                  <td>$value->id</td>
                  <td>" . htmlentities($value->Name, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . htmlentities($value->Networth, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . htmlentities($value->Age, ENT_QUOTES, 'ISO-8859-1') . "</td>
                  <td>" . htmlentities($value->MyCompany, 0, ',', '.') . "</td>
                  <td><a href='" . URLROOT . "/richestpeople/delete/$value->id'>delete<a></td>
                </tr>";
    }


    $data = [
      'title' => '<h1>Landenoverzicht</h1>',
      'countries' => $rows
    ];
    $this->view('countries/index', $data);
  }

  public function update($id = null){
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $this->countryModel->updateCountry($_POST);
      header("Location: " . URLROOT . "/countries/index");  
    } else {
      $row = $this->countryModel->getSingleCountry($id);
      $data = [
      'title' => '<h1>Update LandenOverzicht</h1>',
      'row' => $row
    ];
    $this->view("countries/update", $data);
    }
   
  }

  public function delete($id){

    $this->countryModel->deleteCountry($id);

    $data =[
      'deleteStatus' => "Het record meet id = $id is verwijdert"
    ];
    $this->view("countries/delete", $data);
    header("Refresh:2; url=" . URLROOT . "/countries/index");
  }

  public function create(){
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      try{
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      $this->countryModel->createCountry($_POST);

      header("Location:" . URLROOT . "countries/index");
    } catch(PDOException $e){
      echo "Het inserten van het record is niet gelukt";
      header("Refresh:3; url=" . URLROOT . "/countries/index");
    }

    } else {
      $data = [
        'title' => "Voeg een nieuw land in"
      ];
      $this->view("countries/create", $data);
    }
  }
}

?>