<?php

  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: PUT");
  header("Access-Control-Allow-Headers: Content-Type");
  header("Content-type: application/json");
  

  if($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $dados = json_decode(file_get_contents("php://input"), true);

    if($dados != null) {
      $idEnterprise = $dados['id_enterprise'];
      $companyName = $dados['company_name'];
      $trandingName = $dados['trading_name'];
      $cnpj = $dados['cnpj'];
      $openingDate = $dados['opening_date'];

      if ($companyName == "") {
        $message = "Digite a Razão Social da empresa!";
      } else if ($trandingName == "") {
        $message = "Digite o Nome Fantasia da empresa!";
      } else if ($cnpj == "") {
        $message = "Digite o CNPJ da empresa!";
      } else if ($openingDate == "") {
        $message = "Digite da Data de Abertura da empresa!";
      } else {
        include "../Connection.php";
        $sql = "UPDATE enterprise SET company_name = '$companyName', trading_name = '$trandingName', cnpj = '$cnpj', opening_date='$openingDate' WHERE id_enterprise='$idEnterprise'";
        $result = mysqli_query($connection, $sql) or die (mysqli_error($connection));
        if ($result) {
          $message = "Empresa alterada com sucesso!";
        }
      }
    } else {
      $message = "Informe uma empresa!";
    }
  } else {
    $message = "Utilze o método PUT";
  }

  $return["Message"] = $message;
  echo json_encode($return);

?>