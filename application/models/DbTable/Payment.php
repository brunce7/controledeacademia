<?php

class Application_Model_DbTable_Payment extends Zend_Db_Table_Abstract  {

    protected $_name = 'payment';
  //  protected $_dependentTables = array('customer');
  
  
  //  protected $_referenceMap = array(
   //    "fk_customer" => array(
       //     'columns' => 'id',
        //    'refTableClass' => 'Application_Model_DbTable_Customer',
       //     'refColumns' => 'id',
   //     )
  //  );

    public function gravaPayment($data) {

        return $this->insert($data);
    }



    
    
 //  SELECT `produtos`.* FROM `produtos`
 // INNER JOIN `categorias` ON `produtos`.`categoria_id` = `categorias`.`id`
//ORDER BY `produtos`.`nome` ASC

    
 /*            
  $consulta = $this->select()

        ->from(array('payment'))
        ->joinInner(array('customer'))
        ->order('date asc')
        ->setIntegrityCheck(false); // ADD This Line

        return $this->fetchAll($consulta)->toArray();
       
    
*/



    
  
    public function listar() {
        $consulta = $this->select()

        ->from(array('payment'),array('id AS aluno','customer','date','value','description','open'))
        ->joinInner(array('customer'),'customer.id=payment.customer',array('name','cellphone'))
        ->where("customer.status='ativo'")
        //->where("payment.open='yes'")
        ->order('aluno asc')
        ->setIntegrityCheck(false); // ADD This Line

        return $this->fetchAll($consulta)->toArray();
        
    }
    
       public function editPayment($data, $id) {

        return $this->update($data, 'id=' . $id . '');
    }


    
    
}