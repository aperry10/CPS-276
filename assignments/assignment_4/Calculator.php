<?php
class Calculator
{
    public function calc($operator = null, $number1 = null, $number2 = null)
    {
        if (func_num_args() != 3) {
            return "<p>Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.</p>";
        }

        if (!is_string($operator) ||
            !(is_int($number1) || is_float($number1)) ||
            !(is_int($number2) || is_float($number2)) ||
            !in_array($operator, array("+", "-", "*", "/"))) {
            return "<p>Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.</p>";
        }

        if ($operator == "+") {
            $answer = $number1 + $number2;
        } elseif ($operator == "-") {
            $answer = $number1 - $number2;
        } elseif ($operator == "*") {
            $answer = $number1 * $number2;
        } elseif ($operator == "/") {
            if ($number2 == 0) {
                $answer = "cannot divide a number by zero";
            } else {
                $answer = $number1 / $number2;
            }
        }

        return "<p>The calculation is $number1 $operator $number2. The answer is $answer.</p>";
    }
}
?>