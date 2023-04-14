
## Provider Middleware
This Laravel middleware, named ProviderMiddleware, is used to validate the request sign for all requests received from a casino provider.



## Requirements
To use this middleware, you will need to share a secret AUTH_TOKEN with the casino provider. 

Add the AUTH_TOKEN to your Laravel project's .env file.

Each request should include an X-REQUEST-SIGN header which will contain an HMAC-SHA256 signature created using the request body as the message and the AUTH_TOKEN as the key.



