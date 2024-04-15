# EIYARO Core-PHP

[![Supports Windows](https://img.shields.io/badge/support-Windows-blue?logo=Windows)](https://github.com/EIYARO-Project/core-php/releases/latest)
[![Supports Linux](https://img.shields.io/badge/support-Linux-yellow?logo=Linux)](https://github.com/EIYARO-Project/core-php/releases/latest)
[![License](https://img.shields.io/github/license/EIYARO-Project/core)](https://github.com/EIYARO-Project/core-php/blob/master/LICENSE)
[![Latest Release](https://img.shields.io/github/v/release/EIYARO-Project/core?label=latest%20release)](https://github.com/EIYARO-Project/core-php/releases/latest)
[![Downloads](https://img.shields.io/github/downloads/EIYARO-Project/core-php/total)](https://github.com/EIYARO-Project/core-php/releases)

Set of classes to deal with `EIYARO`'s `API`.

## Examples

Common code:
```php
include __DIR__ . '/vendor/autoload.php';

$base_uri = 'https://api.eiyaro.com';
$accessToken = null;

use EIYARO\API;

$api = new API($base_uri, $accessToken);
```

### Net Info

```php
echo "== Net Info ==\n";
$netInfo = $api->getNetInfo();
echo json_encode($netInfo) . "\n";
echo "==============\n\n";
```

### Block Count
```php
echo "== Block Count ==\n";
$blockCount = $api->getBlockCount();
echo "Height: {$blockCount}\n";
echo "=================\n\n";
```

### Block
```php
echo "== Block ==\n";
$block = $api->getBlock($6635);
echo "Block({$blockCount}): {$block->hash}\n";
echo "===========\n\n";
```

### Transaction
```php
echo "== Transaction ==\n";
try {
    $transaction = $api->getTransaction("fc64be31e56a448879f9984599cafead466ec5b1a985c6ce8e6d45685c55b7d1");
    echo json_encode($transaction, JSON_PRETTY_PRINT) . "\n";
} catch (Exception $e) {
    echo "Error: ". $e->getMessage() ."\n";
}
echo "===========\n\n";
```