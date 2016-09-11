<?php

/**
 * função que devolve em formato JSON os dados do cliente
 */
function retorna($nome, $db) {

    $sql = "SELECT * FROM `customer` WHERE `cpf` = '{$nome}' or `name` = '{$nome}' ";

    $query = $db->query($sql);

    $arr = Array();

    if ($query->num_rows) {
        while ($dados = $query->fetch_object()) {

            $arr['id'] = $dados->id;
            $register1 = $dados->register;
            $register = date('d/m/Y H:i:s', strtotime($register1)); 
            $arr['register'] =  $register;
            $arr['cpf'] = $dados->cpf;
            $arr['name'] = $dados->name;
            $arr['street'] = $dados->street;
            $arr['house_number'] = $dados->house_number;
            $arr['neighborhood'] = $dados->neighborhood;
            $arr['city'] = $dados->city;
            $arr['email'] = $dados->email;
            $arr['gender'] = $dados->gender;
            $arr['cep'] = $dados->cep;
            $arr['phone'] = $dados->phone;
            $arr['cellphone'] = $dados->cellphone;
            $arr['status'] = $dados->status;
            $arr['maturity'] = $dados->maturity;
            $birthday = $dados->birthday;
            $birthday = date('d/m/Y', strtotime($birthday)); 
            $arr['birthday'] =  $birthday;
            $valor = $dados->monthly_payment;
            $valorNumero = str_replace(".",",",$valor);
            $arr['monthly_payment']= $valorNumero;
       
           
            
            $arr['notes'] = $dados->notes;
        }
    } else {
        if (isset($_GET['cpf'])) {
           
            $arr['id'] = 'CPF não cadastrado!';
            $arr['register'] = 'CPF não cadastrado!';
        }
        if (isset($_GET['name'])) {
            
            $arr['id'] = 'Aluno não cadastrado!';
             $arr['register'] = 'Aluno não cadastrado!';
         
        }
    }



    return json_encode($arr);
}

/* só se for enviado o parâmetro, que devolve os dados */
if (isset($_GET['cpf'])) {

    $db = new mysqli('10.0.0.2', 'root', '202369', 'gymcontrol');
    echo retorna(filter($_GET['cpf']), $db);
}


if (isset($_GET['name'])) {

    $db = new mysqli('10.0.0.2', 'root', '202369', 'gymcontrol');
    echo retorna(filter($_GET['name']), $db);
}

function filter($var) {
    return $var; //a implementação desta, fica a cargo do leitor
}
