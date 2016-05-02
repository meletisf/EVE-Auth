# Using EVE-Auth

Using the class if fairly simple since it only contains 3 methods you need to use. 

+ **getEVELink()**
 + Once the class is initialized, this method, when called, will return a link which the user must be redirected to.
 + Example: https://login.eveonline.com/oauth/authorize/?response_type=code&redirect_uri=https://3rdpartysite.com/callback&client_id=3rdpartyClientId&scope=&state=uniquestate123

+ **obtainAccessToken($code)**
 + When the user is redirected back to the callback link he carries a GET parameter called `code`. This code must be passed as an argument.
 + Example: https://3rdpartysite.com/callback?code=gEyuYF_rf...ofM0&state=uniquestate123
 + Sample response:
 ```json
 {
    "access_token": "uNEEh...a\_WpiaA2",
    "token_type": "Bearer",
    "expires_in": 300,
    "refresh_token": null
  }
  ```
  + Response parameters
    + access_token - The only thing that is usefull
 
+ **getCharacterID($tokenData)**
 + This is what returns the actual user data. It takes the response from *obtainAccessToken* as a parameter.
 + Sample resposnse: 
 ```json
 {
    "CharacterID": 273042051,
    "CharacterName": "CCP illurkall",
    "ExpiresOn": "2014-05-23T15:01:15.182864Z",
    "Scopes": " ",
    "TokenType": "Character",
    "CharacterOwnerHash": "XM4D...FoY="
}
 ```

More info can be found here: [EVE SSO Docs](https://eveonline-third-party-documentation.readthedocs.io/en/latest/sso/authentication.html)

--------

**Next: [Examples](/examples/)**
