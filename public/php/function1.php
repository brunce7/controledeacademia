<?php

/**
 * função que devolve em formato JSON os dados do cliente
 */

function retorna($customer,$name,$db) {
    
    $sql =  "SELECT * FROM customer WHERE customer.id ='{$customer}' OR customer.name LIKE '%{$name}%'";
  
    $query = $db->query($sql);

    $arr = Array();

    if ($query->num_rows) {
        while ($dados = $query->fetch_object()) {

            $arr['customer'] = $dados->id;
            $arr['name'] = $dados->name;
            $arr['date']=  date('d/m/Y');
            $mes = date('m/Y');
            $arr['description']= "Mensalidade ref. à $mes";
            $valor = $dados->monthly_payment;
            $valorNumero = str_replace(".",",",$valor);
            $arr['value']= $valorNumero;
            
       
           
            
           
        }
    } else {
       
           
            $arr['name'] = "Aluno não encontrado!";
            $arr['date']=  "";
            $arr['description']= " ";
            $arr['value']= "";
            
      
       
    }



    return json_encode($arr);
}

/* só se for enviado o parâmetro, que devolve os dados */
if  (isset($_GET['customer']) && (isset($_GET['name']))) {
    if ($_GET['name'] == NULL) {
        
        $name = 'NULL';
        
    }


    $db = new mysqli('10.0.0.2', 'root', '202369', 'gymcontrol');
    echo retorna(filter($_GET['customer']),filter($name), $db);
}


 

function filter($var) {
    return $var; //a implementação desta, fica a cargo do leitor
}
