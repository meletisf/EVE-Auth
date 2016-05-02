# Server requirements

In order to make the requests, EVE-Auth uses a PHP extension called **CURL**. 

The chances are that you already have it installed if you are on a shared hosting. 
If you are not sure you can check it by crating a PHP file with the following code:

```php

<?php
  print_r(get_loaded_extensions());
?>

```

The output should look like this:

```
Array
(
   [0] => xml
   [1] => wddx
   [2] => standard
   [3] => session
   [4] => posix
   [5] => pgsql
   [6] => pcre
   [7] => gd
   [8] => ftp
   [9] => db
   [10] => calendar
   [11] => bcmath
)
```

If you see `curl` in that list then you are good to go. If you dont, check the instructions below on how to install it manually.



## Self-hosted

### Debian/Ubuntu

```bash
sudo apt-get install php5-curl
```

### Centos

```bash
yum install php-curl
```

## Shared hosting

1. Open a support ticket with your provider
2. Don't use shared hosting

------

**Next: [Using EVE-Auth](/documentation/usage.md)**
