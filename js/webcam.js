const constraints = {
    video: {
        width: 250,
        height: 250
    }
};

async function getMedia() {
    let stream = null;
    const video = document.querySelector('video');
    try {
        stream = await navigator.mediaDevices.getUserMedia(constraints);
        video.srcObject = stream;

    } catch(err) {
        console.log(err.message);
    }
}
