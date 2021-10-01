leap_year = (year) => (year % 4 == 0 && year % 100 != 0) || year % 400 == 0;

function gen_birth_years() {
  let year_select = document.getElementById("birth-year");
  const max = new Date().getUTCFullYear() - 1;
  const min = max - 120;
  let html = "";
  for (let i = max; i >= min; i--)
    html += "<option value='" + i + "'>" + i + "</option>";
  year_select.innerHTML = html;
}




function gen_birth_days() {
  let day_select = document.getElementById("birth-day");
  const month_select = document.getElementById("birth-month");
  const year_select = document.getElementById("birth-year");
  const year = parseInt(year_select.value);

  const days = {
    1: 31,
    2: leap_year(year) ? 29 : 28,
    3: 31,
    4: 30,
    5: 31,
    6: 30,
    7: 31,
    8: 31,
    9: 30,
    10: 31,
    11: 30,
    12: 31,
  };

  let old_value;
  if (day_select.value.length != 0) old_value = day_select.value;
  else old_value = "1";

  const max = days[parseInt(month_select.value)];
  if (parseInt(old_value) > max) old_value = max.toString();
  let html = "";
  for (let i = 1; i <= max; i++)
    html += "<option value='" + i + "'>" + i + "</option>";
  day_select.innerHTML = html;
  day_select.value = old_value;
}

function check_family_name() {
  let lenom = document.querySelector("input[name='nom']");
  lenom.value = lenom.value.charAt(0).toUpperCase()+lenom.value.slice(1);
  let erroName = document.querySelector("span[name='errorName']");
  if (lenom.value == "") {
    lenom.style.border = "2px solid red";
    return false;
  } else {
    lenom.style.border = "";
    return true;
  }
}

function check_name() {
  let lenom2 = document.querySelector("input[name='prenom']");
  lenom2.value = lenom2.value.charAt(0).toUpperCase() + lenom2.value.slice(1);
  if (lenom2.value == "") {
    lenom2.style.border = "2px solid red";
    return false;
  } else {
    lenom2.style.border = "";
    return true;
  }

}

function check_email() {
  let Email = document.querySelector("input[name='email']");
  Email.value = Email.value.toLowerCase();
  if (Email.value == "") {
    Email.style.border = "2px solid red";
    return false;
  } else {
    Email.style.border = "";
    return true;
  }
}

function check_tel() {
  let tel = document.querySelector("input[name='tel']");
  const exp = new RegExp("^\\d{10}$");
  tel.value = tel.value.replaceAll(" ", "");
  if (exp.test(tel.value)) {
    tel.style.border = "";
    return true;
  } else {
    tel.style.border = "2px solid red";
    return false;
  }
}

function check_birth_date() {
  const current_date = new Date();

  let birth_day = document.querySelector("select[name='day']").value;
  let birth_month = document.querySelector("select[name='month']").value;
  let birth_year = document.querySelector("select[name='year']").value;
  let red_square = document.querySelectorAll("#birth_date select");

  birth_day = parseInt(birth_day);
  birth_month = parseInt(birth_month);
  birth_year = parseInt(birth_year);
  birth_date = new Date(birth_year, birth_month, birth_day);

  const diff_date = new Date(current_date.getTime() - birth_date.getTime());
  const age = diff_date.getUTCFullYear() - 1970;

  if (age < 18) {
    red_square.forEach(function (x) {
      x.style.border = "2px solid red";
    });
    return false;
  } else {
    red_square.forEach(function (x) {
      x.style.border = "";
    });
    return true;
  }
}

function check_pwd() {
  let pwd1 = document.querySelector("input[name='pwd1']");

  if (pwd1.value == "") {
    pwd1.style.border = "2px solid red";
    return false;
  }
  else {
    pwd1.style.border = "";
    return true;
  }
}

function check_pwd2() {
  let pwd1 = document.querySelector("input[name='pwd1']");
  let pwd2 = document.querySelector("input[name='pwd2']");
  let err_pwd = document.querySelector("span#pwderror");
  if (pwd2.value === "") {
    pwd2.style.border = "2px solid red";
    return false;
  }
  if (pwd1.value != pwd2.value) {
    pwd2.style.border = "2px solid red";
    err_pwd.style.opacity = 1;
    return false;
  } else {
    pwd1.style.border = "";
    pwd2.style.border = "";
    err_pwd.style.opacity = 0;
    return true;
  }
}

function check_sex() {
  let element = document.querySelector('input[name="hf"]:checked');
  if (!element) {
    //pour chaque element dans la liste querySelectorAll on executte la onction anonyme qui definie la bordure rouge
    document.querySelectorAll(".H_F>div").forEach(function (z) {
      z.style.border = "2px solid red";
    });
    return false;
  } else {
    document.querySelectorAll(".H_F>div").forEach(function (z) {
      z.style.border = "";
    });
    return true;
  }
}

function checker() {
  const a = check_family_name();
  const b = check_name();
  const c = check_email();
  const d = check_tel();
  const e = check_birth_date();
  const f = check_pwd();
  const g = check_pwd2();
  const h = check_sex();

  return a && b && c && d && e && f && g && h;
}
function checker2() {
  const a = check_email();
  const b = check_pwd();
  
  return a && b;
}



// execute before loading //
function init() {
  gen_birth_years();
  gen_birth_days();
}
