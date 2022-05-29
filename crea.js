const form = document.querySelector('#musicForm').addEventListener('submit', OnMusic);
const form2 = document.querySelector('#photoForm').addEventListener('submit', OnPhotos);

const musica = document.querySelector('.music');
musica.addEventListener('click', MusicForm);

const foto = document.querySelector('.photos');
foto.addEventListener('click', PhotosForm);



function MusicForm(){
    const formM = document.querySelector('#musicForm');
    formM.classList.remove('hidden');
    const formP= document.querySelector('#photoForm');
    formP.classList.add('hidden');
   
    const select = document.querySelector('.music_results');
    select.classList.remove('hidden');
    const select2= document.querySelector('.photos_results');
    select2.classList.add('hidden');

}

function PhotosForm(){
    const formM = document.querySelector('#musicForm');
    formM.classList.add('hidden');
    const formP= document.querySelector('#photoForm');
    formP.classList.remove('hidden');
   

    const select = document.querySelector('.music_results');
    select.classList.add('hidden');
    const select2= document.querySelector('.photos_results');
    select2.classList.remove('hidden');
}


function OnMusic(event){
    
    const text = document.querySelector('#music');
    const text_value = encodeURIComponent(text.value);
    fetch("spotify.php?q="+ text_value).then(onResponse).then(onJson); 
    event.preventDefault();
}

function onResponse(response){
    console.log(response);
    return response.json();
}

function onerror(error){
    console.log(error);
}

function onJson(json){
    console.log('JSON ricevuto');
    console.log(json);
    const library = document.querySelector('.music_results');
    library.innerHTML = '';

    for(i = 0; i < 20; i++){
        
        const textarea = document.createElement('textarea');
        textarea.classList.add('hidden');
        const link = document.createElement('a');
        link.href = 'homepage.php';
        const button = document.createElement('button');
        button.classList.add('hidden');
        button.textContent='Pubblica';
        const results = json.tracks.items[i];
        console.log(results);
       const title = results.name;
        const selected_image = results.album.images[0].url;
        const album = document.createElement('div');
        album.classList.add('album');
        const img = document.createElement('img');
        img.src = selected_image;
       
        link.appendChild(button);
        album.appendChild(img);

        album.appendChild(textarea);
        album.appendChild(link);
        library.appendChild(album);
    }
    
const selected_music = document.querySelectorAll('.album');
for(const select of selected_music){
select.addEventListener('click', SelectSpotify);
    }
}

let img;
let textarea;

function SelectSpotify(event){
    const area = event.currentTarget;

    img = area.querySelector('img');

    const button = area.querySelector('button');
    button.classList.remove('hidden');
    
    textarea = area.querySelector('textarea');
    textarea.classList.remove('hidden');

    button.addEventListener('click', PubSpotify);


}


function PubSpotify(){

    fetch('pubblica_spotify.php?i=' + img.src + '&d=' + textarea.value);
}


 
function OnPhotos(event){
const api_key ='26910272-59b46b3f2d3942d3027df90e0';
    event.preventDefault();

    const text = document.querySelector('#photos');
    const text_value = encodeURIComponent(text.value);
    console.log('Eseguo la ricerca: ' + text_value);
    const req = 'https://pixabay.com/api/?key=' + api_key +'&q=' + text_value;
    fetch(req).then(onResponse, onerror).then(OnJsonPhotos);
}



function OnJsonPhotos(json){
    console.log(json);

    const text = document.querySelector('.photos_results');
    text.innerHTML = '';
    const results = json.hits;
    
    
    
    for(let result of results){
        
        const link = document.createElement('a');
        link.href = 'homepage.php';
        const textarea = document.createElement('textarea');
        textarea.classList.add('hidden');

        const button = document.createElement('button');
        button.classList.add('hidden');
        button.textContent='Pubblica';
        const div = document.createElement('div');
        div.classList.add('sezionealbum');
        
        const img = document.createElement('img');
        img.src = result.previewURL;

        link.appendChild(button);
        div.appendChild(img);
        text.appendChild(div);
        div.appendChild(textarea);
        div.appendChild(link);
    }

    const selected_image = document.querySelectorAll('.sezionealbum');
    for(const select of selected_image){
    select.addEventListener('click', SelectPhotos);
        }

}

    function SelectPhotos(event){
        const area = event.currentTarget;
        img = area.querySelector('img');
       
        const button = area.querySelector('button');
        button.classList.remove('hidden');
        button.classList.add('pubblica');
        

        button.addEventListener('click', PubPhoto);
       
    }


function PubPhoto(){
    fetch('pubblica_photo.php?i=' + img.src);
}



