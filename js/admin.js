function finessAutofill(struc_item) {
  const finess_number = struc_item.querySelector(".struc-finess").value;
  if (finess_number.length !== 9) return;
  httpRequest("finess.php?finess=" + finess_number, "GET", true, function () {
      if (this.readyState === XMLHttpRequest.DONE) {
        if (this.status === 200) {
          const data = JSON.parse(this.responseText);
          const name = data.rslongue || data.rs || "";
          fillField(struc_item.querySelector(".struc-name"), name, false);
          const address = `${data.numvoie || "?"} ${data.typvoie || ""} ${
            data.voie || ""
          }, ${data.ligneacheminement || ""}`;
          fillField(struc_item.querySelector(".struc-addr"), address, false);
          updateStructures();
        }
      }
    }
  );
}
        // rajoue de thomas //

function httpRequest(
    method = "GET",
    is_async = true,
    callback = function() {}
) {
    let req =
        (window.XMLHttpRequest) ?
        new XMLHttpRequest() :
        new ActiveXObject("Microsoft.XMLHTTP");
  req.onreadystatechange = callback;
    req.open(method, url, is_async);
    req.send();
}

        // fonction suppression d'utilisasteur //

function deleteUser(user_id) {
  httpRequest("delete-user.php?user-id=" + user_id, "POST", true, function() {
    if (this.readyState === XMLHttpRequest.DONE) {
      if (this.status === 200) {
        
      }
    }
  });
}



function delet(id){

    var maRequest = new Request('ID')
}



fetch(url).then(function(response) {
  return response.json();
}).then(function(data) {
  console.log(data);
}).catch(function() {
  console.log("Booo");
});