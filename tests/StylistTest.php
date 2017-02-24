<?php
        /**
        * @backupGlobals disabled
        * @backupStaticAttributes disabled
        */

        require_once "src/Stylist.php";

        $server = "mysql:host=localhost:8889;dbname=hair_salon_test";
        $username = "root";
        $password = "root";
        $DB = new PDO($server, $username, $password);

        class StylistTest extends PHPUnit_Framework_TestCase
        {
            protected function tearDown()
            {
                Stylist::deleteAllStylists();
            }

            function test_saveStylist()
            {
                // Arrange
                $first_name = "John";
                $last_name = "Smith";
                $phone_number = 1234567890;
                $test_stylist = new Stylist($id, $first_name, $last_name, $phone_number);

                // Act
                $test_stylist->saveStylist();

                // Assert
                $result = Stylist::getAllStylists();
                $this->assertEquals($test_stylist, $result[0]);
            }

            function test_getAllStylists()
            {
                // Arrange
                $first_name = "John";
                $last_name = "Smith";
                $phone_number = 1234567890;
                $test_stylist = new Stylist($id, $first_name, $last_name, $phone_number);
                $test_stylist->saveStylist();

                $first_name2 = "Lucy";
                $last_name2 = "Jones";
                $phone_number2 = 1234567890;
                $test_stylist2 = new Stylist($id, $first_name2, $last_name2, $phone_number2);
                $test_stylist2->saveStylist();

                // Act
                $result = Stylist::getAllStylists();

                // Assert
                $this->assertEquals([$test_stylist, $test_stylist2], $result);
            }

            function test_deleteAllStylists()
            {
                //Arrange
                $first_name = "John";
                $last_name = "Smith";
                $phone_number = 1234567890;
                $test_stylist = new Stylist($id, $first_name, $last_name, $phone_number);
                $test_stylist->saveStylist();

                $first_name2 = "Lucy";
                $last_name2 = "Jones";
                $phone_number2 = 1234567890;
                $test_stylist2 = new Stylist($id, $first_name2, $last_name2, $phone_number2);
                $test_stylist2->saveStylist();

                //Act
                Stylist::deleteAllStylists();

                //Assert
                $result = Stylist::getAllStylists();
                $this->assertEquals([], $result);
            }

            function test_getStylistId()
            {
                //Arrange
                $id = 135;
                $first_name = "John";
                $last_name = "Smith";
                $phone_number = 1234567890;
                $test_stylist = new Stylist($id, $first_name, $last_name, $phone_number);
                $test_stylist->saveStylist();

                //Act
                $result = $test_stylist->getStylistId();

                //Assert
                $this->assertEquals(135, $result);
            }
        }
?>
