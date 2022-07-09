function onJSONLSET(text){
}

function onLIKESETRESP(response){
    return response.text();
}

function setLike(event){
    console.log("metti like");
    const post_id = event.currentTarget.parentNode.dataset.postId;
    const user_id = document.querySelector("#user_id").value;
    const url = "setLike/"+post_id+"/"+user_id;
    console.log(url);
    console.log("Before Call Fetch");
    console.log(event);
    fetch(url).then(onLIKESETRESP).then(onJSONLSET(event));
    event.currentTarget.classList.toggle("liked");
    const likes = event.currentTarget.parentNode.querySelector("p");
    if(event.currentTarget.classList.contains("liked")){
        likes.textContent = parseInt(likes.textContent) + 1;
    }
    else{
        likes.textContent = parseInt(likes.textContent) - 1;
    }
}




function onJsonComment(json){
    console.log("lunghezza = " + json.length);
    if(json.length>0){
        for(let i = 0; i < json.length; i++){
            let commentSection = document.querySelector(".commentiSezione[data-post-id='" + CSS.escape(json[i].id) + "']");
            console.log(json[i].comments.comment);
            const author = document.createElement("h3");
            author.classList.add("author");
            author.textContent= json[i].comments.username;
            const commentContent = document.createElement("p");
            commentContent.textContent=json[i].comments.comment;
            const singleComment = document.createElement("div");
            singleComment.classList.add("singleComment");
            const img = document.createElement("img");
            img.classList.add("imgUser");
            img.src=json[i].comments.propic;
            /**/
            const lineImageAuthor = document.createElement("div");
            lineImageAuthor.classList.add("imgAuthor");
            lineImageAuthor.appendChild(img);
            lineImageAuthor.appendChild(author);

            /**/
            singleComment.appendChild(lineImageAuthor);
            singleComment.appendChild(commentContent);
            commentSection.appendChild(singleComment);
        }
    }

}

function onCommentResponse(response){
    return response.json();
}

function fetchComments(){
    const postIdsData = document.querySelectorAll(".like");
    for(let id of postIdsData){
        //console.log(id.dataset.postId);
        const url = "getComments/" + id.dataset.postId;
        console.log(url);
        fetch(url).then(onCommentResponse).then(onJsonComment);
    }

}


function ontxtCMT(text){
    console.log(text);
}

function onResponseCMT(response){
    return response.text();
}

function checkNComment(event){

    if(event.key === "Enter" && event.currentTarget.value.length !== 0){
        const comment = event.currentTarget.value;
        const correctComment = encodeURIComponent(comment);
            console.log(correctComment);
            const id_post = event.currentTarget.parentNode.parentNode.dataset.postId;
            const user_id = document.querySelector("input[type='hidden']").value;
            const url = "comment.php?comment=" + correctComment + "&user_id=" + user_id +"&post_id="+id_post;
            console.log(url);
            fetch(url).then(onResponseCMT).then(ontxtCMT);
            event.currentTarget.value="";
            const sezioneCommenti = document.querySelector(".commentiSezione[data-post-id='"+CSS.escape(id_post) +"']")
            const newComment = document.createElement("div");
            newComment.classList.add("singleComment");
            const author = document.createElement("h3");
            author.classList.add("author");
            author.textContent = document.querySelector("#username").value;
            const commentParagraph = document.createElement("p");
            commentParagraph.textContent = comment;
            newComment.appendChild(author);

            newComment.appendChild(commentParagraph);
            sezioneCommenti.appendChild(newComment);
    }
}


function onJsonLikes(json){
    console.log(json);
    const numLikes = document.querySelector(".like[data-post-id='"+ CSS.escape(json[0].id) +"'] p");
    console.log(numLikes);
    numLikes.textContent = json[0].numLikes;
}

function onLikeResponse(response){
    return response.json();
}

function getLikes(){
    const postIdsData = document.querySelectorAll(".like");
    for(let id of postIdsData){
        //console.log(id.dataset.postId);
        const url = "getLikes" + id.dataset.postId;
        //console.log(url);
        fetch(url).then(onLikeResponse).then(onJsonLikes);
    }
}


function onJsonSetLiked(json){
    //console.log(json);
    for(let i = 0; i<json.length; i++){
        let likeBTN = document.querySelector(".like[data-post-id='" + CSS.escape(json[i]) + "'] .likeBTN");
        likeBTN.classList.add("liked");
    }
}

function onResponseSetLiked(response){
    return response.json();
}

function setLiked(){
    fetch("isLiked").then(onResponseSetLiked).then(onJsonSetLiked);
}



function onJson(json){
    console.log(json);
    console.log(json.length)
    for(let i = 0;i<json.length;i++){
        const article= document.querySelector("article");
        const div = document.createElement("div");
        div.classList.add("post");
        //article.appendChild(div);
        const autore = document.createElement("div");
        autore.classList.add("author");
        autore.textContent = json[i].author;
        div.appendChild(autore);
        const contenuto = document.createElement("div");
        contenuto.classList.add("content");
        contenuto.textContent = json[i].content
        div.appendChild(contenuto)

        const like = document.createElement("div");
        like.classList.add("like");
        like.dataset.postId = json[i].id_post;
        //like.addEventListener("click",SetLikes);
        const likeBTN = document.createElement("div");
        likeBTN.classList.add("likeBTN");
        likeBTN.addEventListener("click",setLike);
        const likelogo = document.createElement("i");
        likelogo.classList.add("bi");
        likelogo.classList.add("bi-hand-thumbs-up");
        likeBTN.appendChild(likelogo);
        like.appendChild(likeBTN);
        const likeNUM = document.createElement("p");
        likeNUM.textContent = "0";
        like.appendChild(likeNUM);

        div.appendChild(like);

        /*comments*/
        const commentDiv = document.createElement("div");
        commentDiv.classList.add("comments");
        like.appendChild(likeNUM);

        const normalDiv1 = document.createElement("div");
        //qui metto poi i commenti
        normalDiv1.classList.add("commentiSezione");
        normalDiv1.dataset.postId = json[i].id_post;
        commentDiv.appendChild(normalDiv1);
        const inputComment = document.createElement("input");
        inputComment.classList.add("commentInput");
        inputComment.addEventListener("keydown",checkNComment);
        inputComment.type="text";
        inputComment.name="comment";
        inputComment.placeholder="commenta...";
        commentDiv.appendChild(inputComment);
        div.appendChild(commentDiv);
        div.dataset.postId = json[i].id_post;
        /* ULTIMO*/
        article.appendChild(div);


    }
    /* setLiked(); */
    fetchComments();
    getLikes();


}

function onResponse(response){
    return response.json();
}


fetch("postFetch").then(onResponse).then(onJson);

