<?php

  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: Content-Type");
  header("Content-type: application/json");

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dados = json_decode(file_get_contents("php://input"), true);

    if ($dados != null) {
      $companyName = $dados['company_name'];
      $tradingName = $dados['trading_name'];
      $cnpj = $dados['cnpj'];
      $openingDate = $dados['opening_date'];

      if ($companyName == "") {
        $message = "Digite a Razão Social da empresa!";
      } else if ($tradingName == "") {
        $message = "Digite o Nome Fantasia da empresa!";
      } else if ($cnpj == "") {
        $message = "Digite o CNPJ da empresa!";
      } else if ($openingDate == "") {
        $message = "Digite da Data de Abertura da empresa!";
      } else {
        include "../Connection.php";

        $sql = "INSERT INTO enterprise (company_name, trading_name, cnpj, opening_date) VALUES ('$companyName', '$tradingName', '$cnpj', '$openingDate')";
        $result = mysqli_query($connection, $sql) or die (mysqli_error($connection));
        if ($result) {
          $message = "Empresa cadastrada com sucesso!";
        }
      }
    }
  } else {
    $message = "Utilize o método POST";
  }
  $return["Message"] = $message;
  echo json_encode($return);

?>