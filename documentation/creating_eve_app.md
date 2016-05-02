# Creating an EVE Application

![eve_developers](http://i.imgur.com/iNGOPdj.png)

First things first, you need to register a new EVE Online application on the developer portal. 
This will give you your app keys (not to be confused with the character API keys) which will enable you to access the SSO and CREST.

------

Head over to https://developers.eveonline.com/ and click "Manage Applications". 
If this is your first time accessing the developer center you will be asked to read and accept the terms of service.


Once you do that click on "Create new application". Give your app a name, a short description and make sure you choose **CREST Access**.
From the available scopes pick **publicData**.

![new_app](http://i.imgur.com/eompIg7.png)


**Callback URL:** The Callback URL must match the url provided in EVE-Auth. This poses a problem at the development stage of our 
application since the callback will be different from the production environment.

It is advised to create 2 seperate application on the development portal (one for development and one for production).

------

![app_details](http://i.imgur.com/pca2m5w.png)

Once your application is created you will be given the **clientID** and the **SecretKey**.

------

### Next: [Configuration](/documentation/configuration.md)
