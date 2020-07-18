<?php

namespace App\Services\Connector;

use Abraham\TwitterOAuth\TwitterOAuth;

final class TwitterConnector implements ConnectorInterface
{
    private $key;
    private $secret;
    private $token;
    private $tokenSecret;

    /**
     * TwitterConnector constructor.
     *
     * @param $consumerKey
     * @param $consumerSecret
     * @param $accessToken
     * @param $accessSecret
     */
    public function __construct($consumerKey, $consumerSecret, $accessToken, $accessSecret)
    {
        $this->key         = $consumerKey;
        $this->secret      = $consumerSecret;
        $this->token       = $accessToken;
        $this->tokenSecret = $accessSecret;
    }

    /**
     * @return TwitterOAuth
     */
    public function getConnection():TwitterOAuth
    {
        return new TwitterOAuth($this->key, $this->secret, $this->token, $this->tokenSecret);
    }
}
