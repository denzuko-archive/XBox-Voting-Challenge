<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
   protected function _initView()
   {
      //Initialize view
      $view = new Zend_View();
      $view->doctype('HTML5');
      $view->headTitle('Denzuko - Xbox Voting Application Challenge');
      $viewRenderer = 
         Zend_Controller_Action_HelperBroker::getStaticHelper(
            'ViewRenderer');
      $viewRenderer->setView($view);

      return $view;
   }
}

