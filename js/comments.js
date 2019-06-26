
window.sendComment = async function sentComment(textId) {
    const url = "/gallery/addComment";
    const comment = document.getElementById(textId).value;
    const id = textId.replace("textarea-", '');
    const formData = new FormData();

    formData.append("id", id);
    formData.append("comment", comment);

    try {
        let res = await fetch(url, {
            method: 'POST',
            body: formData
        });
        const author = await res.text();
        console.log(author);
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