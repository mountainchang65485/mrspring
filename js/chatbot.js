//開關
document.getElementById('close_btn').onclick = function () {
    document.getElementById('chatbotTextWrap').style.display = 'none';
}
document.getElementById('monkeyBot').onclick = function () {
    var chat = document.getElementById('chatbotTextWrap');
    if (chat.style.display == 'none') {
        chat.style.display = 'block';
    } else {
        chat.style.display = 'none';
    }
}

//輸入文字
//內容第一層overflow
var content = document.getElementById("chatBot-content");
//內容第二層(包p)
var container = document.getElementById("chatBot-container");
//卷軸維持在最底端
function chatBotScrollTo(container, content) {
    //找到對話框的高度，並設定變數
    let h = container.offsetHeight;
    //送出的同時滾動卷軸到最後一筆留言
    content.scrollTo({
        top: h,
        left: 0,
        behavior: "smooth"
    });
}

//抓輸入的input
var chatUserText = document.getElementsByClassName("chatBot-text")[0];

document.getElementById('chatBot-search').addEventListener("click", function () {
    // 檢查input有沒有內容
    if (chatUserText.value == "") {
        return;
    }
    // 取使用者輸入文字
    var userText = document.getElementsByClassName('chatBot-text')[0].value;
    //創造元素
    var node = document.createElement("p");
    var clear = document.createElement("div");
    //定義元素樣式
    node.className = "chatBot-content-B";
    clear.className = "clearfix";
    //創造節點
    var textnode = document.createTextNode(userText);
    node.appendChild(textnode);
    document.getElementById("chatBot-container").appendChild(node);
    document.getElementById("chatBot-container").appendChild(clear);
});



//Ajax============================================================================================================

//撈資料
function $id(id) {
    return document.getElementById(id);
}

$id("chatBot-search").addEventListener("click", getUserText);

function bottalk(jsonStr) {
    var reply = JSON.parse(jsonStr);//轉成字串

    console.log(reply);
    //創造元素
    var nodeA = document.createElement("p");
    var clear = document.createElement("div");
    //定義元素樣式
    nodeA.className = "chatBot-content-A";
    clear.className = "clearfix";
    //創造節點
    var textnodeA = document.createTextNode(reply);
    nodeA.appendChild(textnodeA);
    document.getElementById("chatBot-container").appendChild(nodeA);
    document.getElementById("chatBot-container").appendChild(clear);
    //清空輸入區
    chatUserText.value = "";
    //卷軸更新
    chatBotScrollTo(container, content);
}

function getUserText() {
    var xhr = new XMLHttpRequest();
    xhr.onload = function () {//網頁load完才執行，資料有回傳的話就執行
        if (xhr.status == 200) {
            bottalk(xhr.responseText);
        } else {
            alert(xhr.status);
        }
    }

    var url = "./php/chatBot.php?chatBot=" + document.getElementById("chatBot-text").value;
    xhr.open("Get", url, true);//格式、要讀取的網址、同步與非同步 //get(讀取資料)、post(傳送資料 )
    xhr.send(null);
}

//tag

function bottag(jsonStr) {
    var tag = JSON.parse(jsonStr);//轉成字串
    console.log(tag);
    for(var i=0 ; i<tag.length; i++){
        //創造元素
        var keytag = document.createElement("li");
        //定義元素樣式
        keytag.className = "keyword-li";
        //創造節點
        var textnodeB = document.createTextNode(tag[i]);
        keytag.appendChild(textnodeB);
        document.getElementById("chatBot-keyword").appendChild(keytag);
        // document.getElementsByClassName("keyword-li")[i] = document.createElement("id");
        // document.getElementsByClassName("keyword-li")[i].id = "keyword-li";
    }
    var clear = document.createElement("div");
    clear.className = "clearfix";
    document.getElementById("chatBot-keyword").appendChild(clear);
}


    var xhr = new XMLHttpRequest();
    xhr.onload = function () {//網頁load完才執行，資料有回傳的話就執行
        if (xhr.status == 200) {
            bottag(xhr.responseText);
            //按TAG
            for(var i=0; i<document.getElementsByClassName("keyword-li").length;i++){
                document.getElementsByClassName("keyword-li")[i].addEventListener("click", putText);

                function putText(){
                    var tagText = this.innerText;
                    document.getElementsByClassName('chatBot-text')[0].value = tagText;
                    document.getElementById('chatBot-search').click();
                }
            }
        } else {
            alert(xhr.status);
        }
    }

    var url = "./php/chatTag.php";
    xhr.open("Get", url, true);//格式、要讀取的網址、同步與非同步 //get(讀取資料)、post(傳送資料 )
    xhr.send(null);

