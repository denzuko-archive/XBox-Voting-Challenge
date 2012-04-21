<?php
require_once 'XboxVoting/soap.php';

class IndexController extends Zend_Controller_Action
{
   protected $voter; // XboxVoting instance
   protected $games; // Games object

    public function init()
    {
      $this->voter = new XboxVoting();
      $this->games = $this->voter->getGames();
    }

    public function indexAction()
    {
      $this->view->games = $this->games;
      $this->render();
    }
}

