<?php

class Locations {

    private $LocationID;
    private $Location;

    public function getLocationID() { return $this->LocationID; }
    public function getLocation() { return $this->Location; }

    public function setLocationID(int $newID) { $this->LocationID = $newID; }
    public function setLocation(string $newLoc) { $this->Location = $newLoc; }

    public function jsonSerialize(){

        $jLocation = new stdClass;

        $jLocation->LocationID = $this->LocationID;
        $jLocation->Location = $this->Location;

        return $jLocation;

    }
}
?>