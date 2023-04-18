//(裡面放css一樣的tag format)
// wishList is a array
var wishList = document.querySelectorAll('.likeBtn');


//當愛心點下去的時候，就check cookie
//如果沒有願望單cookie，就新增一個空array
//把pid push進去 setcookie
//如果有的話，就轉換成array 把pid puch進去
//array都要轉成文字才可以塞餅乾
// setcookie upsate

// arr是餅乾的array，會共用所以要放外面
let arr;
for (let i = 0; i < wishList.length; i++) {

    // press btn and check cookie
    wishList[i].addEventListener("click", function () {
        //console.log("Btn works");

        var productID = wishList[i].dataset.productId;
        //console.log(productID);
        var wishCookie = getCookie("wishCookie");

        if (wishCookie == "") {
            console.log("if", productID);
            arr = [];
            arr.push(productID);

            let dataSet = new Set(arr)
            //console.log([...dataSet])
            //join()轉文字＋給逗號分開
            let text = [...dataSet].join(",");

            setCookie("wishCookie",text, 365);

            //JS 換右上數字
            // let likeNum = [...dataSet].length;
            // console.log(likeNum);

            // let changeNum = document.getElementById("likeNum");
            // changeNum.innerHTML=likeNum;

        } else {
            console.log("else", productID);
            //拆解wishCookie的array
            //split(',')意思是以逗號為界線分開，然後變成一個array
            arr = wishCookie.split(',');
            //是array才可以push
            if(productID){
                arr.push(productID);
            }
            
            let dataSet = new Set(arr)
            //console.log([...dataSet])
            //join()轉文字＋給逗號分開
            let text = [...dataSet].join(",");

            setCookie("wishCookie",text, 365);

        }

    })

}

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookie() {
    let user = getCookie("username");
    if (user != "") {
        alert("Welcome again " + user);
    } else {
        user = prompt("Please enter your name:", "");
        if (user != "" && user != null) {
            setCookie("username", user, 365);
        }
    }
}


//unlike

var newWishList = document.querySelectorAll('.unlikeBtn');


for (let n = 0; n < newWishList.length; n++) {

    newWishList[n].addEventListener("click", function () {
        var newProductID = newWishList[n].dataset.productId;
        //console.log(newProductID);

        var wishCookie = getCookie("wishCookie");
        //console.log(wishCookie);

        if(wishCookie != ""){

            let newArr = wishCookie.split(',');
            console.log("newArr",newArr);

            let index = newArr.indexOf(newProductID);
            console.log("index",index);

            newArr.splice(index,1);
            console.log('newArr',newArr);

            let newDataSet = new Set(newArr)
            //console.log([...dataSet])
            //join()轉文字＋給逗號分開
            let newText = [...newDataSet].join(",");

            setCookie("wishCookie", newText, 365);

            location.reload();
        }
        

})
}