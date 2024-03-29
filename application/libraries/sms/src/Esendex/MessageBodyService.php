<?php
/**
 * Copyright (c) 2013, Esendex Ltd.
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of Esendex nor the
 *       names of its contributors may be used to endorse or promote products
 *       derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL <COPYRIGHT HOLDER> BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @category   Service
 * @package    Esendex
 * @author     Esendex Support <support@esendex.com>
 * @copyright  2013 Esendex Ltd.
 * @license    http://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause
 * @link       https://github.com/esendex/esendex-php-sdk
 */
namespace Esendex;
use Esendex\Model\MessageBody;

class MessageBodyService
{
    const SERVICE = "messageheaders";
    const SERVICE_VERSION = "v1.0";

    private $authentication;
    private $httpClient;

    /**
     * @param Authentication\IAuthentication $authentication
     * @param Http\IHttp $httpClient
     */
    function __construct(Authentication\IAuthentication $authentication, Http\IHttp $httpClient = null)
    {
        $this->authentication = $authentication;
        $this->httpClient = (isset($httpClient))
            ? $httpClient
            : new Http\HttpClient(true);
    }

    /**
     * @param string|\Esendex\Model\ResultMessage $object
     * @return string
     * @throws Exceptions\ArgumentException
     */
    public function getMessageBody($object)
    {
        if ($object instanceof \Esendex\Model\ResultMessage) {
            return $this->loadMessageBody($object->bodyUri());
        }

        if (is_string($object)) {
            return $this->loadMessageBody($object);
        }

        throw new Exceptions\ArgumentException("Should be either MessageBody Uri or ResultMessage");
    }

    /**
     * @param string $messageId
     * @return string
     * @throws Exceptions\ArgumentException
     */
    public function getMessageBodyById($messageId)
    {
        if ($messageId == null) {
            throw new Exceptions\ArgumentException("messageId is null");
        }
        if (!is_string($messageId)) {
            throw new Exceptions\ArgumentException("messageId is not a string");
        }

        $uri = Http\UriBuilder::serviceUri(
            self::SERVICE_VERSION,
            self::SERVICE,
            array($messageId, "body"),
            $this->httpClient->isSecure()
        );

        return $this->loadMessageBody($uri);
    }

    private function loadMessageBody($uri)
    {
        $result = $this->httpClient->get(
            $uri,
            $this->authentication
        );

        $messageBody = simplexml_load_string($result);

        $result = new MessageBody();
        $result->bodyText($messageBody->bodytext);
        $result->characterSet($messageBody->characterset);
        return $result;
    }
}
