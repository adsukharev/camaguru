import {getToken} from "./webcam.js";

window.likePhoto = async function likePhoto(id) {
   const url = "/gallery/incLikes";
   let buttonValue = document.getElementById(id).value;
   const formData = new FormData();
    const token = getToken();
   formData.append("id", id);
   formData.append("like", buttonValue);
   formData.append('csrf', token);
   try{
       await fetch(url, {
           method: 'POST',
           body: formData
       });
        incLike(id, buttonValue);
   }
    catch (e) {
        console.log(e.message);
    }
};

function incLike(id, buttonValue) {

    buttonValue = Number(buttonValue) + 1;
    document.getElementById(id).value = buttonValue;
    document.getElementById(id).innerText = "Like " + buttonValue;
}
