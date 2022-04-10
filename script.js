// Change View Function
function changeView() {
  var signUpBox = document.getElementById("signUpBox");
  var signInBox = document.getElementById("signInBox");

  signUpBox.classList.toggle("d-none");
  signInBox.classList.toggle("d-none");
}

// Sign Up Function
function signUp() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var email = document.getElementById("email");
  var password = document.getElementById("password");
  var mobile = document.getElementById("mobile");
  var gender = document.getElementById("gender");

  // alert(fname.value);
  // alert(lname.value);
  // alert(email.value);
  // alert(password.value);
  // alert(mobile.value);
  // alert(gender.value);

  var form = new FormData();
  form.append("fname", fname.value);
  form.append("lname", lname.value);
  form.append("email", email.value);
  form.append("password", password.value);
  form.append("mobile", mobile.value);
  form.append("gender", gender.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      // alert(t);
      if (t == "success") {
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
  var email = document.getElementById("email2");
  var password = document.getElementById("password2");
  var rememberMe = document.getElementById("rememberMe");

  var form = new FormData();
  form.append("email", email.value);
  form.append("password", password.value);
  form.append("rememberMe", rememberMe.checked);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
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

var bm;

function forgotpassword() {
  var email = document.getElementById("email2");

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        alert("Verification Code Sent to your Email. Please check the inbox.");
        var m = document.getElementById("forgotPasswordModal");
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
  var np = document.getElementById("np");
  var npb = document.getElementById("npb");

  if (npb.innerHTML == "Show") {
    np.type = "text";
    npb.innerHTML = "Hide";
  } else {
    np.type = "password";
    npb.innerHTML = "Show";
  }
}

function showPassword2() {
  var rnp = document.getElementById("rnp");
  var rnpb = document.getElementById("rnpb");

  if (rnpb.innerHTML == "Show") {
    rnp.type = "text";
    rnpb.innerHTML = "Hide";
  } else {
    rnp.type = "password";
    rnpb.innerHTML = "Show";
  }
}

function resetPassword() {
  var e = document.getElementById("email2");
  var np = document.getElementById("np");
  var rnp = document.getElementById("rnp");
  var vc = document.getElementById("vc");

  var form = new FormData();

  form.append("e", e.value);
  form.append("np", np.value);
  form.append("rnp", rnp.value);
  form.append("vc", vc.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
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
  var result = confirm("Are you sure you want to sign out?");
  if (result) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        var t = r.responseText;
        if (t == "success") {
          window.location = "index.php";
        }
      }
    };
  }

  r.open("GET", "SignOutProcess.php", true);
  r.send();
}

function changeImage() {
  var image = document.getElementById("profileimg"); // file chooser
  var prev = document.getElementById("prev0"); // image tag

  image.onchange = function () {
    var file0 = this.files[0];
    var url0 = window.URL.createObjectURL(file0);

    prev.src = url0;
  };
}

function showConfirmModal() {
  var bm = new bootstrap.Modal(document.getElementById("myModal"));
  bm.show();
}

function updateProfile() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var mobile = document.getElementById("mobile");
  var addressline1 = document.getElementById("addline1");
  var addressline2 = document.getElementById("addline2");
  var city = document.getElementById("usercity");
  var image = document.getElementById("profileimg"); // file chooser

  var form = new FormData();
  form.append("f", fname.value);
  form.append("l", lname.value);
  form.append("m", mobile.value);
  form.append("a1", addressline1.value);
  form.append("a2", addressline2.value);
  form.append("c", city.value);
  form.append("i", image.files[0]);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;
      alert(text);
    }
  };

  r.open("POST", "updateProfileProcess.php", true);
  r.send(form);
}

function changeProductImg() {
  var image = document.getElementById("imageUploader");
  var view1 = document.getElementById("prev1");
  var view2 = document.getElementById("prev2");
  var view3 = document.getElementById("prev3");

  image.onchange = function () {
    if (this.files.length == 1) {
      var file1 = this.files[0];
      var url1 = window.URL.createObjectURL(file1);
      view1.src = url1;
      view2.src = "resources/addproductimg.svg";
      view3.src = "resources/addproductimg.svg";
    } else if (this.files.length == 2) {
      var file1 = this.files[0];
      var file2 = this.files[1];
      var url1 = window.URL.createObjectURL(file1);
      var url2 = window.URL.createObjectURL(file2);
      view1.src = url1;
      view2.src = url2;
      view3.src = "resources/addproductimg.svg";
    } else if (this.files.length == 3) {
      var file1 = this.files[0];
      var file2 = this.files[1];
      var file3 = this.files[2];

      var url1 = window.URL.createObjectURL(file1);
      var url2 = window.URL.createObjectURL(file2);
      var url3 = window.URL.createObjectURL(file3);

      view1.src = url1;
      view2.src = url2;
      view3.src = url3;
    }
  };
}

function addProduct() {
  var category = document.getElementById("ca");
  var brand = document.getElementById("br");
  var model = document.getElementById("mo");
  var title = document.getElementById("ti");

  var condition;
  if (document.getElementById("bn").checked) {
    condition = 1;
  } else if (document.getElementById("us").checked) {
    condition = 2;
  }

  var color;
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

  var qty = document.getElementById("qty");
  var price = document.getElementById("cost");
  var delivery_within_colombo = document.getElementById("dwc");
  var delivery_out_of_colombo = document.getElementById("doc");
  var description = document.getElementById("desc");
  var image = document.getElementById("imageUploader");

  var f = new FormData();

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

  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
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
  var productId = id;
  var statusChange = document.getElementById("flexSwitchCheckChecked");
  var statusLabel = document.getElementById("checkLabel" + productId);

  var status;

  if (statusChange.checked) {
    status = 1;
  } else {
    status = 0;
  }

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

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
  var search = document.getElementById("s");

  var age;
  if (document.getElementById("n").checked) {
    age = 1;
  } else if (document.getElementById("o").checked) {
    age = 2;
  } else {
    age = 0;
  }

  var qty;
  if (document.getElementById("l").checked) {
    qty = 1;
  } else if (document.getElementById("h").checked) {
    qty = 2;
  } else {
    qty = 0;
  }

  var condition;
  if (document.getElementById("b").checked) {
    condition = 1;
  } else if (document.getElementById("u").checked) {
    condition = 2;
  } else {
    condition = 0;
  }

  var form = new FormData();
  form.append("s", search.value);
  form.append("a", age);
  form.append("q", qty);
  form.append("c", condition);
  form.append("page", page);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
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
  var id1 = id;

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "updateProduct.php";
      }
    }
  };

  r.open("GET", "sendProductProcess.php?id=" + id1, true);
  r.send();
}

function updateProduct() {
  var title = document.getElementById("ti");
  var qty = document.getElementById("qty");
  var cost = document.getElementById("cost");
  var delivery_within_colombo = document.getElementById("dwc");
  var delivery_out_of_colombo = document.getElementById("doc");
  var description = document.getElementById("desc");
  var image = document.getElementById("imageUploader");

  var form = new FormData();
  form.append("t", title.value);
  form.append("qty", qty.value);
  form.append("c", cost.value);
  form.append("dwc", delivery_within_colombo.value);
  form.append("doc", delivery_out_of_colombo.value);
  form.append("desc", description.value);
  form.append("i1", image.files[0]);
  form.append("i2", image.files[1]);
  form.append("i3", image.files[2]);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      alert(t);
    }
  };
  r.open("POST", "updateProcess.php", true);
  r.send(form);
}

// Advanced Search
function advancedSearch(x) {
  var searchtxt = document.getElementById("s1");
  var category = document.getElementById("ca1");
  var brand = document.getElementById("br1");
  var model = document.getElementById("mo1");
  var condition = document.getElementById("co1");
  var colour = document.getElementById("col1");
  var priceFrom = document.getElementById("pf1");
  var priceTo = document.getElementById("pt1");

  var form = new FormData();
  form.append("s", searchtxt.value);
  form.append("ca", category.value);
  form.append("b", brand.value);
  form.append("m", model.value);
  form.append("con", condition.value);
  form.append("col", colour.value);
  form.append("pf", priceFrom.value);
  form.append("pt", priceTo.value);
  form.append("page", x);

  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      var results = (document.getElementById("results").innerHTML = text);
    }
  };
  request.open("POST", "advancedSearchProcess.php", true);
  request.send(form);
}

// Basic Search
function basicSearch(x) {
  var searchText = document.getElementById("basic_search_txt").value;
  var searchSelect = document.getElementById("basic_search_select").value;

  var form = new FormData();
  form.append("st", searchText);
  form.append("ss", searchSelect);
  form.append("page", x);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      document.getElementById("basicSearchResult").innerHTML = t;
    }
  };
  r.open("POST", "basicSearchProcess.php", true);
  r.send(form);
}
// Basic Search

function loadmainimg(id) {
  var pid = id;
  var img = document.getElementById("pimg" + pid).src;
  var mainimg = document.getElementById("mainimg");

  mainimg.style.backgroundImage = "url(" + img + ")";
}

function qty_inc(qty) {
  var qty1 = qty;
  var input = document.getElementById("qtyinput");

  if (input.value < qty1) {
    var newvalue = parseInt(input.value) + 1;
    input.value = newvalue.toString();
  } else {
    alert("Maximum Quantity has Achieved");
  }
}

function qty_dec() {
  var input = document.getElementById("qtyinput");

  if (input.value > 1) {
    var newvalue = parseInt(input.value) - 1;
    input.value = newvalue.toString();
  } else {
    alert("Minimum Quantity has Achieved");
  }
}

function check_val(qty) {
  var input = document.getElementById("qtyinput");

  if (input.value > qty) {
    alert("Insufficient Quantity");
    input.value = qty;
  }
}

// Watchlist
function addToWatchlist(id) {
  var wid = id;

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        var icon = document.getElementById("heart" + id);

        icon.classList.add("text-danger");
        icon.classList.remove("text-white");
      } else if (t == "success2") {
        var icon = document.getElementById("heart" + id);

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
  var pid = id;

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
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
  var watchlistSearch = document.getElementById("watchlistSearch");

  var f = new FormData();
  f.append("txt", watchlistSearch.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
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
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
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
  var c = confirm("Are you sure to delete this product from cart?");
  if (c) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        var t = r.responseText;
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
  var input = document.getElementById("cartSearchInput");

  var f = new FormData();
  f.append("input", input.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
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
  var restorePage = document.body.innerHTML;
  var page = document.getElementById("page").innerHTML;
  document.body.innerHTML = page;
  window.print();
  document.body.innerHTML = restorePage;
}
