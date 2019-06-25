
import {manageObjects} from "./actions_photo";

window.startVideo = async function startVideo() {

    const constraints = {
        video: {
            width: 250,
            height: 250
        }
    };
    let stream = null;

    const video = document.querySelector('video');
    try {
        stream = await navigator.mediaDevices.getUserMedia(constraints);
        video.srcObject = stream;

    } catch (err) {
        console.log(err.message);
    }
};

window.takeScreenshot = async function takeScreenshot() {
     const canvas = document.createElement('canvas');
     const video = document.querySelector('video');

     canvas.width = video.videoWidth;
     canvas.height = video.videoHeight;
     canvas.getContext('2d').drawImage(video, 0, 0);
     // let canvasData = canvas.toDataURL('image/jpeg');
     canvas.toBlob(function (blob) {
         sendPhoto(blob);
     });
 };

window.uploadPhoto = function uploadPhoto() {

    const file = document.querySelector('[type=file]').files[0];
    sendPhoto(file);
};

async function sendPhoto(file) {

    const radio = document.querySelector('input[name="mem"]:checked').value;
    const url = "/main/makeMagic";
    const formData = new FormData();
    formData.append('photo', file);
    formData.append('meme', radio);
    try {
        let res = await fetch(url, {
            method: 'POST',
            body: formData
        });
        let data = await res.json();

        manageObjects(data);
    }
    catch (e) {
        console.log(e.message);
    }
}



// export {sendPhoto, uploadPhoto};

//
// async function stopVideo(){
//     const video = document.querySelector('video');
//     try {
//         let stream = await navigator.mediaDevices.getUserMedia({audio: false, video: true});
//         stream.getVideoTracks()[0].stop();
//     }
//     catch (err) {
//         console.log(err.message);
//     }
//     // video.src=""
//
//
// }