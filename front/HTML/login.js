
document.addEventListener("DOMContentLoaded", function () {
    const signUpForm = document.getElementById("loginForm");
  
    signUpForm.addEventListener("submit", async function (event) {
      event.preventDefault(); // Prevent form submission
  
      const formData = new FormData(loginForm);
      const formDataObject = {};
        formData.forEach((value, name) => {
        formDataObject[name] = value;
        });
      console.log(formDataObject)
      try {
        const response = await fetch("http://localhost:8080/dashboard/Login%20page/LoginPageDesign/back/PHP/login.php", {
          method: "POST",
          body: JSON.stringify(formDataObject),
          headers: {
            "Content-Type": "application/json",
          },
        });
  
        if (!response.ok) {
          throw new Error("Network response was not ok.");
        }
  
        const data = await response.json();
  
        if (data.error) {
          alert(data.error);
          console.log(data);

        } else {
          // Login successful, store user details in local storage
          console.log(data);
          localStorage.setItem("name", data.name);
          localStorage.setItem("email", data.email);
          // Redirect to the profile page
          window.open("http://localhost:8080/dashboard/Login%20page/LoginPageDesign/front/HTML/profile.html")
        }
      } catch (error) {
        //console.log("An error occurred:", error);
      }
    });
  });
  