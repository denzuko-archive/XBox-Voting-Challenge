<?php
require_once 'XboxVoting/soap.php';

class IndexController extends Zend_Controller_Action
{
   protected $voter; // XboxVoting instance

    public function init()
    {
      $this->voter = new XboxVoting();
    }

    public function indexAction()
    {
      $this->games = $this->voter->getGames();
      $this->render();
    }
}

