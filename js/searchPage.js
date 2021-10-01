function recup() {
  var trierPar = document.querySelector("#tri").value;
  var leForm = document.querySelector("#myForm input[name='modeTri']");//on met la value ligne 5 pour pas que se soit une copie

  if (trierPar != null){ 
    leForm.value = trierPar;  
    document.querySelector("#myForm").submit();// renvoyer le form
  }
}