<?php

class Car   {

    // - Attributes
    private $CarID;
    private $CarBrand;
    private $CarModel;
    private $CarYear;
    private $CarPrice;
    private $CarStatus;
    private $CarIMG;
    private $LocationID;
    
    // - Getters
    public function getCarID() : int { return $this->CarID; }

    public function getCarBrand() : string { return $this->CarBrand; }

    public function getCarModel() : string { return $this->CarModel; }

    public function getCarYear() : int  { return $this->CarYear; }

    public function getCarPrice() : float { return $this->CarPrice; }

    public function getCarStatus() : string { return $this->CarStatus; }

    public function getCarIMG() : string { return $this->CarIMG; }

    public function getLocationID() : int { return $this->LocationID; }

    // - Setters
    public function setCarID(int $newID) { $this->CarID = $newID; }

    public function setCarBrand(string $newBrand) { $this->CarBrand = $newBrand; }

    public function setCarModel(string $newModel) {$this->CarModel = $newModel; }

    public function setCarYear(int $newCarYear)  {$this->CarYear = $newCarYear; }

    public function setCarPrice(float $newPrice)  { $this->CarPrice = $newPrice; }

    public function setCarStatus(string $newStatus) { $this->CarStatus = $newStatus; }

    public function setCarIMG(string $newIMG)  { $this->CarIMG = "https://storage.googleapis.com/myphppics/uploads/".$newIMG; }

    public function setNewCarIMG(string $newIMG)  { $this->CarIMG = $newIMG; }

    public function setLocationID(int $newLocation) { $this->LocationID = $newLocation; }

    // - Serialize to JSON
    public function jsonSerialize() {

        $jCar = new stdClass;

        $jCar->CarID = $this->CarID;
        $jCar->CarBrand = $this->CarBrand;
        $jCar->CarModel = $this->CarModel;
        $jCar->CarYear = $this->CarYear;
        $jCar->CarPrice = $this->CarPrice;
        $jCar->CarStatus = $this->CarStatus;
        $jCar->CarIMG = $this->CarIMG;
        $jCar->LocationID = $this->LocationID;

        return $jCar;

    }

}

?>