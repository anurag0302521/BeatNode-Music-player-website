const audio=document.querySelector("audio");
const playPauseBtn=document.querySelector("#play-pause");
const prevBtn=document.querySelector("#previous");
const nextBtn=document.querySelector("#next");
const songList=document.querySelector(".song-list");

const favSongList=document.querySelector(".fav-song-list");

const title=document.querySelector("#title");
const record=document.querySelector(".record");
const volSlider=document.querySelector(".slider");

const lowVolume = document.querySelector("#low-volume");

const current_duration = document.querySelector("#start-time");
const processBarWrapper = document.querySelector(".process-bar");
const processBar = document.querySelector("#process-bar-update");
const total_duration = document.querySelector("#end-time");


let songArray = [];
let songHeading = '';
let songIndex = 0;
let isPlaying = false;


let favSongArray = [];
let favSongHeading = '';
let favSongIndex = 0;


function loadAudio(){
    audio.src = songArray[songIndex];

    let songListItems = songList.getElementsByTagName('li');
    songHeading = songListItems[songIndex].getAttribute('data-name');
    title.innerText = songHeading;

    //Highlight
    for(i=0;i<songListItems.length;i++){
        songListItems[i].classList.remove('active');
    }

    songList.getElementsByTagName('li')[songIndex].classList.add('active');
}


function loadSongs(){
    let songs = songList.getElementsByTagName('li');
    for(i=0;i<songs.length;i++){
        songArray.push(songs[i].getAttribute('data-src'));
    }
    
    loadAudio();
}

loadSongs(); 

function playAudio(){
    audio.play();
    playPauseBtn.querySelector('i.fas').classList.remove('fa-play');
    playPauseBtn.querySelector('i.fas').classList.add('fa-pause');
    isPlaying = true;
    record.classList.add('record-animation');
}


function pauseAudio(){
    audio.pause();
    playPauseBtn.querySelector('i.fas').classList.remove('fa-pause');
    playPauseBtn.querySelector('i.fas').classList.add('fa-play');
    isPlaying = false;
    record.classList.remove('record-animation');
}


function nextSong(){
    songIndex++;
    if(songIndex>songArray.length - 1){
        songIndex = 0;
    }
    loadAudio();
    playAudio();
}


function previousSong(){
    songIndex--;
    if(songIndex < 0){ 
        songIndex = songArray.length - 1;
    }
    loadAudio();
    playAudio();
}


playPauseBtn.addEventListener('click', function(){

    if(isPlaying){
        pauseAudio();
    }else{
        playAudio();
    }
}, false);


nextBtn.addEventListener('click', function(){
    nextSong();
}, false);


prevBtn.addEventListener('click', function(){
    previousSong();
}, false);


songList.addEventListener('click', function(e){
    songIndex = e.target.closest('li').getAttribute('data-index');
    loadAudio();
    playAudio();
}, false);


volSlider.addEventListener('input', function(){
    audio.volume = volSlider.value / 100;
    if(audio.volume < 0.02){
        lowVolume.classList.remove('fa-volume-down');
        lowVolume.classList.add('fa-volume-mute');
    }else{
        lowVolume.classList.remove('fa-volume-mute');
        lowVolume.classList.add('fa-volume-down');
    }
   
}, false);


if(favSongList != null){
    
//Favorite song list start
function loadFavAudio(newIndex){
    audio.src = favSongArray[newIndex];

    let songListItems = favSongList.getElementsByTagName('li');
    songHeading = songListItems[newIndex].getAttribute('data-name');
    title.innerText = songHeading;

    //Highlight
    for(i=0;i<songListItems.length;i++){
        songListItems[i].classList.remove('active');
    }

    favSongList.getElementsByTagName('li')[newIndex].classList.add('active');
    playAudio();
}


function loadFavSongs(newIndex){
    let songs = favSongList.getElementsByTagName('li');
    for(i=0;i<songs.length;i++){
        favSongArray.push(songs[i].getAttribute('data-src'));
    }
    
    loadFavAudio(newIndex);
}

favSongList.addEventListener('click', function(e){
    favSongArray = [];
    let newIndex = e.target.closest('li').getAttribute('data-index');
    loadFavSongs(newIndex);

}, false);

//Favorite song list end
}

audio.addEventListener('ended', function(){
    nextSong();
});







//update process bar

processBar.addEventListener('mousedown', function(event){
    var clickedPosition = event.clientX - event.target.offsetLeft;
    audio.currentTime = (clickedPosition/event.target.offsetWidth) * audio.duration;
});
// //progress js work
audio.addEventListener("timeupdate", function(e){
    const currentTime = e.target.currentTime;
    const totalDuration = e.target.duration;
    let progressWidth = (currentTime/totalDuration)*100;
    // processBar.style.width = `${progressWidth}%`;
    processBar.value = `${progressWidth}`;
    processBar.max = 100;

    audio.addEventListener('loadeddata', function(){
        
        let musicTotalTime = processBarWrapper.querySelector("#end-time");

        //update song total duration
        let audioDuration = audio.duration;
        let totalMin = Math.floor(audioDuration/60);
        let totalSec = Math.floor(audioDuration%60);
        if(totalSec < 10){
            totalSec = `0${totalSec}`;
        }
        musicTotalTime.innerText = `${totalMin}:${totalSec}`;

        
    });

        //update song current duration
        let musicCurrentTime = processBarWrapper.querySelector("#start-time");
        let currentMin = Math.floor(currentTime/60);
        let currentSec = Math.floor(currentTime%60);
        if(currentSec < 10){
            currentSec = `0${currentSec}`;
        }
        musicCurrentTime.innerText = `${currentMin}:${currentSec}`;
    
});



function changeType() {
    let eye = document.getElementById("password");
    let type = eye.type;
    if (type == "password") {
        eye.setAttribute('type', 'text');
    } else {
        eye.setAttribute('type', 'password');

    }
}



// Disk change code

let imgArray = ['beat.png','beat2.png','beat3.png','beat4.png'];
let imgInd = 0;

nextBtn.addEventListener('click',function (){
    if(imgInd >= imgArray.length){
        imgInd = 0;
    }
        
    record.src = "image/" + imgArray[imgInd];
    imgInd++;
});

prevBtn.addEventListener('click',function (){
    if(imgInd >= imgArray.length){
        imgInd = 0;
    }
        
    record.src = "image/" + imgArray[imgInd];
    imgInd++;
});
