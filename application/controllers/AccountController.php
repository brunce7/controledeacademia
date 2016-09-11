<?php

class AccountController extends Zend_Controller_Action {

    /**
     * @var Zend_Log
     */
    private $logger;

    public function init() {
        $messages = $this->_helper->flashMessenger->getMessages();
        if (!empty($messages)) {
            $this->_helper->layout->getView()->message = $messages[0];
        }





// $this->logger = Zend_Registry::get('logger');
    }

    public function indexAction() {
        //  $this->_helper->viewRenderer->setNoRender();
    }

    public function loginAction() {
      //  $carreg = "/img/carreg2.gif";
       // $loading = "<img src='$carreg' width='30' height='30'>";
        //Desabilita renderização da view
        // $this->_helper->viewRenderer->setNoRender();
        //Obter o objeto do adaptador para autenticar usando banco de dados
        $dbAdapter = Zend_Db_Table_Abstract::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
        //Seta qual tabela e colunas procurar o usuário
        $authAdapter->setTableName('usuario')
                ->setIdentityColumn('login')
                ->setCredentialColumn('senha');
        //Seta as credenciais com dados vindos do formulário de login
        $authAdapter->setIdentity($this->_getParam('login'))
                ->setCredential($this->_getParam('senha'))
                ->setCredentialTreatment('MD5(?)');
        //Realiza autenticação
        $result = $authAdapter->authenticate();
        //Verifica se a autenticação foi válida
        if ($result->isValid()) {
            //Obtém dados do usuário
            $usuario = $authAdapter->getResultRowObject();
            //Armazena seus dados na sessão
            $storage = Zend_Auth::getInstance()->getStorage();
            $storage->write($usuario);

            $identity = Zend_Auth::getInstance()->getIdentity();
            //  $this->view->identity = $identity->login;

            $username = $this->_getParam('login');
            /* include do Zend Session */
            // require_once ('Zend/Session/Namespace.php');

            /* obtendo o namespace padrao */
            // $session = new Zend_Session_Namespace();

            /* inserir dados na sessao */
            //  if (!isset($session->username)) {
            //       $session->username = $storage['login'];
            //  }
            //Redireciona para o Index

            $sauda = "<font size='4'>Parabéns!</font>";


          //  $this->_helper->flashMessenger('<td align="center" class="alert-success"><p><font size="6" color="darkgreen"><i class="icon-unlock"></i></font>' . $sauda . '<br>Login efetuado com sucesso!</p>' . $loading . '</td>');
            $this->_redirect('account');
        } else {

            $sauda = "<font size='4'>Sinto Muito!</font>";
          //  $carreg = "/img/carreg4.gif";
          //  $loading = "<img src='$carreg' width='30' height='30'>";

            $this->_helper->flashMessenger('<td align="center" class ="alert-danger"><p><font size="6" color="darkred" class="icon-lock"></i></font>&nbsp;&nbsp;&nbsp;' . $sauda . '<br>Usuário ou senha incorretos!<br>Tente novamente.</p></td>');
            $this->_redirect('account');
        }
    }

    public function logoutAction() {
        //Limpa dados da Sessão
        $identity = Zend_Auth::getInstance()->getIdentity();
        Zend_Auth::getInstance()->clearIdentity();
        //Redireciona a requisição para a tela de Autenticacao novamente
        
        $this->_helper->flashMessenger('<td align="center" class ="alert-block"><p><font size="6" color="black"><i class="icon-info-sign"></i></font>&nbsp;&nbsp;&nbsp; Usuário ' . $identity->login . ' saiu do Sistema<p></td>');
        $this->_redirect('account');
    }

}
