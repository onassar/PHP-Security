PHP-Security
===

Once again, this repository contains very little in way of actual code.
It&#039;s core purpose is to provide functions that aid in the securing of input
between the user and client.

A common use-case would be running any posted data through the `encode`
function. This would encode the special characters into html entities, therefore
making the input safe to be inserted into a database, written out to the buffer,
or generally manipulate and interact with.
