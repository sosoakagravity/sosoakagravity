//require('./bootstrap');


var card = new Vue({
  el: '#root',
  data: {
    message: ''
  },
  
  methods: {
    add_column: function (user_id) {
  
// Make a request for a user with a given ID
axios.get('/addcolumn')
  .then(function (response) {

    
if(document.getElementById("board").childNodes.length > 0){
  var el=document.createElement("div");
  el.innerHTML=response.data;
  
  document.getElementById("board").appendChild(el);
let id=el.getElementsByClassName('add_new_card')[0].id;
let col_id=id.replace('add_new_card_','');
var but=el.getElementsByClassName('add_new_card')[0];
but.addEventListener('click', function(){
  axios.get('/addcard?col='+parseInt(col_id))
  .then(function (response) {
   
if(document.getElementById("col_content_"+col_id).childNodes.length > 0){
  document.getElementById("col_content_"+col_id).innerHTML=document.getElementById("col_content_"+col_id).innerHTML.concat(response.data)
}
else{
  document.getElementById("col_content_"+col_id).innerHTML=response.data
}

  })
  .catch(function (error) {
    alert('failed to add column, pls check your internet connect!')
    console.log(error);
  })
  .then(function () {
   
  });

});

}
else{
  document.getElementById("board").innerHTML=response.data;
}

  })
  .catch(function (error) {
    alert('failed to add column, pls check your internet connect!')
    console.log(error);
  })
  .then(function () {
   
  });

//end et

    },
    add_card: function (col_id) {
   
// Make a request to add card to column

axios.get('/addcard?col='+col_id)
  .then(function (response) {
   
if(document.getElementById("col_content_"+col_id).childNodes.length > 0){
  document.getElementById("col_content_"+col_id).innerHTML=document.getElementById("col_content_"+col_id).innerHTML.concat(response.data)
}
else{
  document.getElementById("col_content_"+col_id).innerHTML=response.data
}

  })
  .catch(function (error) {
    alert('failed to add column, pls check your internet connect!')
    console.log(error);
  })
  .then(function () {
   
  });

//end et

    }

  }
})

var move_card=(card_id,dir)=>{
   //check if card is movable
let board=document.getElementById("board");
let card=document.getElementById("card_"+card_id);
let parent=null;
col=document.getElementsByClassName('col_main');
for (let i = 0; i < col.length; i++) {
  if(col[i].contains(card)){
parent=col[i];
break;
  }
}

let cont=parent.getElementsByClassName("col_content")[0];

if(dir==='up'){
let first_el=cont.firstElementChild;
if(card===first_el){
alert("Sorry, this card cannot be moved in this direction any further.");
return
}

}
else if(dir==='down'){
let last_el=cont.lastElementChild;
if(card===last_el){
alert("Sorry, this card cannot be moved in this direction any further.");
return
}
}
else if(dir==='right'){
let last_col=board.lastElementChild;
if(parent===last_col){
  alert("Sorry, this card cannot be moved in this direction any further.");
}
}
else if(dir==='left'){
let first_col=board.firstElementChild;
if(parent===first_col){
  alert("Sorry, this card cannot be moved in this direction any further.");
}
}
return
      // Make a request to add card to column
      axios.get('/movecard?card_id='+col_id+"&dir="+dir)
        .then(function (response) {
         
      if(document.getElementById("col_content_"+col_id).childNodes.length > 0){
        document.getElementById("col_content_"+col_id).innerHTML=document.getElementById("col_content_"+col_id).innerHTML.concat(response.data)
      }
      else{
        document.getElementById("col_content_"+col_id).innerHTML=response.data
      }
      
        })
        .catch(function (error) {
          alert('failed to add column, pls check your internet connect!')
          console.log(error);
        })
        .then(function () {
         
        });
      
      //end et
}