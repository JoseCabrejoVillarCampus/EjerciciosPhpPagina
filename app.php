//?Instructions
//?Calculate the Hamming Distance between two DNA strands.
//?
//?Your body is made up of cells that contain DNA. Those cells regularly wear out and need replacing, which they achieve by dividing into daughter cells. In fact, the average human body experiences about 10 quadrillion cell divisions in a lifetime!
//?
//?When cells divide, their DNA replicates too. Sometimes during this process mistakes happen and single pieces of DNA get encoded with the incorrect information. If we compare two strands of DNA and count the differences between them we can see how many mistakes occurred. This is known as the "Hamming Distance".
//?
//?We read DNA using the letters C,A,G and T. Two strands might look like this:
//?
//?GAGCCTACTAACGGGAT
//?CATCGTAATGACGGCCT
//?^ ^ ^ ^ ^ ^^
//?They have 7 differences, and therefore the Hamming Distance is 7.
//?
//?The Hamming Distance is useful for lots of things in science, not just biology, so it's a nice phrase to be familiar with :
//?
//?The Hamming distance is only defined for sequences of equal length, so an attempt to calculate it between sequences of different lengths should not work. The general handling of this situation (e.g., raising an exception vs returning a special value) may differ between languages.
//?
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

function distance(string $strandA, string $strandB): int
{
    if (strlen($strandA) !== strlen($strandB)) {
        throw new \InvalidArgumentException("DNA strands must be of equal length.");
    }

    $distance = 0;
    $length = strlen($strandA);

    for ($i = 0; $i < $length; $i++) {
        if ($strandA[$i] !== $strandB[$i]) {
            $distance++;
        }
    }

    return $distance;
}
?>