import {getToken} from "./webcam";

window.sendComment = async function sentComment(textId) {
    const url = "/gallery/addComment";
    const comment = document.getElementById(textId).value;
    if (!comment){
        return ;
    }
    const id = textId.replace("textarea-", '');
    const formData = new FormData();
    const token = getToken();

    formData.append("id", id);
    formData.append("comment", comment);
    formData.append('csrf', token);

    try {
        let res = await fetch(url, {
            method: 'POST',
            body: formData
        });
        const author = await res.text();
        createNewComment(author, comment, textId);
    }
    catch (e) {
        console.log(e.message);
    }

};

function createNewComment(author, comment, textId) {

    let article = document.createElement("article");
    let p = document.createElement("p");
    p.innerHTML = author + ": " + comment;
    article.appendChild(p);
    document.getElementById(textId).parentNode.append(article);
}
