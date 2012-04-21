<?
// vim:set nu ft=php ts=3 tw=79 ai si sts=3 et sw=2:
/**
 * XBox Voting Application
 * @version 1.0.0
 * A Code Challenge for Nerdery.com - PHP Backend, Revision 4.0
 * Tracks interest in new games for the Xbox360 Console.
 * 
 * @author Dwight Spencer (Denzuko) <denzuko.co.cc>
 * @copyright Copyrighted (C)2012 Dwight Spencer.
 * All Rights Reserved.
 *
 * Redistribution and use in source and binary forms, with or without 
 * modification, are permitted provided that the following conditions are met:
 *
 *  Redistributions of source code must retain the above copyright notice, 
 *  this list of conditions and the following disclaimer.
 *  Redistributions in binary form must reproduce the above copyright notice,
 *  this list of conditions and the following disclaimer in the documentation
 *  and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" 
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE 
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE 
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE 
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR 
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF 
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS 
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN 
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) 
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE 
 * POSSIBILITY OF SUCH DAMAGE.
 *
 */

set_include_path(get_include_path().PATH_SEPARATOR.'../library');
set_include_path(get_include_path().PATH_SEPARATOR.'./library');
require_once 'PHPUnit/Autoload.php';
require_once 'XboxVoting/soap.php';

/**
 * The main library unit test
 * @package XboxVoting
 * @author Dwight Spencer
 */
class XboxVotingTest extends PHPUnit_Framework_TestCase
{
  /**
   * Contains the XboxVoting instance
   * @var XboxVoting objInst
   */
  private $objInst;
  protected $games;

  protected function setUp()
  {
    $this->objInst = new XboxVoting;
    $this->games = $this->objInst->getGames();
  }

  protected function tearDown()
  {
    // We're testing environment so we Clean Up the list of 
    // games.
    $this->objInst->clearGames();
  }

  /**
   * Helper Method for unit testing
   */
  protected function report($error)
  {
     print "Error: ".$error->getMessage();
  }

  /**
   * User Key Authorization
   * @test
   */
  public function ValidateUserKey()
  {
     // Validate Provided User Key
     try {
        $this->assertTrue($this->objInst->validKey());
        $this->objInst = new XboxVoting('deadbeaf');
        $this->assertFalse($this->objInst->validKey());
     } catch (Exception $error) {
        $this->report($error);
     }
  }

  /**
   * Add New Game
   * @test
   */
  public function AddGameTitleToList()
  {
		try {
			// Add new game title
			$this->objInst->newGame('Prototype');	
			$games = $this->objInst->getGames();
			$this->assertTrue(count($games) === 1);

			// Add additional title
			$this->objInst->newGame('Fable');
			$games = $this->objInst->getGames();
			$this->assertTrue(count($games) >= 1);
			$this->assertTrue($games[count($games)]->title == "Fable");

			// Cannot add a repeat title
			$this->objInst->newGame('Fable');
			$games = $this->objInst->getGames();
			$this->assertFalse(count($games) >= 2);

			// Restricted to once per day
			// Prohibited on Saturday and Sunday
			// Cannot add if we voted for a title
		} catch (Exception $error) {
         $this->report($error);
		}
	}
	
  /**
   * Display Games
   * @author Dwight Spencer (denzuko) <dspencer@denzuko.co.cc>
   */
  public function testGetListOfGames()
  {
		try {
			// Check to see if we have an empty return
			$this->assertFalse(empty($games));
			// Check to see if we get an array back
			$this->assertTrue(is_array($games));
			// Check the size of the array is more than 0
			$this->assertTrue(sizeof($games) > 0);
		} catch (Exception $error) {
         $this->report($error);
		}
  }

  /**
   * Set Got It
   * @author Dwight Spencer (denzuko) <dspencer@denzuko.co.cc>
   * @test
   */
  public function shouldBeAbleToMarkTitleAsOwned()
  {
    try {
      foreach($this->games as $game)
        $this->assertTrue(
          $this->objInst->ownTitle($game->id)); // Mark title as owned
    } catch(Exection $error) {
      $this->report($error);
    }
  }

  /**
   * Add Vote
   * @author Dwight Spencer (denzuko) <dspencer@denzuko.co.cc>
   * @test
   */
  public function addOneVotePerDay()
  {
    // Add One vote to a game
    // Restricted to once per day
    // Prohibited on Saturday and Sunday
    $this->markTestIncomplete('This test has not been implemented yet.');
  }
}

$suite = new PHPUnit_Framework_TestSuite('XboxVotingTest');
PHPUnit_TextUI_TestRunner::run($suite);
