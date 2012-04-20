<?php
// vim:set fenc=utf-8 nu fdm=indent fdn=1 ft=php ts=3 tw=79 ai si sts=3 et sw=2:
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
 * Syntax Sugar for the application Soap api
 * @package XboxVoting
 * @author Dwight Spencer
 */
class XboxVoting {
   private $client;
   public  $api;
   
   function __construct()
   {
      $this->api = array(
         'version' => "v2",
         'host'    => "xbox.sierrabravo.net",
         'service' => 'xbox',
         'key'     => "a5b67a25f070fab4688a9069f39cf542");

      $this->client = new SoapClient($this->url().".wsdl");
  }

  /**
   * Builds a url of the service api
   * @return string
   */
   public function url()
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
   protected function games()
   {
      try {
         if ($this->validKey()) {
            $this->$client->getGames($this->api['key']);
         } else {
            throw new Exception("Not authorized or invalid user key");
         }
      } catch(SoapFault $e) {
         throw new Exception("Could not connect to service: ".$e->getMessage());
      }
  }
}
?>
