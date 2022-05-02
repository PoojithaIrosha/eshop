// Change View Function
function changeView() {
  const signUpBox = document.getElementById("signUpBox");
  const signInBox = document.getElementById("signInBox");

  signUpBox.classList.toggle("d-none");
  signInBox.classList.toggle("d-none");
}

// Sign Up Function
function signUp() {
  const fname = document.getElementById("fname");
  const lname = document.getElementById("lname");
  const email = document.getElementById("email");
  const password = document.getElementById("password");
  const mobile = document.getElementById("mobile");
  const gender = document.getElementById("gender");

  // alert(fname.value);
  // alert(lname.value);
  // alert(email.value);
  // alert(password.value);
  // alert(mobile.value);
  // alert(gender.value);

  let form = new FormData();
  form.append("fname", fname.value);
  form.append("lname", lname.value);
  form.append("email", email.value);
  form.append("password", password.value);
  form.append("mobile", mobile.value);
  form.append("gender", gender.value);

  let r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState === 4) {
      let t = r.responseText;
      // alert(t);
      if (t === "success") {
        fname.value = "";
        lname.value = "";
        email.value = "";
        password.value = "";
        mobile.value = "";
        gender.value = 1;
        document.getElementById("msg").innerHTML = "";
        changeView();
      } else {
        document.getElementById("msg").innerHTML = t;
      }
    }
  };

  r.open("POST", "SignUpProcess.php", true);
  r.send(form);
}

function signIn() {
  const email = document.getElementById("email2");
  const password = document.getElementById("password2");
  const rememberMe = document.getElementById("rememberMe");

  let form = new FormData();
  form.append("email", email.value);
  form.append("password", password.value);
  form.append("rememberMe", rememberMe.checked);

  let r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      let t = r.responseText;
      if (t == "success") {
        window.location = "index.php";
      } else {
        document.getElementById("msg2").innerHTML = t;
      }
    }
  };

  r.open("POST", "SignInProcess.php", true);
  r.send(form);
}

let bm;

function forgotpassword() {
  let email = document.getElementById("email2");

  let r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState === 4) {
      let t = r.responseText;
      if (t === "success") {
        alert("Verification Code Sent to your Email. Please check the inbox.");
        let m = document.getElementById("forgotPasswordModal");
        bm = new bootstrap.Modal(m);
        bm.show();
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "ForgotPasswordProcess.php?e=" + email.value, true);
  r.send();
}

function showPassword1() {
  let np = document.getElementById("np");
  let npb = document.getElementById("npb");

  if (npb.innerHTML == "Show") {
    np.type = "text";
    npb.innerHTML = "Hide";
  } else {
    np.type = "password";
    npb.innerHTML = "Show";
  }
}

function showPassword2() {
  let rnp = document.getElementById("rnp");
  let rnpb = document.getElementById("rnpb");

  if (rnpb.innerHTML === "Show") {
    rnp.type = "text";
    rnpb.innerHTML = "Hide";
  } else {
    rnp.type = "password";
    rnpb.innerHTML = "Show";
  }
}

function resetPassword() {
  let e = document.getElementById("email2");
  let np = document.getElementById("np");
  let rnp = document.getElementById("rnp");
  let vc = document.getElementById("vc");

  let form = new FormData();

  form.append("e", e.value);
  form.append("np", np.value);
  form.append("rnp", rnp.value);
  form.append("vc", vc.value);

  let r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState === 4) {
      const t = r.responseText;
      if (t === "success") {
        alert("Password reset success.");
        bm.hide();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "resetPassword.php", true);
  r.send(form);
}

function signOut() {
  let result = confirm("Are you sure you want to sign out?");
  if (result) {
    let r = new XMLHttpRequest();
    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        let t = r.responseText;
        if (t == "success") {
          window.location = "index.php";
        }
      }
    };
    r.open("GET", "SignOutProcess.php", true);
    r.send();
  }


}

function changeImage() {
  let image = document.getElementById("profileimg"); // file chooser
  let prev = document.getElementById("prev0"); // image tag

  image.onchange = function () {
    let file0 = this.files[0];
    let url0 = window.URL.createObjectURL(file0);

    prev.src = url0;
  };
}

function showConfirmModal() {
  let bm = new bootstrap.Modal(document.getElementById("myModal"));
  bm.show();
}

function updateProfile() {
  let fname = document.getElementById("fname");
  let lname = document.getElementById("lname");
  let mobile = document.getElementById("mobile");
  let addressline1 = document.getElementById("addline1");
  let addressline2 = document.getElementById("addline2");
  let city = document.getElementById("usercity");
  let image = document.getElementById("profileimg"); // file chooser

  let form = new FormData();
  form.append("f", fname.value);
  form.append("l", lname.value);
  form.append("m", mobile.value);
  form.append("a1", addressline1.value);
  form.append("a2", addressline2.value);
  form.append("c", city.value);
  form.append("i", image.files[0]);

  let r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      let text = r.responseText;
      alert(text);
    }
  };

  r.open("POST", "updateProfileProcess.php", true);
  r.send(form);
}

function changeProductImg() {
  let image = document.getElementById("imageUploader");
  let view1 = document.getElementById("prev1");
  let view2 = document.getElementById("prev2");
  let view3 = document.getElementById("prev3");

  image.onchange = function () {
    if (this.files.length == 1) {
      let file1 = this.files[0];
      let url1 = window.URL.createObjectURL(file1);
      view1.src = url1;
      view2.src = "resources/addproductimg.svg";
      view3.src = "resources/addproductimg.svg";
    } else if (this.files.length == 2) {
      let file1 = this.files[0];
      let file2 = this.files[1];
      let url1 = window.URL.createObjectURL(file1);
      let url2 = window.URL.createObjectURL(file2);
      view1.src = url1;
      view2.src = url2;
      view3.src = "resources/addproductimg.svg";
    } else if (this.files.length == 3) {
      let file1 = this.files[0];
      let file2 = this.files[1];
      let file3 = this.files[2];

      let url1 = window.URL.createObjectURL(file1);
      let url2 = window.URL.createObjectURL(file2);
      let url3 = window.URL.createObjectURL(file3);

      view1.src = url1;
      view2.src = url2;
      view3.src = url3;
    }
  };
}

function addProduct() {
  let category = document.getElementById("ca");
  let brand = document.getElementById("br");
  let model = document.getElementById("mo");
  let title = document.getElementById("ti");

  let condition;
  if (document.getElementById("bn").checked) {
    condition = 1;
  } else if (document.getElementById("us").checked) {
    condition = 2;
  }

  let color;
  if (document.getElementById("clr1").checked) {
    color = 1;
  } else if (document.getElementById("clr2").checked) {
    color = 2;
  } else if (document.getElementById("clr3").checked) {
    color = 3;
  } else if (document.getElementById("clr4").checked) {
    color = 4;
  } else if (document.getElementById("clr5").checked) {
    color = 5;
  } else if (document.getElementById("clr6").checked) {
    color = 6;
  }

  let qty = document.getElementById("qty");
  let price = document.getElementById("cost");
  let delivery_within_colombo = document.getElementById("dwc");
  let delivery_out_of_colombo = document.getElementById("doc");
  let description = document.getElementById("desc");
  let image = document.getElementById("imageUploader");

  let f = new FormData();

  f.append("c", category.value);
  f.append("b", brand.value);
  f.append("m", model.value);
  f.append("t", title.value);
  f.append("co", condition);
  f.append("col", color);
  f.append("qty", qty.value);
  f.append("p", price.value);
  f.append("dwc", delivery_within_colombo.value);
  f.append("doc", delivery_out_of_colombo.value);
  f.append("desc", description.value);
  f.append("img1", image.files[0]);
  f.append("img2", image.files[1]);
  f.append("img3", image.files[2]);

  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      let text = request.responseText;
      if (text == "success") {
        alert("Product Listed Successfully!");

        // Clear Input Fields
        category.value = 0;
        brand.value = 0;
        model.value = 0;
        title.value = "";
        document.getElementById("bn").checked = true;
        document.getElementById("clr1").checked = true;
        qty.value = 0;
        price.value = "";
        delivery_out_of_colombo.value = "";
        delivery_within_colombo.value = "";
        description.value = "";
        document.getElementById("prev1").src = "resources/addproductimg.svg";
        document.getElementById("prev2").src = "resources/addproductimg.svg";
        document.getElementById("prev3").src = "resources/addproductimg.svg";
      } else {
        alert(text);
      }
    }
  };

  request.open("POST", "addProductProcess.php", true);
  request.send(f);
}

function changeStatus(id) {
  let productId = id;
  let statusChange = document.getElementById("flexSwitchCheckChecked");
  let statusLabel = document.getElementById("checkLabel" + productId);

  let status;

  if (statusChange.checked) {
    status = 1;
  } else {
    status = 0;
  }

  let r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      let text = r.responseText;

      if (text == "Deactivated") {
        statusLabel.innerHTML = "Make your product Active";
      } else {
        statusLabel.innerHTML = "Make your product Deactive";
      }
    }
  };

  r.open(
    "GET",
    "statusChangeProcess.php?p=" + productId + "&s=" + status,
    true
  );
  r.send();
}

function addFilters(page) {
  let search = document.getElementById("s");

  let age;
  if (document.getElementById("n").checked) {
    age = 1;
  } else if (document.getElementById("o").checked) {
    age = 2;
  } else {
    age = 0;
  }

  let qty;
  if (document.getElementById("l").checked) {
    qty = 1;
  } else if (document.getElementById("h").checked) {
    qty = 2;
  } else {
    qty = 0;
  }

  let condition;
  if (document.getElementById("b").checked) {
    condition = 1;
  } else if (document.getElementById("u").checked) {
    condition = 2;
  } else {
    condition = 0;
  }

  let form = new FormData();
  form.append("s", search.value);
  form.append("a", age);
  form.append("q", qty);
  form.append("c", condition);
  form.append("page", page);

  let r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      let t = r.responseText;
      document.getElementById("sort").innerHTML = t;
    }
  };

  r.open("POST", "sortProcess.php", true);
  r.send(form);
}

function clearFilters() {
  window.location = "myProducts.php";
}

function sendId(id) {
  let id1 = id;

  let r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      let t = r.responseText;
      if (t == "success") {
        window.location = "updateProduct.php";
      }
    }
  };

  r.open("GET", "sendProductProcess.php?id=" + id1, true);
  r.send();
}

function updateProduct() {
  let title = document.getElementById("ti");
  let qty = document.getElementById("qty");
  let cost = document.getElementById("cost");
  let delivery_within_colombo = document.getElementById("dwc");
  let delivery_out_of_colombo = document.getElementById("doc");
  let description = document.getElementById("desc");
  let image = document.getElementById("imageUploader");

  let form = new FormData();
  form.append("t", title.value);
  form.append("qty", qty.value);
  form.append("c", cost.value);
  form.append("dwc", delivery_within_colombo.value);
  form.append("doc", delivery_out_of_colombo.value);
  form.append("desc", description.value);
  form.append("i1", image.files[0]);
  form.append("i2", image.files[1]);
  form.append("i3", image.files[2]);

  let r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      let t = r.responseText;
      alert(t);
    }
  };
  r.open("POST", "updateProcess.php", true);
  r.send(form);
}

// Advanced Search
function advancedSearch(x) {
  let searchtxt = document.getElementById("s1");
  let category = document.getElementById("ca1");
  let brand = document.getElementById("br1");
  let model = document.getElementById("mo1");
  let condition = document.getElementById("co1");
  let colour = document.getElementById("col1");
  let priceFrom = document.getElementById("pf1");
  let priceTo = document.getElementById("pt1");

  let form = new FormData();
  form.append("s", searchtxt.value);
  form.append("ca", category.value);
  form.append("b", brand.value);
  form.append("m", model.value);
  form.append("con", condition.value);
  form.append("col", colour.value);
  form.append("pf", priceFrom.value);
  form.append("pt", priceTo.value);
  form.append("page", x);

  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      let text = request.responseText;
      let results = (document.getElementById("results").innerHTML = text);
    }
  };
  request.open("POST", "advancedSearchProcess.php", true);
  request.send(form);
}

// Basic Search
function basicSearch(x) {
  let searchText = document.getElementById("basic_search_txt").value;
  let searchSelect = document.getElementById("basic_search_select").value;

  let form = new FormData();
  form.append("st", searchText);
  form.append("ss", searchSelect);
  form.append("page", x);

  let r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      let t = r.responseText;
      document.getElementById("basicSearchResult").innerHTML = t;
    }
  };
  r.open("POST", "basicSearchProcess.php", true);
  r.send(form);
}
// Basic Search

function loadmainimg(id) {
  let pid = id;
  let img = document.getElementById("pimg" + pid).src;
  let mainimg = document.getElementById("mainimg");

  mainimg.style.backgroundImage = "url(" + img + ")";
}

function qty_inc(qty) {
  let qty1 = qty;
  let input = document.getElementById("qtyinput");

  if (input.value < qty1) {
    let newvalue = parseInt(input.value) + 1;
    input.value = newvalue.toString();
  } else {
    alert("Maximum Quantity has Achieved");
  }
}

function qty_dec() {
  let input = document.getElementById("qtyinput");

  if (input.value > 1) {
    let newvalue = parseInt(input.value) - 1;
    input.value = newvalue.toString();
  } else {
    alert("Minimum Quantity has Achieved");
  }
}

function check_val(qty) {
  let input = document.getElementById("qtyinput");

  if (input.value > qty) {
    alert("Insufficient Quantity");
    input.value = qty;
  }
}

// Watchlist
function addToWatchlist(id) {
  let wid = id;

  let r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      let t = r.responseText;
      if (t == "success") {
        let icon = document.getElementById("heart" + id);

        icon.classList.add("text-danger");
        icon.classList.remove("text-white");
      } else if (t == "success2") {
        let icon = document.getElementById("heart" + id);

        icon.classList.remove("text-danger");
        icon.classList.add("text-white");
      } else {
        alert(t);
      }
    }
  };
  r.open("GET", "addToWatchlistProcess.php?id=" + wid, true);
  r.send();
}

function deleteFromWatchlist(id) {
  let pid = id;

  let r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      let t = r.responseText;
      if (t == "success") {
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };
  r.open("GET", "deleteWatchlistProcess.php?id=" + pid, true);
  r.send();
}

function basicSearchWatchlist() {
  let watchlistSearch = document.getElementById("watchlistSearch");

  let f = new FormData();
  f.append("txt", watchlistSearch.value);

  let r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      let t = r.responseText;
      // console.log(t);
      document.getElementById("results").innerHTML = t;
    }
  };
  r.open("POST", "basicSearchWatchlist.php", true);
  r.send(f);
}
// Watchlist

// Cart
function addToCart(id) {
  let r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      let t = r.responseText;
      if (t == "Please sign in first.") {
        alert(t);
        window.location = "signInSignUp.php";
      } else {
        alert(t);
      }
    }
  };
  r.open("GET", "addToCartProcess.php?id=" + id, true);
  r.send();
}

function deleteFromCart(id) {
  let c = confirm("Are you sure to delete this product from cart?");
  if (c) {
    let r = new XMLHttpRequest();
    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        let t = r.responseText;
        if (t == "success") {
          // alert("Product Added to the Recents Successfully.");
          alert("Product Removed from the Cart Successfully.");

          window.location.reload();
        } else {
          alert(t);
        }
      }
    };

    r.open("GET", "removeCartProcess.php?id=" + id, true);
    r.send();
  }
}

function basicSearchCart() {
  let input = document.getElementById("cartSearchInput");

  let f = new FormData();
  f.append("input", input.value);

  let r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      let t = r.responseText;
      // document.getElementById("cart_results").innerHTML = "";
      document.getElementById("cart_results").innerHTML = t;
    }
  };
  r.open("POST", "basicSearchCartProcess.php", true);
  r.send(f);
}
// Cart

// INVOICE

function printInvoice() {
  let restorePage = document.body.innerHTML;
  let page = document.getElementById("page").innerHTML;
  document.body.innerHTML = page;
  window.print();
  document.body.innerHTML = restorePage;
}
