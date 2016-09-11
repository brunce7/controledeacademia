<?php

class PaymentController extends Zend_Controller_Action {

    /**
     * @var Zend_Log
     */
    private $logger = null;

    public function init() {

        //$this->logger = Zend_Registry::get('logger');
        $messages = $this->_helper->flashMessenger->getMessages();
        if (!empty($messages)) {
            $this->_helper->layout->getView()->message = $messages[0];
        }
        if (!Zend_Auth::getInstance()->hasIdentity()) {


            $this->_redirect('account');
        } else {

            $identity = Zend_Auth::getInstance()->getIdentity();
            $this->view->identity = $identity->login;
        }
    }

    public function indexAction() {
        //  $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/forms/search-customer.ini', 'form');
        //  $this->view->form = new Application_Form_SearchCustomer($config);
    }

    public function listarAction() {





        $dbTable = new Application_Model_DbTable_Payment();

        $lista = $dbTable->listar();
        if (count($lista)) {

            $resp = "Sucesso!";
            $alerta = "text-success";
            $this->view->alerta = $alerta;
            $this->view->resp = $resp;
            $this->view->listaAlunos = $lista;
            //   $form->setAction('/default/payment/buscar/');
            //  $this->view->form = $form;
        } else {

            $resp = "Não existem Alunos cadastrados!";
            $alerta = "alert-danger";
            $this->view->resp = $resp;
            $this->view->alerta = $alerta;

            //  $form->setAction('/default/peyment/buscar/');
            // $this->view->form = $form;
        }
    }

    public function editAction() {
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/forms/search-payment.ini', 'form');
        $form = new Application_Form_Payment($config);

        $dbPayment = new Application_Model_DbTable_Payment();
        $dbCustomer = new Application_Model_DbTable_Customer();

        $form->addElement('button','Pesquisar');
        $form->addElement('button','Limpar');
        $form->addDisplayGroup(array('id', 'customer','description', 'Pesquisar'), 'cadastro9');
        $create9 = $form->getDisplayGroup('cadastro9');
        $create9->setDecorators(array(
            'FormElements',
            'Fieldset',
            array('HtmlTag', array('tag' => 'div', 'style' => 'clear:left;float:left;;padding-left:60px;'))
        ));
        $form->getElement('Pesquisar')->setAttrib("class", "btn btn-info icon-search");
        $form->getElement('Limpar')->setAttrib("class", "btn btn-info");
        $form->getElement('Pesquisar')->setAttrib("id", "Pesquisar");
        $form->addElement('submit', 'Atualizar');
        $form->getElement('Atualizar')->setAttrib("id", "Atualizar");
        $form->getElement('Limpar')->setAttrib("id", "Limpar");
        $form->getElement('id')->setAttrib('required', 'required'); 
        $form->getElement('customer')->setAttrib('required', 'required');
        $form->getElement('name')->setAttrib('required', 'required');
        $form->getElement('value')->setAttrib('required', 'required');
        $form->getElement('description')->setAttrib('required', 'required');
        $form->getElement('description')->setAttrib('placeholder', 'mes/ano xx/xxxx da Mensalidade');
        $form->getElement('id')->setAttrib('title', 'Busca pelo Nº do Pagamento');
        $form->getElement('customer')->setAttrib('title', 'Busca pela Matricula do Aluno');
        $form->getElement('customer')->setAttrib("class", "input-small");
        $form->getElement('description')->setAttrib('title', 'Usar em conjunto com o filtro Matrícula');
        $form->getElement('description')->setAttrib('class', 'input-large search-query');
        $form->getElement('id')->setAttrib('class', 'input-small search-query');
        $form->getElement('customer')->setAttrib('class', 'input-small search-query');
        $form->getElement('customer')->setAttrib('placeholder', 'buscar');
        $form->getElement('id')->setAttrib('placeholder', 'buscar');
        $form->getElement('open')->setAttrib("class", "input-small");
        



        $form->addDisplayGroup(array('open','name', 'date', 'value'), 'cadastro10');
        $create10 = $form->getDisplayGroup('cadastro10');
        $create10->setDecorators(array(
            'FormElements',
            'Fieldset',
            array('HtmlTag', array('tag' => 'div', 'style' => 'float:left;padding-left:60px;padding-right:60px;'))
        ));

        $form->addDisplayGroup(array('Limpar'), 'cadastro11');
        $create11 = $form->getDisplayGroup('cadastro11');
        $create11->setDecorators(array(
            'FormElements',
            'Fieldset',
            array('HtmlTag', array('tag' => 'div', 'style' => 'clear:left;float:right;padding-right:60px;padding-bottom:10px;'))
        ));

        $form->addDisplayGroup(array('Atualizar'), 'cadastro12');
        $create12 = $form->getDisplayGroup('cadastro12');
        $create12->setDecorators(array(
            'FormElements',
            'Fieldset',
            array('HtmlTag', array('tag' => 'div', 'style' => 'float:right;padding-bottom:10px;'))
        ));


        $form->getElement('Atualizar')->setAttrib("class", "btn btn-success");
        // $form->getElement('Adicionar')->setAttrib("onClick", "document.payment.submit();");



        $findcustomer = $dbPayment->find($this->_getParam('id'));



        $row = $findcustomer->current();


        $customer = $row['customer'];
        $idcustomer = $dbCustomer->find($customer);
        $row1 = $idcustomer->current();
        $row['date'] = date('d/m/Y H:i:s', strtotime($row['date']));
        $row['value'] = number_format($row['value'], 2, ',', '.');
        $form->populate($row1->toArray());
        $form->populate($row->toArray());




        //$form->getElement('name')->setRequired(true);
        // $form->getElement('cpf')->addValidator('alnum');




        $this->view->form = $form;

        $dadosFormulario = $this->getRequest()->getPost();
        if ($this->getRequest()->isPost()) {

            if ($form->isValid($dadosFormulario)) {
                $values = $form->getValues();




                $id = $values['id'];
                $name = $values['name'];
                // $form->getElement('id')->setAttrib('value', $id );

                $open = $values['open'];
                $customer = $values['customer'];

                $date = $values['date'];
                $description = $values['description'];


                $value = $values['value'];
                $valor = str_replace(".", "", $value);
                $value = str_replace(",", ".", $valor);
                $data = array(
                    'open' => $open,
                    'customer' => $customer,
                    'description' => $description,
                    'value' => $value,
                );


                $dbPayment = new Application_Model_DbTable_Payment();
                if ($dbPayment->editPayment($data, $id)) {






                    // $this->view->last_id = $last_id;
                    // $this->view->resp = "Nome:  " . $name . ", enviado com sucesso!";
                    //   $form->populate($formData);
                    $this->view->titulo = "Sucesso!";
                    $this->view->form = $form;

                    $this->view->resp = "O Pagamento do Aluno(a): " . $name . ", foi atualizado com sucesso!";
                    $resp1 = $this->view->layout()->scriptTags = '<script>
                        $(function(){
                           $("#dialog").dialog({
                              modal: open
                           });
                        });</script>';
                    $alerta = "alert-success";
                    $this->view->alerta = $alerta;
                    $this->view->resp1 = $resp1;

                    $this->view->form = $form;
                } else {
                    // $this->view->resp = "Nome:  " . $name . ", nao foi gravado!";
                    // $form->populate($values);
                    $this->view->titulo = "Sinto Muito!";

                    $this->view->resp = "O Pagamento do Aluno(a): " . $name . ", não pode ser atualizado.<br>" . "1° voce deve alterar um dado!";
                    $resp1 = $this->view->layout()->scriptTags = '<script>
                        $(function(){
                           $("#dialog").dialog({
                              modal: open
                           });
                        });</script>';
                    $alerta = "alert-danger";
                    $this->view->alerta = $alerta;
                    $this->view->resp1 = $resp1;
                    $form->populate($dadosFormulario);
                    $this->view->form = $form;
                }
            }
        } else {

            $form->populate($dadosFormulario);
            $this->view->form = $form;
        }
    }

}
