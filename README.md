PHP-Security
===

Once again, this repository contains very little in way of actual code.
It&#039;s core purpose is to provide functions that aid in the securing of input
between the user and client.

A common use-case would be running any posted data through the `encode`
function. This would encode the special characters into html entities, therefore
making the input safe to be inserted into a database, written out to the buffer,
or generally manipulate and interact with.

### Sample Encoding

``` php
// sample posted data
$_POST = array(
    "name" => "Oliver O'Connor"
);

// secure and display
$post = encode($_POST);
print_r($post);
exit(0);
```

### Sample Output

```
Array
(
    [name] => Oliver O&#039;Connor
)

```
