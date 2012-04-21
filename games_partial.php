<?
// Controller code
require_once 'library/XboxVoting/soap.php';

$voter = new XboxVoting();
$games = $voter->getGames();
?>
<h2>Games</h2>
<ul class="Games">
   <? foreach($games as $game) { ?>
   <li>
     <span class="gameTitle"><?php echo($game->title); ?></span>
     <span class="gameVotes">Voted on: <? echo($game->votes); ?></span>
     <span class="gameOwned"><? echo($game->status); ?></span>
     <span class="gameTime"><? echo($game->votetime); ?></span>
   </li>
   <? } ?>
</ul>
