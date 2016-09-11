<?php
  /**
   * função que devolve em formato JSON os dados do cliente
   */
  function retorna( $nome, $db )
  {
      
    $sql = "SELECT `id`, `register`, `name`, `cpf`, `cellphone`,`city`
      FROM `customer` WHERE `cpf` = '{$nome}' ";

    $query = $db->query( $sql );

    $arr = Array();
    if( $query->num_rows )
    {
      while( $dados = $query->fetch_object() )
      {
        $arr['id'] = $dados->id;
        $arr['register'] = $dados->register;
        $arr['name'] = $dados->name;
        $arr['cellphone'] = $dados->cellphone;
        $arr['city'] = $dados->city;
      }
    }
    else
      $arr['name'] = 'não encontrado';

    return json_encode( $arr );
  }

/* só se for enviado o parâmetro, que devolve os dados */
if( isset($_GET['cpf']) )
{
  
  $db = new mysqli('10.0.0.2', 'root', '202369','gymcontrol');
   echo retorna( filter ( $_GET['cpf'] ), $db );
  
}

function filter( $var ){
  return $var;//a implementação desta, fica a cargo do leitor
}
