function format_activation_code() { // formatage du code 
  let e = document.querySelector("#code");// on recup l'id
  e.value = e.value.toUpperCase(); // on met tous en MAJUSCULE
  e.value = e.value.replaceAll(" ", ""); // on enlève les espace 
}

function check_activation_code() {
  const exp = new RegExp("^[A-Z0-9]{8}$");
  format_activation_code();
  let e = document.querySelector("#code");
  if (exp.test(e.value)) {
    e.classList.remove("invalid");
    hide_error_msg("general");
    return true;
  } else {
    e.classList.add("invalid");
    show_error_msg(
      "general",
      "Veuillez entrer un code à huit caractères alphanumériques"
    );
    return false;
  }
}

function check_form() {
  const a = check_activation_code();
  return a;
}
// on appelle la fonction format... dans check ...
