function increment() { 
    const quantity_button = document.getElementById("num-of-items");
    var value = parseInt(document.getElementById("num-of-items").textContent);
    quantity_button.textContent = String(value + 1);
}

function decrement() { 
    const quantity_button = document.getElementById("num-of-items");
    var value = parseInt(document.getElementById("num-of-items").textContent);
    if (value>1) {
        quantity_button.textContent = String(value -1);        
    }
}

function add_to_cart() {
    const cart = document.getElementById("cart-counter")
    var value = parseInt(document.getElementById("num-of-items").textContent)
    cart.textContent = value

}

function increase_counter() {
    const counter = document.getElementById("review_counter");
    const textArea = document.getElementById("review-txt");
    const string = String(textArea.value);
    const string_length = string.length;
    counter.innerHTML = String(string_length) + " / 500";

    if (string_length > 0){
        document.querySelector("#error_msg").style.display ='none';
    }
}

function add_cart_index(x){
    const cart = document.getElementById("cart-counter");
    var value = parseInt(document.getElementById("cart-counter").textContent) ;
    console.log(value);
    cart.textContent= value+1;
    Add_item_row(products[x-1].name,products[x-1].price)
}

function submit_review_form(){
    const counter = document.getElementById("review_counter");

    if(counter.innerText.slice(0, 1) == 0) {
        document.querySelector("#error_msg").style.display = 'block';
        return false
    }else {
        const name = document.getElementsByClassName("txt-area")[0]
        if(name.value == ""){
            name.value = "Customer";
        }
        // window.location.href=window.location.href;
        return true;
    }

}

function add_review(){
    const form = document.getElementById("disappearing-form");
    form.classList.add('show-form')
    form.classList.remove('hide')
    form.classList.remove('hide-form')

}

let products = [
    {
      name:'Best Sandwich',
      price: 23.9
    },
    {
      name:'Burger',
      price: 25.9
    },
    {
      name:'burger Meal',
      price: 27.5
    },
    {
      name:'Best Deal Meal',
      price: 32.9
    },
    {
      name:'Chicken Burger',
      price: 19.4
    },
    {
      name:'Pizza',
      price: 28.5
    }
        ];


        
function Add_item_row(n,p){
    var cartRow = document.createElement('div')
    cartRow.classList.add('cart-row')
    var body =  document.getElementById("modal-body")
    var price =parseInt(document.getElementById("modal-price").textContent)
    price+=p;
    document.getElementById("cart-total").remove();
    
    var html = ` <div class="row">
    <div class="col-md-6 col-sm-6" >
    ${n}
    </div>
    <div class="col-md-6 col-sm-6">
    ${p}
    </div>
  </div> `


  body.innerHTML += html

  body.innerHTML += ` <div id="cart-total" class="row">
  <div class="col-md-6 col-sm-6">
    Total
  </div>
  <div id="modal-price" class="col-md-6 col-sm-6">
  ${price}
  </div>
</div>`
    
}


function Order_now(){
    var body =  document.getElementById("modal-body")
    var counter =  document.getElementById("cart-counter")
   counter.textContent = 0
    body.innerHTML = `<div class="row">
    <div class="col-md-6 col-sm-6">
      Item
    </div>
    <div class="col-md-6 col-sm-6">
      Price
    </div>
  </div>                  

  <div id="cart-total" class="row">
    <div class="col-md-6 col-sm-6">
      Total
    </div>
    <div id="modal-price" class="col-md-6 col-sm-6">
      0
    </div>
  </div>`
  
}

function showReview(id) {
  fetch(`php/review.php?id=${id}`)
      .then(response => response.json())
      .then(data => {

          if (data.length == 0) {
              document.getElementById('reviewTitle').textContent = "No Reviews";
          }

          else {
              document.getElementById('reviewTitle').textContent = "Reviews";

              element = document.getElementsByClassName('carousel-indicators')[0];
              element.innerHTML = '';
              let i = 0;
              for (const review of data) {
                  element.innerHTML = element.innerHTML + `<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="${i}" class="active" aria-current="true" aria-label="Slide 1"></button>`
                  i++;
              }

              element3 = document.getElementsByClassName('carousel-inner')[0];
              element3.innerHTML = '';
              i = 0;
              for (const review of data) {
                  var stars='';
                  for(let i = 0; i < review.rating; i++){
                      stars+='&#11088 ';
                  }
                  element3.innerHTML = element3.innerHTML +
                      `<div class="carousel-item ${i == 0 ? 'active' : ''}">
                          <div class="row">
                              <img src="php/reviewImages/${review.image}" class="col-md-12 col-sm-12 col-lg-6 col-xl-6 col-xxl-6 " />
                              <div class=" review2 col-md-12 col-sm-12 col-lg-6 col-xl-6 col-xxl-6 align-self-center">
                                  <h4>${review.reviewer_name}</h4>
                                  <h5>${review.city}  ${review.date} ${stars} </h5>
                                  <p>${review.review}</p>
                              </div>
                          </div>
                      </div>`

                  i++;

              }

              element3 = document.getElementsByClassName('carousel-inner')[0];

              if (element3.innerHTML == '') {

                  element2 = document.getElementById('carouselExampleIndicators');
                  element2.innerHTML = element2.innerHTML + `<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
  </button>
  
`
              }
          }
      });

}

function showDescriptionTable (){
  documnet.getElementById("table-pill").style = "background: none";
  document.getElementById("review-pill").style = "background: #ffaa00"
  const table = document.getElementById("description-table");
  const review = document.getElementById("Review-section");

  table.style.display = "block";
  review.style.display = "none";
}

function submitFunction(id) {

  var ok = submit_review_form();

  if(ok){
  let formData = new FormData( document.getElementById("disappearing-form") );
  formData.append('id', id);


  fetch(`php/review.php`, {
      method: 'POST',
      body: formData
      
  })
  .then(response => response.json())
  .then(data => {
    const form = document.getElementById("disappearing-form");
    form.classList.remove('show-form')
    form.classList.add('hide')
    form.classList.add('hide-form');
      showReview(id);
  });

  }

}
