function validateForm() {

    var x = document.forms["addForm"]["brand"].value;
    if (x == "") {
      alert("Name must be filled out");
      return false;
    }

}