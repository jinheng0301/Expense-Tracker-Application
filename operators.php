<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operators</title>
</head>

<body>
    <?php
    $num1 = 1;
    echo "$num1 value is" . $num1;
    $num2 = &$num1;
    $num2 = 20;
    echo "<br />$num1 value is " . $num1;
    echo "<br />$num2 value is " . $num1;
    ?>
    <!-- 
     1 value is1
20 value is 20
20 value is 20
-->

    <?php
    $x = 30;
    $y = 20;
    $z = 15;
    if ($x > $y && $x > $z)
        echo "<br><br>$x is greater than $y and $z";
    if ($x > $z || $y > $z)
        echo "<br>$z is the smallest";
    ?>

    <!-- 30 is greater than 20 and 15
15 is the smallest -->

    <?php
    $a = 10;
    $b = $a++;
    echo "<br><br>Value of $b=$a++ is: " . $b . "<br />";
    echo "Value of $a is :" . $a . "<br />";
    echo "Pre - increment<br />";
    $a = 10;
    $b = $a++;
    echo "Value of $b=$++a is: " . $b . "<br />";
    echo "Value of $a is : " . $a . "<br><br>";
    ?>

    <!-- Value of 10=11++ is: 10
Value of 11 is :11
Pre - increment
Value of 10=$++a is: 10
Value of 11 is : 11 -->

    <?php
    $a = 5;
    $b = 12;

    // a) $a + $b
    echo $a + $b . "<br>"; // Output: 17

    // b) $a - $b
    echo $a - $b . "<br>"; // Output: -7

    // c) ($b - $a) * $a
    echo ($b - $a) * $a . "<br>"; // Output: (12 - 5) * 5 = 7 * 5 = 35

    // d) $b % $a
    echo $b % $a . "<br>"; // Output: 12 % 5 = 2 (remainder when 12 is divided by 5)

    // e) $b / $a
    echo $b / $a . "<br><br>"; // Output: 12 / 5 = 2.4
    ?>

    <?php
    $a = 10;
    $b = 15;
    $c = '15';
    $d = 'My String';
    $e = 'Not My String';

    // $a != $b
    echo ($a != $b) . "\n"; // Output: 1 (True because 10 is not equal to 15)

    // $a == $b
    echo ($a == $b) . "\n"; // Output: (False because 10 is not equal to 15)

    // $b == $c
    echo ($b == $c) . "\n"; // Output: 1 (True because 15 is equal to '15' when type is ignored)

    // $b === $c
    echo ($b === $c) . "\n"; // Output: (False because 15 (integer) is not strictly equal to '15' (string))

    // $a < $b
    echo ($a < $b) . "\n"; // Output: 1 (True because 10 is less than 15)

    // $e > $d
    echo ($e > $d) . "\n"; // Output: 1 (True because 'Not My String' comes after 'My String' lexicographically)

    // ($c - $b) != 0
    echo (($c - $b) != 0) . "\n"; // Output: (False because '15' - 15 is 0, and 0 is equal to 0)
    ?>

    <?php
    $a = 5;

    echo "<br><br>Pre-increment $a: " . ++$a . "<br>";
    echo "Post-increment $b: " . $b++ . "<br>";
    echo "Check curent values, \$a = $a and \$b = $b<br>"

    ?>

    <!-- Pre-increment 5: 6
Post-increment 10: 10
Check curent values, $a = 6 and $b = 11 -->

</body>

</html>