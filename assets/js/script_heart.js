let hearts = document.querySelectorAll(".heart");
let likes = document.querySelectorAll(".like");
let plop = 0;


hearts.forEach(element => {
    
    element.addEventListener("click",liker);
});

likes.forEach(element2 => {
    
    element2.addEventListener("click",liker);
});

function liker() {

    
    if (plop == 0){
        
        this.style =
        `
        animation: favori 1s steps(28);
        background-position: -2800px 0;
        ` 
        plop++
        
    }else{
        
        this.style =
        `
        background-position: 0 0;
        ` 
        plop--
        
    }

    setInterval(function(){ document.forms["myform"].submit();}, 1100)

}

