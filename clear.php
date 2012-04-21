<?php
require_once 'library/XboxVoting/soap.php';

$voter = new XboxVoting();

$games = $voter->getGames();

foreach($games as $game)
  print $game->title." ".$game->id."\n";

$voter->clearGames();
