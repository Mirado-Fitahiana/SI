var form_1 = document.querySelector(".form_1");
var form_2 = document.querySelector(".form_2");
var form_3 = document.querySelector(".form_3");

var form_1_btns = document.querySelector(".form_1_btns");
var form_2_btns = document.querySelector(".form_2_btns");
var form_3_btns = document.querySelector(".form_3_btns");

var form_1_next_btn = document.querySelector(".form_1_btns .btn_next");
var form_2_back_btn = document.querySelector(".form_2_btns .btn_back");
var form_2_next_btn = document.querySelector(".form_2_btns .btn_next");
var form_3_back_btn = document.querySelector(".form_3_btns .btn_back");


var form_2_progressbar = document.querySelector(".form_2_progress");
var form_3_progressbar = document.querySelector(".form_3_progress");



form_1_next_btn.addEventListener("click", function () {
    form_1.style.display = "none";
    form_2.style.display = "block";

    form_1_btns.style.display = "none";
    form_2_btns.style.display = "flex";

    form_2_progressbar.classList.add("active")

});

form_2_back_btn.addEventListener("click", function () {
    form_1.style.display = "block";
    form_2.style.display = "none";
    form_3.style.display = "none";

    form_1_btns.style.display = "flex";
    form_2_btns.style.display = "none";

    form_2_progressbar.classList.remove("active")

});
form_2_next_btn.addEventListener("click", function () {

    form_2.style.display = "none";
    form_3.style.display = "block";

    form_2_btns.style.display = "none";
    form_3_btns.style.display = "flex";

    form_3_progressbar.classList.add("active");
});


form_3_back_btn.addEventListener("click", function () {
    form_2.style.display = "block";
    form_3.style.display = "none";


    form_2_btns.style.display = "flex";
    form_3_btns.style.display = "none";
    // form_3_btns.style.display = "block";

    form_3_progressbar.classList.remove("active")

});

// function checkPass() {
//     var input1 = document.getElementById("password").value;
//     var input2 = document.getElementById("confirm_password").value;
//     var put1 = document.getElementById("password");
//     var put2 = document.getElementById("confirm_password");
//     var errreur = document.getElementById("error");
//     if (input1 != input2 || input1 == '' || input2 == '') {
//         put1.style.borderColor = "red";
//         put2.style.borderColor = "red";
//         errreur.style.display = "flex";
//         // return false;
//     } else {

//         errreur.style.display = "none";

//         form_2_next_btn.addEventListener("click", function () {

//             form_2.style.display = "none";
//             form_3.style.display = "block";

//             form_2_btns.style.display = "none";
//             form_3_btns.style.display = "flex";

//             form_3_progressbar.classList.add("active");
//         });
//         put1.style.borderColor = "green";
//         put2.style.borderColor = "green";
//         // return true;
//     }
// }
//https://youtu.be/oWH-r2r8VSI
