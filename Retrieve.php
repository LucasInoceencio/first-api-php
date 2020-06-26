<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-type: application/json");
  
  if($_SERVER['REQUEST_METHOD'] == 'GET') {
    include '../Connection.php';
    $sql = "SELECT id_enterprise, company_name, trading_name, cnpj, opening_date FROM enterprise";
    $result = mysqli_query($connection, $sql);

    while($dado = mysqli_fetch_assoc($result)) {
      $dados[] = $dado;
    }
    echo json_encode($dados);

  } else {
    $return["Mensagem"] = "Utilize o método GET";
    echo json_encode($return);
  }

?>