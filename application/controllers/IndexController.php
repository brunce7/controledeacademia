<?php



class IndexController extends Zend_Controller_Action
{

    public function init()
    {
    if(!Zend_Auth::getInstance()->hasIdentity()){
            
       
            $this->_redirect('account');
        }else {
            
            $identity = Zend_Auth::getInstance()->getIdentity();
             $this->view->identity = $identity->login;
             $this->_redirect('/default/customer/buscar');
        }
    }

    public function indexAction()
    {
      if(!Zend_Auth::getInstance()->hasIdentity()){
            
       
            $this->_redirect('account');
        }else {
            
            $identity = Zend_Auth::getInstance()->getIdentity();
             $this->view->identity = $identity->login;
             $this->_redirect('/default/customer/buscar');
        }
   //    $this->logger->log('Mensagem de debug', Zend_Log::DEBUG);
    //   $this->logger->log(array('para1' => 'value'), Zend_Log::DEBUG);
    }

    public function paymentAction()
    {
        // action body
    }


}



