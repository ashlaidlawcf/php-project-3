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

        function test_deleteAllClients()
        {
            //Arrange
            $first_name = "John";
            $last_name = "Smith";
            $phone_number = 1234567890;
            $test_client = new Client($first_name, $last_name, $phone_number, $client_id, $id);
            $test_client->save();

            $first_name = "Lucy";
            $last_name = "Jones";
            $phone_number = 1234567890;
            $test_client = new Client($first_name, $last_name, $phone_number, $client_id, $id);
            $test_client->save();

            //Act
            Client::deleteAll();

            //Assert
            $result = Client::getAll();
            $this->assertEquals([], $result);
        }

        function test_getId()
        {
            //Arrange
            $first_name = "Jim";
            $last_name = "Gonzales";
            $phone_number = 2135467764;
            $test_stylist = new Stylist($first_name, $last_name, $phone_number, $id);
            $test_stylist->save();

            $first_name = "John";
            $last_name = "Smith";
            $phone_number = 1234567890;
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($first_name, $last_name, $phone_number, $client_id, $id);
            $test_client->save();

            //Act
            $result = $test_client->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_getStylistId()
        {
            //Arrange
            $first_name = "Jim";
            $last_name = "Gonzales";
            $phone_number = 2135467764;
            $test_stylist = new Stylist($first_name, $last_name, $phone_number, $id);
            $test_stylist->save();

            $first_name = "John";
            $last_name = "Smith";
            $phone_number = 1234567890;
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($first_name, $last_name, $phone_number, $stylist_id, $id);
            $test_client->save();

            //Act
            $result = $test_client->getStylistId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $first_name = "Jim";
            $last_name = "Gonzales";
            $phone_number = 2135467764;
            $test_stylist = new Stylist($first_name, $last_name, $phone_number, $id);
            $test_stylist->save();

            $first_name = "John";
            $last_name = "Smith";
            $phone_number = 1234567890;
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($first_name, $last_name, $phone_number, $stylist_id, $id);

            //Act
            $test_client->save();

            //Assert
            $result = Client::getAll();
            $this->assertEquals($test_client, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $first_name = "Jim";
            $last_name = "Gonzales";
            $phone_number = 2135467764;
            $test_stylist = new Stylist($first_name, $last_name, $phone_number, $id);
            $test_stylist->save();

            $first_name = "John";
            $last_name = "Smith";
            $phone_number = 1234567890;
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($first_name, $last_name, $phone_number, $stylist_id, $id);
            $test_client->save();

            $first_name2 = "Megan";
            $last_name2 = "Johansson";
            $phone_number2 = 1147751222;
            $stylist_id = $test_stylist->getId();
            $test_client2 = new Client($first_name, $last_name, $phone_number, $stylist_id, $id);
            $test_client2->save();

            //Act
            $result = Client::getAll();

            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);
        }

        function test_deleteAll()
        {
           //Arrange
           $first_name = "Jim";
           $last_name = "Gonzales";
           $phone_number = 2135467764;
           $test_stylist = new Stylist($first_name, $last_name, $phone_number, $id);
           $test_stylist->save();

           $first_name = "John";
           $last_name = "Smith";
           $phone_number = 1234567890;
           $stylist_id = $test_stylist->getId();
           $test_client = new Client($first_name, $last_name, $phone_number, $stylist_id, $id);
           $test_client->save();

           $first_name2 = "Megan";
           $last_name2 = "Johansson";
           $phone_number2 = 5447751122;
           $stylist_id = $test_stylist->getId();
           $test_client2 = new Client($first_name, $last_name, $phone_number, $stylist_id, $id);
           $test_client->save();

           //Act
           Client::deleteAll();

           //Assert
           $result = Client::getAll();
           $this->assertEquals([], $result);
       }

       function test_find()
       {
            //Arrange
            $first_name = "Jim";
            $last_name = "Gonzales";
            $phone_number = 2135467764;
            $test_stylist = new Stylist($first_name, $last_name, $phone_number, $id);
            $test_stylist->save();

            $stylist_id = $test_stylist->getId();

            $first_name = "John";
            $last_name = "Smith";
            $phone_number = 1234567890;
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($first_name, $last_name, $phone_number, $stylist_id, $id);
            $test_client->save();

            $first_name2 = "Lucy";
            $last_name2 = "Jones";
            $phone_number2 = 1234567890;
            $stylist_id = $test_stylist->getId();
            $test_client2 = new Client($first_name, $last_name, $phone_number, $stylist_id, $id);
            $test_client2->save();

            //Act
            $result = Client::find($test_client->getId());

            //Assert
            $this->assertEquals($test_client, $result);
        }

        function testUpdate()
        {
            //Arrange
            $first_name = "Jim";
            $last_name = "Gonzales";
            $phone_number = 2135467764;
            $test_stylist = new Stylist($first_name, $last_name, $phone_number, $id);
            $test_stylist->save();

            $first_name = "John";
            $last_name = "Smith";
            $phone_number = 1234567890;
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($first_name, $last_name, $phone_number, $stylist_id, $id);
            $test_client->save();

            $new_first_name = "Jake";

            //Act
            $test_client->update($new_first_name, $new_last_name, $new_phone_number);
            $result = $test_client->getFirstName();

            //Assert
            $this->assertEquals("Jake", $result);
        }

        function testDeleteClient()
        {
            //Arrange
            $first_name = "John";
            $last_name = "Smith";
            $phone_number = 1234567890;
            $stylist_id = 1;
            $test_client = new Client($first_name, $last_name, $phone_number, $stylist_id, $id);
            $test_client->save();

            $first_name2 = "Lucy";
            $last_name2 = "Jones";
            $phone_number2 = 1234567890;
            $stylist_id = 1;
            $test_client2 = new Client($first_name, $last_name, $phone_number, $stylist_id, $id);
            $test_client2->save();

            //Act
            $test_client->delete();
            $result = Client::getAll();

            //Assert
            $this->assertEquals([$test_client2], $result);
        }
    }
?>
