
async function startVideo() {

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
}

async function takeScreenshot() {
    const canvas = document.createElement('canvas');
    const video = document.querySelector('video');

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0);
    // let canvasData = canvas.toDataURL('image/jpeg');
    canvas.toBlob( function (blob) {
        sendPhoto(blob);
    });
}

function uploadPhoto() {

    const file = document.querySelector('[type=file]').files[0];
    sendPhoto(file);
}

async function sendPhoto(file) {
    const url = "/main/makeMagic";
    const formData = new FormData();
    formData.append('photo', file);

    try {
        let res = await fetch(url, {
            method: 'POST',
            body: formData
        });
        let text = await res.text();
        fetchAddImage(text);
    }
    catch (e) {
        console.log(e.message);
    }
}

function fetchAddImage(base64) {

    let buffer = Uint8Array.from(window.atob(base64), c => c.charCodeAt(0));
    let blob = new Blob([buffer], { type: "image/jpeg" });
    let url = URL.createObjectURL(blob);
    let img = document.createElement("img");
    img.src = url;
    document.getElementById('screens').appendChild(img);

}


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