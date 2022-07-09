function onMyCMT_Json(json){
    console.log(json);
    if(json.length === 0){
        const noCmts = document.createElement("p");
        noCmts.textContent = "i tuoi commenti appariranno qui";
        commentsDiv.appendChild(noCmts);
    }
    else{
        for(let i = 0; i<json.length;i++){
            const comment = document.createElement("div");
            comment.classList.add("comment");
            const p = document.createElement("p");
            p.textContent = json[i].comment;
            const deleteBtn = document.createElement("div");
            deleteBtn.classList.add("delete");
            deleteBtn.addEventListener("click",deleteComment);
            const xIcon = document.createElement("i");
            xIcon.classList.add("bi");
            xIcon.classList.add("bi-x-square");
            deleteBtn.dataset.postId = json[i].id;
            deleteBtn.appendChild(xIcon);
            comment.appendChild(p);
            comment.appendChild(deleteBtn);
            commentsDiv.appendChild(comment);
        }
    }
}

function onMyCMT_Resp(response){
   return response.json();
}

fetch("getMyComments").then(onMyCMT_Resp).then(onMyCMT_Json);

function onTextCommentDelete(text){
    console.log(text);
}

function onResponseCommentDelete(response){
    return response.text();
}

function deleteComment(event){
    console.log(event.currentTarget.dataset.postId);
    const pid = event.currentTarget.dataset.postId;
    const url = "deleteMyComment/"+pid;
    console.log(url);
    fetch(url).then(onResponseCommentDelete).then(onTextCommentDelete);
    const toDelete = event.currentTarget.parentNode;
    toDelete.remove();
}

const commentsDiv = document.querySelector(".commentsDiv");