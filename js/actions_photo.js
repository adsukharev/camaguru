
async function sendPhoto() {

    const url = "/main/makeMagic";
    const file = document.querySelector('[type=file]').files[0];
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

    let buffer=Uint8Array.from(atob(base64), c => c.charCodeAt(0));
    let blob=new Blob([buffer], { type: "image/jpeg" });
    let urle=URL.createObjectURL(blob);
    let img =document.createElement("img");
    img.src=urle;
    document.body.appendChild(img);

}
