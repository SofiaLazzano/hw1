function onResponse(response){
   
    return response.json();
    
}

function onJson(json){
    console.log(json);
        for(i=json.length-1; i >= 0; i--){

            const content = document.createElement('section');
            content.classList.add('content');
           


            const element = document.createElement('div');   
            element.classList.add('element');
            content.appendChild(element);
          

            const user = document.createElement('div');
            user.classList.add('user');                     
            element.appendChild(user);

            const description = document.createElement('p');
            description.classList.add('description');         
            description.textContent = json[i].description;
            const img2 = document.createElement('img');
            img2.src = json[i].img;
            img2.classList.add('img2');
            user.appendChild(img2);
            element.appendChild(description);
            
            
            const div2 = document.createElement('div');
    
            const username = document.createElement('div');
            username.textContent = "@"+json[i].username;
       
            username.classList.add('AUser');
           
            div2.appendChild(username);

            

            const div = document.createElement('div');
            div.classList.add('imgAuthor');
            const img = document.createElement('img');
            img.src = "immagini/thor.png";
            div.appendChild(img);
                                                                                            

            const div3 = document.createElement('div');
            div3.classList.add('actions');
            const button1 = document.createElement('button');
            button1.textContent = "";
            button1.classList.add('like');
            button1.dataset.postid =json[i].id;

            const numLike = document.createElement('div');
            numLike.textContent = json[i].nlikes;
            numLike.dataset.postid = json[i].id;

           
           if(json[i].post){
            
            button1.classList.remove('unliked');
            button1.classList.add('liked');
            button1.removeEventListener('click', Like);
            button1.addEventListener('click', Unlike);
         
           
            
        } else {
            button1.classList.remove('liked');
            button1.classList.add('unliked');
            button1.removeEventListener('click', Unlike);
            button1.addEventListener('click', Like);
      
        }

           
           div3.appendChild(button1);
        
            div3.appendChild(numLike);
           element.appendChild(div);
           element.appendChild(div2);
           element.appendChild(div3);

           document.querySelector('.central').appendChild(element);
        }
}

fetch("posts.php").then(onResponse).then(onJson)



function Like(event){

    const b = event.currentTarget;

    b.classList.remove('unliked');
    b.classList.add('liked');
    b.removeEventListener('click', Like);
    b.addEventListener('click', Unlike);
    fetch('like.php?postid=' + (parseInt(b.dataset.postid))).then(onResponse).then(onJs);


}

function Unlike(event){
    const b = event.currentTarget;
    b.classList.remove('liked');
    b.classList.add('unliked');
    b.removeEventListener('click', Unlike);
    b.addEventListener('click', Like);
    fetch('Unlike.php?postid=' + (parseInt(b.dataset.postid))).then(onResponse).then(onJs);
}

function onJs(json){
console.log(json);
const array = document.querySelectorAll('.actions div');
for(let res of array){
    if(res.dataset.postid == json.id){
        res.textContent = json.nlikes;
    }
}
}