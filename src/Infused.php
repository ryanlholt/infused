<?php

namespace RyanLHolt\Infused;

use Illuminate\Log\LogManager;
use Illuminate\Support\Facades\Log;
use Infusionsoft\Infusionsoft;
use Infusionsoft\InfusionsoftException;
use RyanLHolt\Infused\Models\InfusionsoftToken;

class Infused
{
    protected $app;
    protected $infusionsoft;

    public function __construct($app)
    {
        $this->app = $app;

        $this->infusionsoft = new Infusionsoft(config('infused.infusionsoft'));

        $this->infusionsoft->setHttpLogAdapter($this->app->make(LogManager::class));
    }

    public function updateToken($token)
    {
        $tokenModel = InfusionsoftToken::firstOrNew([
            'user_id' => auth()->id(),
        ]);

        $tokenExtraInfo = $token->getExtraInfo();

        $tokenAppId = explode('|', $tokenExtraInfo['scope']);
        $tokenAppId = $tokenAppId[1];

        $tokenModel->user_id = auth()->id();
        $tokenModel->infusionsoft_app_id = $tokenAppId;
        $tokenModel->access_token = $token->getAccessToken();
        $tokenModel->refresh_token = $token->getRefreshToken();
        $tokenModel->token_type = $tokenExtraInfo['token_type'];
        $tokenModel->end_of_life = $token->getEndOfLife();
        $tokenModel->serialized_token = serialize($token);

        $tokenModel->save();

        return true;
    }

    public function getAccessToken($code = null): bool
    {
        try {
            $token = (isset($code))
                ? $this->infusionsoft->requestAccessToken($code)
                : $this->infusionsoft->refreshAccessToken();

            $this->updateToken($token);

            return true;
        } catch (InfusionsoftException $e) {
            Log::error('Error refreshing token: ' . $e->getMessage());

            return false;
        }
    }
}
