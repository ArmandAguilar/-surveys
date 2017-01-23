<?php
/**
 * Autor : Armando Aguilar  L.
 *Description : Class for ask the task of each rpoyect
 */
class CProyectos extends poolConnecion
{

  function apply_surveys($info)
  {
    $idEncuestado = $info->idEncuestado;
    $idEncuetador = $info->idEncuetador;
    $idEncuesta = $info->idEncuesta;
    $idTarea = $info->idTarea;
    /*get the number of questions */
    $NumAsk = 0;
    $obj = new poolConnecion();
    $Sql="SELECT [Id],[IdEncuesta],[Pregunta] FROM [SAP].[dbo].[AAPreguntas] WHERE [IdEncuesta] = '$idEncuesta'";
    $con=$obj->ConexionSQLSAP();
    $RSet=$obj->QuerySQLSAP($SqlID,$con);
     while($fila=sqlsrv_fetch_array($RSet,SQLSRV_FETCH_ASSOC))
           {
              $NumAsk++;
              $ArrayID = $fila[Id];
           }
    $obj->CerrarSQLNorthwind($RSet,$con);
    /*insert in teh table the surveys*/
    foreach ($ArrayID as $key => $value) {
      if (!empty($value))
      {
        $sql = "INSERT INTO [SAP].[dbo].[AA_Encuestado] VALUES ('$idEncuestado','$idEncuetador','$idTarea','$value','0')";
        $con=$obj->ConexionSQLSAP();
        $RSet=$obj->QuerySQLSAP($sql,$con);
         while($fila=sqlsrv_fetch_array($RSet,SQLSRV_FETCH_ASSOC))
               {
                  $NumAsk++;
                  $ArrayID = $fila[Id];
               }
        $obj->CerrarSQLNorthwind($RSet,$con);
      }
    }

  }

}

?>
