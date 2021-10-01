function valid_credit_card(value) {
  // Accept only digits, dashes or spaces
  if (/[^0-9-\s]+/.test(value)) return false;

  // The Luhn Algorithm. It's so pretty.
  let nCheck = 0,
    bEven = false;
  value = value.replace(/\D/g, "");

  for (var n = value.length - 1; n >= 0; n--) {
    var cDigit = value.charAt(n),
      nDigit = parseInt(cDigit, 10);

    if (bEven && (nDigit *= 2) > 9) nDigit -= 9;

    nCheck += nDigit;
    bEven = !bEven;
  }

  return nCheck % 10 == 0;
}
function check_cb() {
  let lenom = document.querySelector("input[name='CB']");
  let erroCB = document.querySelector("span[name='errorCB']");
  if (valid_credit_card(lenom.value) == 0) {
    lenom.style.border = "2px solid red";
    return false;
  } else {
    lenom.style.border = "";
    return true;
  }
}