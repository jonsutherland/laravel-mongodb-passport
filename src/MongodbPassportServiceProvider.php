<?php

namespace mvjacobs\Mongodb;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Bridge\RefreshTokenRepository as PassportRefreshTokenRepository;
use Laravel\Passport\Passport;
use mvjacobs\Mongodb\Passport\AuthCode;
use mvjacobs\Mongodb\Passport\Bridge\RefreshTokenRepository;
use mvjacobs\Mongodb\Passport\Client;
use mvjacobs\Mongodb\Passport\PersonalAccessClient;
use mvjacobs\Mongodb\Passport\Token;

class MongodbPassportServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        Passport::useAuthCodeModel(AuthCode::class);
        Passport::useClientModel(Client::class);
        Passport::usePersonalAccessClientModel(PersonalAccessClient::class);
        Passport::useTokenModel(Token::class);

        $this->app->bind(PassportRefreshTokenRepository::class, function () {
            return $this->app->make(RefreshTokenRepository::class);
        });
    }
}
