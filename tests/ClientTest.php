<?php
        /**
        * @backupGlobals disabled
        * @backupStaticAttributes disabled
        */

        require_once "src/Client.php";

        $server = "mysql:host=localhost:8889;dbname=hair_salon_test";
        $username = "root";
        $password = "root";
        $DB = new PDO($server, $username, $password);

        class ClientTest extends PHPUnit_Framework_TestCase
        {
            function test_save()
            {
                // Arrange
                $first_name = "John";
                $last_name = "Smith";
                $phone_number = 1234567890;
                $test_client = new Client($id, $first_name, $last_name, $phone_number);

                // Act
                $test_client->save();

                // Assert
                $result = Client::getAll();
                $this->assertEquals($test_client, $result[0]);
            }
        }

?>
