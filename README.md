# php-cli-colour
Add Colours to PHP CLI output

# Usage

This is a stand alone class and can be used as it is.


## Methods

### Paint

```php
Colourout\Colour::paint("This is a sample string", Colour::BLUE);
```
will return the string in blue

```php
Colourout\Colour::paint("This is a sample string", Colour::GREY, Colour::RED);
```
will return the string in grey text with red background

* Note: Paint will not print anything to console. This is useful only to colour the string. You can use `echo` or use other methods explained below

### Print and Println
```php
Colourout\Colour::print("This is a sample string", Colour::GREEN, Colour::YELLOW);
```

will print the string in green text colour and yellow background

`println` will print with a new line.

### Presets
* Presets are predefined colour combinations.

```php
Colourout\Colour::printError($errorString, $boldText, $printToConsole)
```
will print the error string in grey text and red background. The text can be made bold by sending `true` as the second parameter.
Its default value depends on the preset.
`$printToConsole` is set to true by default. If sent as false, nothing will be printed to the console.

All the methods return strings.

### List of Available Methods

```php
Colourout\Colour::paint($string, $textColour, $backgroundColour);
Colourout\Colour::print($string, $textColour, $backgroundColour);
Colourout\Colour::println($string, $textColour, $backgroundColour);
```

#### Presets:
```php
Colourout\Colour::printError($string, $boldText, $printToConsole);
Colourout\Colour::printInfo($string, $boldText, $printToConsole);
Colourout\Colour::printWarning($string, $boldText, $printToConsole);
```

#### Util Methods
```php
Colourout\Colour::getAvailableTextColours($printToConsole);
```
returns an array of text colours supported by this class

```php
Colourout\Colour::getAvailableBackgroundColours($printToConsole);
```
returns an array of background colours supported by this class

* Notes: 
    * `$printToConsole` is `true` by default. It will also return the array of colours
    * Your console might support more colours than this class.
