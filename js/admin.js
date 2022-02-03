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

function delet(id){

    var maRequest = new Request('ID')
}