<?php
    class Stylist
    {
        private $id;
        private $first_name;
        private $last_name;
        private $phone_number;

        function __construct($id = null, $first_name, $last_name, $phone_number)
        {
            $this->id = $id;
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->phone_number = $phone_number;
        }

        function getId()
        {
            return $this->id;
        }

        function setFirstName($new_first_name)
        {
            $this->first_name = $new_first_name;
        }

        function getFirstName()
        {
            return $this->first_name;
        }

        function setLastName($new_last_name)
        {
            $this->last_name = $new_last_name;
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
                $id = $stylist["id"];
                $first_name = $stylist["first_name"];
                $last_name = $stylist["last_name"];
                $phone_number = $stylist["phone_number"];
                $test_stylist = new Stylist($id, $first_name, $last_name, $phone_number);
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
            $stylists = Stylist::getAllStylists();

            foreach($stylists as $stylist) {
                $stylist_id = $stylist->getId();
                if ($stylist_id == $search_id) {
                    $found_stylist = $stylist;
                }
            }

            return $found_stylist;
        }

        function updateFirstName($new_first_name)
        {
            $GLOBALS['DB']->exec("UPDATE stylists SET first_name = '{$new_first_name}' WHERE id = {$this->getStylistId()};");
            $this->setFirstName($new_first_name);
        }

        function updateLastName($new_last_name)
        {
            $GLOBALS['DB']->exec("UPDATE stylists SET last_name = '{$new_last_name}' WHERE id = {$this->getStylistId()};");
            $this->setLastName($new_last_name);
        }

        function updatePhoneNumber($new_number)
        {
            $GLOBALS['DB']->exec("UPDATE stylists SET phone_number = {$new_number} WHERE id = {$this->getStylistId()};");
            $this->setPhoneNumber($new_number);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getStylistId()};");
        }
    }
?>
