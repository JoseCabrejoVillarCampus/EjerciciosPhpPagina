//?Introduction
//?The way we measure time is kind of messy. We have 60 seconds in a minute, and 60 minutes in an hour. This comes from ancient Babylon, where they used 60 as the basis for their number system. We have 24 hours in a day, 7 days in a week, and how many days in a month? Well, for days in a month it depends not only on which month it is, but also on what type of calendar is used in the country you live in.
//?
//?What if, instead, we only use seconds to express time intervals? Then we can use metric system prefixes for writing large numbers of seconds in more easily comprehensible quantities.
//?
//?A food recipe might explain that you need to let the brownies cook in the oven for two kiloseconds (that's two thousand seconds).
//?Perhaps you and your family would travel to somewhere exotic for two megaseconds (that's two million seconds).
//?And if you and your spouse were married for a thousand million seconds, you would celebrate your one gigasecond anniversary.
<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);

function from(DateTimeImmutable $date): DateTimeImmutable
{
    $gigaSecond = new DateInterval('PT1000000000S');
    $futureDate = $date->add($gigaSecond);
    
    return $futureDate;
}
?>