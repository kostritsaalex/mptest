<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb0c93eb94b06b0fafbad2faf145366f2
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/..' . '/symfony/deprecation-contracts/function.php',
        '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/functions_include.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Wohali\\OAuth2\\Client\\' => 21,
        ),
        'V' => 
        array (
            'Vertisan\\OAuth2\\Client\\Provider\\' => 32,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Http\\Client\\' => 16,
        ),
        'L' => 
        array (
            'Luchianenco\\OAuth2\\Client\\' => 26,
            'League\\OAuth2\\Client\\' => 21,
        ),
        'K' => 
        array (
            'Kerox\\OAuth2\\Client\\' => 20,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
            'GuzzleHttp\\Promise\\' => 19,
            'GuzzleHttp\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Wohali\\OAuth2\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/wohali/oauth2-discord-new/src',
        ),
        'Vertisan\\OAuth2\\Client\\Provider\\' => 
        array (
            0 => __DIR__ . '/..' . '/vertisan/oauth2-twitch-helix/src',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
            1 => __DIR__ . '/..' . '/psr/http-factory/src',
        ),
        'Psr\\Http\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-client/src',
        ),
        'Luchianenco\\OAuth2\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/luchianenco/oauth2-amazon/src',
        ),
        'League\\OAuth2\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/oauth2-client/src',
            1 => __DIR__ . '/..' . '/afbora/oauth2-linkedin-openid/src',
            2 => __DIR__ . '/..' . '/league/oauth2-facebook/src',
            3 => __DIR__ . '/..' . '/league/oauth2-github/src',
            4 => __DIR__ . '/..' . '/league/oauth2-google/src',
        ),
        'Kerox\\OAuth2\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/kerox/oauth2-spotify/src',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
        'GuzzleHttp\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/promises/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'GuzzleHttp\\BodySummarizer' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/BodySummarizer.php',
        'GuzzleHttp\\BodySummarizerInterface' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/BodySummarizerInterface.php',
        'GuzzleHttp\\Client' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Client.php',
        'GuzzleHttp\\ClientInterface' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/ClientInterface.php',
        'GuzzleHttp\\ClientTrait' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/ClientTrait.php',
        'GuzzleHttp\\Cookie\\CookieJar' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Cookie/CookieJar.php',
        'GuzzleHttp\\Cookie\\CookieJarInterface' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Cookie/CookieJarInterface.php',
        'GuzzleHttp\\Cookie\\FileCookieJar' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Cookie/FileCookieJar.php',
        'GuzzleHttp\\Cookie\\SessionCookieJar' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Cookie/SessionCookieJar.php',
        'GuzzleHttp\\Cookie\\SetCookie' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Cookie/SetCookie.php',
        'GuzzleHttp\\Exception\\BadResponseException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/BadResponseException.php',
        'GuzzleHttp\\Exception\\ClientException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/ClientException.php',
        'GuzzleHttp\\Exception\\ConnectException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/ConnectException.php',
        'GuzzleHttp\\Exception\\GuzzleException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/GuzzleException.php',
        'GuzzleHttp\\Exception\\InvalidArgumentException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/InvalidArgumentException.php',
        'GuzzleHttp\\Exception\\RequestException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/RequestException.php',
        'GuzzleHttp\\Exception\\ServerException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/ServerException.php',
        'GuzzleHttp\\Exception\\TooManyRedirectsException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/TooManyRedirectsException.php',
        'GuzzleHttp\\Exception\\TransferException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/TransferException.php',
        'GuzzleHttp\\HandlerStack' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/HandlerStack.php',
        'GuzzleHttp\\Handler\\CurlFactory' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/CurlFactory.php',
        'GuzzleHttp\\Handler\\CurlFactoryInterface' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/CurlFactoryInterface.php',
        'GuzzleHttp\\Handler\\CurlHandler' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/CurlHandler.php',
        'GuzzleHttp\\Handler\\CurlMultiHandler' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/CurlMultiHandler.php',
        'GuzzleHttp\\Handler\\EasyHandle' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/EasyHandle.php',
        'GuzzleHttp\\Handler\\HeaderProcessor' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/HeaderProcessor.php',
        'GuzzleHttp\\Handler\\MockHandler' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/MockHandler.php',
        'GuzzleHttp\\Handler\\Proxy' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/Proxy.php',
        'GuzzleHttp\\Handler\\StreamHandler' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/StreamHandler.php',
        'GuzzleHttp\\MessageFormatter' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/MessageFormatter.php',
        'GuzzleHttp\\MessageFormatterInterface' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/MessageFormatterInterface.php',
        'GuzzleHttp\\Middleware' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Middleware.php',
        'GuzzleHttp\\Pool' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Pool.php',
        'GuzzleHttp\\PrepareBodyMiddleware' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/PrepareBodyMiddleware.php',
        'GuzzleHttp\\Promise\\AggregateException' => __DIR__ . '/..' . '/guzzlehttp/promises/src/AggregateException.php',
        'GuzzleHttp\\Promise\\CancellationException' => __DIR__ . '/..' . '/guzzlehttp/promises/src/CancellationException.php',
        'GuzzleHttp\\Promise\\Coroutine' => __DIR__ . '/..' . '/guzzlehttp/promises/src/Coroutine.php',
        'GuzzleHttp\\Promise\\Create' => __DIR__ . '/..' . '/guzzlehttp/promises/src/Create.php',
        'GuzzleHttp\\Promise\\Each' => __DIR__ . '/..' . '/guzzlehttp/promises/src/Each.php',
        'GuzzleHttp\\Promise\\EachPromise' => __DIR__ . '/..' . '/guzzlehttp/promises/src/EachPromise.php',
        'GuzzleHttp\\Promise\\FulfilledPromise' => __DIR__ . '/..' . '/guzzlehttp/promises/src/FulfilledPromise.php',
        'GuzzleHttp\\Promise\\Is' => __DIR__ . '/..' . '/guzzlehttp/promises/src/Is.php',
        'GuzzleHttp\\Promise\\Promise' => __DIR__ . '/..' . '/guzzlehttp/promises/src/Promise.php',
        'GuzzleHttp\\Promise\\PromiseInterface' => __DIR__ . '/..' . '/guzzlehttp/promises/src/PromiseInterface.php',
        'GuzzleHttp\\Promise\\PromisorInterface' => __DIR__ . '/..' . '/guzzlehttp/promises/src/PromisorInterface.php',
        'GuzzleHttp\\Promise\\RejectedPromise' => __DIR__ . '/..' . '/guzzlehttp/promises/src/RejectedPromise.php',
        'GuzzleHttp\\Promise\\RejectionException' => __DIR__ . '/..' . '/guzzlehttp/promises/src/RejectionException.php',
        'GuzzleHttp\\Promise\\TaskQueue' => __DIR__ . '/..' . '/guzzlehttp/promises/src/TaskQueue.php',
        'GuzzleHttp\\Promise\\TaskQueueInterface' => __DIR__ . '/..' . '/guzzlehttp/promises/src/TaskQueueInterface.php',
        'GuzzleHttp\\Promise\\Utils' => __DIR__ . '/..' . '/guzzlehttp/promises/src/Utils.php',
        'GuzzleHttp\\Psr7\\AppendStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/AppendStream.php',
        'GuzzleHttp\\Psr7\\BufferStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/BufferStream.php',
        'GuzzleHttp\\Psr7\\CachingStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/CachingStream.php',
        'GuzzleHttp\\Psr7\\DroppingStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/DroppingStream.php',
        'GuzzleHttp\\Psr7\\Exception\\MalformedUriException' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/Exception/MalformedUriException.php',
        'GuzzleHttp\\Psr7\\FnStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/FnStream.php',
        'GuzzleHttp\\Psr7\\Header' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/Header.php',
        'GuzzleHttp\\Psr7\\HttpFactory' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/HttpFactory.php',
        'GuzzleHttp\\Psr7\\InflateStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/InflateStream.php',
        'GuzzleHttp\\Psr7\\LazyOpenStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/LazyOpenStream.php',
        'GuzzleHttp\\Psr7\\LimitStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/LimitStream.php',
        'GuzzleHttp\\Psr7\\Message' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/Message.php',
        'GuzzleHttp\\Psr7\\MessageTrait' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/MessageTrait.php',
        'GuzzleHttp\\Psr7\\MimeType' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/MimeType.php',
        'GuzzleHttp\\Psr7\\MultipartStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/MultipartStream.php',
        'GuzzleHttp\\Psr7\\NoSeekStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/NoSeekStream.php',
        'GuzzleHttp\\Psr7\\PumpStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/PumpStream.php',
        'GuzzleHttp\\Psr7\\Query' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/Query.php',
        'GuzzleHttp\\Psr7\\Request' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/Request.php',
        'GuzzleHttp\\Psr7\\Response' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/Response.php',
        'GuzzleHttp\\Psr7\\Rfc7230' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/Rfc7230.php',
        'GuzzleHttp\\Psr7\\ServerRequest' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/ServerRequest.php',
        'GuzzleHttp\\Psr7\\Stream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/Stream.php',
        'GuzzleHttp\\Psr7\\StreamDecoratorTrait' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/StreamDecoratorTrait.php',
        'GuzzleHttp\\Psr7\\StreamWrapper' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/StreamWrapper.php',
        'GuzzleHttp\\Psr7\\UploadedFile' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/UploadedFile.php',
        'GuzzleHttp\\Psr7\\Uri' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/Uri.php',
        'GuzzleHttp\\Psr7\\UriComparator' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/UriComparator.php',
        'GuzzleHttp\\Psr7\\UriNormalizer' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/UriNormalizer.php',
        'GuzzleHttp\\Psr7\\UriResolver' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/UriResolver.php',
        'GuzzleHttp\\Psr7\\Utils' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/Utils.php',
        'GuzzleHttp\\RedirectMiddleware' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/RedirectMiddleware.php',
        'GuzzleHttp\\RequestOptions' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/RequestOptions.php',
        'GuzzleHttp\\RetryMiddleware' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/RetryMiddleware.php',
        'GuzzleHttp\\TransferStats' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/TransferStats.php',
        'GuzzleHttp\\Utils' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Utils.php',
        'Kerox\\OAuth2\\Client\\Provider\\Exception\\SpotifyIdentityProviderException' => __DIR__ . '/..' . '/kerox/oauth2-spotify/src/Provider/Exception/SpotifyIdentityProviderException.php',
        'Kerox\\OAuth2\\Client\\Provider\\Exception\\SpotifyProviderException' => __DIR__ . '/..' . '/kerox/oauth2-spotify/src/Provider/Exception/SpotifyProviderException.php',
        'Kerox\\OAuth2\\Client\\Provider\\Spotify' => __DIR__ . '/..' . '/kerox/oauth2-spotify/src/Provider/Spotify.php',
        'Kerox\\OAuth2\\Client\\Provider\\SpotifyResourceOwner' => __DIR__ . '/..' . '/kerox/oauth2-spotify/src/Provider/SpotifyResourceOwner.php',
        'League\\OAuth2\\Client\\Exception\\HostedDomainException' => __DIR__ . '/..' . '/league/oauth2-google/src/Exception/HostedDomainException.php',
        'League\\OAuth2\\Client\\Grant\\AbstractGrant' => __DIR__ . '/..' . '/league/oauth2-client/src/Grant/AbstractGrant.php',
        'League\\OAuth2\\Client\\Grant\\AuthorizationCode' => __DIR__ . '/..' . '/league/oauth2-client/src/Grant/AuthorizationCode.php',
        'League\\OAuth2\\Client\\Grant\\ClientCredentials' => __DIR__ . '/..' . '/league/oauth2-client/src/Grant/ClientCredentials.php',
        'League\\OAuth2\\Client\\Grant\\Exception\\InvalidGrantException' => __DIR__ . '/..' . '/league/oauth2-client/src/Grant/Exception/InvalidGrantException.php',
        'League\\OAuth2\\Client\\Grant\\FbExchangeToken' => __DIR__ . '/..' . '/league/oauth2-facebook/src/Grant/FbExchangeToken.php',
        'League\\OAuth2\\Client\\Grant\\GrantFactory' => __DIR__ . '/..' . '/league/oauth2-client/src/Grant/GrantFactory.php',
        'League\\OAuth2\\Client\\Grant\\Password' => __DIR__ . '/..' . '/league/oauth2-client/src/Grant/Password.php',
        'League\\OAuth2\\Client\\Grant\\RefreshToken' => __DIR__ . '/..' . '/league/oauth2-client/src/Grant/RefreshToken.php',
        'League\\OAuth2\\Client\\OptionProvider\\HttpBasicAuthOptionProvider' => __DIR__ . '/..' . '/league/oauth2-client/src/OptionProvider/HttpBasicAuthOptionProvider.php',
        'League\\OAuth2\\Client\\OptionProvider\\OptionProviderInterface' => __DIR__ . '/..' . '/league/oauth2-client/src/OptionProvider/OptionProviderInterface.php',
        'League\\OAuth2\\Client\\OptionProvider\\PostAuthOptionProvider' => __DIR__ . '/..' . '/league/oauth2-client/src/OptionProvider/PostAuthOptionProvider.php',
        'League\\OAuth2\\Client\\Provider\\AbstractProvider' => __DIR__ . '/..' . '/league/oauth2-client/src/Provider/AbstractProvider.php',
        'League\\OAuth2\\Client\\Provider\\AppSecretProof' => __DIR__ . '/..' . '/league/oauth2-facebook/src/Provider/AppSecretProof.php',
        'League\\OAuth2\\Client\\Provider\\Exception\\FacebookProviderException' => __DIR__ . '/..' . '/league/oauth2-facebook/src/Provider/Exception/FacebookProviderException.php',
        'League\\OAuth2\\Client\\Provider\\Exception\\GithubIdentityProviderException' => __DIR__ . '/..' . '/league/oauth2-github/src/Provider/Exception/GithubIdentityProviderException.php',
        'League\\OAuth2\\Client\\Provider\\Exception\\IdentityProviderException' => __DIR__ . '/..' . '/league/oauth2-client/src/Provider/Exception/IdentityProviderException.php',
        'League\\OAuth2\\Client\\Provider\\Exception\\LinkedInAccessDeniedException' => __DIR__ . '/..' . '/afbora/oauth2-linkedin-openid/src/Provider/Exception/LinkedInAccessDeniedException.php',
        'League\\OAuth2\\Client\\Provider\\Facebook' => __DIR__ . '/..' . '/league/oauth2-facebook/src/Provider/Facebook.php',
        'League\\OAuth2\\Client\\Provider\\FacebookUser' => __DIR__ . '/..' . '/league/oauth2-facebook/src/Provider/FacebookUser.php',
        'League\\OAuth2\\Client\\Provider\\GenericProvider' => __DIR__ . '/..' . '/league/oauth2-client/src/Provider/GenericProvider.php',
        'League\\OAuth2\\Client\\Provider\\GenericResourceOwner' => __DIR__ . '/..' . '/league/oauth2-client/src/Provider/GenericResourceOwner.php',
        'League\\OAuth2\\Client\\Provider\\Github' => __DIR__ . '/..' . '/league/oauth2-github/src/Provider/Github.php',
        'League\\OAuth2\\Client\\Provider\\GithubResourceOwner' => __DIR__ . '/..' . '/league/oauth2-github/src/Provider/GithubResourceOwner.php',
        'League\\OAuth2\\Client\\Provider\\Google' => __DIR__ . '/..' . '/league/oauth2-google/src/Provider/Google.php',
        'League\\OAuth2\\Client\\Provider\\GoogleUser' => __DIR__ . '/..' . '/league/oauth2-google/src/Provider/GoogleUser.php',
        'League\\OAuth2\\Client\\Provider\\LinkedIn' => __DIR__ . '/..' . '/afbora/oauth2-linkedin-openid/src/Provider/LinkedIn.php',
        'League\\OAuth2\\Client\\Provider\\LinkedInResourceOwner' => __DIR__ . '/..' . '/afbora/oauth2-linkedin-openid/src/Provider/LinkedInResourceOwner.php',
        'League\\OAuth2\\Client\\Provider\\ResourceOwnerInterface' => __DIR__ . '/..' . '/league/oauth2-client/src/Provider/ResourceOwnerInterface.php',
        'League\\OAuth2\\Client\\Token\\AccessToken' => __DIR__ . '/..' . '/league/oauth2-client/src/Token/AccessToken.php',
        'League\\OAuth2\\Client\\Token\\AccessTokenInterface' => __DIR__ . '/..' . '/league/oauth2-client/src/Token/AccessTokenInterface.php',
        'League\\OAuth2\\Client\\Token\\LinkedInAccessToken' => __DIR__ . '/..' . '/afbora/oauth2-linkedin-openid/src/Token/LinkedInAccessToken.php',
        'League\\OAuth2\\Client\\Token\\ResourceOwnerAccessTokenInterface' => __DIR__ . '/..' . '/league/oauth2-client/src/Token/ResourceOwnerAccessTokenInterface.php',
        'League\\OAuth2\\Client\\Tool\\ArrayAccessorTrait' => __DIR__ . '/..' . '/league/oauth2-client/src/Tool/ArrayAccessorTrait.php',
        'League\\OAuth2\\Client\\Tool\\BearerAuthorizationTrait' => __DIR__ . '/..' . '/league/oauth2-client/src/Tool/BearerAuthorizationTrait.php',
        'League\\OAuth2\\Client\\Tool\\GuardedPropertyTrait' => __DIR__ . '/..' . '/league/oauth2-client/src/Tool/GuardedPropertyTrait.php',
        'League\\OAuth2\\Client\\Tool\\MacAuthorizationTrait' => __DIR__ . '/..' . '/league/oauth2-client/src/Tool/MacAuthorizationTrait.php',
        'League\\OAuth2\\Client\\Tool\\ProviderRedirectTrait' => __DIR__ . '/..' . '/league/oauth2-client/src/Tool/ProviderRedirectTrait.php',
        'League\\OAuth2\\Client\\Tool\\QueryBuilderTrait' => __DIR__ . '/..' . '/league/oauth2-client/src/Tool/QueryBuilderTrait.php',
        'League\\OAuth2\\Client\\Tool\\RequestFactory' => __DIR__ . '/..' . '/league/oauth2-client/src/Tool/RequestFactory.php',
        'League\\OAuth2\\Client\\Tool\\RequiredParameterTrait' => __DIR__ . '/..' . '/league/oauth2-client/src/Tool/RequiredParameterTrait.php',
        'Luchianenco\\OAuth2\\Client\\Exception\\AmazonIdentityProviderException' => __DIR__ . '/..' . '/luchianenco/oauth2-amazon/src/Exception/AmazonIdentityProviderException.php',
        'Luchianenco\\OAuth2\\Client\\Provider\\Amazon' => __DIR__ . '/..' . '/luchianenco/oauth2-amazon/src/Provider/Amazon.php',
        'Luchianenco\\OAuth2\\Client\\Provider\\AmazonResourceOwner' => __DIR__ . '/..' . '/luchianenco/oauth2-amazon/src/Provider/AmazonResourceOwner.php',
        'Psr\\Http\\Client\\ClientExceptionInterface' => __DIR__ . '/..' . '/psr/http-client/src/ClientExceptionInterface.php',
        'Psr\\Http\\Client\\ClientInterface' => __DIR__ . '/..' . '/psr/http-client/src/ClientInterface.php',
        'Psr\\Http\\Client\\NetworkExceptionInterface' => __DIR__ . '/..' . '/psr/http-client/src/NetworkExceptionInterface.php',
        'Psr\\Http\\Client\\RequestExceptionInterface' => __DIR__ . '/..' . '/psr/http-client/src/RequestExceptionInterface.php',
        'Psr\\Http\\Message\\MessageInterface' => __DIR__ . '/..' . '/psr/http-message/src/MessageInterface.php',
        'Psr\\Http\\Message\\RequestFactoryInterface' => __DIR__ . '/..' . '/psr/http-factory/src/RequestFactoryInterface.php',
        'Psr\\Http\\Message\\RequestInterface' => __DIR__ . '/..' . '/psr/http-message/src/RequestInterface.php',
        'Psr\\Http\\Message\\ResponseFactoryInterface' => __DIR__ . '/..' . '/psr/http-factory/src/ResponseFactoryInterface.php',
        'Psr\\Http\\Message\\ResponseInterface' => __DIR__ . '/..' . '/psr/http-message/src/ResponseInterface.php',
        'Psr\\Http\\Message\\ServerRequestFactoryInterface' => __DIR__ . '/..' . '/psr/http-factory/src/ServerRequestFactoryInterface.php',
        'Psr\\Http\\Message\\ServerRequestInterface' => __DIR__ . '/..' . '/psr/http-message/src/ServerRequestInterface.php',
        'Psr\\Http\\Message\\StreamFactoryInterface' => __DIR__ . '/..' . '/psr/http-factory/src/StreamFactoryInterface.php',
        'Psr\\Http\\Message\\StreamInterface' => __DIR__ . '/..' . '/psr/http-message/src/StreamInterface.php',
        'Psr\\Http\\Message\\UploadedFileFactoryInterface' => __DIR__ . '/..' . '/psr/http-factory/src/UploadedFileFactoryInterface.php',
        'Psr\\Http\\Message\\UploadedFileInterface' => __DIR__ . '/..' . '/psr/http-message/src/UploadedFileInterface.php',
        'Psr\\Http\\Message\\UriFactoryInterface' => __DIR__ . '/..' . '/psr/http-factory/src/UriFactoryInterface.php',
        'Psr\\Http\\Message\\UriInterface' => __DIR__ . '/..' . '/psr/http-message/src/UriInterface.php',
        'Vertisan\\OAuth2\\Client\\Provider\\Exception\\TwitchHelixIdentityProviderException' => __DIR__ . '/..' . '/vertisan/oauth2-twitch-helix/src/Exception/TwitchHelixIdentityProviderException.php',
        'Vertisan\\OAuth2\\Client\\Provider\\TwitchHelix' => __DIR__ . '/..' . '/vertisan/oauth2-twitch-helix/src/TwitchHelix.php',
        'Vertisan\\OAuth2\\Client\\Provider\\TwitchHelixResourceOwner' => __DIR__ . '/..' . '/vertisan/oauth2-twitch-helix/src/TwitchHelixResourceOwner.php',
        'Wohali\\OAuth2\\Client\\Provider\\Discord' => __DIR__ . '/..' . '/wohali/oauth2-discord-new/src/Provider/Discord.php',
        'Wohali\\OAuth2\\Client\\Provider\\DiscordResourceOwner' => __DIR__ . '/..' . '/wohali/oauth2-discord-new/src/Provider/DiscordResourceOwner.php',
        'Wohali\\OAuth2\\Client\\Provider\\Exception\\DiscordIdentityProviderException' => __DIR__ . '/..' . '/wohali/oauth2-discord-new/src/Provider/Exception/DiscordIdentityProviderException.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb0c93eb94b06b0fafbad2faf145366f2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb0c93eb94b06b0fafbad2faf145366f2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb0c93eb94b06b0fafbad2faf145366f2::$classMap;

        }, null, ClassLoader::class);
    }
}