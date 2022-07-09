function onTextPostDelete(text){
    console.log(text);
}

function onResponsePostDelete(response){
    return response.text();
}

function deletePost(event){
    console.log(event.currentTarget.dataset.postId);
    const pid = event.currentTarget.dataset.postId;
    const url = "deletePost.php?post_id="+pid;
    console.log(url);
    fetch(url).then(onResponsePostDelete).then(onTextPostDelete);
    const toDelete =event.currentTarget.parentNode;
    toDelete.remove();
}


function onJsonMyPosts(json){
    if(json.length > 0){
        console.log(json);
        for(let i = 0; i<json.length;i++) {
            const post = document.createElement("div");
            post.classList.add("post");
            post.textContent = json[i].content;
            const deleteDiv = document.createElement("div");
            deleteDiv.classList.add("delete");
            deleteDiv.dataset.postId = json[i].id;
            const xDel = document.createElement("i");
            xDel.classList.add("bi");
            xDel.classList.add("bi-x-square");
            deleteDiv.appendChild(xDel);
            deleteDiv.addEventListener("click",deletePost);
            post.appendChild(deleteDiv);
            rightBar.appendChild(post);
        }
    }
    else{
        rightBar.appendChild(noPostsDiv);
    }
}

const rightBar = document.querySelector(".RightBar");
const noPostsDiv = document.createElement("div");
noPostsDiv.classList.add("noPosts");
noPostsDiv.textContent = "nessun post";
const h1 = document.createElement("h1");
h1.textContent="I miei post:";

function onResponseMyPosts(response){
    return response.json();
}

function loadPosts(){
    rightBar.textContent = "";
    rightBar.appendChild(h1);
    fetch("myPosts.php").then(onResponseMyPosts).then(onJsonMyPosts);
}

loadPosts();
