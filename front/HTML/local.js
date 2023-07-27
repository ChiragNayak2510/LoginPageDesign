function setValue(){
    document.getElementsByName("name").setValue(localStorage.setItem("name"));
    document.getElementsByName("email").setValue(localStorage.setItem("email"));
    document.getElementsByName("contact").setValue(localStorage.setItem("contact"));
    document.getElementsByName("age").setValue(localStorage.setItem("age"));
}