
import {manageObjects} from "./actions_photo.js";

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

window.takeScreenshot = async function takeScreenshotReal() {

     const canvas = document.createElement('canvas');
     const video = document.querySelector('video');

     canvas.width = video.videoWidth;
     canvas.height = video.videoHeight;
     canvas.getContext('2d').drawImage(video, 0, 0);
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
    let token = getToken();
    const url = "/main/makeMagic";
    const formData = new FormData();
    formData.append('photo', file);
    formData.append('meme', radio);
    formData.append('csrf', token);

    try {
        let res = await fetch(url, {
            method: 'POST',
            body: formData,
        });
        let data = await res.json();
        manageObjects(data);
    }
    catch (e) {
        console.log(e.message);
    }
}

function getToken() {
    const token = document.cookie.split(';');
    let neededToken;
    for (let i = 0; i < token.length; i++){
        if (token[i].indexOf("my_token") !== -1)
            neededToken = token[i];
    }

    const pos = neededToken.indexOf('=');
    const value = neededToken.substring(pos + 1);
    let clearToken = decodeURIComponent(value);
    return clearToken;
}

export {getToken};