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

            function test_deleteAllClients()
            {
                //Arrange
                $first_name = "John";
                $last_name = "Smith";
                $phone_number = 1234567890;
                $test_stylist = new Client($id, $first_name, $last_name, $phone_number);
                $test_stylist->save();

                $first_name2 = "Lucy";
                $last_name2 = "Jones";
                $phone_number2 = 1234567890;
                $test_stylist2 = new Client($id, $first_name2, $last_name2, $phone_number2);
                $test_stylist2->save();

                //Act
                Client::deleteAll();

                //Assert
                $result = Client::getAll();
                $this->assertEquals([], $result);
            }

            function test_getClientId()
            {
                //Arrange
                $id = 1;
                $first_name = "John";
                $last_name = "Smith";
                $phone_number = 1234567890;
                $test_client = new Client($id, $first_name, $last_name, $phone_number);

                //Act
                $result = $test_client->getId();

                //Assert
                $this->assertEquals(1, $result);
            }

            function test_find()
            {
                //Arrange
                $first_name = "John";
                $last_name = "Smith";
                $phone_number = 1234567890;
                $test_client = new Client($id, $first_name, $last_name, $phone_number);
                $test_client->save();

                $first_name2 = "Lucy";
                $last_name2 = "Jones";
                $phone_number2 = 1234567890;
                $test_client2 = new Client($id, $first_name2, $last_name2, $phone_number2);
                $test_client2->save();

                //Act
                $id = $test_client->getId();
                $result = Client::find($id);

                //Assert
                $this->assertEquals($test_client, $result);
            }
        }

?>
