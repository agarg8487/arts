function validateEmail(email) {
    var re_mail = /^[a-zA-Z0-9_\.]+@[a-zA-Z]+\.[a-zA-Z]+(\.[a-zA-Z]+)*$/;
    return re_mail.test(email);
}
function validatePhone(phone) {
    var re_phone = /^(\+91|0)[3|5|7|8|9][1-9]\d{8}$/;
    return re_phone.test(phone);
}
function check_name(name) {
    var message_name="";
    if (name.value==="") {
        name.style.border='1px solid red';
        message_name="Please enter your name !";
        document.getElementById('message_name').innerHTML=message_name;
        return 0;
    } else if (name.value.length<3) {
        name.style.border='1px solid red';
        message_name="Please enter your full name !";
        document.getElementById('message_name').innerHTML=message_name;
        return 0;
    } else {
        name.style.border='1px solid green';
        message_name="";
        document.getElementById('message_name').innerHTML=message_name;
        return true;
    }
}
function check_email(mail) {
    var message_mail="";
    if (mail.value==="") {
        mail.style.border='1px solid red';
        message_mail="Please enter your Email !";
        document.getElementById('message_mail').innerHTML=message_mail;
        return 0;
    } else if (!validateEmail(mail.value)) {
        mail.style.border='1px solid red';
        message_mail="Email invalid !";
        document.getElementById('message_mail').innerHTML=message_mail;
        return 0;
    } else {
        mail.style.border='1px solid green';
        message_mail="";
        document.getElementById('message_mail').innerHTML=message_mail;
        return 1;
    }
}
function check_age(age) {
    var message_age="";
    if (age.value==="") {
        age.style.border='1px solid red';
        message_age="Please enter your age !";
        document.getElementById('message_age').innerHTML=message_age;
        return 0;
    } else {
        age.style.border='1px solid green';
        message_age="";
        document.getElementById('message_age').innerHTML=message_age;
        return 1
    }
}

function check_gender(gender) {
    var message_gender="";
    if (gender.value==="") {
        gender.style.border='1px solid red';
        message_gender="Please enter your gender !";
        document.getElementById('message_gender').innerHTML=message_gender;
        return 0;
    } else {
        gender.style.border='1px solid green';
        message_gender="";
        document.getElementById('message_gender').innerHTML=message_gender;
        return 1;
    }
}
function check_zipcode(zipcode) {
    var message_zipcode="";
    if (zipcode.value==="") {
        zipcode.style.border='1px solid red';
        message_zipcode="Please enter your Zipcode !";
        document.getElementById('message_zipcode').innerHTML=message_zipcode;
        return 0;
    } else {
        zipcode.style.border='1px solid green';
        message_zipcode="";
        document.getElementById('message_zipcode').innerHTML=message_zipcode;
        return 1;
    }
}
function check_phone(phone) {
    var message_phone="";
    if (phone.value==="") {
        phone.style.border='1px solid red';
        message_phone="Please enter your phone number !";
        document.getElementById('message_phone').innerHTML=message_phone;
        return 0;
    } else if (!validatePhone(phone.value)) {
        phone.style.border='1px solid red';
        message_phone="Number phone invalid !";
        document.getElementById('message_phone').innerHTML=message_phone;
        return 0;
    } else {
        phone.style.border='1px solid green';
        message_phone="";
        document.getElementById('message_phone').innerHTML=message_phone;
        return 1;
    }
}
function check_password(password) {
    var message_password="";
    if (password.value==="") {
        password.style.border='1px solid red';
        message_password="Please enter your password !";
        document.getElementById('message_password').innerHTML=message_password;
        return 0;
    } 
	else if (password.value.length < 0) {
        password.style.border='1px solid red';
        message_password="Passwords must be at least 8 characters long";
        document.getElementById('message_password').innerHTML=message_password;
        return 0;
    } 
	else {
        password.style.border='1px solid green';
        message_password="";
        document.getElementById('message_password').innerHTML=message_password;
        return 1;
    }
}

function check(){ 
    var name = document.getElementById('name');
    var email = document.getElementById('email');
    var age = document.getElementById('age');
    var phone = document.getElementById('phone');
    var gender = document.getElementById('gender');
    var password = document.getElementById('password');
    var zipcode = document.getElementById('zipcode');
	var register= 1;
    check_name(name);
    if (check_name(name)==0) {
        return false;
    };
    check_email(email);
    if (check_email(email)==0) {
        return false ;
    };
    check_age(age);
    if (check_age(age)==0) {
        return false;
    };
    
    check_gender(gender);
    if (check_gender(gender)==0) {
        return false;
    };
	check_zipcode(zipcode);
    if (check_zipcode(zipcode)==0) {
        return false;
    };
	check_phone(phone);
    if (check_phone(phone)==0) {
        return false;
    };
    check_password(password);
    if (check_password(password)==0) {
        return false;
    };
}