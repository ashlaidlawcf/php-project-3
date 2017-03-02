<?php
    class Stylist
    {
        private $first_name;
        private $last_name;
        private $phone_number;
        private $id;

        function __construct($first_name, $last_name, $phone_number, $id = null)
        {
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->phone_number = $phone_number;
            $this->id = $id;
        }

        function getId()
        {
            return $this->id;
        }

        function setFirstName($new_first_name)
        {
            $this->first_name = (string) $new_first_name;
        }

        function getFirstName()
        {
            return $this->first_name;
        }

        function setLastName($new_last_name)
        {
            $this->last_name = (string) $new_last_name;
        }

        function getLastName()
        {
            return $this->last_name;
        }

        function setPhoneNumber($new_phone_number)
        {
            $this->phone_number = $new_phone_number;
        }

        function getPhoneNumber()
        {
            return $this->phone_number;
        }

        function save()
        {
            $GLOBALS["DB"]->exec("INSERT INTO stylists (first_name, last_name, phone_number) VALUES ('{$this->getFirstName()}', '{$this->getLastName()}', {$this->getPhoneNumber()});");
            $this->id = $GLOBALS["DB"]->lastInsertId();
        }

        static function getAll()
        {
            $returned_stylists = $GLOBALS["DB"]->query("SELECT * FROM stylists;");
            $stylists = array();

            foreach($returned_stylists as $stylist) {
                $first_name = $stylist["first_name"];
                $last_name = $stylist["last_name"];
                $phone_number = $stylist["phone_number"];
                $id = $stylist["id"];
                $test_stylist = new Stylist($first_name, $last_name, $phone_number, $id);
                array_push($stylists, $test_stylist);
            }

            return $stylists;
        }

        static function deleteAll()
        {
            $GLOBALS["DB"]->exec("DELETE FROM stylists;");
        }

        static function find($search_id)
        {
            $found_stylist = null;
            $stylists = Stylist::getAll();

            foreach($stylists as $stylist) {
                $stylist_id = $stylist->getId();
                if ($stylist_id == $search_id) {
                    $found_stylist = $stylist;
                }
            }

            return $found_stylist;
        }

        function update($new_first_name, $new_last_name, $new_phone_number)
        {
            if ($new_first_name) {
                $GLOBALS['DB']->exec("UPDATE stylists SET first_name = '{$new_first_name}' WHERE id = {$this->getId()};");
                $this->setFirstName($new_first_name);
            }

            if ($new_last_name) {
                $GLOBALS['DB']->exec("UPDATE stylists SET last_name = '{$new_last_name}' WHERE id = {$this->getId()};");
                $this->setLastName($new_last_name);
            }

            if ($new_phone_number) {
                $GLOBALS['DB']->exec("UPDATE stylists SET phone_number = {$new_phone_number} WHERE id = {$this->getId()};");
                $this->setPhoneNumber($new_phone_number);
            }
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM clients WHERE stylist_id = {$this->getId()};");
        }

        function getClients()
        {
            $clients = array();
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$this->getId()};");

            foreach($returned_clients as $client) {
                $first_name = $client["first_name"];
                $last_name = $client["last_name"];
                $phone_number = $client["phone_number"];
                $stylist_id = $client["stylist_id"];
                $id = $client["id"];
                $new_client = new Client($first_name, $last_name, $phone_number, $stylist_id, $id);
                array_push($clients, $new_client);
            }

            return $clients;
        }
    }
?>
