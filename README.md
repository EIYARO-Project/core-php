# EIYARO Core-PHP

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
$block = $api->getBlock($blockCount);
echo "Block({$blockCount}): {$block->hash}\n";
echo "===========\n\n";
```