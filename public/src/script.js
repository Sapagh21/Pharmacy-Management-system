
// Handling 'Forgot Password' pop-up
let forgotpass = document.getElementById("forgot");
let Card_hide_Page = document.querySelector(".forgot-pass-card");
let card_content = document.querySelector(".card-content");
if (forgotpass) {

    forgotpass.addEventListener("click", function () {
        Card_hide_Page.style.display = "flex";
    });


    function hideCard(card) {
        if (window.getComputedStyle(card).display == "flex") {
            card.style.display = "none";
        }
    }

    //box is hidden if esc key is stroke 
    document.addEventListener("keydown", function (event) {
        if (event.key == "Escape") {
            hideCard(Card_hide_Page);
        }
    });

    // or mouse is clicked on anything in the page other than the "forgot password" or the pop-up(x not included)
    document.addEventListener("mousedown", function (event) {
        if ((event.target != card_content) && (event.target != document.querySelector(".card-content span")) && (event.target != forgotpass)) {
            hideCard(Card_hide_Page);
        }
    });


}


// Log in button Hover effect

let sub_butn = document.querySelector("button");       //  button itself
let btn_txt = document.querySelector("button span");    //  text within
let btn_hover = document.querySelector("button div"); //  slider

sub_butn.addEventListener("mouseover", function (event) {
    // btn_hover.style.transform = `translate(0 , 0)`;
    btn_hover.style.width = `100%`;
    btn_txt.style.color = "var(--main   -color)";
});

sub_butn.addEventListener("mouseout", function (event) {
    btn_hover.style.width = "";
    btn_txt.style.color = "";
});

