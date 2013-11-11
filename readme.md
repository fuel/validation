# FuelPHP Validation library.

[![Build Status](https://travis-ci.org/fuelphp/validation.png?branch=master)](https://travis-ci.org/fuelphp/validation)

A flexible library to validate different kinds of data.

##Simple usage

```php
<?php

use Fuel\Validation\Validator;

// Create a new validator instance to play with
$v = new Validator;

// Set up our required validation rules
$v->addField('name', 'User Name')
    ->required()
  ->addField('email', 'Email Address')
    ->required()
    ->email()
  ->addField('age', 'Current Age')
    ->number();

// Create some dummy data to validate
$data = array(
    'name' => 'John',
    'email' => 'john@doe.example',
    'age' => 32,
);

// Perform the validation
$result = $v->run($data);

var_dump($result->isValid()); // true
var_dump($result->validated()); // List of all the fields that passed validation

```

### Current validation rules

All core rule classes can be found under the `Fuel\Validation\Rule` namespace.

 - email - Checks for a valid email format
 - ip -  Checks for a valid IP address
 - matchFiled - Compares the given field against another field being validated
 - minLength - Checks if the value is >= a given value
 - number - Checks if the value is numeric or not
 - numericBetween - Checks if a numeric value falls between an upper and lower band
 - numericMax - Checks if the value is less than or equal to a given value
 - numericMin - Checks if the value is greater than or equal to a given value
 - regex - Checks if the value matches against a given regular expression
 - required - Checks if the value exists in the data being validated
 - url - Checks if the given value is a valid url or not

## Error messages

Messages can be retrieved from the result object after validatoin has been performed

```php
<?php

use Fuel\Validation\Validator;

// Create a new validator instance to play with
$v = new Validator;

// Set up our required validation rules
$v->addField('name', 'User Name')
    ->required()
  ->addField('email', 'Email Address')
    ->required()
    ->email()
  ->addField('age', 'Current Age')
    ->number();

// Create some dummy data to validate
$data = array(
    'email' => 'john',
    'age' => 'not a number',
);

// Perform the validation
$result = $v->run($data);

var_dump($result->isValid()); // false
var_dump($result->getValidated()); // array()

var_dump($result->getErrors()); // returns an array of all the error messages encountered
var_dump($result->getError('name')); // Returns the error message for the 'name' field
```

### Custom messages
Messages can be set in two ways, directly on a rule instance or as part of the method chain.

```php

use Fuel\Validation\Validator;

$v = new Validator;

$v->addField('name', 'User Name')
    ->required()
    ->setMessage('{label} is required, please enter a value');

```
Now when the `required()` rule fails the custom message will be used.

There are several tokens that can be used as substitutions for various values. As in the example `{label}` will be replaced
with the field's label and `{name}` will be replaced with the field's name. (`name` in the example above). Rules can also
provide other values, for instance `NumericBetween` will allow you to use `{upper}` and `{lower}`. Please refer to each rule
on the custom tokens provided.

If a token in a string is not found then it will simply be ignored and not replaced.

## Manually adding rules and rule overriding
As well as using the default core rules it is possible to dynamically add your own rules or override existing rules.

This is done by calling the `addRule()` function on a `Validator` like so: `$v->addRule('myCustomRule', 'My\App\Rules\CustomRule')`.
If the class cannot be loaded for any reason a `InvalidRuleException` will be thrown when the rule gets used.

The `myCustomRule` rule is now available for use with the `Validator` instance and can be called via the magic method syntax as well as the `createRuleInstance()` function in `Validator`.

```php
<?php

use Fuel\Validation\Validator;

// Create a new validator instance to play with
$v = new Validator;

$v->addRule('myCustomRule', 'My\App\Rules\CustomRule');

// Example of adding the new rule via magic method syntax
$v->addField('foobar')
    ->myCustomRule();

$instance = $v->getRuleInstance('myCustomRule');
var_dump($instance); // instance of My\App\Rules\CustomRule
```

### Overriding existing rules
It is possible to replace existing rules simply by calling `addRule()` as in the previous example and passing the name of an existing rule

```php
<?php

use Fuel\Validation\Validator;

// Create a new validator instance to play with
$v = new Validator;

$v->addRule('required', 'My\App\Rules\CustomRule');

// Example of adding the new rule via magic method syntax
$v->addField('foobar')
    ->required();

$instance = $v->getRuleInstance('required');
var_dump($instance); // instance of My\App\Rules\CustomRule
```

## Automatic `Validator` population
Through the use of `RuleProvider` classes it is possible to automatically create rule sets for a given `Validator` this can be used to automatically create validation for any kind of object from forms to ORM models.
At the moment only one provider exists to serve as an example that creates rule sets from a config array. In the future Fieldset and ORM will provide their own providers.

The provider is used by creating a new `Validator`, setting up your config array and then populating the `Validator`.

```php
<?php

use Fuel\Validation\Validator;
use Fuel\Validation\RuleProvider\FromArray;

// The key is the name of the field that has a value of an array containing the rules
$config = array(
    'name' => array(
        'required', // Rules with no parameters can be specified like this
    ),
    'email' => array(
        'required',
        'email', // Make sure this is a valid email address
    ),
    'age' => array(
        'number',
        'numericMin' => 18, // Make sure the value is 18 or greater
    ),

    // The exact parameters for each rule are documented with the rule itself and can differ between rules.
);

$v = new Validator;

$generator = new FromArray;
$generator->setData($data)->populateValidator($v);

// $v is now populated with the fields and rules specified in the config array.
```

The `RuleProvider`s will also be aware of custom rules that are added to the `Validator` that they are passed.

```php
<?php

use Fuel\Validation\Validator;
use Fuel\Validation\RuleProvider\FromArray;

$config = array(
    'name' => array(
        'myCustomRule',
    ),
);

$v = new Validator;

$v->addRule('myCustomRule', 'My\App\Rules\CustomRule');

$generator = new FromArray;
$generator->setData($data)->populateValidator($v);

```
