
import {getToken} from "./webcam";

function manageObjects(data) {

    const pathImage = data[0];
    const base64 = data[1];

    const image = createImage(base64);
    const button = createButton(pathImage);
    addObjects(image, button, pathImage);
}

function createButton(pathImage) {

    const button = document.createElement("button");
    button.innerHTML = "Delete";
    button.addEventListener ("click", function() {
        const result = confirm("Confirm for deleting image above");
        if (result){
            deleteImage(pathImage);
        }
    });
    return button;
}

function createImage(base64) {

    let buffer = Uint8Array.from(window.atob(base64), c => c.charCodeAt(0));
    let blob = new Blob([buffer], { type: "image/jpeg" });
    let url = URL.createObjectURL(blob);
    let img = document.createElement("img");
    img.src = url;

    return img;
}

function addObjects(image, button, pathImage) {

    const div = document.createElement("div");
    div.setAttribute("id", pathImage);

    document.getElementById('screens').appendChild(div);
    document.getElementById(pathImage).appendChild(image);
    document.getElementById(pathImage).appendChild(button);
}

window.deleteImage = async function deleteImage(pathImage) {

    const url = "/main/deleteImage";
    const formData = new FormData();
    const token = getToken();
    formData.append('imageToDelete', pathImage);
    formData.append('csrf', token);
    try {
        await fetch(url, {
            method: 'POST',
            body: formData
        });
        deleteObjects(pathImage);
    }
    catch (e) {
        console.log(e.message);
        return 0;
    }

};

function deleteObjects(pathImage) {

    const element = document.getElementById(pathImage);
    element.parentNode.removeChild(element);
}

export {manageObjects};
