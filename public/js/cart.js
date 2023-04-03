$(document).ready(function() {
  // id= document.getElementsByClassName('product_main');
  // Array.from(id).forEach(function (element) {
  //     element.addEventListener('click',(e)=>{
  //         price1 = element.children[3].children[0]; 
  //         price2= price1.innerHTML;  
  //         price3 = price2.substr(2);  
  //         quantity=e.target.value;
          
  //       //   price1.innerHTML=price2 * quantity;
           
  //          console.log(quantity)
  //          console.log(price3)
  //         console.log(price3*quantity)

  //         // total_amount= 
  

  //     })
  // });




id= document.getElementsByClassName('delete_btn');
  Array.from(id).forEach(function (element) {
  
      element.addEventListener('click',(e)=>{
      

        $(document).ready(function() {

 let product_id =e.target.value; 
   if(product_id!=""){
       $.ajax({
           url: "/delete_cart_product",
           type: "POST",
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           data: {   
               type: 1,
               product_id: product_id,
               
           },
           cache: false,
           success: function(dataResult){
             
               var dataResult = JSON.parse(dataResult);
               if(dataResult.statusCode==200){
                if(product_id){
                  $("#"+product_id).attr("style", "display: none !important");
                  $("#"+'hr'+product_id).attr("style", "display: none !important");
                  location.reload(true)
                            }
               }
               else if(dataResult.statusCode==201){
                  alert("Error occured !");
               }
               
           }
       });
   }   
});
});
                })
  
    



        // adding change in quantity in cart table        

        
id= document.getElementsByClassName('quantity_change');
Array.from(id).forEach(function (element) {

    element.addEventListener('change',(e)=>{
    
 $(document).ready(function() {

let quantity =e.target.value; 
let product_id = $(e.target).attr('product_id');
 if(product_id!=""){
     $.ajax({
         url: "/update_quantity",
         type: "POST",
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         data: {   
             type: 1,
             product_id: product_id,
             quantity : quantity
             
         },
         cache: false,
         success: function(dataResult){
                 
              console.log(dataResult)
             var dataResult = JSON.parse(dataResult);
             if(dataResult.statusCode==200){
              location.reload(true)
          
             }
             else if(dataResult.statusCode==201){
                alert("Error occured !");
             }
             
         }
     });
 }   
});
});
              })

  




                
})

