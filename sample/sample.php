<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
</head>

<body>

    This is a php file

    <?php

    echo "<br>This is a php script!";

    //single line comment

    /*
    multiple line comment
    */
    #this is a single line comment
    //php variables
    $name = "Juan"; //global variables
    $age = 21;
    $Age = 22;

    echo "<br>";
    echo "My Name is $name and I am $age years old";

    //global

    // function sample(){
    //     $sum = 0; //local variable
    //     global $age;//from global variable
    //     echo "Variable $age outside function is: $age";
    // }

    // sample();
    echo "<br>";

    function test()
    {
        static $x = 0;
        echo $x;
        $x++;
    }

    test();
    test();
    test();
    echo "<br>";
    print "Tis is a print function";

    //datatypes
    /*
    PHP supports the following data types:

    String
    Integer
    Float (floating point numbers - also called double)
    Boolean
    Array
    Object
    NULL
    
    PHP divides the operators in the following groups:

    Arithmetic operators
    Assignment operators
    Comparison operators
    Increment/Decrement operators
    Logical operators
    String operators
    Array operators
    Conditional assignment operators
    &&
    and
    ||
    or
    . concatenation

    */
    echo "<br>";
    $txt1 = "Hello";
    $txt2 = " world!";
    $txt1 .= $txt2;

    echo $txt1 . "<br>";
    define('NAME', 'Juan'); //constant variable

    echo NAME;
    /**
     if(){
        //codes
     }elseif(){
        codes
     }else{
        //codes
     }

switch (n) {
  case label1:
    code to be executed if n=label1;
    break;
  case label2:
    code to be executed if n=label2;
    break;
  case label3:
    code to be executed if n=label3;
    break;
  default:
    code to be executed if n is different from all labels;
} 
while(condition){
    //execution
}
do {
  code to be executed;
} while (condition is true);

for (init counter; test counter; increment counter) {
  code to be executed for each iteration;
}
//key/value
$colors = array("red", "green", "blue", "yellow");
foreach ($array as $value) {
  code to be executed;
} 
     */
    echo "<hr>";
    $colors = array("red", "green", "blue", "yellow"); //indexed array
    foreach ($colors as $value) {
        echo $value . "<br>";
    }

    $age = array("Peter" => "35", "Ben" => "37", "Joe" => "43");

    $age['Peter'] = "35";
    $age['Ben'] = "37";
    $age['Joe'] = "43";


    //multidimensional array - indexed array
    $cars = array (
        array("Volvo",22,18, "added1", 21,23), //0
        array("BMW",15,13), //1
        array("Saab",5,2), //2
        array("Land Rover",17,15),
        array("Land Rover",17,15),
        array("Land Rover",17,15),
        array("BMW",15,13),
        array("BMW",15,13)
      );

      echo $cars[3][0] . $cars[1][0] . "<hr>" . sizeof($cars) . "<br>";

      for($row = 0; $row < sizeof($cars); $row++){ //$row = 0, 1, 2

        for($col = 0; $col < sizeof($cars[$row]); $col++){ //$col = 0, 1, 2, 3
            echo $cars[$row][$col] . "<br>";
        }

      }
      //$cars[0][0]
      //$cars[0][1]
      //$cars[0][2]
      //$cars[1][0]
      //$cars[1][1]
      //$cars[1][2]
    ?>
    
</body>

</html>