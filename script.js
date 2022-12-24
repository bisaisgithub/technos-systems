

(() => {
  "use strict";

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll(".needs-validation");
  const password = document.getElementById("password");
  const confirmpassword = document.getElementById("confirmpassword");
  // Loop over them and prevent submission
  Array.from(forms).forEach((form) => {
    form.addEventListener(
      "submit",
      (event) => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        } else if (password.value !== confirmpassword.value) {
          event.preventDefault();
          event.stopPropagation();
          var el = document.createElement("div");
          el.classList.add('alert');
          el.classList.add('alert-danger');
          el.innerHTML = "Password Mismatch";
          var referenceNode = document.getElementById("alreadyhave");
          referenceNode.parentNode.insertBefore(el, referenceNode.nextSibling);
        }

        form.classList.add("was-validated");
      },
      false
    );
  });
})();

