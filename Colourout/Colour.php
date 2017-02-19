<?php

/**
 * Author: Mayank Dharwa
 */

namespace ConsoleOut;

class Colour
{
    const BLACK = 'BLACK';
    const GREY_BOLD = 'GREY_BOLD';
    const YELLOW = 'YELLOW';
    const YELLOW_BOLD = 'YELLOW_BOLD';
    const MAGENTA = 'MAGENTA';
    const BLACK_BOLD = 'BLACK_BOLD';
    const GREY = 'GREY';
    const BLUE = 'BLUE';
    const BLUE_BOLD = 'BLUE_BOLD';
    const GREEN = 'GREEN';
    const GREEN_BOLD = 'GREEN_BOLD';
    const CYAN = 'CYAN';
    const CYAN_BOLD = 'CYAN_BOLD';
    const RED = 'RED';
    const RED_BOLD = 'RED_BOLD';
    const PURPLE = 'PURPLE';
    const PURPLE_BOLD = 'PURPLE_BOLD';

    /**
     * Colour Codes for font colour.
     */
    private static $textColourCodes = array(
        self::BLACK => '0;30m',
        self::GREY_BOLD => '1;37m',
        self::YELLOW => '0;33m',
        self::YELLOW_BOLD => '1;33m',
        self::BLACK_BOLD => '1;30m',
        self::GREY => '0;37m',
        self::BLUE => '0;34m',
        self::BLUE_BOLD => '1;34m',
        self::GREEN => '0;32m',
        self::GREEN_BOLD => '1;32m',
        self::CYAN => '0;36m',
        self::CYAN_BOLD => '1;36m',
        self::RED => '0;31m',
        self::RED_BOLD => '1;31m',
        self::PURPLE => '0;35m',
        self::PURPLE_BOLD => '1;35m'
    );

    /**
     * Colour Codes for Background Colour.
     */
    private static $backgroundColourCodes = array(
        self::BLACK => '40m',
        self::RED => '41m',
        self::GREEN => '42m',
        self::YELLOW => '43m',
        self::BLUE => '44m',
        self::MAGENTA => '45m',
        self::CYAN => '46m',
        self::GREY => '47m'
    );

    /**
     * Escaped Character for Console Colour Output.
     */
    private static $TAG = "\033[";

    /**
     * Ending Escaped Character for Console Colour Output.
     */
    private static $CLOSING_TAG = "\033[0m";

    /**
     * As this class contains all static methods
     * the constructor is made private.
     */
    private function __construct()
    {
    }

    /**
     * Paint the given string with the given colours.
     *
     * @param String $string           - String to be coloured
     * @param String $textColour       - Colour of the text, default is black
     * @param String $backgroundColour - Colour of the background, default is black
     *
     * @return String - Coloured String
     */
    public static function paint($string, $textColour = Colour::BLACK, $backgroundColour = null)
    {
        $colouredString = self::$TAG . Colour::getTextColourCode($textColour);
        if ($backgroundColour) {
            $colouredString .= self::$TAG . Colour::getBackgroundColourCode($backgroundColour);
        }

        return $colouredString . $string . self::$CLOSING_TAG;
    }

    /**
     * Prints the painted String without a new line.
     *
     * @param String $string           - String to be coloured
     * @param String $textColour       - Colour of the text, default is black
     * @param String $backgroundColour - Colour of the background, default is black
     *
     * @return String - Coloured String
     */
    public static function print($string, $textColour = Colour::BLACK, $backgroundColour = null)
    {
        $str = Colour::paint($string, $textColour, $backgroundColour);
        echo $str;

        return $str;
    }

    /**
     * Prints the painted String with a new line.
     *
     * @param String $string           - String to be coloured
     * @param String $textColour       - Colour of the text, default is black
     * @param String $backgroundColour - Colour of the background, default is black
     *
     * @return String - Coloured String
     */
    public static function println($string, $textColour = Colour::BLACK, $backgroundColour = null)
    {
        $str = Colour::paint($string, $textColour, $backgroundColour);
        echo $str . PHP_EOL;

        return $str;
    }

    /**
     * Preset for displaying Error
     *
     * @param String  $string - Input String
     * @param boolean $bold   - Print in a bold text
     * @param boolean $print  - Whether to print the error of not
     *
     * @return String
     */
    public static function printError($string, $bold = false, $print = true)
    {
        if ($bold) {
            return Colour::preset($string, Colour::GREY_BOLD, Colour::RED, $print);
        } else {
            return Colour::preset($string, Colour::GREY, Colour::RED, $print);
        }
        
    }

    /**
     * Preset for displaying Information 
     *
     * @param String  $string - Input String
     * @param boolean $bold   - Print in a bold text
     * @param boolean $print  - Whether to print the error of not
     *
     * @return String
     */
    public static function printInfo($string, $bold = false, $print = true)
    {
        if ($bold) {
            return Colour::preset($string, Colour::GREEN_BOLD, null, $print);
        } else {
            return Colour::preset($string, Colour::GREEN, null, $print);
        }
    }

    /**
     * Preset for displaying Warning
     *
     * @param String  $string - Input String
     * @param boolean $bold   - Print in a bold text
     * @param boolean $print  - Whether to print the error of not
     *
     * @return String
     */
    public function printWarning($string, $bold = true, $print = true)
    {
        if ($bold) {
            return Colour::preset($string, Colour::YELLOW_BOLD, null, $print);
        } else {
            return Colour::preset($string, Colour::YELLOW, null, $print);
        }
    }

    /**
     * Returns a list of available text colour names
     * painted with themselves for reference
     *
     * @return array
     */
    public static function getAvailableTextColours($print = true)
    {
        ksort(self::$textColourCodes);
        if ($print) {
            echo "Available Text Colours ==> \n";
            foreach (self::$textColourCodes as $colour => $code) {
                Colour::println($colour, $colour);
            }
        }

        return array_keys(self::$textColourCodes);
    }

    /**
     * Returns a list of available background colour names
     * along with a patch for reference
     *
     * @returns String
     */
    public static function getAvailableBackgroundColours($print = true)
    {
        ksort(self::$backgroundColourCodes);
        $colours = array_keys(self::$backgroundColourCodes);
        if ($print) {
            $maxlen = 0;
            foreach ($colours as $colour) {
                $len = strlen($colour);
                $maxlen = ($len > $maxlen) ? $len : $maxlen;
            }
            $maxlen++;
            $paddedColours = array();
            foreach ($colours as $colour) {
                $paddedColour = $colour;
                $paddingRequired = $maxlen - strlen($colour);
                while ($paddingRequired > 0) {
                    $paddedColour .= " ";
                    $paddingRequired--;
                }
                $paddedColours[$colour] = $paddedColour;
            }
            $patchString = "          ";
            echo "Available Background Colours ==> \n";
            foreach (self::$backgroundColourCodes as $colour => $code) {
                Colour::println($paddedColours[$colour] . "  : " . Colour::paint($patchString, Colour::BLACK, $colour));
            }
        }

        return $colours;
    }

    /**
     * Converts the colour name to its code for text colour
     *
     * @param String $colour - Name of the colour
     *
     * @return String - Colour Code
     */
    private static function getTextColourCode($colour)
    {
        if (!isset(self::$textColourCodes[$colour])) {
            throw new \Exception($colour . " is not supported as a text colour");
        }

        return self::$textColourCodes[$colour];
    }

    /**
     * Converts the colour name to its code for background
     *
     * @param String $colour - Name of the colour
     *
     * @return String - Colour Code
     */
    private static function getBackgroundColourCode($colour)
    {
        if (!isset(self::$backgroundColourCodes[$colour])) {
            throw new \Exception($colour . " is not supported as a background colour");
        }

        return self::$backgroundColourCodes[$colour];
    }

    /**
     * Abstract method for various preset methods
     *
     * @param String  $string           - String to be coloured
     * @param String  $textColour       - Colour of the text, default is black
     * @param String  $backgroundColour - Colour of the background, default is black
     * @param boolean $print            - Whether to echo the string or not
     *
     * @return String
     */
    private static function preset($string, $textColour, $backgroundColour, $print)
    {
        $paintedStr = Colour::paint($string, $textColour, $backgroundColour);
        if ($print) {
            echo $paintedStr . PHP_EOL;
        }

        return $paintedStr;
    }
}