/*function show_img() {
  document.querySelector("#upload").src =
    "file:///" + document.querySelector("#file-input").value;
}
*/
function show_img() {
  let input = document.querySelector("#file-input");
  
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      let img = document.querySelector("#upload");
      img.src = e.target.result;
      img.classList.add('show_img');
      //img.style.border = "2px red solid";
      //img.style.margin = 0;
    };

    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

