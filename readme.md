# RDP-Notif-Handler
Micro service to handle notification post-payment. For testing purpose. Repo for testcase [here](https://github.com/bolon/rdp-test)

## Services
### Endpoint       
| Endpoint                        | Method   | Description                                       |
|---------------------------------|----------|---------------------------------------------------|
| ``/notif-handler-with-hosting`` | ``POST`` | Save JSON String sent to http://www.jsonblob.com  |
| ``/notif-handler-v2``           | ``POST`` | Save JSON String sent to database.                |
| ``/get-last-notification``      | ``GET``  | Get last notification that stored in database.    |

### Sample
``/notif-handler-with-hosting``

#### Request   
```
{  
   "redirect_url":"http:\/\/localhost\/rdp\/service\/test-suite\/T_redirection_hosted_single\/redirect_url",
   "notify_url":"http:\/\/localhost\/rdp\/notif_server\/payment_api\/notif-url.php",
   "back_url":"http:\/\/localhost\/rdp\/service\/test-suite\/T_redirection_hosted_single\/back_url",
   "mid":"1000089029",
   "order_id":"TST102",
   "amount":"0.01",
   "ccy":"SGD",
   "api_mode":"redirection_hosted",
   "payment_type":"S",
   "merchant_reference":"the things to reference",
   "signature":"325cda0dc4a0dfa523afc542c245ae008ca73910779e670f96b3ed4bd241b966e752036afd1920ae9690ca475b82eda302a3b0a7ad9157a4d4cdb0cc38b36e52"
}
```

#### Response
Response code : ``200``
```
{
    "data": "https:\/\/jsonblob.com\/api\/jsonBlob\/7d1d524c-701f-11e7-9e0d-cb4350d25f03"
}
```

``/notif-handler-v2``

#### Request
```
{
	"redirect_url":"http:\/\/localhost\/rdp\/service\/test-suite\/T_redirection_hosted_single\/redirect_url",
	"notify_url":"http:\/\/localhost\/rdp\/notif_server\/payment_api\/notif-url.php",
	"back_url":"http:\/\/localhost\/rdp\/service\/test-suite\/T_redirection_hosted_single\/back_url",
	"mid":"1000089029",
	"order_id":"TST102",
	"amount":"0.01",
	"ccy":"SGD",
	"api_mode":"redirection_hosted",
	"payment_type":"S",
	"merchant_reference":"the things to reference",
	"signature":"325cda0dc4a0dfa523afc542c245ae008ca73910779e670f96b3ed4bd241b966e752036afd1920ae9690ca475b82eda302a3b0a7ad9157a4d4cdb0cc38b36e52"
}
```

#### Response
Response code : ``200``
```
{
    "resp_msg": "success"
}
```

``/get-last-notification``

#### Response
```
{
    "response_msg": "success",
    "response_value": {
        "ccy": "SGD",
        "mid": "1000089029",
        "amount": "0.01",
        "api_mode": "redirection_hosted",
        "back_url": "http://localhost/rdp/service/test-suite/T_redirection_hosted_single/back_url",
        "order_id": "TST102",
        "signature": "325cda0dc4a0dfa523afc542c245ae008ca73910779e670f96b3ed4bd241b966e752036afd1920ae9690ca475b82eda302a3b0a7ad9157a4d4cdb0cc38b36e52",
        "notify_url": "http://localhost/rdp/notif_server/payment_api/notif-url.php",
        "payment_type": "S",
        "redirect_url": "http://localhost/rdp/service/test-suite/T_redirection_hosted_single/redirect_url",
        "merchant_reference": "the things to reference"
    }
}
```

## Deploying
Use heroku to deploy the application. Follow this [guide](http://www.easylaravelbook.com/blog/2015/01/31/deploying-a-laravel-application-to-heroku/)
