let allbtn = document.querySelectorAll('.btn')

let allmodal = document.querySelectorAll('.popup')

let allbtnferme = document.querySelectorAll('.btnferme')


allbtn.forEach( btn => {

        btn.addEventListener('click', histoire)
})

allbtnferme.forEach( modal => {

        modal.addEventListener('click', closehistoire)
})

function histoire(){

        for( i = 0; i < allbtn.length ; i++){

                var fenetre = allmodal[i]
                
                if( this.dataset.modal == fenetre.id ){
                        
                        fenetre.classList.add('active')

                }
                
        }       
        
}


function closehistoire() {

        for( i = 0; i < allbtn.length ; i++){

                var fenetre = allmodal[i]
                fenetre.classList.remove('active')
                
        }


}