function setImage(event){
    const profilepic = document.querySelector("#propic");
    profilepic.src=event.currentTarget.src;
    changedFlag = 1;
}

function onJson(json){
    //console.log(json);
    let results = json.results;
    modal.textContent = "";
    for(let i = 0; i < 5; i++){
        console.log(results[i].urls.small);
        const item = document.createElement("div");
        item.classList.add("item");
        const img = document.createElement("img");
        img.src = results[i].urls.small;
        img.addEventListener("click",setImage);
        item.appendChild(img);
        modal.appendChild(item);
    }
}

function onResponse(response){
    return response.json();
}

function searchImages(event){
    if(event.key === "Enter"){
        if(event.currentTarget.value.length === 0)
            inputSearch.classList.add("error");
        else{
            const q = encodeURIComponent(event.currentTarget.value); /* ricorda di mettere che può cercare l'utente*/
            console.log(q);
            fetch("phpProfilePicture.php?q="+q).then(onResponse).then(onJson);
        }

    }
}



function toggleEditor(){
    container.classList.toggle("hidden");
}

function onResponsePIC_CHANGE(response){
    console.log(response.status);
}

function saveChanges(){
    if(changedFlag === 1){
        let imgSrc = document.querySelector("#propic").src;
        console.log(imgSrc);
        let url ="changeProfilePicture.php?urlImg=" + imgSrc;
        console.log(url);
        fetch(url).then(onResponsePIC_CHANGE);
    }
    else{
        console.log("can't change");
    }
}

let changedFlag = 0;

const modal = document.querySelector(".modal");
const container = document.querySelector("#container");

const editBtn = document.querySelector(".overlay");
editBtn.addEventListener("click",toggleEditor);

const inputSearch = document.querySelector("#search");
inputSearch.addEventListener("keydown",searchImages);

const saveBtn = document.querySelector("#save");
saveBtn.addEventListener("click",saveChanges);
