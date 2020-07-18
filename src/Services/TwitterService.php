<?php

namespace App\Services;

use App\Services\Connector\ConnectorInterface;

class TwitterService
{
    private $twitterConnection;
    private $twitterScreenName;

    /**
     * TwitterService constructor.
     *
     * @param ConnectorInterface $twitterConnector
     * @param                    $twitterScreenName
     */
    public function __construct(ConnectorInterface $twitterConnector, $twitterScreenName)
    {
        $this->twitterConnection = $twitterConnector->getConnection();
        $this->twitterScreenName = $twitterScreenName;
    }

    /**
     * @param bool $includeRTS
     *
     * @return mixed
     */
    public function getTweets($includeRTS = true)
    {
        $tweets = $this->twitterConnection->get('statuses/user_timeline', [
            'screen_name' => $this->twitterScreenName,
            'include_rts' => $includeRTS,
            'tweet_mode'  => 'extended',
        ]);

        return $tweets;
    }
}
