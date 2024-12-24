var TxtType = function(el, toRotate, period) {
    this.toRotate = toRotate;
    this.el = el;
    this.loopNum = 0;
    this.period = parseInt(period, 10) || 2000;
    this.txt = '';
    this.tick();
    this.isDeleting = false;
};

TxtType.prototype.tick = function() {
    var i = this.loopNum % this.toRotate.length;
    var fullTxt = this.toRotate[i];

    if (this.isDeleting) {
    this.txt = fullTxt.substring(0, this.txt.length - 1);
    } else {
    this.txt = fullTxt.substring(0, this.txt.length + 1);
    }

    this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

    var that = this;
    var delta = 200 - Math.random() * 100;

    if (this.isDeleting) { delta /= 2; }

    if (!this.isDeleting && this.txt === fullTxt) {
    delta = this.period;
    this.isDeleting = true;
    } else if (this.isDeleting && this.txt === '') {
    this.isDeleting = false;
    this.loopNum++;
    delta = 500;
    }

    setTimeout(function() {
    that.tick();
    }, delta);
};

window.onload = function() {
    var elements = document.getElementsByClassName('typewrite');
    for (var i=0; i<elements.length; i++) {
        var toRotate = elements[i].getAttribute('data-type');
        var period = elements[i].getAttribute('data-period');
        if (toRotate) {
          new TxtType(elements[i], JSON.parse(toRotate), period);
        }
    }
    // INJECT CSS
    var css = document.createElement("style");
    css.type = "text/css";
    css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
    document.body.appendChild(css);
};


document.getElementById("loginbtn").addEventListener("click", function() {
    // Redirect to a certain page
    window.location.href = "login.html";
  });

  document.getElementById("createAcc").addEventListener("click", function() {
    // Redirect to a certain page
    window.location.href = "CreateAcc.html";
  });
  document.getElementById("Complaint").addEventListener("click", function() {
    // Redirect to a certain page
    window.location.href = "Complaint.html";
  });
  function food_services(){
    // Redirect to a certain page
    window.location.href = "food-services.html";
  }
  function other_services(){
    // Redirect to a certain page
    window.location.href = "other-services.html";
  }
  function validateForm() {
    // Get form input values
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var message = document.getElementById('message').value;
    var containsNumber = /\d/.test(name);
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    // Check if name is empty
    if (name === '') {
      alert('Please enter your name');
      return false; // Prevent form submission
    }
    if (containsNumber) {
      alert('Name cannot contain numbers');
      return false; // Prevent form submission
    }
    // Check if email is empty or invalid
    if (email === '') {
      alert('Please enter your email');
      return false; // Prevent form submission
    } else if (!validateEmail(email)) {
      alert('Please enter a valid email address');
      return false; // Prevent form submission
    }
    if (!emailRegex.test(email)) {
      alert('Please enter a valid email address');
      return false; // Prevent form submission
    }
    // Check if message is empty
    if (message === '') {
      alert('Please enter your message');
      return false; // Prevent form submission
    }
    
    // If all validation passed, allow form submission
    return true;
  }