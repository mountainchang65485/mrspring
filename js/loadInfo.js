var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function(){
    if( xhr.readyState == 4){
      if( xhr.status == 200 ){
          showBranchInfo(xhr.responseText);
      }else{
        alert( xhr.status );
      }
    }
}

var url = "php/loadInfo.php";
xhr.open("Get", url, true);
xhr.send( null );

function showBranchInfo(jsonStr){
  var branch = JSON.parse(jsonStr);
  //分店資訊初始化
  document.querySelector(".firstBranch_d .firstBranch_p").innerHTML = branch[0].branchName.substr(0,2);
  document.querySelector(".secondBranch_d .secondBranch_p").innerHTML = branch[2].branchName.substr(0,2);
  document.querySelector(".thirdBranch_d .thirdBranch_p").innerHTML = branch[1].branchName.substr(0,2);

  document.querySelector(".firstBranch_d").setAttribute("roomPrice",branch[0].branchPrice);
  document.querySelector(".secondBranch_d").setAttribute("roomPrice",branch[2].branchPrice);
  document.querySelector(".thirdBranch_d").setAttribute("roomPrice",branch[1].branchPrice);

  document.querySelector(".firstBranchText .branchText_title_text").innerHTML = branch[0].branchName;
  document.querySelector(".firstBranchText .branchText_addr p").innerHTML = branch[0].branchAddress;
  document.querySelector(".firstBranchText .branchText_tel p").innerHTML = branch[0].branchTel;

  document.querySelector(".secondBranchText .branchText_title_text").innerHTML = branch[2].branchName;
  document.querySelector(".secondBranchText .branchText_addr p").innerHTML = branch[2].branchAddress;
  document.querySelector(".secondBranchText .branchText_tel p").innerHTML = branch[2].branchTel;

  document.querySelector(".thirdBranchText .branchText_title_text").innerHTML = branch[1].branchName;
  document.querySelector(".thirdBranchText .branchText_addr p").innerHTML = branch[1].branchAddress;
  document.querySelector(".thirdBranchText .branchText_tel p").innerHTML = branch[1].branchTel;
  // console.log(branch[0].branchName);
  // console.log(branch);
  // console.log(branch[1].branchName);
  // console.log(branch[1]);
  // console.log(branch[2].branchName);
  // console.log(branch[2]);
}