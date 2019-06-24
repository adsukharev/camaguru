
const constraints = {
    video: {
        width: 250,
        height: 250
    }
};


async function startVideo() {
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
    let img = document.createElement('img');

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0);
    img.src = canvas.toDataURL("image/png");

}

// async function takeScreenshot() {
//     const canvas = document.createElement('canvas');
//     const video = document.querySelector('video');
//     let img = document.createElement('img');
//
//     canvas.width = video.videoWidth;
//     canvas.height = video.videoHeight;
//     canvas.getContext('2d').drawImage(video, 0, 0);
//     img.src = canvas.toDataURL("image/png");
//
//     // document.getElementById("screens").appendChild(img);
// }



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