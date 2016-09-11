<?php

/**
 * função que devolve em formato JSON os dados do cliente
 */
function retorna($id,$db) {

    $sql = "SELECT payment.open, payment.id, payment.customer, customer.name, payment.date, payment.value, payment.description FROM payment INNER JOIN customer ON customer.id =payment.customer WHERE payment.id = '{$id}'";


    $query = $db->query($sql);

    $arr = Array();

    if ($query->num_rows) {
        while ($dados = $query->fetch_Object()) {
            
            $arr['id'] = $dados->id;
            $arr['open'] = $dados->open;
            $arr['customer'] = $dados->customer;
            $arr['name'] = $dados->name;
            $arr['date']=  date('d/m/Y H:i:s', strtotime($dados->date)); 
            $arr['description']= $dados->description;
            $valor = $dados->value;
            $valorNumero = str_replace(".",",",$valor);
            $arr['value']= $valorNumero;
            
       
           
            
           
        }
    } else {
       
            
            $arr['name'] = "Aluno não encontrado!";
            $arr['open']= " ";
            $arr['date']=  " ";
            $arr['description']= " ";
            $arr['value']= " ";
            
      
       
    }



    return json_encode($arr);
}

/* só se for enviado o parâmetro, que devolve os dados */
if (isset($_GET['id'])) {

    $db = new mysqli('10.0.0.2', 'root', '202369', 'gymcontrol');
    echo retorna(filter($_GET['id']), $db);
}



function filter($var) {
    return $var; //a implementação desta, fica a cargo do leitor
}
