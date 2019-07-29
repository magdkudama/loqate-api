LOQATE PHP CLIENT
=================

Loqate PHP client. Simply using the API endpoint I need for now.

```php
<?php

use MagdKudama\Loqate\Client;

include_once __DIR__ . '/vendor/autoload.php';

$client = new Client('my-api-key');

$client->bankAccount()->validate('sort-code', 'account-number');
```

Enjoy!
