const liensnav = document.getElementById("liensnav");
const btnnavbar = document.getElementById("btnnavbar");

btnnavbar.addEventListener("click", affichageNav);

let links = document.querySelectorAll(".linky");

links.forEach(linky => {
    linky.addEventListener("click", affichageNav);
});

function affichageNav() {
    console.log(liensnav);

    if(liensnav.style.visibility == "hidden"){
        liensnav.style.visibility = "visible"
        liensnav.style.opacity = "1"
        liensnav.style.zIndex = "9998"
    } else{
        liensnav.style.visibility = "hidden"
        liensnav.style.opacity = "0"
        liensnav.style.zIndex = "-9998"
    }

}

affichageNav()

