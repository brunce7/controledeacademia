<?php

class Application_Model_DbTable_Customer extends Zend_Db_Table_Abstract {

    protected $_name = 'customer';
    
  

    public function gravar($data) {
        return $this->insert($data);
    }

    public function editar($data, $id) {



        return $this->update($data, 'id=' . $id . '');
    }

    public function listar() {
        $select = $this->select()
                ->order("id asc");
        return $this->fetchall($select)->toArray();
    }

    public function buscar($id, $name, $option1, $option2, $option3) {
        if (!$id) {
            $id= 'NULL';
        }
       
        if (!$name) {
            $name = 'NULL';
        }

        if ($option1) {

            $opt1 = "customer.status='ativo'";
        }

        if (!$option1) {

            $opt1 = "customer.status='NULL'";
        }
        if ($option2) {

            $opt2 = "customer.status='inativo'";
        }
        if (!$option2) {

            $opt2 = "customer.status='NULL'";
        }

        if ($option3) {
            $opt3 = "payment.open = 'yes'";
        }

        if (!$option3) {

            $opt3 = "payment.open = 'NULL'";
        }



       // echo $id;
       // echo "<br>";
       // echo $name;
      //  echo "<br>";
      //  echo $opt1;
      //  echo "<br>";
      //  echo $opt2;
      //  echo "<br>";
     //   echo $opt3;

        $select = $this->select()
                ->from(array('customer'),array('id AS aluno','name','phone','cellphone','monthly_payment','status'))
              
                ->joinInner(array('payment'),'customer.id=payment.customer',array('open','description'))
                
                ->Where('customer.id=?', $id)
                
                ->orWhere("customer.name LIKE '%$name%'")
                ->orWhere($opt1)
                ->orWhere($opt2)
                ->orWhere($opt3)
                ->group('customer.id')
             
                ->setIntegrityCheck(false); // ADD This Line

        
        
        
        
        return $this->fetchAll($select)->toArray();
    }

    public function deletar($id) {

        return $this->delete('id='. $id .'');
    }
    
      public function searchPayment($id) {
        if (!$id) {
            $id= 'NULL';
        }   
        $select = $this->select()
                ->Where('id=?', $id);
                

        return $this->fetchAll($select)->toArray();    
        
    }
      


}
