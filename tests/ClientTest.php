<?php
        /**
        * @backupGlobals disabled
        * @backupStaticAttributes disabled
        */

        require_once "src/Client.php";
        require_once "src/Stylist.php";

        $server = "mysql:host=localhost:8889;dbname=hair_salon_test";
        $username = "root";
        $password = "root";
        $DB = new PDO($server, $username, $password);

        class ClientTest extends PHPUnit_Framework_TestCase
        {
            protected function tearDown()
            {
                Stylist::deleteAll();
                Client::deleteAll();
            }

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

            function test_getId()
            {
                //Arrange
                $id = null;
                $first_name = "Jim";
                $last_name = "Gonzales";
                $phone_number = 2135467764;
                $test_stylist = new Stylist($id, $first_name, $last_name, $phone_number);
                $test_stylist->save();

                $first_name = "John";
                $last_name = "Smith";
                $phone_number = 1234567890;
                $stylist_id = $test_stylist->getId();
                $test_client = new Client($id, $first_name, $last_name, $phone_number, $stylist_id);

                //Act
                $result = $test_client->getId();

                //Assert
                $this->assertEquals(true, is_numeric($result));
            }

            function test_getStylistId()
            {
                //Arrange
                $id = null;
                $first_name = "Jim";
                $last_name = "Gonzales";
                $phone_number = 2135467764;
                $test_stylist = new Stylist($id, $first_name, $last_name, $phone_number);
                $test_stylist->save();

                $first_name = "John";
                $last_name = "Smith";
                $phone_number = 1234567890;
                $stylist_id = $test_stylist->getId();
                $test_client = new Client($id, $first_name, $last_name, $phone_number, $stylist_id);

                //Act
                $result = $test_client->getStylistId();

                //Assert
                $this->assertEquals(true, is_numeric($result));
            }

            function test_save()
            {
                //Arrange
                $id = null;
                $first_name = "Jim";
                $last_name = "Gonzales";
                $phone_number = 2135467764;
                $test_stylist = new Stylist($id, $first_name, $last_name, $phone_number);
                $test_stylist->save();

                $first_name = "John";
                $last_name = "Smith";
                $phone_number = 1234567890;
                $stylist_id = $test_stylist->getId();
                $test_client = new Client($id, $first_name, $last_name, $phone_number, $stylist_id);

                //Act
                $test_client->save();

                //Assert
                $result = Client::getAll();
                $this->assertEquals($test_client, $result[0]);
            }

            function test_getAll()
            {
                //Arrange
                $id = null;
                $first_name = "Jim";
                $last_name = "Gonzales";
                $phone_number = 2135467764;
                $test_stylist = new Stylist($id, $first_name, $last_name, $phone_number);
                $test_stylist->save();

                $first_name = "John";
                $last_name = "Smith";
                $phone_number = 1234567890;
                $stylist_id = $test_stylist->getId();
                $test_client = new Client($id, $first_name, $last_name, $phone_number, $stylist_id);

                $first_name2 = "Megan";
                $last_name2 = "Johansson";
                $phone_number2 = 5447751122;
                $stylist_id = $test_stylist->getId();
                $test_client2 = new Client($id, $first_name2, $last_name2, $phone_number2, $stylist_id);

                //Act
                $result = Client::getAll();

                //Assert
                $this->assertEquals([$test_client, $test_client2], $result);
            }

            function test_deleteAll()
           {
               //Arrange
               $id = null;
               $first_name = "Jim";
               $last_name = "Gonzales";
               $phone_number = 2135467764;
               $test_stylist = new Stylist($id, $first_name, $last_name, $phone_number);
               $test_stylist->save();

               $first_name = "John";
               $last_name = "Smith";
               $phone_number = 1234567890;
               $stylist_id = $test_stylist->getId();
               $test_client = new Client($id, $first_name, $last_name, $phone_number, $stylist_id);

               $first_name2 = "Megan";
               $last_name2 = "Johansson";
               $phone_number2 = 5447751122;
               $stylist_id = $test_stylist->getId();
               $test_client2 = new Client($id, $first_name2, $last_name2, $phone_number2, $stylist_id);

               //Act
               Client::deleteAll();

               //Assert
               $result = Client::getAll();
               $this->assertEquals([], $result);
           }

            function test_find()
            {
                //Arrange
                $id = null;
                $first_name = "Jim";
                $last_name = "Gonzales";
                $phone_number = 2135467764;
                $test_stylist = new Stylist($id, $first_name, $last_name, $phone_number);
                $test_stylist->save();

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
                $result = Client::find($test_client->getId());

                //Assert
                $this->assertEquals($test_client, $result);
            }

            function testUpdateFirstName()
            {
                //Arrange
                $first_name = "John";
                $last_name = "Smith";
                $phone_number = 1234567890;
                $test_client = new Client($id, $first_name, $last_name, $phone_number);
                $test_client->save();

                $new_first_name = "Jake";

                //Act
                $test_client->updateFirstName($new_first_name);

                //Assert
                $this->assertEquals("Jake", $test_client->getFirstName());
            }

            function testDeleteClient()
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
                $test_client->delete();

                //Assert
                $this->assertEquals([$test_client2], Client::getAll());
            }
        }

?>
