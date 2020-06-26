<?php

  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: DELETE");
  header("Access-Control-Allow-Headers: Content-Type");
  header("Content-type: application/json");

  if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $dados = json_decode(file_get_contents("php://input"), true);
    if($dados != null) {
      $idEnterprise = $dados['idEnterprise'];

      include '../Connection.php';
      $sql = "DELETE FROM enterprise WHERE id_enterprise='$idEnterprise'";
      $result = mysqli_query($connection, $sql) or die (mysqli_error($sql));

      if($result) {
        $message = "Empresa excluída com sucesso!";
      }
    } else {
      $message = "Informe uma empresa!";
    }
  } else {
    $message = "Utilize o método DELETE!";
  }

  $return["Message"] = $message;
  echo json_encode($return);

?>