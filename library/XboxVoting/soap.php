<?php
// vim:set fenc=utf-8 nu ft=php ts=3 tw=79 ai si sts=3 et sw=2:
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


/**
 * Syntax Sugar for the XBox Game Voting App Api
 * @package XboxVoting
 * @author Dwight Spencer
 */
class XboxVoting {
   private $api;
   private $client;
   public  $games; // Store returned game list from the server
   
   function __construct($key="a5b67a25f070fab4688a9069f39cf542")
   {
      $this->api = array(
         'version' => "v2",
         'host'    => "xbox.sierrabravo.net",
         'service' => 'xbox',
         'key'     => $key);

      $this->client = new SoapClient($this->url().".wsdl");
      $this->games  = $this->getGames();
  }

  /**
   * Builds a url of the service api
   * @return string
   */
   protected function url()
   {
      return "http://".$this->api['host']."/".$this->api['version']."/".$this->api['service'];
   }

  /**
   * Verifies if the provided User Key is authorized or not
   * @return TRUE or FALSE if key is valid
   */
   public function validKey()
   {
      try {
         return $this->client->checkKey($this->api['key']);
      } catch(SoapFault $error) {
         print("Could not connect to service: ".$error->getMessage());
         throw Exection;
      }
  }

  /**
   * Get an array of games listed
   * @return array
   */
   public function getGames()
   {
     try {
		if ($this->validKey()) {
			$games = $this->client->getGames($this->api['key']);
		} else {
			throw new Exception("Not authorized or invalid user key");
		}
     } catch(SoapFault $e) {
      throw new Exception("Could not connect to service: ".$e->getMessage());
     }
	return $games;
  }

  /**
   * Prints each game
   * @returns 
   */
   public function displayGames()
   {
      $games = $this->games();
      if ($games != NULL) {
        foreach ($games as &$game) { print game.'\n'; }
      } else {
        print "No games found.\n";
      }
   }

  /**
   * Add New Game
   * @param string $title
   * @return bool
   */
   public function newGame($title)
   {
      if($this->validKey())
        return $this->client->addGame($this->api['key'], "Prototype");
   }

  /**
   * Clear games
   * @returns bool
   */
  public function clearGames()
  {
    try {
      if($this->validKey()) {
        foreach($this->games as $game) {
          $this->client->clearGames($game->id);
        }
      }
    } catch(SoapFault $e) {
      throw new Exception("Could not clear games: ".$e->getMessage());
    } catch(Exception $e) {
      return false;
    }
    return true;
  }

  /**
   * Marks a title as owned
   * @param integer $id
   * @returns bool
   */
   public function ownTitle($id)
   {
      // Marks a game title as owned
      if($this->validKey())
         return $this->client->setGotIt($this->api['key'], $id);
      return true;
   }

  /**
   * Restricts to once per day
   * @returns bool
   */
   protected function oncePerDay()
   {
      $now   = getdate();
      $today = $now['wday'];
      return (($today >= 0) || ($today <= 6)) ? true: false;
   }
}
